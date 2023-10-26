<?php //$this->load->view('layout/tambahan') ?>
<?php $this->load->view('layout/header') ?>


<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2>
    </div>
</section>
<section class="team-one">
    <div class="container">
        <div class="row" id="result_table"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <nav aria-label="..." id="pagination_link"></nav>
        </div>
</section>


<script>
	$(document).ready(function(){
		load_data(1);
	}).on("click", ".pagination li a", function(event){
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		load_data(page);
	});
	function load_data(page,data={}){
		dynamic_ajax("<?=base_url().'Selayang_pandang/load_data/fasilitas/'?>"+page,null,function(res){
			$("#result_table").html(res.result);
			$("#title").html(res.title);
			$('#pagination_link').html(res.pagination_link);
		});
	}
</script>