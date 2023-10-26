<div class="main-menu">
	<header class="header">
		<a href="<?=urls('/')?>" class="logo"><img width="50px" src="<?=base_url()?>assets/images/logo-dark.png"/><?=$site?></a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="<?=assets('bo/images/profile.png')?>" alt=""><span class="status online"></span></a>
			<h5 class="name"><a href="#"><?=$this->session->nama?></a></h5>
			<h5 class="position"><?=$this->session->level?></h5>
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="<?=base_url('auth/logout')?>"><i class="fa fa-sign-out"></i> Log out</a></div>
				</div>
				<!-- /.control-list -->
			</div>
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<?php $akses = $this->session->access_level?>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<h5 class="title">Navigation</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li  <?=$this->uri->segment('2')==''?'class="current active"':''?>>
					<a class="waves-effect" href="<?=urls('')?>"><i class="menu-icon fa fa-dashboard"></i><span>Dashboard</span></a>
                </li>
				<li 
				<?=$this->session->id_level!=1&&$this->session->id_level!=7&&$this->session->id_level!=5 && $this->session->id_level!=2?'style="display:none"':''?>

				<?=
				$this->uri->segment('2')=='berita' ||
				$this->uri->segment('2')=='lowongan' ||
				$this->uri->segment('2')=='gallery' ||
				$this->uri->segment('2')=='fasilitas' ||
				$this->uri->segment('2')=='partnership' ||
				$this->uri->segment('2')=='sarana_prasarana' ||
				$this->uri->segment('2')=='informasi'?'class="current active"':''?>
				>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-film"></i><span>Master Konten</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=7?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='berita'?'active':''?>" href="<?=urls('berita')?>"><span>Berita</span></a></li>
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=7?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='lowongan'?'active':''?>" href="<?=urls('lowongan')?>"><span>Lowongan</span></a></li>
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=7?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='partnership'?'active':''?>" href="<?=urls('partnership')?>"><span>Partnership</span></a></li>
						<li 
						<?=$this->session->id_level!=1&&$this->session->id_level!=2&&$this->session->id_level!=5?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='informasi'?'active':''?>" href="<?=urls('informasi')?>"><span>Informasi</span></a></li>
						<li
							<?=$this->session->id_level!=1&&$this->session->id_level!=5?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='gallery'?'active':''?>" href="<?=urls('gallery')?>"><span>Gallery</span></a></li>
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=2?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='slider'?'active':''?>" href="<?=urls('slider')?>"><span>Slider</span></a></li>
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=2?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='fasilitas'?'active':''?>" href="<?=urls('fasilitas')?>"><span>Fasilitas</span></a></li>
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=2?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='sarana_prasarana'?'active':''?>" href="<?=urls('sarana_prasarana')?>"><span>Sarana dan Prasarana</span></a></li>
					</ul>
                </li>
				<li
				<?=$this->session->id_level!=1&&$this->session->id_level!=3&&$this->session->id_level!=4?'style="display:none"':''?>

				<?=
				$this->uri->segment('2')=='guru' ||
				$this->uri->segment('2')=='jurusan' ||
				$this->uri->segment('2')=='kelas' ||
				$this->uri->segment('2')=='manajemen' ||
				$this->uri->segment('2')=='siswa'?'class="current active"':''?>
				>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-file-o"></i><span>Master Data</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li 
						<?=$this->session->id_level!=1&&$this->session->id_level!=3?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='manajemen'?'active':''?>" href="<?=urls('manajemen')?>"><span>Manajemen</span></a></li>
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=4?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='guru'?'active':''?>" href="<?=urls('guru')?>"><span>Guru</span></a></li>
						<li 
						<?=$this->session->id_level!=1&&$this->session->id_level!=3?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='jurusan'?'active':''?>" href="<?=urls('jurusan')?>"><span>Jurusan</span></a></li>
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=4?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='kelas'?'active':''?>" href="<?=urls('kelas')?>"><span>Kelas</span></a></li>
						<li
						<?=$this->session->id_level!=1&&$this->session->id_level!=4?'style="display:none"':''?>
						><a class="waves-effect <?=$this->uri->segment('2')=='siswa'?'active':''?>" href="<?=urls('siswa')?>"><span>Siswa</span></a></li>
					</ul>
                </li>
				<li 
					<?=$this->session->id_level!=1?'style="display:none"':''?> 
					<?=$this->uri->segment('2')=='files'?'class="current active"':''?>
				>
					<a class="waves-effect" href="<?=urls('files')?>"><i class="menu-icon fa fa-file-archive-o"></i><span>Manajemen Files</span></a>
                </li>
				<li 
					<?=$this->session->id_level!=1?'style="display:none"':''?> 
					<?=$this->uri->segment('2')=='user'?'class="current active"':''?>
				>
					<a class="waves-effect" href="<?=urls('user')?>"><i class="menu-icon fa fa-users"></i><span>User Admin</span></a>
                </li>
				<li 
					<?=$this->session->id_level!=1?'style="display:none"':''?> 
					<?=$this->uri->segment('2')=='contact'?'class="current active"':''?>
				>
					<a class="waves-effect" href="<?=urls('contact')?>"><i class="menu-icon fa fa-envelope"></i><span>Kontak</span></a>
                </li>
                <li  
				<?=$this->session->id_level!=1?'style="display:none"':''?> 
				<?=$this->uri->segment('2')=='setting'?'class="current active"':''?>>
					<a class="waves-effect" href="<?=urls('setting')?>"><i class="menu-icon fa fa-gear"></i><span>Setting</span></a>
                </li>
			</ul>
			<!-- /.menu js__accordion -->
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>