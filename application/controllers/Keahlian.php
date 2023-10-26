<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 21/12/2019
 * Time: 09:30
 */

class Keahlian extends CI_Controller
{
    public function index(){
        $data['isi'] = 'page/keahlian/index';
        $this->load->view("layout/wrapper.php",$data);
    }
    public function load_data($action=null){
        if($action == 'get'){
            $read_data = $this->M_crud->get_data("tbl_jurusan","*","slug='".$_POST['type']."'");
            $title=$read_data['title']!=null?$read_data['title']:'Tidaka Ada data';
            if($read_data != null){
                $result= /** @lang text */'
                <div class="col-md-12">
                    <div class="col-lg-6">
                        <div class="team-one__single">
                            <div class="blog-one__image2">
                                <img src="'.$read_data["image"].'" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="team-details__content">
                            <h2 class="team-details__title">'.$read_data["title"].'</h2>
                            <p class="team-details__text" style="text-align:justify">'.strip_tags($read_data["deskripsi"]).'</p>
                            <p class="team-details__text" style="font-size:16px;text-align:justify;color: #333">Visi</p>
                            <p class="team-details__text" style="text-align:justify">'.strip_tags($read_data["visi"]).'</p>
                             <p class="team-details__text" style="font-size:16px;text-align:justify;color: #333">Misi</p>
                            <p class="team-details__text" style="text-align:justify">'.strip_tags($read_data["misi"]).'</p>
                        </div>
                    </div>
                </div>
                <hr/>
                ';
            }
            else{
                $result=/** @lang text */'<div class="col-md-12"><h1 class="text-center">Tidak Ada Data</h1></div>';
            }
            echo json_encode(array('result'=> $result,'title'=> $title));
        }
    }
}