<?php 

// tbl_berita: type 1:berita;type 2:lowongan;type 3:informasi;

class Site extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->output->set_header("Cache-Control: no-store, no-cache, max-age=0, post-check=0, pre-check=0");
		if(!$this->session->is_logged_in){
			redirect('auth');
		}
		$this->akses=(int)$this->session->grant_access==0?false:true;
		$this->id=$this->session->id;
		$this->layout='backoffice/layout/index';
		$this->site='SMKN 14 BANDUNG';
	}
	
	function index(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Dashboard',
			'page'=>'dashboard/index',
			'js'=>'dashboard/js',
			'guru'=> $this->M_crud->count_data('tbl_manajemen','jabatan',array('jabatan'=>7)),
			'siswa'=> $this->M_crud->count_data('tbl_siswa','id'),
			'pengunjung'=> $this->M_crud->count_data('tbl_pengunjung','id_pengunjung'),
		);
		$this->load->view($this->layout,$data);
	}

	function home(){
		$chart = $this->db->query('SELECT weekday(tanggal_pengunjung)AS daily,COUNT(id_pengunjung) jumlah FROM tbl_pengunjung GROUP BY daily ORDER BY daily ASC')->result_array();
		$donut = $this->db->query('SELECT COUNT(perangkat_pengunjung) AS value, perangkat_pengunjung AS platform FROM tbl_pengunjung GROUP BY platform ORDER BY platform ASC')->result_array();
		$pengunjung = array();
		foreach($chart as $item){
			array_push($pengunjung, 
			array(
				'x'=>($item['daily']==0?"SENIN":($item['daily']==1?"SELASA":($item['daily']==2?"RABU":($item['daily']==3?"KAMIS":($item['daily']==4?"JUMAT":($item['daily']==5?"SABTU":"MINGGU")))))),
				'y'=>$item['jumlah']
			));
		}

		$platform = array();
		foreach($donut as $item){
			array_push($platform, 
			array(
				'value'=> $item['value'],
                'label'=>$item['platform']
			));
		}
		echo json_encode(array(
			'chart'=>$pengunjung,
			'donut'=>$platform
		), true);

	}

	function berita(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Manajemen Berita',
			'page'=>'berita/index',
			'js'=>'berita/js'
		);
		$this->load->view($this->layout,$data);
	}

	function lowongan(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Manajemen Lowongan Pekerjaan',
			'page'=>'lowongan/index',
			'js'=>'lowongan/js'
		);
		$this->load->view($this->layout,$data);
	}

	function beritaAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			if(!$this->akses) $where['id_member']=$this->id;
			if(isset($_GET['category'])) $where['id_category']=$_GET['category'];
			if(isset($_GET['type'])) $where['type']=$_GET['type'];
			if(isset($_GET['status'])) $where['status']=$_GET['status'];
			if(isset($_GET['q'])) $where['title like']="%".$_GET['q']."%";
			$page= isset($_GET['page'])?$_GET['page']:1;
			$count = $this->M_crud->count_read_data('v_berita','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
			$countpage = $jml==0?1:$jml;
			
			$berita = $this->M_crud->read_data('v_berita','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('v_berita','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id_member"=>$this->session->id,
					"id_category"=>$this->input->post('id_category'),
					"title"=>$this->input->post('title'),
					"slug"=>url_title($this->input->post('title'), 'dash', true),
					"content"=>$this->input->post('content'),
					"image"=>getImage(_uploadImage()),
					"tags"=>$this->input->post('tags'),
					"status"=>(!$this->akses?'0':'1'),
					"type"=>$this->input->post('type')
				);
				$berita = $this->M_crud->create_data('tbl_berita',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$image;
				$data = array(
					"id_member"=>$this->session->id,
					"id_category"=>$this->input->post('id_category'),
					"title"=>$this->input->post('title'),
					"slug"=>url_title($this->input->post('title'), 'dash', true),
					"content"=>$this->input->post('content'),
					"tags"=>$this->input->post('tags'),
					"status"=>(!$this->akses?'0':'1'),
					"type"=>$this->input->post('type'),
					"updated_at"=>date("Y-m-d")
				);
				if (!empty($_FILES["image"]["name"])) {
					$image = _uploadImage();
					$data['image']=getImage($image);
				}
				$berita = $this->M_crud->update_data('tbl_berita',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_berita',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_berita',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function categoryAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			// if(!$this->akses) $where['id']=$this->id;
			$where['id !=']=4;
			$page= isset($_GET['page'])?$_GET['page']:1;
			if(isset($_GET['q'])) $where['title like']="%".$_GET['q']."%";

			$count = $this->M_crud->count_read_data('tbl_category','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('tbl_category','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('tbl_category','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"title"=>$this->input->post('title'),
					"slug"=>url_title($this->input->post('title'), 'dash', true),

				);
				$berita = $this->M_crud->create_data('tbl_category',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"title"=>$this->input->post('title'),
					"slug"=>url_title($this->input->post('title'), 'dash', true),
					"updated_at"=>date("Y-m-d")
				);
				$berita = $this->M_crud->update_data('tbl_category',$data,array('id'=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_category',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id'),
					"status"=>$this->input->post('status'),
					"updated_at"=>date("Y-m-d")
				);
				$berita = $this->M_crud->update_data('tbl_category',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function user(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Manajemen User',
			'page'=>'user/index',
			'js'=>'user/js'
		);
		$this->load->view($this->layout,$data);
	}

	function userAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			if(!$this->akses) $where['id_member']=$this->id;
			$page= isset($_GET['page'])?$_GET['page']:1;
			if(isset($_GET['q'])) $where['nama like']="%".$_GET['q']."%";

			$where['id !=']=1;
			$count = $this->M_crud->count_read_data('v_user','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('v_user','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('v_user','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"nama"=>$this->input->post('nama'),
					"username"=>$this->input->post('username'),
					"password"=>$this->bcrypt->hash_password($this->input->post('password')),
					"status"=>$this->input->post('status'),
					"id_level"=>$this->input->post('level'),
				);
				$berita = $this->M_crud->create_data('tbl_user',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"nama"=>$this->input->post('nama'),
					"username"=>$this->input->post('username'),
					"status"=>$this->input->post('status'),
					"id_level"=>$this->input->post('level'),
					"updated_at"=>date("Y-m-d")

				);
				if($this->input->post('password')!=''){
					$data['password']=$this->bcrypt->hash_password($this->input->post('password'));
				}
				$berita = $this->M_crud->update_data('tbl_user',$data,array('id'=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_user',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_user',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function userlevel(){
		$data=array(
			'site'=>$this->site,
			'title'=>'User Level',
			'page'=>'userLevel/index',
			'js'=>'userLevel/js'
		);
		$this->load->view($this->layout,$data);
	}

	function userLevelAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			if(!$this->akses) $where['id_member']=$this->id;
			$page= isset($_GET['page'])?$_GET['page']:1;
			if(isset($_GET['q'])) $where['title like']="%".$_GET['q']."%";
			$count = $this->M_crud->count_read_data('tbl_user_level','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('tbl_user_level','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('tbl_user_level','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"title"=>$this->input->post('title'),
				);
				$berita = $this->M_crud->create_data('tbl_user_level',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"title"=>$this->input->post('title')
				);
				$berita = $this->M_crud->update_data('tbl_user_level',$data,array('id'=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_user_level',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id'),
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_user_level',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function manajemen(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Manajemen',
			'page'=>'manajemen/index',
			'js'=>'manajemen/js'
		);
		$this->load->view($this->layout,$data);
	}

	function guru(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Guru',
			'page'=>'guru/index',
			'js'=>'guru/js'
		);
		$this->load->view($this->layout,$data);
	}

	function manajemenAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			// if(!$this->akses) $where['id_member']=$this->id;
			$page= isset($_GET['page'])?$_GET['page']:1;
			$type= isset($_GET['type'])?$_GET['type']:'all';
			if(isset($_GET['q'])) $where['nama like']="%".$_GET['q']."%";

			if($type=='guru') $where['jabatan']=7;
			else $where['jabatan !=']=7;

			$count = $this->M_crud->count_read_data('v_manajemen','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
			$countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('v_manajemen','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('v_manajemen','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"nama"=>$this->input->post('nama'),
					"jabatan"=>$this->input->post('jabatan'),
					"nip"=>$this->input->post('nip'),
					"image"=>getImage(_uploadImage()),
					"deskripsi"=>$this->input->post('deskripsi'),
					"matpel"=>$this->input->post('matpel'),
					"id_jurusan"=>$this->input->post('id_jurusan'),
				);
				$berita = $this->M_crud->create_data('tbl_manajemen',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"nama"=>$this->input->post('nama'),
					"jabatan"=>$this->input->post('jabatan'),
					"nip"=>$this->input->post('nip'),
					"deskripsi"=>$this->input->post('deskripsi'),
					"matpel"=>$this->input->post('matpel'),
					"id_jurusan"=>$this->input->post('id_jurusan'),

				);
				if (!empty($_FILES["image"]["name"])) {
                    $getImg=$this->M_crud->get_data('tbl_manajemen','*',"id='".$this->input->post('id')."'");
                    $imgReplace=str_replace(base_url(),'',$getImg['image']) ;
                    if(file_exists($imgReplace)){
                        unlink($imgReplace);
                    }
                    $image = getImage(_uploadImage());
					$data['image']=$image;

				}
				$berita = $this->M_crud->update_data('tbl_manajemen',$data,array('id'=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $getImg=$this->M_crud->get_data('tbl_manajemen','*',"id='".$this->input->post('id')."'");
                $imgReplace=str_replace(base_url(),'',$getImg['image']) ;
                if(file_exists($imgReplace)){
                    unlink($imgReplace);
                }

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_manajemen',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id'),
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_manajemen',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function jabatanAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			// if(!$this->akses) $where['id_member']=$this->id;
			if(isset($_GET['q'])) $where['title like']="%".$_GET['q']."%";

			$page= isset($_GET['page'])?$_GET['page']:1;
			$count = $this->M_crud->count_read_data('tbl_jabatan','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('tbl_jabatan','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('tbl_jabatan','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"title"=>$this->input->post('title'),
				);
				$berita = $this->M_crud->create_data('tbl_jabatan',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"title"=>$this->input->post('title')
				);
				$berita = $this->M_crud->update_data('tbl_jabatan',$data,array('id'=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_jabatan',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id'),
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_jabatan',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function informasi(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Informasi',
			'page'=>'informasi/index',
			'js'=>'informasi/js'
		);
		$this->load->view($this->layout,$data);
	}

	function jurusan(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Manajemen Jurusan',
			'page'=>'jurusan/index',
			'js'=>'jurusan/js'
		);
		$this->load->view($this->layout,$data);
	}

	function jurusanAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			$page= isset($_GET['page'])?$_GET['page']:1;
			if(isset($_GET['q'])) $where['title like']="%".$_GET['q']."%";

			$count = $this->M_crud->count_read_data('tbl_jurusan','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('tbl_jurusan','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('tbl_jurusan','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"title"=>$this->input->post('title'),
					"slug"=>url_title($this->input->post('title'), 'dash', true),
					"image"=>getImage(_uploadImage()),
					"icon"=>getImage(_uploadImage('image2')),
					"deskripsi"=>$this->input->post('deskripsi'),
					"visi"=>$this->input->post('visi'),
					"misi"=>$this->input->post('misi'),
				);
				$berita = $this->M_crud->create_data('tbl_jurusan',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"title"=>$this->input->post('title'),
					"slug"=>url_title($this->input->post('title'), 'dash', true),
					"deskripsi"=>$this->input->post('deskripsi'),
					"visi"=>$this->input->post('visi'),
					"misi"=>$this->input->post('misi'),
					"updated_at"=>date("Y-m-d")

				);
				if (!empty($_FILES["image"]["name"])) {
					$image = _uploadImage();
					$data['image']=getImage($image);
				}
				if (!empty($_FILES["image2"]["name"])) {
					$image = _uploadImage('image2');
					$data['icon']=getImage($image);
				}
				
				$berita = $this->M_crud->update_data('tbl_jurusan',$data,array('id'=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_jurusan',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_jurusan',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function siswa(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Siswa',
			'page'=>'siswa/index',
			'js'=>'siswa/js'
		);
		$this->load->view($this->layout,$data);
	}

	function siswaAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			// if(!$this->akses) $where['id']=$this->id;
			if(isset($_GET['q'])) $where['nama like']="%".$_GET['q']."%";

			$page= isset($_GET['page'])?$_GET['page']:1;
			$kelas= $_GET['kelas'];
			if($kelas!=0) $where['id_kelas']=$kelas;
			if(isset($_GET['q'])) $where['nama LIKE']='%'.$_GET['q'].'%';
			$count = $this->M_crud->count_read_data('v_siswa','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('v_siswa','*',$where,null, null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('v_siswa','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"nama"=>$this->input->post('nama'),
					"nis"=>$this->input->post('nis'),
					"id_kelas"=>$this->input->post('kelas'),
					"jenis_kelamin"=>$this->input->post('jenis_kelamin'),
					"no_hp"=>$this->input->post('no_hp'),
					"alamat"=>$this->input->post('alamat'),
				);
				$berita = $this->M_crud->create_data('tbl_siswa',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"nama"=>$this->input->post('nama'),
					"nis"=>$this->input->post('nis'),
					"id_kelas"=>$this->input->post('kelas'),
					"jenis_kelamin"=>$this->input->post('jenis_kelamin'),
					"no_hp"=>$this->input->post('no_hp'),
					"alamat"=>$this->input->post('alamat'),
				);
				$berita = $this->M_crud->update_data('tbl_siswa',$data,array('id'=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_siswa',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id'),
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_siswa',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function kelas(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Kelas',
			'page'=>'kelas/index',
			'js'=>'kelas/js'
		);
		$this->load->view($this->layout,$data);
	}

	function kelasAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			// if(!$this->akses) $where['id']=$this->id;
			$page= isset($_GET['page'])?$_GET['page']:1;
			if(isset($_GET['q'])) $where['nama like']="%".$_GET['q']."%";

			$kelas= $_GET['jurusan'];
			if($kelas!=0) $where['id_jurusan']=$kelas;
			if(isset($_GET['q'])) $where['nama LIKE']='%'.$_GET['q'].'%';
			$count = $this->M_crud->count_read_data('v_siswa','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('v_kelas','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('v_kelas','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"nama"=>$this->input->post('nama'),
					"id_jurusan"=>$this->input->post('id_jurusan')
				);
				$berita = $this->M_crud->create_data('tbl_kelas',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"nama"=>$this->input->post('nama'),
					"id_jurusan"=>$this->input->post('id_jurusan')
				);
				$berita = $this->M_crud->update_data('tbl_kelas',$data,array('id'=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_kelas',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id'),
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_kelas',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function fasilitas(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Fasilitas Sekolah',
			'page'=>'fasilitas/index',
			'js'=>'fasilitas/js'
		);
		$this->load->view($this->layout,$data);
	}

	function slider(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Slider',
			'page'=>'slider/index',
			'js'=>'slider/js'
		);
		$this->load->view($this->layout,$data);
	}

	function partnership(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Partnership',
			'page'=>'partnership/index',
			'js'=>'partnership/js'
		);
		$this->load->view($this->layout,$data);
	}

	function gallery(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Gallery Kegiatan Sekolah',
			'page'=>'gallery/index',
			'js'=>'gallery/js'
		);
		$this->load->view($this->layout,$data);
	}

	function sarana_prasarana(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Sarana dan Prasarana Sekolah',
			'page'=>'sarana_prasarana/index',
			'js'=>'sarana_prasarana/js'
		);
		$this->load->view($this->layout,$data);
	}

	function galleryAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			if(!$this->akses) $where['id_member']=$this->id;
			if(isset($_GET['category'])) $where['id_category']=$_GET['category'];
			if(isset($_GET['q'])) $where['title like']="%".$_GET['q']."%";
			if($_GET['type']!=0) $where['type']=$_GET['type'];
			if($_GET['type']==0)$where['type != 5 and type != 7 and type != 8 and type != 9 and type !=']=6;
			if(isset($_GET['status'])) $where['status']=$_GET['status'];
			$page= isset($_GET['page'])?$_GET['page']:1;

			$count = $this->M_crud->count_read_data('tbl_gallery','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
			$countpage = $jml==0?1:$jml;
			
			$berita = $this->M_crud->read_data('tbl_gallery','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('tbl_gallery','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id_member"=>$this->session->id,
					"image"=>getImage(_uploadImage()),
					"title"=>$this->input->post('title'),
					"slug"=>url_title($this->input->post('title'), 'dash', true),
					"deskripsi"=>$this->input->post('deskripsi'),
					"type"=>$this->input->post('type'),
					"link"=>$this->input->post('link'),
					"status"=>(!$this->akses?'0':'1')
				);
				$berita = $this->M_crud->create_data('tbl_gallery',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$image;
				$data = array(
					"id_member"=>$this->session->id,
					"title"=>$this->input->post('title'),
					"slug"=>url_title($this->input->post('title'), 'dash', true),
					"deskripsi"=>$this->input->post('deskripsi'),
					"type"=>$this->input->post('type'),
					"link"=>$this->input->post('link'),
					"status"=>(!$this->akses?'0':'1'),
					"updated_at"=>date("Y-m-d")
				);
				if (!empty($_FILES["image"]["name"])) {
					$image = _uploadImage();
					$data['image']=getImage($image);
				}
				$berita = $this->M_crud->update_data('tbl_gallery',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_gallery',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_gallery',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function contact(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Kontak',
			'page'=>'contact/index',
			'js'=>'contact/js'
		);
		$this->load->view($this->layout,$data);
	}

	function contactAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			if(!$this->akses) $where['id']=$this->id;
			$page= isset($_GET['page'])?$_GET['page']:1;
			if(isset($_GET['q'])) $where['nama like']="%".$_GET['q']."%";

			$count = $this->M_crud->count_read_data('tbl_contact','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('tbl_contact','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$berita = $this->M_crud->get_data('tbl_contact','*',array('id'=>1));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"title"=>$this->input->post('title'),
				);
				$berita = $this->M_crud->create_data('tbl_contact',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"site_title"=>$this->input->post('site_title'),
					"email"=>$this->input->post('email'),
					"telp"=>$this->input->post('telp'),
					"fax"=>$this->input->post('fax'),
					"address"=>$this->input->post('address'),
					"facebook"=>$this->input->post('facebook'),
					"twitter"=>$this->input->post('twitter'),
					"instagram"=>$this->input->post('instagram'),
				);
				$berita = $this->M_crud->update_data('tbl_contact',$data,array('id'=>1));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_contact',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id'),
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_contact',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function files(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Files',
			'page'=>'files/index',
			'js'=>'files/js'
		);
		$this->load->view($this->layout,$data);
	}

	function filesAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			if(!$this->akses) $where['id_member']=$this->id;
			if(isset($_GET['category'])) $where['id_category']=$_GET['category'];
			if(isset($_GET['q'])) $where['title like']="%".$_GET['q']."%";
			if(isset($_GET['status'])) $where['status']=$_GET['status'];
			$page= isset($_GET['page'])?$_GET['page']:1;

			$count = $this->M_crud->count_read_data('tbl_files','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
			$countpage = $jml==0?1:$jml;
			
			$berita = $this->M_crud->read_data('tbl_files','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$id= $_GET['id'];
			$berita = $this->M_crud->get_data('tbl_files','*',array('id'=>$id));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$files = _uploadFiles();
				// dd($files);
				if($files==false) echo 'false';
				else{
					$data = array(
						"title"=> $this->input->post('title'),
						"status"=> $this->input->post('status'),
						"link"=>getFile($files),
						"hits"=>0
					);
					$berita = $this->M_crud->create_data('tbl_files',$data);
					echo json_encode($berita, true);

				}
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$image;
				$data = array(
					"link"=>getImage(_uploadImage()),
					"updated_at"=>date("Y-m-d")
				);
				if (!empty($_FILES["image"]["name"])) {
					$image = _uploadImage();
					$data['image']=getImage($image);
				}
				$berita = $this->M_crud->update_data('tbl_files',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_files',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_files',$data,array("id"=>$this->input->post('id')));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}

	function setting(){
		$data=array(
			'site'=>$this->site,
			'title'=>'Setting',
			'page'=>'setting/index',
			'js'=>'setting/js'
		);
		$this->load->view($this->layout,$data);
	}

	function settingAction(){
		$action = $_GET['aksi'];
		$where = array();
		if($action=='get'){
			if(!$this->akses) $where['id']=$this->id;
			$page= isset($_GET['page'])?$_GET['page']:1;
			$count = $this->M_crud->count_read_data('tbl_config','id',$where);
			$limit = 10;
            $offset = ($limit * ($page-1));
            $jml = ceil($count / $limit);
            $countpage = $jml==0?1:$jml;
			// ($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null
			$berita = $this->M_crud->read_data('tbl_config','*',$where,'created_at DESC', null,$limit,$offset);
			$result = array(
				"data"=>$berita,
				"count"=>$count,
				"current_page"=>(int)$page,
				"perpage"=>$limit,
				"last_page"=>$countpage
			);
			echo json_encode($result, true);
		}elseif($action=='detail'){
			$berita = $this->M_crud->get_data('tbl_config','*',array('id'=>1));
			echo json_encode($berita, true);
		}elseif($action=='create'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"title"=>$this->input->post('title'),
				);
				$berita = $this->M_crud->create_data('tbl_config',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='update'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				
				$data = array(
					"site_title"=>$this->input->post('site_title'),
					"email"=>$this->input->post('email'),
					"telp"=>$this->input->post('telp'),
					"fax"=>$this->input->post('fax'),
					"address"=>$this->input->post('address'),
					"facebook"=>$this->input->post('facebook'),
					"twitter"=>$this->input->post('twitter'),
					"instagram"=>$this->input->post('instagram'),
					"video_footer"=>$this->input->post('video_footer'),

				);
				$berita = $this->M_crud->update_data('tbl_config',$data,array('id'=>1));
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='delete'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				$data = array(
					"id"=>$this->input->post('id')
				);
				$berita = $this->M_crud->delete_data('tbl_config',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}elseif($action=='approval'){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$data = array(
					"id"=>$this->input->post('id'),
					"status"=>$this->input->post('status')
				);
				$berita = $this->M_crud->update_data('tbl_config',$data);
				echo json_encode($berita, true);
			}else{
				echo 'FORBIDDEN.';
			}
		}else{
			echo 'FORBIDDEN.';
		}
	}
}
 ?>