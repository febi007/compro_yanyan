<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 20/12/2019
 * Time: 14:23
 */

class Detail extends CI_Controller
{
    public function index(){
        $slug = $_GET['title'];
        $type = $_GET['type'];
        if($type == 'lowongan_kerja'){
            $isi = 'page/berita/detail_berita';
            $read_data = $this->M_crud->get_data("v_berita","*","status='1' and slug='".$slug."'");
            $late_post = $this->M_crud->read_data("v_berita","*","status='1' and type='2' and slug != '".$slug."'","RAND()",null,3);
        }elseif ($type == 'berita'){
            $isi = 'page/berita/detail_berita';
            $read_data = $this->M_crud->get_data("v_berita","*","status='1' and slug='".$slug."'");
            $late_post = $this->M_crud->read_data("v_berita","*","status='1' and type='1' and slug != '".$slug."'","RAND()",null,3);
        }elseif ($type == 'gallery'){
            $isi = 'page/berita/detail';
            $read_data = $this->M_crud->get_data("tbl_gallery","*","status='1' and slug='".$slug."'");
            $late_post = $this->M_crud->read_data("tbl_gallery","*","status='1' and slug != '".$slug."'","RAND()",null,3);
        }

        $data['isi']        = $isi;
        $data['kategori']   = $this->M_crud->read_data("tbl_category","*");
        $data['read_data']  = $read_data;
        $data['late_post']  = $late_post;
        $this->load->view("layout/wrapper",$data);
    }



}