<?php

$file = "LAPORAN_BULANAN_ORCHARD.xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
<table class="table" border="1">
<thead>

                    <?php 
                       $t_pemasukan = 0;
                       ?>
                            
                            <tr>
                                <th class="sticky-top th-atas">Akun</th>
                                <?php foreach ($periode as $key => $value): ?>
                                    <?php $bulan=  date('M-Y', strtotime($value->tgl)) ?>
                                        <th class="sticky-top th-atas"><?= $bulan ?></th>
                                <?php endforeach ?>   
                                <th>Total</th>
                            </tr> 
                            </thead>
                            <tbody>
                            <tr><td style="color: #B7AEF7;"><dt>Pemasukan</dt></td></tr>
                            <?php foreach($akun_pendapatan as $ap): ?>
                                
                            <tr>
                            <td><?= $ap->nm_akun ?></td>
                            <?php foreach($periode as $pd): ?>
                                    <?php 
                                        $month = date('m' , strtotime($pd->tgl));
                                        $year = date('Y' , strtotime($pd->tgl));
                                        $jml = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->get_where('tb_jurnal',[
                                            'tb_akun.id_akun' => $ap->id_akun,
                                            'tb_jurnal.id_buku !=' => 3,
                                            'MONTH(tgl)' => $month,
                                            'YEAR(tgl)' => $year
                                        ])->row();
                                        // $ket = $this->db->get_where(" tb_absen where nm_karyawan = '$kry->nm_kry' and tgl BETWEEN '$dt_c' AND '$dt_a' order by tgl ASC, nm_karyawan ")->result();    
                                    $debit = $jml->debit;
                                    $kredit = $jml->kredit;

                                    $jumlah_p = $kredit - $debit;

                                    if(!$jumlah_p){
                                        $jumlah_p = 0;
                                    }

                                    $t_pemasukan += $jumlah_p;

                                    ?>
                                    <td><?= number_format($jumlah_p,0) ?></td>
                                        
                                    <?php endforeach; ?>
                                    <td></td>      
                            </tr>
                            <?php endforeach ?>

                            <tr>
                            <td style="color: black;"><strong>Total Pemasukan</strong></td>

                            <?php 
                            $total_pendapatan = [];                            
                            foreach($periode as $pd): ?>

                            <?php
                             $month = date('m' , strtotime($pd->tgl));
                             $year = date('Y' , strtotime($pd->tgl));
                            $ttl = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->get_where('tb_jurnal',[
                                            'tb_jurnal.id_buku' => 1,
                                            'tb_akun.pendapatan' => 'Y',
                                            'MONTH(tgl)' => $month,
                                            'YEAR(tgl)' => $year
                                        ])->row(); ?>                          
                                    <td style="color: black;"><strong><?= number_format($ttl->kredit - $ttl->debit,0) ?></strong></td>
                              <?php $total_pendapatan [] = $ttl->kredit - $ttl->debit; ?>
                            <?php endforeach; ?>        
                                <td></td>
                            </tr>        

                            </tbody>

                            <!-- total pengeluaran     -->
                            <?php 
                            $t_pengeluaran = 0;
                            ?>
                            <tbody>
                            <tr><td style="color: #B7AEF7;"><dt>Pengeluaran</dt></td></tr>
                                <tr>
                            <td style="color: black;"><strong>Total Pengeluaran</strong></td>

                            <?php 
                            $total_pengeluaran = [];
                            $buku = [3,4];
                            foreach($periode as $pd): ?>

                            <?php
                             $month = date('m' , strtotime($pd->tgl));
                             $year = date('Y' , strtotime($pd->tgl));
                            $ttl = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->where('tb_akun.id_kategori !=',7)->where('tb_akun.pengeluaran','Y')->where('tb_akun.pph_hutang','T')->where('MONTH(tgl)',$month)->where('YEAR(tgl)',$year)->where_in('tb_jurnal.id_buku',$buku)->get('tb_jurnal',[
                                            'tb_jurnal.id_buku' =>3,
                                            'tb_akun.id_kategori !=' => 7,
                                            'tb_akun.pengeluaran' => 'Y',
                                            'tb_akun.pph_hutang' => 'T',
                                            'MONTH(tgl)' => $month,
                                            'YEAR(tgl)' => $year
                                        ])->row(); ?>                          
                                    <td style="color: black;"><strong><?= number_format($ttl->debit - $ttl->kredit,0) ?></strong></td>

                            <?php 
                          $total_pengeluaran [] = $ttl->debit - $ttl->kredit;
                          endforeach; ?>        
                            <td></td>    
                            </tr>
                            </tbody>
                            <!-- end total pengeluaran     -->

                            <!-- biaya fix -->
                            <tr><td style="color: #B7AEF7;"><dt>Biaya Fix</dt></td></tr>

                            <?php foreach($akun_biaya_fix as $ap): 
                            ?>
                            <tr>
                            
                            <td style="width:10%"><?= $ap->nm_akun ?></td>
                            <?php foreach($periode as $pd): ?>
                                    <?php 
                                        $month = date('m' , strtotime($pd->tgl));
                                        $year = date('Y' , strtotime($pd->tgl));
                                        $jml = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->where('tb_akun.id_akun',$ap->id_akun)->where('tb_akun.id_kategori !=',7)->where('MONTH(tgl)',$month)->where('YEAR(tgl)',$year)->where_in('tb_jurnal.id_buku',$buku)->get('tb_jurnal')->row();
                                        // $ket = $this->db->get_where(" tb_absen where nm_karyawan = '$kry->nm_kry' and tgl BETWEEN '$dt_c' AND '$dt_a' order by tgl ASC, nm_karyawan ")->result();    
                                    $debit = $jml->debit;
                                    $kredit = $jml->kredit;

                                    $jumlah_p = $debit - $kredit;

                                    if(!$jumlah_p){
                                        $jumlah_p = 0;
                                    }

                                    $t_pengeluaran += $jumlah_p

                                    ?>
                                    <td><?= number_format($jumlah_p,0) ?></td>
                                        
                                    <?php endforeach; ?>
                                    <td></td>      
                            </tr>
                            <?php endforeach ?>

                            <!-- end biaya fix -->


                            <!-- biaya tidak fix -->
                            <tr><td style="color: #B7AEF7;"><dt>Biaya Tidak Fix</dt></td></tr>
                            <?php foreach($akun_pengeluaran as $ap): ?>
                            <tr>
                               
                            <td style="width:10%"><?= $ap->nm_akun ?></td>
                            <?php foreach($periode as $pd): ?>
                                    <?php 
                                        $month = date('m' , strtotime($pd->tgl));
                                        $year = date('Y' , strtotime($pd->tgl));
                                        $jml = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->where('tb_akun.id_akun',$ap->id_akun)->where('tb_akun.id_kategori !=',7)->where('MONTH(tgl)',$month)->where('YEAR(tgl)',$year)->where_in('tb_jurnal.id_buku',$buku)->get('tb_jurnal')->row();
                                        // $ket = $this->db->get_where(" tb_absen where nm_karyawan = '$kry->nm_kry' and tgl BETWEEN '$dt_c' AND '$dt_a' order by tgl ASC, nm_karyawan ")->result();    
                                    $debit = $jml->debit;
                                    $kredit = $jml->kredit;

                                    $jumlah_p = $debit - $kredit;

                                    if(!$jumlah_p){
                                        $jumlah_p = 0;
                                    }

                                    $t_pengeluaran += $jumlah_p

                                    ?>
                                    <td><?= number_format($jumlah_p,0) ?></td>
                                        
                                    <?php endforeach; ?>
                                    <td></td>      
                            </tr>
                            <?php endforeach ?>
                            <!-- end biaya tidak fix -->
                            

                            <!-- laporan laba rugi -->
                            <tbody>
                            <tr><td style="color: #B7AEF7;"><dt>Laporan Laba Rugi</dt></td></tr>
                                <tr>
                                <td style="width:10%">Laba bersih sebelum pajak</td>
                                <?php for($count = 0; $count<count($total_pendapatan); $count++): ?>
                                <td><?= number_format($total_pendapatan[$count] - $total_pengeluaran[$count],0) ?></td>
                                <?php endfor; ?>
                                <td></td>  
                                </tr>
                                <tr>
                                <td style="width:10%">PPH Terhutang(-)</td>
                                <?php 
                                $pph_hutang = [];
                                foreach($periode as $pd): ?>
                                <?php 
                                    $month = date('m' , strtotime($pd->tgl));
                                    $year = date('Y' , strtotime($pd->tgl));
                                    $jml = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->where('tb_akun.pph_hutang','Y')->where('tb_akun.id_kategori !=',7)->where('MONTH(tgl)',$month)->where('YEAR(tgl)',$year)->where_in('tb_jurnal.id_buku',$buku)->get('tb_jurnal')->row();
                                    $pph_hutang [] = $jml->debit - $jml->kredit;
                                    $jml_pph = $jml->debit - $jml->kredit;
                                    ?>
                                    <td><?= number_format($jml_pph,0) ?></td>
                                <?php endforeach; ?>
                                <td></td>  
                                </tr>
                                <tr>
                                <td style="width:10%">Laba bersih setelah pajak</td>
                                <?php for($count = 0; $count<count($total_pendapatan); $count++): ?>
                                <td><?= number_format($total_pendapatan[$count] - $total_pengeluaran[$count] - $pph_hutang[$count],0) ?></td>
                                <?php endfor; ?>
                                </tr>

                                <tr>
                                <td style="width:10%">Pendapatan Bank(+)</td>
                                <?php 
                                $pendapatan_bank = [];
                                foreach($periode as $pd): ?>
                                <?php 
                                    $month = date('m' , strtotime($pd->tgl));
                                    $year = date('Y' , strtotime($pd->tgl));
                                    $jml = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->where('tb_akun.pendapatan_bank','Y')->where('tb_akun.id_kategori !=',7)->where('MONTH(tgl)',$month)->where('YEAR(tgl)',$year)->where_in('tb_jurnal.id_buku',$buku)->get('tb_jurnal')->row();
                                    $pendapatan_bank [] = $jml->debit - $jml->kredit;
                                    $jml_pph = $jml->debit - $jml->kredit;
                                    ?>
                                    <td><?= number_format($jml_pph,0) ?></td>
                                <?php endforeach; ?>
                                <td></td>  
                                </tr>

                                <td style="width:10%; color:black;"><strong>Laba bersih</strong></td>
                                <?php for($count = 0; $count<count($total_pendapatan); $count++): ?>
                                <td style="color: black;"><strong><?= number_format($total_pendapatan[$count] - $total_pengeluaran[$count] - $pph_hutang[$count] + $pendapatan_bank[$count],0) ?></strong></td>
                                <?php endfor; ?>
                                <td></td>
                                </tr>

                            </tbody>
                            <!-- end laporan laba rugi -->

                            <!-- aktiva -->
                            <tbody>
                            <tr><td style="color: #B7AEF7;"><dt>Aktiva</dt></td></tr>
                            <?php 
                            
                            foreach($akun_aktiva as $ap): 
                                $jumlah_aktiva = 0;
                            ?>
                            <tr>
                            <td style="width:10%"><?= $ap->nm_akun ?></td>
                            <?php foreach($periode as $pd): ?>
                                    <?php 
                                        $month = date('m' , strtotime($pd->tgl));
                                        $year = date('Y' , strtotime($pd->tgl));
                                        $jml = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->where('tb_akun.id_akun', $ap->id_akun)->where('tb_akun.id_kategori', 7)->where('MONTH(tgl)', $month)->where('YEAR(tgl)', $year)->where_in('tb_jurnal.id_buku',$buku)->get('tb_jurnal')->row();
                                        // $ket = $this->db->get_where(" tb_absen where nm_karyawan = '$kry->nm_kry' and tgl BETWEEN '$dt_c' AND '$dt_a' order by tgl ASC, nm_karyawan ")->result();    
                                    $debit = $jml->debit;
                                    $kredit = $jml->kredit;

                                    $jumlah_p = $debit - $kredit;

                                    if(!$jumlah_p){
                                        $jumlah_p = 0;
                                    }

                                    $t_pengeluaran += $jumlah_p;
                                    $jumlah_aktiva += $debit - $kredit;

                                    ?>
                                    <td><?= number_format($jumlah_p,0) ?></td> 
                                    <?php endforeach; ?> 
                                    <td><strong><?= number_format($jumlah_aktiva,0); ?></strong></td>     
                            </tr>
                            <?php endforeach ?>

                            </tbody>
                            <tbody>
                                <tr>
                                <td style="color: black;"><strong>Total Aktiva</strong></td>

                                <?php 
                                $sum_aktiva = 0;
                                foreach($periode as $pd): ?>

                                <?php
                                
                                $month = date('m' , strtotime($pd->tgl));
                                $year = date('Y' , strtotime($pd->tgl));
                                $ttl = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_akun','tb_jurnal.id_akun = tb_akun.id_akun')->where('tb_akun.id_kategori',7)->where('tb_akun.pengeluaran','Y')->where('MONTH(tgl)',$month)->where('YEAR(tgl)',$year)->where_in('tb_jurnal.id_buku',$buku)->get('tb_jurnal')->row(); ?>                          
                                        <td style="color: black;"><strong><?= number_format($ttl->debit - $ttl->kredit,0) ?></strong></td>

                                <?php 
                            $sum_aktiva += $ttl->debit - $ttl->kredit;
                            endforeach; ?>        
                                <td style="color: black;"><strong><?= number_format($sum_aktiva,0) ?></strong></td>
                                </tr>
                            </tbody>
                            <!-- end aktiva -->

                            <!-- Aktiva Gantung -->
                            <tr><td style="color: #B7AEF7;"><dt>Aktiva Gantung</dt></td></tr>
                            <?php foreach($akun_gantung as $ap): ?>
                            <tr>
                               
                            <td style="width:10%"><?= $ap->nm_post ?></td>
                            <?php foreach($periode as $pd): ?>
                                    <?php 
                                        $month = date('m' , strtotime($pd->tgl));
                                        $year = date('Y' , strtotime($pd->tgl));
                                        $jml = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_post_center','tb_jurnal.id_post_center = tb_post_center.id_post')->where('tb_post_center.id_post',$ap->id_post)->where('MONTH(tgl)',$month)->where('YEAR(tgl)',$year)->where_in('tb_jurnal.id_buku',$buku)->get('tb_jurnal')->row();
                                        // $ket = $this->db->get_where(" tb_absen where nm_karyawan = '$kry->nm_kry' and tgl BETWEEN '$dt_c' AND '$dt_a' order by tgl ASC, nm_karyawan ")->result();    
                                    $debit = $jml->debit;
                                    $kredit = $jml->kredit;

                                    $jumlah_p = $debit - $kredit;

                                    if(!$jumlah_p){
                                        $jumlah_p = 0;
                                    }

                                    $t_pengeluaran += $jumlah_p

                                    ?>
                                    <td><?= number_format($jumlah_p,0) ?></td>
                                        
                                    <?php endforeach; ?>
                                    <td></td>      
                            </tr>
                            <?php endforeach ?>
                            <!-- end Aktiva Gantung -->

</table>



