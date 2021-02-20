<?php 
// ================================== STOK CABUT ==========================================
    function stok_cabut(){
        $data['title']   = "Gudang Cabut";
        $data['stok']    = $this->Mymodel->dt_ambil(" where no_grade = 'STOK' ");

        $this->load->view('tema/Header', $data);
        $this->load->view('cabut/stok', $data);
        $this->load->view('tema/Footer');
    }

    function input_stok_cabut(){
        $data_input = array(
            'pengambil'   => $this->input->post('pengambil'),
            'harga'       => $this->input->post('harga'),
            'no_grade'    => 'STOK',
            'pcs'         => $this->input->post('pcs'),
            'gram'        => $this->input->post('gram'),
            'tgl_ambil'   => $this->input->post('tgl_ambil')
        );
        $res = $this->Mymodel->InputData('tb_ambil', $data_input);
        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Stok Berhasil Di Tambah</div>');
        redirect ('Match/stok_cabut');
    }

    function edit_stok_cabut($id_ambil){
        $a = $this->Mymodel->dt_ambil(" where id_ambil ='$id_ambil'");
        $data = array(
            "id_ambil"  => $a[0]['id_ambil'],
            "pengambil" => $a[0]['pengambil'],           
            "tgl_ambil" => $a[0]['tgl_ambil'],           
            "harga"     => $a[0]['harga'],
            "pcs"       => $a[0]['pcs'],
            "gram"      => $a[0]['gram']
        );
        $data['title'] = 'EDIT STOK CABUT';
        
        $this->load->view('tema/Header', $data);
        $this->load->view('gudang/edit_cabut', $data);
        $this->load->view('tema/Footer');
    }

    function update_stok_cabut(){
        $id_ambil   = $this->input->post('id_ambil');
        $data = array(
            'pengambil'   => $this->input->post('pengambil'),
            'harga'       => $this->input->post('harga'),
            'no_grade'    => 'STOK',
            'pcs'         => $this->input->post('pcs'),
            'gram'        => $this->input->post('gram'),
            'tgl_ambil'   => $this->input->post('tgl_ambil')
        );
        $where = array('id_ambil' => $id_ambil);
        $res = $this->Mymodel->UpdateData('tb_ambil', $data, $where);
        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Stok Berhasil Di Update</div>');
        redirect ('Match/stok_cabut');
    }

    function drop_stok_cabut($id_ambil){
        $where = array('id_ambil' => $id_ambil);
        $res = $this->Mymodel->DropData('tb_ambil', $where);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok Berhasil Di Hapus !!</div>');
        redirect("Match/stok_cabut");
    }
// ================================== end STOK cabut ==========================================

// ================================== STOK CETAK ==========================================
    function stok_cetak(){
        $data['title']   = "Gudang Cetak";
        $data['stok']    = $this->Mymodel->dt_summary_cabut(" where status = 'stok' ");

        $this->load->view('tema/Header', $data);
        $this->load->view('stok/cetak', $data);
        $this->load->view('tema/Footer');
    }

    function input_stok_cetak(){
        $data_input = array(
            'pengambil'   => $this->input->post('pengambil'),
            'pekerjaan'   => 'STOK',
            'status'      => 'STOK',
            'no_nota'     => $this->input->post('no_nota'),
            'pcs_d'       => $this->input->post('pcs_d'),
            'gram'        => $this->input->post('gram'),
            'harga'       => $this->input->post('harga'),
            'tanggal'     => date('Y-m-d'),
            'tgl_selesai' => date('Y-m-d')
        );
        $res = $this->Mymodel->InputData('tb_kerja_cabut', $data_input);
        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Stok Berhasil Di Tambah</div>');
        redirect ('Match/stok_cetak');
    }

    function edit_stok_cetak($no_nota){
        $a = $this->Mymodel->dt_kerja_cabut(" where no_nota ='$no_nota'");
        $data = array(
            "no_nota"   => $a[0]->no_nota,
            "pengambil" => $a[0]->pengambil,           
            "harga"     => $a[0]->harga,
            "pcs_d"     => $a[0]->pcs_d,
            "gram"      => $a[0]->gram
        );
        $data['title'] = 'EDIT STOK CETAK';

        $this->load->view('tema/Header', $data);
        $this->load->view('gudang/edit_cetak', $data);
        $this->load->view('tema/Footer');
    }

    function update_stok_cetak(){
        $no_nota   = $this->input->post('no_nota');
        $data = array(
            'pengambil'   => $this->input->post('pengambil'),
            'harga'       => $this->input->post('harga'),
            'pcs_d'       => $this->input->post('pcs_d'),
            'gram'        => $this->input->post('gram')
        );
        $where = array('no_nota' => $no_nota);
        $res = $this->Mymodel->UpdateData('tb_kerja_cabut', $data, $where);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Stok Berhasil Di Update</div>');
        redirect ('Match/stok_cetak');
    }

    function drop_stok_cetak($no_nota){
        $where = array('no_nota' => $no_nota);
        $res = $this->Mymodel->DropData('tb_kerja_cabut', $where);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok Berhasil Di Hapus !!</div>');
        redirect("Match/stok_cetak");
    }
// ================================== end STOK CETAK ==========================================

// ================================== STOK GRADING ==========================================
    function stok_grading(){
        $data['title']   = "Gudang Grading";
        $data['stok']    = $this->Mymodel->dt_summary_cetak(" where status = 'stok' ");

        $this->load->view('tema/Header', $data);
        $this->load->view('stok/grading', $data);
        $this->load->view('tema/Footer');
    }

    function input_stok_grading(){
        $data_input = array(
            'pengambil'   => $this->input->post('pengambil'),
            'pekerjaan'   => 'STOK',
            'status'      => 'STOK',
            'no_nota'     => $this->input->post('no_nota'),
            'pcs'         => $this->input->post('pcs'),
            'gram'        => $this->input->post('gram'),
            'harga'       => $this->input->post('harga'),
            'tanggal'     => date('Y-m-d'),
            'tgl_selesai' => date('Y-m-d')
        );
        $res = $this->Mymodel->InputData('tb_kerja_cetak', $data_input);
        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Stok Berhasil Di Tambah</div>');
        redirect ('Match/stok_grading');
    }

    function edit_stok_grade($no_nota){
        $a = $this->Mymodel->dt_kerja_cetak(" where no_nota ='$no_nota'");
        $data = array(
            "no_nota"   => $a[0]->no_nota,
            "pengambil" => $a[0]->pengambil,           
            "harga"     => $a[0]->harga,
            "pcs"       => $a[0]->pcs,
            "gram"      => $a[0]->gram
        );
        $data['title'] = 'EDIT STOK GRADING';

        $this->load->view('tema/Header', $data);
        $this->load->view('gudang/edit_grade', $data);
        $this->load->view('tema/Footer');
    }

    function update_stok_grade(){
        $no_nota   = $this->input->post('no_nota');
        $data = array(
            'pengambil'   => $this->input->post('pengambil'),
            'harga'       => $this->input->post('harga'),
            'pcs'         => $this->input->post('pcs'),
            'gram'        => $this->input->post('gram')
        );
        $where = array('no_nota' => $no_nota);
        $res = $this->Mymodel->UpdateData('tb_kerja_cetak', $data, $where);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Stok Berhasil Di Update</div>');
        redirect ('Match/stok_grading');
    }

    function drop_stok_grade($no_nota){
        $where = array('no_nota' => $no_nota);
        $res = $this->Mymodel->DropData('tb_kerja_cetak', $where);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok Berhasil Di Hapus !!</div>');
        redirect("Match/stok_grading");
    }
// ================================== end STOK GRADING ==========================================

// ================================== STOK SORTIR ==========================================
    function stok_sortir(){
        $data['title']   = "Gudang Sortir";
        $data['d_grade'] = $this->Mymodel->d_grade_x();
        $data['stok']    = $this->Mymodel->dt_gudang_grading(" where status = 'STOK' ");

        $this->load->view('tema/Header', $data);
        $this->load->view('stok/sortir', $data);
        $this->load->view('tema/Footer');
    }

    function input_stok_sortir(){
        $data_input = array(
            'pengambil'   => $this->input->post('pengambil'),
            'no_grade'    => $this->input->post('no_grade'),
            'harga'       => $this->input->post('harga'),  
            'status'      => 'STOK',
            'pcs'         => $this->input->post('pcs'),
            'gram'        => $this->input->post('gram')
        );
        $res = $this->Mymodel->InputData('tb_kerja_grade', $data_input);
        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Stok Berhasil Di Tambah</div>');
        redirect ('Match/stok_sortir');
    }

    function edit_stok_sortir($idk_grade){
        $a = $this->Mymodel->dt_gudang_grading(" where idk_grade ='$idk_grade'");
        $data = array(
            "idk_grade" => $a[0]->idk_grade,
            "no_grade"  => $a[0]->no_grade,
            "pengambil" => $a[0]->pengambil,           
            "harga"     => $a[0]->harga,
            "pcs"       => $a[0]->pcs,
            "gram"      => $a[0]->gram
        );
        $data['title']   = 'EDIT STOK SORTIR';
        $data['d_grade'] = $this->Mymodel->d_grade_x();

        $this->load->view('tema/Header', $data);
        $this->load->view('gudang/edit_sortir', $data);
        $this->load->view('tema/Footer');
    }

    function update_stok_sortir(){
        $idk_grade   = $this->input->post('idk_grade');
        $data = array(
            'pengambil'   => $this->input->post('pengambil'),
            'no_grade'    => $this->input->post('no_grade'),
            'status'      => 'STOK',
            'harga'       => $this->input->post('harga'),  
            'pcs'         => $this->input->post('pcs'),
            'gram'        => $this->input->post('gram')
        );
        $where = array('idk_grade' => $idk_grade);
        $res = $this->Mymodel->UpdateData('tb_kerja_grade', $data, $where);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Stok Berhasil Di Update</div>');
        redirect ('Match/stok_sortir');
    }

    function drop_stok_sortir($idk_grade){
        $where = array('idk_grade' => $idk_grade);
        $res = $this->Mymodel->DropData('tb_kerja_grade', $where);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok Berhasil Di Hapus !!</div>');
        redirect("Match/stok_sortir");
    }
// ================================== end STOK SORTIR ==========================================


?>