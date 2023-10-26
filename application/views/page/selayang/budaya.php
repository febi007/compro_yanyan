<?php //$this->load->view('layout/tambahan') ?>
<?php $this->load->view('layout/header') ?>


<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2>
    </div>
</section>

<section class="team-one">
    <div class="container">
        <div class="row justify-content-between" id="result_table"></div>
    </div>
</section>

<script>
    $(document).ready(function(){
	    load_data();
    });
	function load_data(){
		dynamic_ajax("<?=base_url().'Selayang_pandang/load_data/budaya'?>",null,function(res){
			$("#result_table").html(res.result);
			$("#title").html(res.title)
		});
	}
</script>