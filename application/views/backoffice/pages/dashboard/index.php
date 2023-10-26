<style>
	.ico_link{
		color:#333;
	}
	.ico_link:hover{
		color:#e0e0e0
	}
	.icon_panel{
		background:#eee;width:100%;height:100px;text-align:center;
		padding-top:20px;font-size:2em
	}
	.icon_panel .title{
		font-size:.5em !important;
	}

	/* .icon_container{
		padding:5px !important;
	} */
	.no_margin{
		margin:0px;
		padding:5px;
		margin-top:5px;
	}
</style>
<div class="row small-spacing">
	<div class="col-lg-4 col-md-6 col-xs-12">
		<div class="box-content bg-success text-white">
			<div class="statistics-box with-icon">
				<i class="ico small fa fa-diamond"></i>
				<p class="text text-white">Total Guru</p>
				<h2 class="counter"><?=$guru?></h2>
			</div>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-4 col-md-6 col-xs-12 -->
	<div class="col-lg-4 col-md-6 col-xs-12">
		<div class="box-content bg-info text-white">
			<div class="statistics-box with-icon">
				<i class="ico small fa fa-users"></i>
				<p class="text text-white">Total Siswa</p>
				<h2 class="counter"><?=$siswa?></h2>
			</div>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-4 col-md-6 col-xs-12 -->
	<div class="col-lg-4 col-md-6 col-xs-12">
		<div class="box-content bg-danger text-white">
			<div class="statistics-box with-icon">
				<i class="ico small fa fa-area-chart"></i>
				<p class="text text-white">Total Kunjungan</p>
				<h2 class="counter"><?=$pengunjung?></h2>
			</div>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-4 col-md-6 col-xs-12 -->
</div>

<div class="row small-spacing">
	<div class="col-lg-7 col-xs-7">
		<div class="box-content">
			<h4 class="box-title">Application Button</h4>
			<p>Silahkan pilih menu di sebelah kiri untuk mengelola website anda atau klik icon pada Control Panel dibawah ini:</p>
			<div class="row"  style="padding:10px">
				<a href="<?=urls('berita')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=7?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-newspaper-o"></i>
							<div class="title">Berita</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('lowongan')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=7?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-building-o"></i>
							<div class="title">Lowongan</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('partnership')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=7?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-archive"></i>
							<div class="title">Parnership</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('informasi')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=2&&$this->session->id_level!=5?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-info"></i>
							<div class="title">Informasi</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('gallery')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=5?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-photo"></i>
							<div class="title">Gallery</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('slider')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=2?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-columns"></i>
							<div class="title">Slider</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('fasilitas')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=2?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-wifi"></i>
							<div class="title">Fasilitas</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('sarana_prasarana')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=2?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-puzzle-piece"></i>
							<div class="title">Sarana & Prasarana</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('manajemen')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=3?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-users"></i>
							<div class="title">Manajemen</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('guru')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=4?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-user-secret"></i>
							<div class="title">Guru</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('jurusan')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=3?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-file-o"></i>
							<div class="title">Jurusan</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('kelas')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=4?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-bank"></i>
							<div class="title">kelas</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('siswa')?>" class="ico_link" <?=$this->session->id_level!=1&&$this->session->id_level!=4?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-user"></i>
							<div class="title">Siswa</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('user')?>" class="ico_link" <?=$this->session->id_level!=1?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-user-plus"></i>
							<div class="title">User Admin</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('contact')?>" class="ico_link" <?=$this->session->id_level!=1?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-envelope"></i>
							<div class="title">Kontak</div>
						</div>
					</div>
				</a>
				<a href="<?=urls('setting')?>" class="ico_link" <?=$this->session->id_level!=1?'style="display:none"':''?>>
					<div class="col-md-3 no_margin">
						<div class="icon_panel">
							<i class="fa fa-gears"></i>
							<div class="title">Setting</div>
						</div>
					</div>
				</a>
				
				
			</div>
			<!-- /.box-title -->
		</div>
		<!-- /.box-content -->
	</div>
	<div class="col-lg-5 col-xs-5">
		<div class="row">
			<div class="col-md-12">
				<div class="box-content">
					<h4 class="box-title">Grafik Kunjungan</h4>
					<!-- /.box-title -->
					<!-- /.dropdown js__dropdown -->
					<div id="morris-pengunjung" class="morris-chart" style="height: 240px"></div>
					<!-- /#bar-morris-chart.morris-chart -->
				</div>
				<!-- /.box-content -->
			</div>
				<div class="col-md-12">
					<div class="box-content">
						<h4 class="box-title">Platform Pengunjung</h4>
						<!-- /.box-title -->
						<!-- /.dropdown js__dropdown -->
						<div id="donut-morris-chart" class="morris-chart" style="height: 240px"></div>
						<!-- /#donut-morris-chart.morris-chart -->
					</div>
				<!-- /.box-content -->
				</div>
		</div>

	</div>

</div>

<?php if( (int)$this->session->grant_access==1):?>
<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Berita <small>(<a href="<?=base_url()?>site/berita">Selengkapnya</a>)</small></h4>
		    <table class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Gambar</th> 
						<th>Judul</th> 
						<th>Penulis</th> 
						<th>Konten</th> 
						<th>Status</th> 
						<th>Dibuat pada</th> 
					</tr> 
				</thead>
				<tbody id="berita"></tbody>
			</table>
		</div>
	</div>
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Lowongan <small>(<a href="<?=base_url()?>site/lowongan">Selengkapnya</a>)</small></h4>
		    <table class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Gambar</th> 
						<th>Judul</th> 
						<th>Penulis</th> 
						<th>Konten</th> 
						<th>Status</th> 
						<th>Dibuat pada</th> 
					</tr> 
				</thead>
				<tbody id="lowongan"></tbody>
			</table>
		</div>
	</div>
</div>

<div class="row small-spacing">
	<div class="col-lg-6 col-xs-6">
		<div class="box-content">
			<h4 class="box-title">Gallery <small>(<a href="<?=base_url()?>site/gallery">Selengkapnya</a>)</small></h4>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Gambar</th> 
						<th>Judul</th> 
						<th>Status</th> 
						<th>Dibuat pada</th> 
					</tr> 
				</thead>
				<tbody id="gallery"></tbody>
			</table>
			
		</div>
	</div>
	<div class="col-lg-6 col-xs-6">
		<div class="box-content">
			<h4 class="box-title">Partnership <small>(<a href="<?=base_url()?>site/partnership">Selengkapnya</a>)</small></h4>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Gambar</th> 
						<th>Judul</th> 
						<th>Status</th> 
						<th>Dibuat pada</th> 
					</tr> 
				</thead>
				<tbody id="partnership"></tbody>
			</table>
		</div>
	</div>
</div>
<?php endif?>