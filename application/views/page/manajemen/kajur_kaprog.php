<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>
<section class="team-one">
    <div class="container">
        <div class="form-group">
            <label for="">Cari Berdasarkan :</label>
            <select name="any" id="any" class="form-control">
                <option value="">Semua</option>
                <?php $read_data = $this->M_crud->read_data("tbl_jurusan","*"); foreach ($read_data as $row): ?>
                <option value="<?=$row['slug']?>"><?=$row['title']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row" id="result_table"></div><!-- /.row -->
    </div><!-- /.container -->
    <div class="container" id="pagination_link"></div>
</section><!-- /.team-one team-page -->


<script>
	$(document).ready(function(){
		load_data(1);
		$('#any').select2();
	}).on("click", ".pagination li a", function(event){
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		load_data(page);
	});

	$("#any").change(function(){

		load_data(1,{any:$("#any").val()});
    });

	function load_data(page,data={}){
		dynamic_ajax("<?=base_url().'manajemen/load_data/kajur_kaprog/'?>"+page,data,function(res){
			$("#result_table").html(res.result);
			$("#title").html(res.title);
			$('#pagination_link').html(res.pagination_link);
		});
	}

</script>