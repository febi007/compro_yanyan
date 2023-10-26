<?php $this->load->view('layout/header') ?>
<!DOCTYPE html>
<h1>Tambah Jurusan</h1>
<form action="<?=base_url();?>Bo_Controller/tambah_jurusan" method="post">
	<input name="nama_jurusan" placeholder="Nama Jurusan">
	<button class="btn btn-succces" class="submit">Tambahkan</button>
</form>