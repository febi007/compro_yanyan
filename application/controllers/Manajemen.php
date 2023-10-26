<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 19/12/2019
 * Time: 17:45
 */

class Manajemen extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->table = 'v_manajemen';
    }
    public function index(){
        $data['isi'] = 'page/manajemen/'.$_GET['type'];
        $this->load->view("layout/wrapper.php"	,$data);
    }

    public function filter1($where){
        $read_data = $this->M_crud->get_data($this->table,"*",$where);
        if($read_data != null){
            $title = $read_data['nama_jabatan'];
            $result= $this->M_website->tempOne(str_replace("www.","",$read_data["image"]),$read_data["nama"],$read_data["nip"],$read_data["nama_jabatan"],$read_data["deskripsi"]);
        }else{
            $title = $this->M_website->noData();
            $result= $this->M_website->noData();
        }
        return $data = array('title'=>$title,'result'=>$result);
    }


    public function load_data($action=null){
        $result='';$title='';
        if($action == 'kepala_sekolah'){
            $config = $this->filter1("jabatan='1'");
            echo json_encode(array('result'=> $config['result'],'title'=> $config['title']));
        }elseif ($action == 'kepala_tu'){
            $config = $this->filter1("jabatan='2'");
            echo json_encode(array('result'=> $config['result'],'title'=> $config['title']));
        }
        elseif ($action == 'wakil_kepala_sekolah'){
            $pagin = $this->M_website->myPagination($this->table,'id','jabatan=3',8);
            $read_data = $this->M_crud->read_data($this->table,"*","jabatan='3'","id desc",null,$pagin["perPage"], $pagin['start']);
            if($read_data!=null){
                $title.= "Wakil Kepala Sekolah";
                foreach($read_data as $row){
                    $result.=$this->M_website->tempTwo(str_replace("www.","",$row["image"]),$row['nama'],$row['nip'],$row['deskripsi']);
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
        elseif($action == 'dewan_komite'){
            $pagin = $this->M_website->myPagination($this->table,'id','jabatan=4',8);
            $read_data = $this->M_crud->read_data($this->table,"*","jabatan='4'","id desc",null,$pagin["perPage"], $pagin['start']);
            if($read_data!=null){
                $title.= "Dewan Komite";
                foreach($read_data as $row){
                    $result.=$this->M_website->tempTwo(str_replace("www.","",$row["image"]),$row['nama'],$row['nip'],$row['deskripsi']);
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
        elseif($action == 'kajur_kaprog'){
            $where = "jabatan in(5,6)";
            if($this->input->post("any") != null || $this->input->post("any") != ''){
                ($where == null) ? null : $where .= " AND ";
                $where.="slug='".$_POST['any']."'";
            }
            $pagin=$this->M_website->myPagination($this->table,'id',$where,8);
            $read_data = $this->M_crud->read_data($this->table,"*",$where,"id desc",null,$pagin["perPage"], $pagin['start']);
            if($read_data!=null){
                $title.= "Kajur & Kaprog";
                foreach($read_data as $row){
                    if($row['jabatan'] == 5){
                        $jabatan =  $row['nip']?$row['nip']:"-".'<br><br> ( Kajur )';
                    }elseif ($row['jabatan'] == 6){
                        $jabatan =  $row['nip']?$row['nip']:"-".'<br><br> ( Kaprog )';
                    }
                    $result.=$this->M_website->tempTwo(str_replace("www.","",$row["image"]),$row['nama'],$jabatan,$row['title']);
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