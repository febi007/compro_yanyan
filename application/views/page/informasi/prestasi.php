<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>

<section class="team-details" style ="padding:40px">
    <div class="container">
        <div class="row justify-content-between" id="result_header"></div>
    </div>
    <div class="container">
        <h2 class="text-center" id="title_body"></h2><br>
        <div class="row" id="result_body"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <nav aria-label="..." id="pagination_link"></nav>
        </div>
    </div><!-- /.container -->
</section>

<script>
	$(document).ready(function(){
		load_data(1);
	}).on("click", ".pagination li a", function(event){
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		load_data(page);
	});
	function load_data(page){
		dynamic_ajax("<?=base_url().'informasi/load_data/prestasi/'?>"+page,null,function(res){
			$("#result_body").html(res.result_body);
			$('#pagination_link').html(res.pagination_link);
			$("#title").html(res.title);
			$("#result_header").html(res.header);
			$("#title_body").html(res.title_body);
			$("table").addClass('table table-bordered table-hover')

		});
	}
</script>