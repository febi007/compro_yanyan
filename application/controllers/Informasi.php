<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 20/12/2019
 * Time: 11:29
 */

class Informasi extends CI_Controller
{
    public function index(){
        $folder = 'informasi'; $type = $_GET['type'];
        $data['isi'] = 'page/'.$folder.'/'.$type;
        $this->load->view("layout/wrapper.php"	,$data);
    }

    public function load_data($action=null){
        $title='';$result='';
        if($action=='tenaga_pendidik'){
            $pagin = $this->M_website->myPagination('v_manajemen','id','jabatan=7',8);
            $read_data = $this->M_crud->read_data('v_manajemen',"*","jabatan='7'","id desc",null,$pagin["perPage"], $pagin['start']);
            if($read_data!=null){
                $title.= "Tenaga Pendidik";
                foreach($read_data as $row){
                    $result.=$this->M_website->tempTwo(str_replace("www.","",$row['image']),$row['nama'],$row['nip'],$row['deskripsi']);
                }
            }else{
                $title.=/** @lang text */'<div class="col-md-12"><h1 class="text-center">Tidak Ada Data</h1></div>';
                $result.=/** @lang text */'<div class="col-md-12"><h1 class="text-center">Tidak Ada Data</h1></div>';
            }
            echo json_encode(array(
                "pagination_link"   => $pagin['pagination_link'],
                'result'            => $result,
                'title'             => $title
            ));
        }
        elseif($action=='prestasi'){
            $read_header = $this->M_crud->get_data("v_berita","*","id='16'");
            $title.=$read_header['title'];
            $title_body ='Galeri Prestasi';
            $pagin = $this->M_website->myPagination("tbl_gallery",'id','type=8',8);
            $read_data = $this->M_crud->read_data("tbl_gallery","*",'type=8',"id desc",null,$pagin["perPage"], $pagin['start']);
            $header='<div class="col-lg-12">'.html_entity_decode($read_header["content"]).'</div>';
            $body='';
            if($read_data!=null){
                foreach($read_data as $row){
                    $body.='
                    <div class="col-md-4">
                        <div class="blog-two__single" style="background-image: url('.str_replace("www.","",$row['image']).')">
                            <div class="blog-two__inner">
                                <a href="'.base_url("detail?type=gallery&title=".$row["slug"]).'" class="blog-two__date">
                                    <span>'.date("d",strtotime($row["created_at"])).'</span>
                                    '.date("M",strtotime($row["created_at"])).'
                                </a>
                                <div class="blog-two__meta">
                                    <a href="#">oleh Admin</a>
                                </div>
                                <h3 class="blog-two__title">
                                    <a href="'.base_url("detail?type=gallery&title=".$row["slug"]).'">'.$row["title"].'</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    
                    ';
                }
            }else{
                $body.=$this->M_website->noData();
            }
            echo json_encode(array(
                'header'=>$header,
                'title'=>$title,
                'result_body'=>$body,
                "pagination_link"   => $pagin['pagination_link'],
                'title_body'=>$title_body
            ));
        }
        elseif ($action == 'sarana_prasarana'){
            $pagin = $this->M_website->myPagination("tbl_gallery",'id',"type='6' and status='1'",10);
            $read_data = $this->M_crud->read_data("tbl_gallery","*","type='6' and status='1'","id desc",null,$pagin["perPage"], $pagin['start']);
            if($read_data!=null){
                $title.='Sarana & Prasarana';
                foreach($read_data as $row){
                    $result.=$this->M_website->tempThree(str_replace("www.","",$row['image']),$row["title"],$row["deskripsi"]);
                }
            }else{
                $title.='Tidak Ada Data';
                $result.='<h1 class="text-center">Tidak Ada Data</h1>';
            }
            echo json_encode(array(
                'pagination_link' => $pagin['pagination_link'],
                'result'=>$result,
                'title'=>$title
            ));
        }
        elseif ($action == 'akreditasi'){
            $read_data = $this->M_crud->get_data('v_berita',"*","id=4");
            if($read_data!=null){
                $title.=$read_data['title'];
                $result.=$this->M_website->tempThree(str_replace("www.","",$read_data['image']),$read_data["title"],$read_data["content"]);
            }else{
                $title.='Tidak Ada Data';
                $result.='<h1 class="text-center">Tidak Ada Data</h1>';
            }
            echo json_encode(array(
                'result'=>$result,
                'title'=>$title
            ));
        }
        elseif ($action == 'lowongan_kerja'){
            $pagin = $this->M_website->myPagination("v_berita",'id','status=1 and type=2',10);
            $read_data = $this->M_crud->read_data("v_berita","*",'status=1 and type=2',"id desc",null,$pagin["perPage"], $pagin['start']);
            if($read_data!=null){
                $title.='Lowongan Kerja';
                foreach($read_data as $row){
                    if(strlen($row['content']) > 220){
                        $desc = substr($row['content'],0,220).' .... ';
                    }else{
                        $desc = $row['content'];
                    }
                    $result.= /** @lang text */'
                    <div class="col-md-12">
                        <div class="col-lg-4">
                            <div class="blog-one__single">
                                <div class="blog-one__image">
                                    <img src="'.str_replace("www.","",$row['image']).'" alt="" widht="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <h3 class="text-left" style="color: #012237">'.$row["title"].'</h3>
                            <p class="blog-one__text">'.html_entity_decode($desc).' <a href="'.base_url("detail?type=lowongan_kerja&title=".$row['slug']).'">Selengkapnya</a></p>
                            <p class="blog-one__text"><i class="fa fa-clock"></i> '.date("Y-m-d",strtotime($row["created_at"])).' | <i class="fa fa-share"></i> Bagikan</p>
                        </div>
                        
                    </div>
                    <hr/>
                    ';
                }
            }else{
                $title.='Tidak Ada Data';
                $result.='<h1 class="text-center">Tidak Ada Data</h1>';
            }
            echo json_encode(array(
                'pagination_link' => $pagin['pagination_link'],
                'result'=>$result,
                'title'=>$title
            ));
        }
    }

}