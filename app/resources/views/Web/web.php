<?php headerWeb('Web.Template.header_web', $data); ?>
<!-- banner part start-->
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="banner_slider owl-carousel">
                    <?= $data['items_banner']; ?>
                </div>
                <div class="slider-counter"></div>
            </div>
        </div>
    </div>
</section>
<section class="product_list section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>awesome <span>shop</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product_list_slider owl-carousel">
                    <div class="single_product_list_slider">
                        <div class="row align-items-center justify-content-between">
                            <?= $data["carousel_1"] ?>
                        </div>
                    </div>
                    <div class="single_product_list_slider">
                        <div class="row align-items-center justify-content-between">
                            <?= $data["carousel_2"] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php footerWeb('Web.Template.footer_web', $data); ?>