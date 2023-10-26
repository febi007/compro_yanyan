<?php 	
/**
* 
*/
class Auth extends CI_Controller
{
	public function index(){
		// dd($this->bcrypt->hash_password('admin1'));
        error_reporting(0);

		if($_GET['type'] == 'siswa') {
            if ($this->session->isLogin == true) {
                redirect();
            } else {
                $this->load->view('auth/login', array('title' => 'SMKN 14 Bandung', 'config' => $this->M_crud->get_data("tbl_config", "*")));
            }
        }else{
            if($this->session->is_logged_in){
                redirect('site');
            }else{
                $this->load->view('auth/login_bo',array('title'=>'SMKN 14 Bandung'));
            }
        }


	}

	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$username = $this->input->post('username');
		$password = $this->input->post('password');


		if ($this->form_validation->run() != FALSE){
            $cek = $this->M_crud->get_data('v_user','*',array('username'=>$username));
            if($cek){
                if ($this->bcrypt->check_password($password , $cek['password'])){
                    // dd($cek);
                    $session=array(
                        'id'=>$cek['id'],
                        'nama'=>$cek['nama'],
                        'username'=>$cek['username'],
                        'id_level'=>$cek['id_level'],
                        'level'=>$cek['level'],
                        'access_level'=>$cek['access_level'],
                        'grant_access'=>$cek['grant_access'],
                        'is_logged_in'=>true,
                    );
                    $this->session->set_userdata($session);
                    redirect('site');
                }else{
                    $this->session->set_flashdata('error', 'Password salah.');
                    redirect('auth');
                }
            }
            else{
                $this->session->set_flashdata('error', 'Username tidak dikenali.');
                redirect('auth');
            }
		}
		else{
			$this->session->set_flashdata('error', 'Username/Password tidak valid.');
			redirect('auth');
		}

	}


    public function logins(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->form_validation->run() != FALSE){
            $cek_ = $this->M_crud->get_data('tbl_siswa','*',"nis='$username' and nis='$password'");
            if($cek_){
                $data = array(
                    "id"=>$cek_['id'],
                    "id_kelas"=>$cek_['id_kelas'],
                    "nis"=>$cek_['nis'],
                    "nama"=>$cek_['nama'],
                    "jenis_kelamin"=>$cek_['jenis_kelamin'],
                    "no_hp"=>$cek_['no_hp'],
                    "alamat"=>$cek_['alamat'],
                    'isLogin'=>true,
                );
                $this->session->set_userdata($data);
                redirect('beranda');

            }else{
                $this->session->set_flashdata('error', 'Username atau password tidak dikenali.');
                redirect('auth?type=siswa');
            }

        }
        else{
            $this->session->set_flashdata('error', 'Username/Password tidak valid.');
            redirect('auth?type=siswa');
        }

    }

	function logout(){
		$this->session->sess_destroy();
		// null the session (just in case):
		redirect('/auth');
	}
    function logout_(){
        $this->session->sess_destroy();
        // null the session (just in case):
        redirect('beranda');
    }
}
 ?>