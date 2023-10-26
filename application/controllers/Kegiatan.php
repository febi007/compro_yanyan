<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 19/12/2019
 * Time: 23:13
 */

class Kegiatan extends CI_Controller
{
    public function index(){
        $data['isi'] = 'page/kegiatan/index';
        $this->load->view("layout/wrapper.php",$data);
    }

    public function load_data($action=null){
        $body='';$title='';$header='';$where=null;$type=null;$title_body='';
        if($action=='eskul'){
            $where.="id='15'";
            $type.="type='3'";
        }elseif ($action == 'osis'){
            $where.="id='13'";
            $type.="type='1'";
        }elseif($action == 'pramuka'){
            $where.="id='14'";
            $type.="type='2'";
        }

        $read_header = $this->M_crud->get_data("v_berita","*",$where);
        $pagin = $this->M_website->myPagination("tbl_gallery",'id',$type,8);
        $read_data = $this->M_crud->read_data("tbl_gallery","*",$type,"id desc",null,$pagin["perPage"], $pagin['start']);

        if($action == 'osis' || $action == 'pramuka'){
            if($read_header!=null){
                $title.=$read_header['title'];
                $title_body.='Galeri Kegiatan '.$read_header['title'];
                $header.=$this->M_website->tempThree($read_header["image"],'',$read_header["content"]);
            }else{
                $title.=/** @lang text */'<h1 class="text-center">Tidak Ada Data</h1>';
                $title_body.=/** @lang text */'<h1 class="text-center">Tidak Ada Data</h1>';
                $header.=/** @lang text */'<h1 class="text-center">Tidak Ada Data</h1>';
            }
            if($read_data!=null){
                foreach($read_data as $row){
                    $body.=$this->M_website->tempGallery($row['image'],$row['title']);
                }
            }else{
                $body.=/**@lang text */'<div class="col-md-12"><h1 class="text-center">Tidak Ada Data</h1></div>';
            }
        }else{
            $title.=$read_header['title'];
            $title_body.='Galeri Kegiatan ';
            $header.=/** @lang text */'<div class="col-lg-12">'.html_entity_decode($read_header["content"]).'</div>';
            if($read_data!=null){
                foreach($read_data as $row){
                    $body.=$this->M_website->tempGallery($row['image'],$row['title']);
                }
            }else{
                $body.=/**@lang text */'<div class="col-md-12"><h1 class="text-center">Tidak Ada Data</h1></div>';
            }

        }
        echo json_encode(array(
            'header'=>$header,
            'title'=>$title,
            'result_body'=>$body,
            "pagination_link"   => $pagin['pagination_link'],
            'title_body'=>$title_body
        ));




    }

//    public function header($content){
//        return
//    }

}