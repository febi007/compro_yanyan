
<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2>
    </div><!-- /.container -->
</section>


<section class="course-one course-page">
    <div class="container">
        <div class="row" id="result_table"></div>
        <div class="col-md-12 col-sm-12 col-xs-12"><nav aria-label="..." id="pagination_link"></nav></div>
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
	function load_data(page){
		var type = "<?=$_GET['title']?>";
		dynamic_ajax("<?=base_url().'berita/load_data/get_list/'?>"+page,{type:type},function(res){
			$('#result_table').html(res.result_table);
			$('#pagination_link').html(res.pagination_link);
			$("#title").html("Berita")
		});
	}




	function isLike(idContent){
		var id = "<?=$this->session->id?>";
		if(id!==''){
			dynamic_ajax("<?=base_url().'berita/isLike'?>",{idContent:idContent},function(res){
				if(res.status === 'success'){
					console.log(res.msg);
					load_data(1);
					$("#love").css('color','red');
				}else{
					console.log(res.msg);
					load_data(1);
					$("#love").css('color','white');
				}
			})
        }

	}

</script>