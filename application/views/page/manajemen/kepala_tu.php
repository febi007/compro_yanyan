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
		dynamic_ajax("<?=base_url().'manajemen/load_data/kepala_tu'?>",null,function(res){
			$("#result_table").html(res.result);
			$("#title").html(res.title)
		});
	}
</script>