<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" href="<?=base_url()?>assets/images/logo-dark.png"/>">

    <title><?=$title?> - <?=$site?></title>

    <!-- Main Styles -->
    <link rel="stylesheet" href="<?=assets('bo/styles/style.min.css')?>">
    <link rel="stylesheet" href="<?=assets('bo/styles/additional.css')?>">
    <link rel="stylesheet" href="<?=assets('bo/styles/HoldOn.min.css')?>">

    <!-- Material Design Icon -->
    <link rel="stylesheet" href="<?=assets('bo/fonts/material-design/css/materialdesignicons.css')?>">

    <!-- mCustomScrollbar -->
    <link rel="stylesheet" href="<?=assets('bo/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css')?>">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="<?=assets('bo/plugin/waves/waves.min.css')?>">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?=assets('bo/plugin/sweet-alert/sweetalert.css')?>">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?=assets('bo/plugin/toastr/toastr.css')?>">
    <!-- Morris Chart -->
    <link rel="stylesheet" href="<?=assets('bo/plugin/chart/morris/morris.css')?>">

    <!-- FullCalendar -->
    <link rel="stylesheet" href="<?=assets('bo/plugin/fullcalendar/fullcalendar.min.css')?>">
    <link rel="stylesheet" href="<?=assets('bo/plugin/fullcalendar/fullcalendar.print.css')?>" media='print'>

</head>

<body>
<?php
$this->load->view('backoffice/layout/side_menu')
?>
<!-- /.main-menu -->

<div class="fixed-navbar">
    <div class="pull-left">
        <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
        <h1 class="page-title"><?=$title?></h1>
        <!-- /.page-title -->
    </div>
    <!-- /.pull-left -->
    <div class="pull-right">
        <a href="<?=base_url()?>auth/logout" class="ico-item mdi mdi-logout"></a>
    </div>
    <!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<div id="wrapper">
    <div class="main-content">
        <?=$this->load->view('backoffice/pages/'.$page, [], TRUE)?>
        <!-- .row -->
        <footer class="footer">
            <ul class="list-inline">
                <li>2019 © <?=$site?>.</li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Help</a></li>
            </ul>
        </footer>
    </div>
    <!-- /.main-content -->
</div><!--/#wrapper -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="assets/script/html5shiv.min.js"></script>
<script src="assets/script/respond.min.js"></script>
<![endif]-->
<!--
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=assets('bo/scripts/jquery.min.js')?>"></script>
<script src="<?=assets('bo/scripts/pagination.js')?>"></script>
<script src="<?=assets('bo/scripts/modernizr.min.js')?>"></script>
<script src="<?=assets('bo/plugin/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?=assets('bo/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')?>"></script>
<script src="<?=assets('bo/plugin/nprogress/nprogress.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.18.1/dist/sweetalert2.all.min.js"></script>
<script src="<?=assets('bo/plugin/waves/waves.min.js')?>"></script>
<script src="<?=assets('bo/plugin/ckeditor/ckeditor.js')?>"></script>

<script src="<?=assets('bo/plugin/chart/morris/morris.min.js')?>"></script>
<script src="<?=assets('bo/plugin/chart/morris/raphael-min.js')?>"></script>
<!-- <script src="<?=assets('bo/scripts/chart.morris.init.min.js')?>"></script> -->

<!-- Toastr -->
<script src="<?=assets('bo/plugin/toastr/toastr.min.js')?>"></script>
<script src="<?=assets('bo/scripts/main.min.js')?>"></script>
<script src="<?=assets('bo/scripts/HoldOn.min.js')?>"></script>

<script>
	$.fn.modal.Constructor.prototype.enforceFocus = function () {
		var $modalElement = this.$element;
		$(document).on('focusin.modal', function (e) {
			var $parent = $(e.target.parentNode);
			if ($modalElement[0] !== e.target && !$modalElement.has(e.target).length
				// add whatever conditions you need here:
				&&
				!$parent.hasClass('cke_dialog_ui_input_select') && !$parent.hasClass('cke_dialog_ui_input_text')) {
				$modalElement.focus()
			}
		})
	};
	function set_ckeditor(id){
		$(function () {
			var editor =CKEDITOR.replace(id, {
				filebrowserImageBrowseUrl : '<?php echo base_url('assets/bo/plugin/kcfinder/browse.php?type=upload');?>',
				height: '300px'
			});

		});
	}
	function CKReset(caption){
		console.log(CKEDITOR.instances['caption']);
		if (CKEDITOR.instances['caption']) {
			CKEDITOR.instances['caption'].destroy(true);    
		}//if
		CKEDITOR.replace('caption');
		CKEDITOR.instances['caption'].setData(caption);
	}//fn
	function readURL(input, img) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#' + img).attr('src', e.target.result);
				// toDataURL(e.target.result, function (dataUrl) {
				// $("#imgbase64").val(dataUrl)
				// })
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": true,
		"progressBar": true,
		"rtl": false,
		"positionClass": "toast-bottom-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 1000,
		"timeOut": 5000,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	var optionsLoader = {
		theme:"sk-bounce",
		message:'Tunggu sebentar...',
		backgroundColor:"#333",
		textColor:"white"
	};
</script>
<?=$js?$this->load->view('backoffice/pages/'.$js, [], TRUE):''?>

</body>
</html>