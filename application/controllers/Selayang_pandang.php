<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 19/12/2019
 * Time: 17:17
 */

class Selayang_pandang extends CI_Controller
{
    public function index(){
        $data['isi'] = 'page/selayang/'.$_GET['type'];
        $this->load->view("layout/wrapper.php",$data);
    }

    public function load_data($action=null){
        $result='';$title = ''; $table = 'v_berita';
        if($action == 'sejarah'){
            $read_data = $this->M_crud->get_data($table,"*","id='5'");
            $title.=$read_data['title']!=null?$read_data['title']:'Tidaka Ada data';
            if($read_data != null){
                $result.=$this->M_website->tempThree($read_data["image"],$read_data["title"],$read_data["content"]);
            }
            else{
                $result.=$this->M_website->noData();
            }
            echo json_encode(array('result'=> $result,'title'=> $title));

        }
        elseif($action == 'visi_misi'){
            $read_data = $this->M_crud->get_data($table,"*","id='6'");
            $title.=$read_data['title']!=null?$read_data['title']:'Tidaka Ada data';
            if($read_data!=null){
                $result.=/** @lang text */'
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="sidebar">
                        <div class="sidebar__single sidebar__search">
                            <h2 class="blog-one__title">'.$read_data["title"].'</h2>
                            <p class="blog-one__text" style="font-weight: bold;">'.$read_data["content"].'</p>
                        </div>
                    </div>
                </div>';
            }
            else{
                $result.=$this->M_website->noData();
            }
            echo json_encode(array('result'=> $result,'title'=> $title));

        }
        elseif($action == 'budaya'){
            $read_data = $this->M_crud->get_data($table,"*","id='7'");
            $title.=$read_data['title']!=null?$read_data['title']:'Tidaka Ada data';
            if($read_data != null){
                $result.=$this->M_website->tempThree($read_data["image"],$read_data["title"],$read_data["content"]);
            }
            else{
                $result.=$this->M_website->noData();
            }
            echo json_encode(array('result'=> $result,'title'=> $title));

        }
        elseif($action == 'landasan_hukum'){
            $read_data = $this->M_crud->get_data($table,"*","id='8'");
            $title.=$read_data['title']!=null?$read_data['title']:'Tidaka Ada data';
            if($read_data!=null){
                $result.=$this->M_website->tempThree($read_data["image"],$read_data["title"],$read_data["content"]);
            }else{
                $result.=/** @lang text */'<div class="col-md-12"><h1 class="text-center">Tidak Ada Data</h1></div>';
            }
            echo json_encode(array('result'=> $result,'title'=> $title));
        }
        elseif($action == 'fasilitas'){
            $pagin = $this->M_website->myPagination('tbl_gallery', "id", "type='5' and status='1'",6);
            $read_data = $this->M_crud->read_data("tbl_gallery","*","type='5' and status='1'","id desc",null,$pagin["perPage"], $pagin['start']);
            if($read_data != null){
                $title.='Fasilitas';
                foreach($read_data as $row){
                    if(strlen($row["title"]) > 20){
                        $luhur = substr($row['title'],0,20).' ...';
                    }else{
                        $luhur = $row['title'];
                    }

                    $result.= /** @lang text */'
                        <div class="col-lg-4 col-xs-6">
                            <div class="blog-one__single">
                                <div class="blog-one__image">
                                    <img src="'.$row["image"].'" alt="">
                                </div>
                                <div class="blog-one__content text-center">
                                    <h4>'.$luhur.'</h4>
                                    <p class="blog-one__text">'.$row['deskripsi'].'</p>
                                </div>
                            </div>
                        </div>
                    ';
                }

            }else{
                $title.=$this->M_website->noData();
                $result.=$this->M_website->noData();
            }
            echo json_encode(array(
                "pagination_link"   => $pagin['pagination_link'],
                'result'            => $result,
                'title'             => $title
            ));
        }

    }
}