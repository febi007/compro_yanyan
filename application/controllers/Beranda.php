<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 20/12/2019
 * Time: 21:39
 */

class Beranda extends CI_Controller
{
    function __construct() {
        parent::__construct();
        // Load the captcha helper
        $this->load->helper('captcha');
    }
    public function chaptaConfig(){
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'img_width'     => '160',
            'img_height'    => 76,
            'word_length'   => 4,
            'font_size'     => 20,
            'font_path'     => './path/to/fonts/texb.ttf',
            'expiration'    => 60
        );

        return $config;
    }

    public function index(){


        $this->load->library('user_agent');
        $user_ip=$_SERVER['REMOTE_ADDR'];
        if ($this->agent->is_browser()){
            $agent = $this->agent->browser();
        }elseif ($this->agent->is_robot()){
            $agent = $this->agent->robot();
        }elseif ($this->agent->is_mobile()){
            $agent = $this->agent->mobile();
        }else{
            $agent='Other';
        }
        $cek_ip = $this->M_crud->read_data("tbl_pengunjung","COUNT(ip_pengunjung) AS jml", array("ip_pengunjung"=>$user_ip));
        $isExist = $cek_ip[0]['jml'];
        if($isExist==0)  {
            $this->M_crud->create_data("tbl_pengunjung", array(
                "ip_pengunjung"=>$user_ip,
                "perangkat_pengunjung"=> $agent
            ));
        }

//        $config = $this->chaptaConfig();
//        $captcha = create_captcha($config);
//        $this->session->set_userdata('captchaCode',$captcha['word']);
//        // Send captcha image to view
//        $data['captchaImg'] = $captcha['image'];
        $data['page'] = 'beranda';
        $data['isi'] = 'page/beranda/index';
        $data['jurusan'] = $this->M_crud->read_data("tbl_jurusan","*");
        $data['config'] = $this->M_crud->get_data("tbl_config","*");
        $data['manajemen'] = $this->M_crud->get_data("tbl_manajemen","*","jabatan=1");
        $data['gallery'] = $this->M_crud->read_data("tbl_gallery","*","type in(1,2,3,4)","id desc",null,3);
        $data['jurusan'] = $this->M_crud->read_data("tbl_jurusan","*");
        $this->load->view("layout/wrapper.php",$data);
    }

    public function load_data($action=null){
        if($action == 'gallery'){
            $read_data = $this->M_crud->read_data("tbl_gallery","*",null,"RAND()",null,3);
            if($read_data!=null){
                foreach($read_data as $row){
                    $result =$this->M_website->tempFour($row['image'],$row['created_at'],'netindo',$row['title'],$row['title']);
                }
            }else{
                $result = $this->M_website->noData();
            }
            echo json_encode(array('result'=>$result));
        }


    }
    public function refresh(){
//        $config = $this->chaptaConfig();
//        $captcha = create_captcha($config);
//        $this->session->unset_userdata('captchaCode');
//        $this->session->set_userdata('captchaCode',$captcha['word']);
//
//
//        // Display captcha image
//        echo $captcha['image'];

    }

    public function komentar(){
//        $config = $this->chaptaConfig();
//        $captcha = create_captcha($config);
        $response = array();
        $input = $this->input->post();
        $inputCaptcha = $input['captcha'];
        $sessCaptcha = $this->session->userdata('captchaCode');
        if($inputCaptcha === $sessCaptcha){
//            $this->session->unset_userdata('captchaCode');
//            $this->session->set_userdata('captchaCode',$captcha['word']);
            $this->M_crud->create_data("tbl_contact",array('nama'=>$input['nama'],'email'=>$input['email'],'pesan'=>$input['pesan']));
            $response['status']='success';
            $response['msg']='Berhasil Mengirim pesan';
        }else{
            $response['status']='failed';
            $response['msg']='chapta tidak sama';
        }
        echo json_encode($response);
    }

}