<footer class="footer_part">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-sm-6 col-lg-2">
                <div class="single_footer_part">
                    <h4>Top Products</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Managed Website</a></li>
                        <li><a href="#">Manage Reputation</a></li>
                        <li><a href="#">Power Tools</a></li>
                        <li><a href="#">Marketing Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="single_footer_part">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Brand Assets</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="single_footer_part">
                    <h4>Features</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Brand Assets</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="single_footer_part">
                    <h4>Resources</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Guides</a></li>
                        <li><a href="#">Research</a></li>
                        <li><a href="#">Experts</a></li>
                        <li><a href="#">Agencies</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="single_footer_part">
                    <h4>Newsletter</h4>
                    <p>Heaven fruitful doesn't over lesser in days. Appear creeping
                    </p>
                    <div id="mc_embed_signup">
                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative mail_part">
                            <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address" class="placeholder hide-on-focus" onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '">
                            <button type="submit" name="submit" id="newsletter-submit" class="email_icon newsletter-submit button-contactForm">subscribe</button>
                            <div class="mt-10 info"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="copyright_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="copyright_text">
                        <P>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </P>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer_icon social_icon">
                        <ul class="list-unstyled">
                            <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modales -->
<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="text-center">
                <div class="modal-body">
                    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End modales -->

<script>
    const base_url = "<?php echo base_url(); ?>";
</script>
<!-- jquery plugins here-->
<!-- <script src="/js/plugins/jquery.min.js"></script> -->
<script src="/js/plugins/template_web/jquery-1.12.1.min.js"></script>
<!-- popper js -->
<script src="/js/plugins/popper.min.js"></script>
<!-- bootstrap js -->
<script src="/js/plugins/bootstrap.min.js"></script>
<!-- easing js -->
<script src="/js/plugins/template_web/jquery.magnific-popup.js"></script>
<!-- swiper js -->
<script src="/js/plugins/template_web/swiper.min.js"></script>
<!-- swiper js -->
<script src="/js/plugins/template_web/masonry.pkgd.js"></script>
<!-- particles js -->
<script src="/js/plugins/template_web/owl.carousel.min.js"></script>
<script src="/js/plugins/template_web/jquery.nice-select.min.js"></script>
<!-- slick js -->
<script src="/js/plugins/template_web/slick.min.js"></script>
<script src="/js/plugins/template_web/jquery.counterup.min.js"></script>
<script src="/js/plugins/template_web/waypoints.min.js"></script>
<script src="/js/plugins/template_web/contact.js"></script>
<script src="/js/plugins/template_web/jquery.ajaxchimp.min.js"></script>
<script src="/js/plugins/template_web/jquery.form.js"></script>
<script src="/js/plugins/template_web/jquery.validate.min.js"></script>
<script src="/js/plugins/template_web/validate.message_es.js"></script>
<script src="/js/plugins/template_web/mail-script.js"></script>
<!-- custom js -->
<script src="/js/plugins/template_web/custom.js"></script>

<script src="/js/plugins/sweetalert2.all.min.js"></script>
<script src="/js/app/general.js"></script>
<script>
    function verpass(e, input) {
        let selector = "#" + input;
        let elem = $(selector);
        console.log(elem);

        if (elem.attr("type") == "password") {
            elem.attr("type", "text");
        } else {
            elem.attr("type", "password");
        }
    }

    function ocultarbarra(e) {
        let selector = "#" + e;
        let elem = $(selector);
        elem.hide("slow");
    }

    function validarfuerza(e, a) {
        let elem = $(e).val();
        let fuerza = 0;
        if (elem == "") {
            fuerza = 0;
        }
        if (elem.length >= 6 && elem.length <= 9) {
            fuerza += 10;
        } else if (elem.length > 9) {
            fuerza += 25;
        }
        if (elem.length >= 7 && elem.match(/[a-z]+/)) {
            fuerza += 15;
        }

        if (elem.length >= 8 && elem.match(/[A-Z]+/)) {
            fuerza += 20;
        }

        if (elem.length >= 9 && elem.match(/[@#$%&;*]/)) {
            fuerza += 25;
        }

        if (elem.match(/([0-9]+).*\1{2}/)) {
            fuerza += -25;
        }
        console.log(fuerza);
        mostrarForca(fuerza, a);
    }

    function mostrarForca(forca, a) {
        let selector = "#" + a;
        let elem = $(selector);
        elem.show("slow");
        if (forca < 30 && forca >= 5) {
            elem.html(
                '<div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>'
            );
        } else if (forca >= 30 && forca < 50) {
            elem.html(
                '<div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>'
            );
        } else if (forca >= 50 && forca < 70) {
            elem.html(
                '<div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>'
            );
        } else if (forca > 70) {
            elem.html(
                '<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>'
            );
        } else {
            elem.html(
                '<div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'
            );
        }
    }
</script>
<!--  -->
<?php
if (isset($js) && !empty($js)) {
    for ($i = 0; $i < count($js); $i++) {
        echo '<script src="/' . $js[$i] . '"></script>';
    }
}
?>
</body>

</html>