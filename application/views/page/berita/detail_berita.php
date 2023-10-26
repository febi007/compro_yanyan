
<section class="course-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" id="result_table">

            </div><!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="course-details__list">
                        <h2 class="course-details__list-title">Infromasi Lainnya</h2>
                        <?php foreach($late_post as $row):
                            if(html_entity_decode(strlen($row['title'])) > 50){

                                $title = substr($row['title'],0,50).' ....';
                            } else{
                                $title = $row['title'];
                            }
                        ?>
                        <div class="course-details__list-item">
                            <div class="course-details__list-img">
                                <img src="<?=$row['image']?>" style="height: 70px;width: 70px;" alt="">
                            </div>
                            <div class="course-details__list-content">
                                <a class="course-details__list-author" href="#">Oleh <span><?=$row['nama']?></span></a>
                                <h3><a href="<?=base_url("detail?type=".$_GET['type']."&title=".$row['slug'])?>"><?=$title?></a></h3>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="course-details__list">
                        <h2 class="course-details__list-title">Kategori Lainnya</h2>
                        <ul class="sidebar__category-list">
                            <?php foreach($kategori as $row): ?>
                            <li class="sidebar__category-list-item"><a href="<?=base_url("berita?title=".$row['slug'])?>"><?=$row['title']?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div><!-- /.sidebar -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog-details -->
<script>

    load_data();
	function load_data(){
		var type = "<?=$_GET['title']?>";
		console.log(type);
		dynamic_ajax("<?=base_url().'berita/load_data/detail'?>",{type:type},function(res){
			$("#result_table").html(res.result_table);
		})
	}
    function isLike(idContent){
		var id="<?=$this->session->id?>";
		if(id!==''){
			dynamic_ajax("<?=base_url().'berita/isLike'?>",{idContent:idContent},function(res){
				if(res.status === 'success'){
					console.log(res.msg);
					load_data();
					$("#love").css('color','red');
				}else{
					console.log(res.msg);
					load_data();
					$("#love").css('color','white');
				}
			})
        }else{
			alert('silahkan masuk terlebih dahulu')
            window.location.href="<?=base_url().'auth?type=siswa'?>"
        }

    }
</script>