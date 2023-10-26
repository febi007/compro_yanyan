<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 19/12/2019
 * Time: 22:48
 */

class Struktur extends CI_Controller
{
    public function index(){
        $data['isi'] = 'page/so/index';
        $this->load->view("layout/wrapper.php",$data);
    }

    public function load_data($action=null){
        $result='';$title='';$where=null;
        if($action == 'bagan'){
            $where.="id=2";
        }else{
            $where.="id=3";
        }
        $read_data = $this->M_crud->get_data("v_berita","*",$where);
        if($read_data!=null){
            $title.=$read_data['title'];
            $result.=$this->tempFour($read_data['image'],'',$read_data['content']);
        }else{
            $title.= /** @lang text */'<h1>Tidak Ada Data</h1>';
            $result.= /** @lang text */'<div class="col-md-12"><h1 class="text-center">Tidak Ada Data</h1></div>';
        }
        $img = '<img src="'.$read_data['image'].'" width="100%" height="100%!important;">';
        echo json_encode(array('result'=>$result,'title'=>$title,'img'=>$img));

    }
    public function tempFour($img,$title,$desc){
        return /** @lang text */
            '
            <div class="col-lg-12">
                <div class="gallery-one__single">
                    <img src="'.$img.'">
                    <a style="color:white!important;font-weight:bold;" onclick="printDiv()" href="#" class="gallery-one__popup img-popup">
                        Cetak Gambar
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="team-details__content">
                    <h2 class="team-details__title">'.$title.'</h2>
                    <p class="team-details__text" style="text-align:justify">'.strip_tags($desc).'</p>
                </div>
            </div>
            
        ';
    }

}