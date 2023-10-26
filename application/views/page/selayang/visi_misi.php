<?php //$this->load->view('layout/tambahan') ?>
<?php $this->load->view('layout/header') ?>


<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>
<section class="team-one">
    <div class="container-fluid">
        <div class="row" id="result_table">

        </div>
    </div><!-- /.container -->
</section><!-- /.blog-details -->


<script>
	$(document).ready(function(res){
		load_data();
	});
	function load_data(){
		dynamic_ajax("<?=base_url().'Selayang_pandang/load_data/visi_misi'?>",null,function(res){
			$("#result_table").html(res.result);
			$("#title").html(res.title)
		});
	}
</script>