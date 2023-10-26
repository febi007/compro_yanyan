<?php
$jurusan = $this->M_crud->read_data("tbl_jurusan","*");
$config = $this->M_crud->get_data("tbl_config","*");
include 'header.php';
include 'navbar.php';
include "sidebar.php";
include "content.php";
include "footer.php";
 ?>