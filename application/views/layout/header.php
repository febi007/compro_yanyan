<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from layerdrops.com/kipso/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Dec 2019 02:02:09 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$config['site_title']?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>assets/images/logo-dark.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>assets/images/logo-dark.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/images/logo-dark.png">
    <link rel="manifest" href="<?=base_url();?>assets/images/favicons/site.webmanifest">
    <!-- plugin scripts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,500i,600,700,800%7CSatisfy&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/animate.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fontawesome-free-5.11.2-web/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/kipso-icons/style.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/vegas.min.css">

    <!-- template styles -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/responsive.css">
    <!-- Animation Scroll -->

    <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>



</head>
<style>
    /* Extra small devices (phones, 600px and down) */
    @media only screen and (max-width: 600px) {
        .banner-one__title{font-size: 50px!important;}
        .img-news{height: 100%!important;}
        .img-gallery{height: 100%!important;}
        #headEmail{font-size: 10px!important;}
        #headTelp{font-size: 10px!important;}
        .inner-banner__title{font-size: 20px!important;}
    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (min-width: 600px) {

    }

    @media screen and (min-device-width: 360px) and (max-device-width: 768px) { 
        .tulisan1{
            font-size:30px ;
            text-align:center;
        }
        .tulisan2{
            text-align:left;
            font-size:20px ;

        }
        .tulisan4{
            text-align:center;
            font-size:15px;
            }
        .tulisan3{
            text-align:justify;
            font-size:18px ;
        }

        .about-two__image-dots{
            display:none;            
        }

    }

    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) {

    }

    /* Large devices (laptops/desktops, 992px and up) */
    @media only screen and (min-width: 992px) {

    }

    /* Extra large devices (large laptops and desktops, 1200px and up) */
    @media only screen and (min-width: 1200px) {
        .tulisan4{
            text-align:left;
            font-size:20px;
            }

    }
    .text{
        color:white;
    }
 
    .first-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1050;
        background: rgba(168, 168, 168, .5)
    }
    .first-loader img {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px
    }
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: #1e88e5;
        /*border-radius: 10px;*/
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #1e88e5;
        z-index: 1050;
        /*border-radius: 10px;*/
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #1e88e5;
    }
    .pagination > li > a {
        padding: 6px 12px;
        color: #000000;
        font-size: 16px;
        font-weight: bold;
        background-color: #ffffff;
        border: 1px solid #dddddd;
        margin: 0 3px;
    }
    .pagination > .active > a {
        color: #000000;
        font-weight: bold;
        background-color: #ffffff;
        border: 1px solid #dddddd;
    }
    .pagination > li:first-child > a {
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
    }
    .pagination > li:last-child > a {
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
    }
    .pagination > li > a:hover,
    .pagination > li > a:focus {
        color: #ffffff;
        background-color: #0073b7 !important;
        border-color: #0073b7 !important;
    }
    .pagination > .active > a,
    .pagination > .active > a:hover,
    .pagination > .active > a:focus {
        color: #ffffff;
        background-color: #0073b7 !important;
        border-color: #0073b7 !important;
        z-index: -0!important;
    }
    .pagination > .disabled > a,
    .pagination > .disabled > a:hover,
    .pagination > .disabled > a:focus {
        color: #777777;
        background-color: #ffffff;
        border-color: #dddddd;

    }
    @media only screen and (max-width: 600px){
        /*Small smartphones [325px -> 425px]*/
        h2.course-one__title>a{
            font-size: 12px !important;
        }
        h2.course-one__title{
            margin-top: -20px !important;
        }
        .subcontent>p{
            font-size: 10px !important;
        }
        img.img-news{
            border-top-right-radius: 10px !important;
            border-top-left-radius: 10px !important;
            height: 150px !important;
        }
        a.course-one__link{
            display: none !important;
        }

        .course-one__admin{
            margin-left: -31px !important;
            position: relative !important;
            font-size: 10px !important;
        }
        .course-one__content{
            border-bottom-right-radius: 10px !important;
            border-bottom-left-radius: 10px !important;
            padding-left: 10px !important;
            padding-right: 10px !important;
            font-size: 10px !important;
            line-height: normal !important;
        }
        .course-one__meta>a{
            font-size: 10px !important;
        }
        .course-one__category{
            left: 0 !important;
            align-items: center !important;
            align-content: center !important;
            display: flex !important;
        }
        .wrap-team-one__single{
            height: 350px !important;
            margin-bottom: 0 !important;
        }
        .team-one__image>img{
            border-top-right-radius: 10px !important;
            border-top-left-radius: 10px !important;
        }
        .team-one__content{
            padding-left: 0 !important;
            padding-right: 0 !important;
            border-radius: 10px !important;

        }
        h2.course-details__title{
            font-size: 16px !important;
        }
        .team-one__content>h5{
            font-size: 12px !important;
        }
        #pagination_link{
            float: right !important;
        }
        .course-details__tab-content{
            font-size: 12px !important;
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        .overview>p{
            font-size: 12px !important;
        }
        .course-details__list{
            padding-left: 10px !important;
        }
        p.course-details__author{
            font-size: 12px !important;
        }

    }
</style>
<script>
	var img_loader = '<img src="<?=base_url().'assets/'?>spin.svg">';
	function dynamic_ajax(url,req=null,func_req){
		$.ajax({
			url : url,
			type:"POST",
			dataType : "JSON",
			data:req?req:null,
			success:func_req,
			beforeSend: function() {$('body').append('<div class="first-loader">'+img_loader+'</div>')},
			complete: function() {$('.first-loader').remove()},
		});
		return;
	}
</script>