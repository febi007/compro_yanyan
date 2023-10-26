<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 22/12/2019
 * Time: 15:20
 */

class Download extends CI_Controller
{
    function __construct() {
        parent::__construct();
        // Load the captcha helper
        $this->load->helper('download');
    }
    public function index(){
        $data['isi'] = 'page/download/index';
        $this->load->view("layout/wrapper.php",$data);
    }

    public function load_data($action=null){
        $result='';$title='';$no=1;
        $where	= "status='1'";
        $this->session->unset_userdata('search');
        isset($_POST["search"]) ? $this->session->set_userdata('search', array('any' => $_POST['any'])) : null;
        $search = $this->session->search['any'];
        if(isset($search)&&$search!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "title like '%".$search."%'";
        }
        if($action=='get_data'){
            $pagin = $this->M_website->myPagination('tbl_files','id',$where,6);
            $read_data = $this->M_crud->read_data(
                "tbl_files","*",
                $where,"id desc",null,$pagin["perPage"], $pagin['start']
            );
            if($read_data!=null){
                $title.='<h1 class="text-center">Download</h1>';
                foreach($read_data as $row){
                    $result.='
                    <tr>
                        <td>'.$no++.'</td>
                        <td>'.$row["title"].'</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="'.base_url("download/download_files/".$row["id"]).'" "><i class="fa fa-download"></i></a>
                        </td>
                    </tr>
                ';
                }
            }else{
                $title.='<h1 class="text-center">Tidak Ada Data</h1>';
                $result.='<tr><td colspan="4">Tidak Ada Data</td></tr>';
            }
            echo json_encode(array(
                "pagination_link"   => $pagin['pagination_link'],
                "result_table" 	    => $result,
                "title"=>$title
            ));
        }
        elseif($action == 'download'){

        }
    }

    public function download_files($id){
        $read_data=$this->M_crud->get_data("tbl_files","*","id='$id'");
        $file=$read_data['link'];
        $hits = $read_data['hits']+1;
        $this->M_crud->update_data("tbl_files",array("hits"=>$hits),"id='$id'");
//        var_dump($hits);die();
//        var_dump();die();
        $data =  file_get_contents($file);
        force_download($file, $data);
        redirect('download');

//        var_dump()
//        dd(force_download($file, $data));
    }
}