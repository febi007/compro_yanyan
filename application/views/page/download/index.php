<?php $this->load->view('layout/header') ?>

<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2>
    </div><!-- /.container -->
</section>

<section class="course-one course-page">
    <div class="container">
        <div class="row" style="margin-bottom: 10px;">
            <div class="input-group">
                <input type="text" name="any" class="form-control pull-right" id="any" value="<?=isset($this->session->search['any'])?$this->session->search['any']:''?>" placeholder="Cari disini ...">
                <span class="input-group-btn">
                    <button class="btn btn-primry" type="button" onclick="cari()">Cari</button>
                </span>
            </div><!-- /input-group -->
        </div>

        <div class="row">

            <table class="table table-responsive table-borderd table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>File</th>
<!--                    <th>Total</th>-->
                    <th>#</th>
                </tr>
                </thead>
                <tbody id="result_table"></tbody>
            </table>
        </div>
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
	function load_data(page,data={}){
		dynamic_ajax("<?=base_url().'download/load_data/get_data/'?>"+page,data,function(res){
			$("#result_table").html(res.result_table);
			$("#title").html(res.title);
			$('#pagination_link').html(res.pagination_link);
		});
	}
	function cari() {
		var any = $("#any").val();
		load_data(1, {search: true, any: any});
	}
	$("#any").on("keyup keypress",function(e){
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			var any = $("#any").val();
			load_data(1, {search: true, any: any});
		}
	});

	function download(id){
		$.ajax({
			url: "<?=base_url().'download/load_data/download'?>", // my URL
			type: "POST",
            data:{id:id},
			dataType: 'binary',
			success: function(result) {
				var url = URL.createObjectURL(result);
				var $a = $('<a />', {
					'href': url,
					'download': result.result,
					'text': "click"
				}).hide().appendTo("body")[0].click();

				// URL.revokeObjectURL(url);
			}
		});
    }
</script>