<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_Controller extends CI_Controller{
	public function index(){
		$data['isi'] = 'page/beranda/index';
		$data['jurusan'] = $this->M_crud->read_data("tbl_jurusan","*");
		$data['config'] = $this->M_crud->get_data("tbl_config","*");
		$data['manajemen'] = $this->M_crud->get_data("tbl_manajemen","*","jabatan=1");
		$data['berita'] = $this->M_crud->read_data("tbl_berita","*","type='1'","id desc",null,3);
		$data['gallery'] = $this->M_crud->read_data("tbl_gallery","*","type='4'","id desc",null,3);
		$data['jurusan'] = $this->M_crud->read_data("tbl_jurusan","*");
		$data['berita'] = $this->M_crud->read_data("tbl_berita","*",null,"id desc",null,3);
 		$this->load->view("layout/wrapper.php",$data);
	}


	public function load_banner(){
        $ke = '';$slide='';$gbr='';
        $read_data = $this->M_crud->read_data("tbl_gallery","*","type='7'");
        foreach($read_data as $key=>$value){
            $ke.=$key;
            $gbr.=$value['image'];
            $slide.= /** @lang text */'
            <div class="banner-one__slide banner-one__slide-'.$ke.'" style="background-image: url('."'$gbr'".');">
                <div class="container">
                    <div class="banner-one__bubble-1"></div>
                    <div class="banner-one__bubble-2"></div>
                    <div class="banner-one__bubble-3"></div>
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <h3 class="banner-one__title banner-one__light-color">'.$value["title"].' </h3>
                            <p class="banner-one__tag-line">'.$value["deskripsi"].' </p>
                            <a href="'.$value["link"].'" class="thm-btn banner-one__btn">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        echo json_encode(array('result'=>$slide));
    }

	function beranda(){
		$data['isi'] = 'page/beranda/index';
		$this->load->view("layout/wrapper.php",$data);
	}
	function berita($action=null){
        $data['isi'] = 'page/berita/index';
        if($action == "get"){
            $pagin = $this->M_website->myPagination('v_berita','id',"type='1'",8);
            $read_data = $this->M_crud->read_data(
                "v_berita","*",
                "type='1'","id desc",null,$pagin["perPage"], $pagin['start']
            );
            $res_index = "";
            if($read_data != null){
                foreach ($read_data as $row):
                    $res_index.=$this->M_website->tempNews($row['image'],base_url("detail?type=berita&title=".$row['slug']),$row['created_at'],$row['nama'],$row['title'],$row['content']);
                endforeach;
            }else{
                $res_index .=/**@lang text */'<div class="col-md-12"><h1 class="text-center">Tidak Ada Data</h1></div>';
            }
            $data = array(
                "pagination_link"   => $pagin['pagination_link'],
                "result_table" 	    => $res_index,
            );
            echo json_encode($data);
        }else{
            $this->load->view("layout/wrapper.php",$data);
        }
	}

    function login(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->form_validation->run() != FALSE){
            $cek = $this->M_crud->get_data('tbl_siswa','*',array('nis'=>$username));
            if($cek){
                $this->M_crud->update_data("tbl_siswa",array("isLogin"=>1),"nis='".$username."'");
                redirect('http://localhost/perpustakaan/bo/dashboard');
            }else{
                $this->session->set_flashdata('error', 'Username tidak dikenali.');
                redirect('menu_controller/login');
            }
        }else{
            $this->session->set_flashdata('error', 'Username/Password tidak valid.');
            redirect('menu_controller/login');
        }

        $this->load->view("");

    }

}
 ?>