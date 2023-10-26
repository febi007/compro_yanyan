
<section class="course-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" id="result_table">
                <div class="course-details__content">
                    <p class="course-details__author">
                        <img src="<?=base_url().'assets/images/logo-dark.png'?>" alt="">
                        Oleh <a href="#"><?='Admin'?></a>
                    </p>
                    <div class="course-details__top">
                        <div class="course-details__top-left">
                            <h2 class="course-details__title"><?=$read_data['title']?></h2>
                        </div>
                    </div>
                    <div class="course-one__image">
                        <img src="<?=$read_data['image']?>" alt="">
                    </div>
                    <div class="tab-content course-details__tab-content ">
                        <div class="tab-pane show active  animated fadeInUp" role="tabpanel" id="overview">
                            <p class="course-details__tab-text">
                                <?=html_entity_decode($read_data["deskripsi"])?>
                            </p>
                        </div>
                        <div class="course-one__meta">
                            <a href="#!"><i class="far fa-clock"></i> <?=$read_data["created_at"]?></a>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="course-details__list">
                        <h2 class="course-details__list-title">Gallery Lainnya</h2>
                        <?php foreach($late_post as $row):
                            if(strlen($row['title']) > 10){
                                $title = substr($row['title'],0,10).' ....';
                            } else{
                                $title = $row['title'];
                            }
                            ?>
                            <div class="course-details__list-item">
                                <div class="course-details__list-img">
                                    <img src="<?=$row['image']?>" style="height: 70px;width: 70px;" alt="">
                                </div>
                                <div class="course-details__list-content">
                                    <a class="course-details__list-author" href="#">Oleh <span>Admin</span></a>
                                    <h3><a href="<?=base_url("detail?type=".$_GET['type']."&title=".$row['slug'])?>"><?=$title?></a></h3>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!-- /.sidebar -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog-details -->
