<?php $this->load->view('tema/Header', $title); ?>

<script src="<?= base_url('css_maruti/'); ?>js/jquery.min.js"></script> 
<script src="<?php echo base_url('css_maruti/'); ?>assets/ajax.js"></script>

<style type="text/css">

.modal .modal-dialog-aside{
	width: 350px;
	max-width:80%; height: 500px; margin:0;
	transform: translate(0); transition: transform .2s;
}


.modal .modal-dialog-aside .modal-content{  height: inherit; border:0; border-radius: 0;}
.modal .modal-dialog-aside .modal-content .modal-body{ overflow-y: auto }
.modal.fixed-left .modal-dialog-aside{ margin-left:auto;  transform: translateX(100%); }
.modal.fixed-right .modal-dialog-aside{ margin-right:auto; transform: translateX(-100%); }

.modal.show .modal-dialog-aside{ transform: translateX(0);  }

.th{            
            top: 54px;            
        }

    .th-atas-bulanan {

			top: 58px;
		}

</style>

<!-- ======================================================== conten ======================================================= -->
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
	
	<div class="content-header">
		<div class="container">

			<div class="row mb-2">
				<!-- <div class="col-sm-12">
					<h1 class="m-0 text-dark">Jurnal</h1>
				</div> -->
				<div class="col-sm-6">
					<?php if ($this->session->userdata('edit_hapus')=='1'): ?>
						<!-- <button data-toggle="modal" data-target="#modal-detail" class="btn btn-success"><i class="fas fa-download"></i> Detail</button> -->
						<!--<button data-toggle="modal" data-target="#modal-view" class="btn btn-success"><i class="fas fa-eye"></i> View</button>-->
						<!--<button data-toggle="modal" data-target="#modal-summary" class="btn btn-success"><i class="fas fa-print"></i> Summary</button>-->
						<!-- <button data-toggle="modal" data-target="#modal-delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> -->
					<?php endif ?>
				</div>
				<!-- <div class="col-5 mt-2">
					<a href="<?= base_url('match/order'); ?>" class="btn btn-warning">Kembali</a>
				</div> -->
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-12">
				
			</div>
			<div class="col-12">
      <?= $this->session->flashdata('message'); ?>

      <!-- <?php 
      $bulan = ['bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; 
      $bulan1 = (int)$month;      
      ?> -->
      
				<div class="card">
                    <!-- <div class="card-header">
                       <button type="button" class="btn btn-sm btn-outline-secondary float-right ml-2" data-toggle="modal" data-target="#add-laporan"><i class="fa fa-plus"></i> Add Laporan</button>
                       
                      </div> -->                        
                      <div class="card-header">
                       <h4 class="float-left">Laporan Pendapatan</h4>
                       
                       <a class="btn btn-sm btn-outline-secondary float-right ml-2" href="<?= base_url('Match/excel_laporan_bulanan') ?>"><i class="fas fa-file-export"></i> Export</a>
                       
                      </div>    
                    <div class="card-body">

                    <div class="row">
                        <div class="col-5"></div>
                        <div class="col-5"></div>
                        <div class="col-2">
                        <label class="float-left"><input type="search" class="form-control form-control-sm" placeholder="Search.." id="search_bulanan"></label>
                        </div>
                    </div>
                       

                       <?php 
                       $t_pemasukan = 0;
                       ?>
                       <table class="table table-sm table-bordered" style="font-size: 12px;">

                            <thead>
                            
                            <tr>
                                <th class="sticky-top th-atas-bulanan">Akun</th>
                                <?php foreach ($periode as $key => $value): ?>
                                    
                                        <th class="sticky-top th-atas-bulanan"><?= date('M-Y', strtotime($value->tgl)) ?></th>
                                <?php endforeach ?>   
                                <th class="sticky-top th-atas-bulanan">Total</th>
                            </tr> 
                            </thead>
                            <tbody id="tb_bulanan">
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

                            

                            <!-- total pengeluaran     -->
                            <?php 
                            $t_pengeluaran = 0;
                            ?>

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

                            <!-- end total pengeluaran     -->

                            <!-- biaya fix -->
                            <tr><td style="color: #B7AEF7;"><dt>Biaya Fix</dt></td></tr>

                            <?php foreach($akun_biaya_fix as $ap): 
                            ?>
                            <tr>
                            
                            <td style="width:10%"><a href="#modal_jurnal" class="btn_akun" id_akun ="<?= $ap->id_akun ?>" data-toggle="modal"><?= $ap->nm_akun ?></a></td>
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
                                    <td><a href="#modal_detail_jurnal" data-toggle="modal" class="btn_detail_jurnal" id_akun ="<?= $ap->id_akun ?>" month="<?= $month ?>" year="<?= $year ?>"><?= number_format($jumlah_p,0) ?></a></td>
                                        
                                    <?php endforeach; ?>
                                    <td></td>      
                            </tr>
                            <?php endforeach ?>

                            <!-- end biaya fix -->


                            <!-- biaya tidak fix -->
                            <tr><td style="color: #B7AEF7;"><dt>Biaya Tidak Fix</dt></td></tr>
                            <?php foreach($akun_pengeluaran as $ap): ?>
                            <tr>
                               
                            <td style="width:10%"><a href="#modal_jurnal" class="btn_akun" id_akun ="<?= $ap->id_akun ?>" data-toggle="modal"><?= $ap->nm_akun ?></a></td>
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
                                    <td><a href="#modal_detail_jurnal" data-toggle="modal" class="btn_detail_jurnal" id_akun ="<?= $ap->id_akun ?>" month="<?= $month ?>" year="<?= $year ?>"><?= number_format($jumlah_p,0) ?></a></td>
                                        
                                    <?php endforeach; ?>
                                    <td></td>      
                            </tr>
                            <?php endforeach ?>
                            <!-- end biaya tidak fix -->
                            

                            <!-- laporan laba rugi -->

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


                            <!-- end laporan laba rugi -->

                            <!-- aktiva -->

                            <tr><td style="color: #B7AEF7;"><dt>Aktiva</dt></td></tr>
                            <?php 
                            
                            foreach($akun_aktiva as $ap): 
                                $jumlah_aktiva = 0;
                            ?>
                            <tr>
                            <td style="width:10%"><a href="#modal_jurnal" class="btn_akun" id_akun ="<?= $ap->id_akun ?>" data-toggle="modal"><?= $ap->nm_akun ?></a></td>
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
                                    <td><a href="#penyesuaian" class="penyesuaian" id_akun="<?= $ap->id_akun ?>" month="<?= $month ?>" year="<?= $year ?>" data-toggle="modal"><?= number_format($jumlah_p,0) ?></a></td> 
                                    <?php endforeach; ?> 
                                    <td><strong><?= number_format($jumlah_aktiva,0); ?></strong></td>     
                            </tr>
                            <?php endforeach ?>

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

                            <!-- end aktiva -->

                            
                            <!-- Aktiva Gantung -->

                            <tr><td style="color: #B7AEF7;"><dt>Aktiva Gantung</dt></td></tr>
                            <?php 
                            foreach($akun_gantung as $ap): 
                            $jumlah_gantung = 0;
                            ?>
                            <tr>
                               
                            <td style="width:10%"><a href="#modal_jurnal" class="btn_akun_post" id_akun ="<?= $ap->id_akun ?>" id_post ="<?= $ap->id_post ?>" data-toggle="modal"><?= $ap->nm_akun ?> <br> <?= $ap->nm_post ?></a></td>
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

                                    $jumlah_gantung += $jumlah_p

                                    ?>
                                    <td><a href="#modal_detail_jurnal" data-toggle="modal" class="btn_detail_jurnal_post" id_akun ="<?= $ap->id_akun ?>" id_post ="<?= $ap->id_post ?>" month="<?= $month ?>" year="<?= $year ?>"><?= number_format($jumlah_p,0) ?></td>
                                        
                                    <?php endforeach; ?>
                                    <td><strong><?= number_format($jumlah_gantung,0) ?></strong></td>      
                            </tr>
                            <?php endforeach ?>

                            <tr>
                                <td style="color: black;"><strong>Total Akun Gantung</strong></td>

                                <?php 
                                $sum_gantung = 0;
                                foreach($periode as $pd): ?>

                                <?php
                                
                                $month = date('m' , strtotime($pd->tgl));
                                $year = date('Y' , strtotime($pd->tgl));
                                $ttl = $this->db->select_sum('debit')->select_sum('kredit')->join('tb_post_center','tb_jurnal.id_post_center = tb_post_center.id_post')->join('tb_akun','tb_post_center.id_akun = tb_akun.id_akun')->where('tb_akun.akun_gantung','Y')->where('MONTH(tgl)',$month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->row(); ?>                          
                                        <td style="color: black;"><strong><?= number_format($ttl->debit - $ttl->kredit,0) ?></strong></td>

                                <?php 
                            $sum_gantung += $ttl->debit - $ttl->kredit;
                            endforeach; ?>        
                                <td style="color: black;"><strong><?= number_format($sum_gantung,0) ?></strong></td>
                                </tr>
                            </tbody>
                            
                            <!-- end Aktiva Gantung -->


                            </table>                              

                    </div>
					
				</div>



			</div>
			
			
		</div>
	</div>

  <style>
    .modal-lg-max {
    max-width: 900px;
  }
  </style>

<form action="<?= base_url('jurnal/add_penyesuaian') ?>" method="POST">
<div class="modal fade" id="penyesuaian" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Jurnal penyesuaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="form_penyesuaian">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
</form>


<!-- Modal add -->
<form action="<?= base_url('match/add_laporan_bulanan') ?>" method="POST">
<div class="modal fade" id="add-laporan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Add data laporan bulanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">

        <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <label for="list_kategori">Akun</label>
                      <select name="month" class="form-control" required="">                              
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>                 
                      </select>
                  </div>
              </div>

              <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                      <label for="list_kategori">Tahun</label>
                      <select name="year" class="form-control select" required="">
                          <?php foreach($tahun as $t): ?>                                
                            <?php  $tanggal = $t->tgl;
                            $explodetgl=explode('-', $tanggal); ?>
                          <option value="<?=$explodetgl[0];?>"><?=$explodetgl[0];?></option>
                          <?php endforeach; ?>
                        </select>  
                  </div>
              </div>

      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- add jurnal -->
<!-- Modal -->
<form action="<?= base_url('Jurnal/add_pengeluaran') ?>" method="POST" id="form-jurnal">
  <div class="modal fade" id="modal_jurnal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h5 class="modal-title" id="exampleModalLabel">Jurnal Pengeluaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row">

            <div class="col-sm-3 col-md-3">
              <div class="form-group">
                <label for="list_kategori">Tanggal</label>
                <input class="form-control" type="date" name="tgl" id="tgl" required>

              </div>
            </div>

            <div class="mt-3 ml-1">
              <p class="mt-4 ml-2 text-warning"><strong>Db</strong></p>
            </div>


            <div class="col-sm-4 col-md-4">
              <div class="form-group">
                <label for="list_kategori">Akun</label>
                <select name="id_akun" id="id_akun" class="form-control select" required="">
                  <?php foreach ($akun_all as $a) : ?>
                    <option value="<?= $a->id_akun ?>"><?= $a->nm_akun ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="col-sm-2 col-md-2">
              <div class="form-group">
                <label for="list_kategori">Debit</label>
                <input type="number" class="form-control total" id="total" name="total" readonly>
              </div>
            </div>
            <div class="col-sm-2 col-md-2">
              <div class="form-group">
                <label for="list_kategori">Kredit</label>
                <input type="number" class="form-control" readonly>
              </div>
            </div>

            <div class="col-sm-3 col-md-3">

            </div>

            <div class="mt-1">
              <p class="mt-1 ml-3 text-warning"><strong>Cr</strong></p>
            </div>

            <div class="col-sm-4 col-md-4">
              <div class="form-group">
                <select name="metode" id="metode" class="form-control select" required>
                  <?php foreach ($akun_all as $k) : ?>
                    <option value="<?= $k->id_akun ?>"><?= $k->nm_akun ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-sm-2 col-md-2">
              <div class="form-group">

                <input type="number" class="form-control" readonly>
              </div>
            </div>
            <div class="col-sm-2 col-md-2">
              <div class="form-group">

                <input type="number" id="total1" class="form-control total" readonly>
              </div>
            </div>

          </div>
         

          <!-- non-monitoring -->

          <div id="non_monitoring" class="detail">
            <hr>

            <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                  <label for="list_kategori">Post Center</label>
                  <select name="id_post_center[]" class=" select form-control input_detail input_non_monitoring detail_post_center detail_post_center1" id="post_center">
                    
                  </select>
                </div>
              </div>  

              <div class="col-md-4">
                <div class="form-group">
                  <label for="list_kategori">Keterangan</label>
                  <input type="text" class="form-control input_detail input_non_monitoring" name="ket[]" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="list_kategori">Total Rp</label>
                  <input type="text" class="form-control  input_detail input_non_monitoring total_rp" name="ttl_rp[]" required>
                </div>
              </div>

            </div>

            <div id="detail_non_monitoring">


            </div>

            <div align="right" class="mt-2">
              <button type="button" id="tambah_non_monitoring" class="btn-sm btn-success">Tambah</button>
            </div>

          </div>

                 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Input</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- end jurnal -->


<!-- modal tambah post center -->
<form  id="form_modal_post_center">
<div class="modal fade" id="tambah_post_center" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Post Center</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        <input type="hidden" name="id_akun" id="id_akun_post">

          <div class="col-md-12">
              <div class="form-group">
                  <label for="list_kategori">Nama Post Center</label>
                  <input class="form-control" type="text" name="nm_post" required>             
              </div>                                          
          </div>

    
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Seve</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- end tambah post center -->



<div class="modal fade" id="modal_detail_jurnal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg-max" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #FFA07A;">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pengeluaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="form_detail_jurnal">

        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div> -->
    </div>
  </div>
</div>

<!-- modal edit -->
<form action="<?= base_url('Jurnal/edit_jurnal_pengeluaran') ?>" method="POST" id="form-jurnal">
  <div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <!-- <form action="<?= base_url() ?>match/app_add_order_multiple2" method="post"> -->
      <div class="modal-content">
        <div class="modal-header" style="background:#fadadd;">
          <h4 class="modal-title">Edit Journal</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="get_jurnal">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Save/Edit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>

</form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
<script src="<?= base_url() ?>asset/time/jquery.skedTape.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('asset/'); ?>/plugins/daterangepicker/daterangepicker.js"></script>

<script>

$(function () {
             $('.select').select2()

             $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
           });

	$(document).ready(function(){

    $(document).on("keyup", "#search_detail_jurnal", function() {
            var value = $(this).val().toLowerCase();
            $("#tb_detail_jurnal tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    $("#search_bulanan").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tb_bulanan tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    //edit jurnal
    $(document).on('click', '.btn_edit', function(){
      var kd_gabungan = $(this).attr("kd_gabungan");

      // console.log('yy'+kd_gabungan);

      $.ajax({
        url: "<?= base_url(); ?>Match/get_jurnal/",
        method: "POST",
        data: {
          kd_gabungan: kd_gabungan
        },
        success: function(data) {
          $('#get_jurnal').html(data);
          $('.select').select2();
        }
      });

    });

    $(document).on('click', '.btn_detail_jurnal', function(){
      var id_akun = $(this).attr('id_akun');
      var month = $(this).attr('month');
      var year = $(this).attr('year');

      $.ajax({
                url: "<?= base_url(); ?>Jurnal/get_detail_jurnal/",
                type: "POST",
                data: {
                    id_akun: id_akun, month: month, year: year
                },
                success: function(data) {
                  $('#form_detail_jurnal').html(data);
                }
            });

    });

    $(document).on('click', '.btn_detail_jurnal_post', function(){
      var id_akun = $(this).attr('id_akun');
      var id_post = $(this).attr('id_post');
      var month = $(this).attr('month');
      var year = $(this).attr('year');

      $.ajax({
                url: "<?= base_url(); ?>Jurnal/get_detail_jurnal_post/",
                type: "POST",
                data: {
                    id_akun: id_akun, month: month, year: year, id_post: id_post
                },
                success: function(data) {
                  $('#form_detail_jurnal').html(data);
                }
            });

    });




    function get_post_center(id_akun, urutan=1, id_post = 0){
  $.ajax({
          url: "<?= base_url(); ?>Jurnal/get_post_center/",
          method: "POST",
          data: {
            id_akun: id_akun, id_post: id_post
          },
          success: function(data) {
            if(urutan == 1){
              $('.detail_post_center').html(data);
              $('.detail_post_center').select2({
                width: '100%',
                language: {
                  noResults: function() {
                    return '<button class="btn btn-sm btn-primary btn_tambah_post_center" id_akun="'+id_akun+'" data-toggle="modal" data-target="#tambah_post_center">Tambah Post Center</a>';
                  },
                },
                escapeMarkup: function(markup) {
                  return markup;
                },
              }); 
            }else{
              $('.detail_post_center'+urutan).html(data);
              $('.detail_post_center'+urutan).select2({
                width: '100%',
                language: {
                  noResults: function() {
                    return '<button class="btn btn-sm btn-primary btn_tambah_post_center" id_akun="'+id_akun+'" data-toggle="modal" data-target="#tambah_post_center">Tambah Post Center</a>';
                  },
                },
                escapeMarkup: function(markup) {
                  return markup;
                },
              }); 
            }
            
          }
          });
}

$(document).on('click', '.btn_tambah_post_center', function(){
            
            var id_akun = $(this).attr("id_akun");
            $('#id_akun_post').val(id_akun);
            
            get_post_center(id_akun);

        });

    $(document).on('click', '.btn_akun', function(){
      var id_akun = $(this).attr('id_akun');
    //  console.log(id_akun);
      $('#id_akun').val(id_akun);
      $('#id_akun').trigger('change');

      $('#metode').val(13);
      $('#metode').trigger('change');

      get_post_center(id_akun);
    });

    $(document).on('click', '.btn_akun_post', function(){
      var id_akun = $(this).attr('id_akun');
      var id_post = $(this).attr('id_post');
     console.log(id_post);
      get_post_center(id_akun,1,id_post);
      $('#id_akun').val(id_akun);
      $('#id_akun').trigger('change');

      $('#metode').val(13);
      $('#metode').trigger('change');

    });

    $(document).on("keyup", ".total_rp", function() {
      //   $('.rp_pajak').keyup(function(){
      var debit = 0;

      $(".total_rp:visible").each(function() {
        debit += parseInt($(this).val());
      });
      $('.total').val(debit);
    });

       // Non Monitoring
       var count_non_monitoring = 1;
    $('#tambah_non_monitoring').click(function() {
      count_non_monitoring = count_non_monitoring + 1;
      // var no_nota_atk = $("#no_nota_atk").val();
      var id_akun = $('#id_akun').val();
      var id_post = $('#post_center').val();
      var html_code = "<div class='row' id='row_non_monitoring" + count_non_monitoring + "'>";
      
      html_code += '<div class="col-md-4"><div class="form-group"><select name="id_post_center[]" class=" select form-control input_detail input_non_monitoring detail_post_center detail_post_center'+count_non_monitoring+'" ></select></div></div>';          

      html_code += '<div class="col-md-4"><div class="form-group"><input type="text" class="form-control input_detail input_non_monitoring" name="ket[]" required></div></div>';

      html_code += '<div class="col-md-3"><div class="form-group"><input type="text" class="form-control  input_detail input_non_monitoring total_rp" name="ttl_rp[]" required></div></div>';

      html_code += ' <div class="col-md-1"><button type="button" name="remove" data-row="row_non_monitoring' + count_non_monitoring + '" class="btn btn-danger btn-sm remove_non_monitoring">-</button></div>';


      html_code += "</div>";
      console.log(id_post);
      $('#detail_non_monitoring').append(html_code);
      get_post_center(id_akun,count_non_monitoring,id_post);
      // $('.select').select2()
    });

    $(document).on('click', '.remove_non_monitoring', function() {
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();
    });


    $(document).on('click', '.penyesuaian', function(){
      var id_akun = $(this).attr("id_akun");
      var month = $(this).attr("month");
      var year = $(this).attr("year");

      $.ajax({
                url: "<?= base_url(); ?>Jurnal/get_relation_akun/",
                type: "POST",
                data: {
                    id_akun: id_akun, month: month, year: year
                },
                success: function(data) {
                  $('#form_penyesuaian').html(data);
                }
            });
      
    });

    $(document).on('keyup', '.total_aktiva', function(){
      var total = $(this).val();

      $('.total_aktiva').val(total);
     
      
    });


    $(document).on('submit', '#form_modal_post_center', function(event) {
            event.preventDefault();

            var id_akun = $('#id_akun_post').val();
            $.ajax({
                url: "<?php echo base_url('Jurnal/add_post_center_jurnal'); ?>",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#tambah_post_center').hide();
                    // setTimeout(function(){
                    //   $('#tambah_post_center').modal('toggle');
                    //     },50);
                   
                    // setTimeout(function(){
                    //       $("[data-dismiss=modal]").trigger({ type: "click" });
                    //     },50);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Post center berhasil dibuat'
                        });

                        get_post_center(id_akun);      
                }
            });

            //Watch for closing modals
            $('.modal').on('hidden.bs.modal', function () {
                //If there are any visible
                if($(".modal:visible").length > 0) {
                    //Slap the class on it (wait a moment for things to settle)
                    setTimeout(function() {
                        $('body').addClass('modal-open');
                    },200)
                }
            });

        });

		  
  });


</script>




	<?php $this->load->view('tema/Footer'); ?>

