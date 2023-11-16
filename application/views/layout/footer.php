<footer class="site-footer">
    <div class="site-footer__upper">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-3">
                    <div class="footer-widget footer-widget__contact">
                        <h2 class="footer-widget__title">Alamat</h2>
                        <ul class="list-unstyled footer-widget__course-list">
                            <li>
                                <h2><a href="#"><?=$config['address']?></a></h2>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-3">
                    <div class="footer-widget footer-widget__link">
                        <h2 class="footer-widget__title">Kontak Kami</h2>
                        <div class="footer-widget__link-wrap">
                            <ul class="list-unstyled footer-widget__link-list">
                                <li><a href="#">Email: <?=$config['email']?> </a></li>
                                <li><a href="#">Phone: <?=$config['telp']?></a></li>
                                <li><a href="#">Fax: <?=$config['fax']?></a></li>
                            </ul>
                            <ul class="list-unstyled footer-widget__link-list">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="footer-widget footer-widget__about">
                        <h2 class="footer-widget__title" style="margin-bottom:'1em';">Tentang Kami</h2>
                        <p class="footer-widget__text"><?=$config['site_title']?></p>
			<div class="embed-responsive embed-responsive-4by3">
			<iframe
				class="embed-responsive-item"
				src="<?=base64_decode($config['video_footer'])?>?autoplay=1"
				allowfullscreen
				title="YouTube video player" 
				frameborder="0"
				allow="	accelerometer; 
					autoplay;
					clipboard-write; 
					encrypted-media; 
					gyroscope; 
					picture-in-picture"
			></iframe>
			</div>
			
<!--                        <div class="footer-widget__btn-block">-->
<!--                            <a href="#" class="thm-btn">Contact</a>-->
<!--                            <a href="#" class="thm-btn">Purchase</a>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <p class="site-footer__copy"> H. YANYAN SOPIYAN, LC.</a></p>
            <div class="site-footer__social">
                <a href="#" data-target="html" class="scroll-to-target site-footer__scroll-top"><i class="kipso-icon-top-arrow"></i></a>
                <a href="<?=$config['twitter']?>"><i class="fab fa-twitter"></i></a>
                <a href="<?=$config['facebook']?>"><i class="fab fa-facebook-square"></i></a>
                <a href="<?=$config['instagram']?>"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="<?=base_url();?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url();?>assets/js/owl.carousel.min.js"></script>
<script src="<?=base_url();?>assets/js/waypoints.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.counterup.min.js"></script>
<script src="<?=base_url();?>assets/js/TweenMax.min.js"></script>
<script src="<?=base_url();?>assets/js/wow.js"></script>
<script src="<?=base_url();?>assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url();?>assets/js/countdown.min.js"></script>
<script src="<?=base_url();?>assets/js/vegas.min.js"></script>
<!-- template scripts -->
<script src="<?=base_url();?>assets/js/theme.js"></script>
<script src="<?=base_url();?>assets/js/scrollreveal.min.js"></script>

<!-- template scripts -->
<!-- ANIMATION SCROLL -->
<script>

	var ScrollReveal;
	var sr;
	window.sr = ScrollReveal({
		scale: 1,
		duration: 750,
		delay: 400,
		distance: 0,
		easing: "cubic-bezier(.4, 0, .2, 1)",
	});
	sr.reveal(".sr-btm", {
		distance: "3em",
		origin: "bottom",
	});


</script>

</body>


<!-- Mirrored from layerdrops.com/kipso/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Dec 2019 02:03:46 GMT -->
</html>