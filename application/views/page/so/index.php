<?php //$this->load->view('layout/tambahan') ?>
<?php $this->load->view('layout/header') ?>

<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title text" id="title"></h2><!-- /.inner-banner__title -->
    </div><!-- /.container -->
</section>
<section class="team-details">
    <div class="container">
        <div onclick="printDiv()" class="row justify-content-between" id="result_table"></div><!-- /.row -->
        <div id='DivIdToPrint' style="display: none"> </div>
    </div><!-- /.container -->
</section><!-- /.team-details -->


<script>
	$(document).ready(function(res){
		load_data();
	});
	function load_data(){
		var type = "<?=$_GET['type']?>";
		dynamic_ajax("<?=base_url().'struktur/load_data/'?>"+type,null,function(res){
			$("#result_table").html(res.result);
			$("#title").html(res.title);
			$("#DivIdToPrint").html(res.img);
		});
	}
	function printDiv() {

		var divToPrint=document.getElementById('DivIdToPrint');

		var newWin=window.open('','Print-Window');

		newWin.document.open();

		newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

		newWin.document.close();

		setTimeout(function(){newWin.close();},10);

	}
</script>