<?php //$this->load->view('layout/tambahan') ?>
<?php $this->load->view('layout/header') ?>


<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<section class="team-one">
    <div class="container">
        <div class="row justify-content-between" id="result_table">

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.team-details -->

<script>
	$(document).ready(function(res){
		load_data();
	});
	function load_data(){
		var type = "<?=$_GET['type']?>";
		dynamic_ajax("<?=base_url().'keahlian/load_data/get'?>",{type:type},function(res){
			$("#result_table").html(res.result);
			$("#title").html(res.title)
		});
	}
</script>