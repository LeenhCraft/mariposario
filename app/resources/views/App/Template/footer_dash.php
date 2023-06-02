</div>
<!-- / Content -->

<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            , power by
            <a href="https://leenhcraft.com" target="_blank" class="footer-link fw-bolder">LeenhCraft</a>
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
<script>
    const base_url = "<?php echo base_url(); ?>";
</script>

<!-- Core JS -->
<script src="/js/app/plugins/jquery.min.js"></script>
<script src="/js/app/plugins/popper.min.js"></script>
<script src="/js/app/plugins/bootstrap.min.js"></script>

<script src="/js/app/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/js/app/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="/js/app/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="/js/app/plugins/main.js"></script>

<!-- Page JS -->
<!-- <script src="/js/plugins/template_app/dashboards-analytics.js"></script> -->
<!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->

<script src="/js/app/plugins/jquery.dataTables.min.js"></script>
<script src="/js/app/plugins/dataTables.bootstrap.min.js"></script>
<script src="/js/app/plugins/sweetalert2.all.min.js"></script>
<script src="/js/app/plugins/select2.min.js"></script>
<script src="/js/app/plugins/dropzone-min.js"></script>

<script>
    var divLoading = $("#divLoading");
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    function crearSlug(slug) {
        slug = slug.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        slug = slug
            .replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, " ")
            .toLowerCase();
        slug = slug.replace(/^\s+|\s+$/gm, "");
        slug = slug.replace(/\s+/g, "-");
        return slug;
    }
</script>
<?php
if (isset($data['js']) && !empty($data['js'])) {
    for ($i = 0; $i < count($data['js']); $i++) {
        echo '<script src="' . base_url() . $data['js'][$i] . '"></script>';
    }
}
?>
<!-- configuracion de apariencia  -->
<script src="/js/template-customizer.js"></script>

<style>
    #template-customizer {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
        font-size: inherit !important;
        position: fixed;
        top: 0;
        right: 0;
        height: 100%;
        z-index: 99999999;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 360px;
        background: #fff;
        -webkit-box-shadow: 0 0 20px 0 rgba(0, 0, 0, .2);
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, .2);
        -webkit-transition: all .2s ease-in;
        -o-transition: all .2s ease-in;
        transition: all .2s ease-in;
        -webkit-transform: translateX(380px);
        -ms-transform: translateX(380px);
        transform: translateX(380px)
    }

    #template-customizer h5 {
        position: relative;
        font-size: 11px;
        font-weight: 600
    }

    #template-customizer>h5 {
        flex: 0 0 auto
    }

    #template-customizer .disabled {
        color: #d1d2d3 !important
    }

    #template-customizer.template-customizer-open {
        -webkit-transition-delay: .1s;
        -o-transition-delay: .1s;
        transition-delay: .1s;
        -webkit-transform: none !important;
        -ms-transform: none !important;
        transform: none !important
    }

    #template-customizer .template-customizer-open-btn {
        position: absolute;
        top: 180px;
        left: 0;
        z-index: -1;
        display: block;
        width: 42px;
        height: 42px;
        border-top-left-radius: 15%;
        border-bottom-left-radius: 15%;
        background: #333;
        color: #fff !important;
        text-align: center;
        font-size: 18px !important;
        line-height: 42px;
        opacity: 1;
        -webkit-transition: all .1s linear .2s;
        -o-transition: all .1s linear .2s;
        transition: all .1s linear .2s;
        -webkit-transform: translateX(-62px);
        -ms-transform: translateX(-62px);
        transform: translateX(-62px)
    }

    @media(max-width: 991.98px) {
        #template-customizer .template-customizer-open-btn {
            top: 145px
        }
    }

    .dark-style #template-customizer .template-customizer-open-btn {
        background: #555
    }

    #template-customizer .template-customizer-open-btn::before {
        content: "";
        width: 22px;
        height: 22px;
        display: block;
        background-size: 100% 100%;
        position: absolute;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAABClJREFUaEPtmY1RFEEQhbsjUCIQIhAiUCNQIxAiECIQIxAiECIAIpAMhAiECIQI2vquZqnZvp6fhb3SK5mqq6Ju92b69bzXf6is+dI1t1+eAfztG5z1BsxsU0S+ici2iPB3vm5E5EpEDlSVv2dZswFIxv8UkZcNy+5EZGcuEHMCOBeR951uvVDVD53vVl+bE8DvDu8Pxtyo6ta/BsByg1R15Bwzqz5/LJgn34CZwfnPInI4BUB6/1hV0cSjVxcAM4PbcBZjL0XklIPN7Is3fLCkdQPpPYw/VNXj5IhPIvJWRIhSl6p60ULWBGBm30Vk123EwRxCuIzWkkjNrCZywith10ewE1Xdq4GoAjCz/RTXW44Ynt+LyBEfT43kYfbj86J3w5Q32DNcRQDpwF+dkQXDMey8xem0L3TEqB4g3PZWad8agBMRgZPeu96D1/C2Zbh3X0p80Op1xxloztN48bMQQNoc7+eLEuAoPSPiIDY4Ooo+E6ixeNXM+D3GERz2U3CIqMstLJUgJQDe+7eq6mub0NYEkLAKwEHkiBQDCZtddZCZ8d6r7JDwFkoARklHRPZUFVDVZWbwGuNrC4EfdOzFrRABh3Wnqhv+d70AEBLGFROPmeHlnM81G69UdSd6IUuM0GgUVn1uqWmg5EmMfBeEyB7Pe3txBkY+rGT8j0J+WXq/BgDkUCaqLgEAnwcRog0veMIqFAAwCy2wnw+bI2GaGboBgF9k5N0o0rUSGUb4eO0BeO9j/GYhkSHMHMTIqwGARX6p6a+nlPBl8kZuXMD9j6pKfF9aZuaFOdJCEL5D4eYb9wCYVCanrBmGyii/tIq+SLj/HQBCaM5bLzwfPqdQ6FpVHyra4IbuVbXaY7dETC2ESPNNWiIOi69CcdgSMXsh4tNSUiklMgwmC0aNd08Y5WAES6HHehM4gu97wyhBgWpgqXsrASglprDy7CwhehMZOSbK6JMSma+Fio1KltCmlBIj7gfZOGx8ppQSXrhzFnOhJ/31BDkjFHRvOd09x0mRBA9SFgxUgHpQg0q0t5ymPMlL+EnldFTfDA0NAmf+OTQ0X0sRouf7NNkYGhrOYNrxtIaGg83MNzVDSe3LXLhP7O/yrCsCz1zlWTpjWkuZAOBpX3yVnLqI1yLCOKU6qMrmP7SSrUEw54XF4WBIK5FxCMOr3lVsfGqNSmPzBXUnJTIX1jyVBq9wO6UObOpgC5GjO98vFKnTdQMZXxEsWZlDiCZMIxAbNxQOqlpVZtobejBaZNoBnRDzMFpkxvTQOD36BlrcySZuI6p1ACB6LU3wWuf5581+oHfD1vi89bz3nFUC8Nm7ZlP3nKkFbM4bWPt/MSFwklprYItwt6cmvpWJ2IVcQBCz6bLysSCv3SaANCiTsnaNRrNRqMXVVT1/BrAqz/buu/Y38Ad3KC5PARej0QAAAABJRU5ErkJggg==);
        margin: 10px
    }

    .customizer-hide #template-customizer .template-customizer-open-btn {
        display: none
    }

    [dir=rtl] #template-customizer .template-customizer-open-btn {
        border-radius: 0;
        border-top-right-radius: 15%;
        border-bottom-right-radius: 15%
    }

    [dir=rtl] #template-customizer .template-customizer-open-btn::before {
        margin-left: -2px
    }

    #template-customizer.template-customizer-open .template-customizer-open-btn {
        opacity: 0;
        -webkit-transition-delay: 0s;
        -o-transition-delay: 0s;
        transition-delay: 0s;
        -webkit-transform: none !important;
        -ms-transform: none !important;
        transform: none !important
    }

    #template-customizer .template-customizer-close-btn {
        position: absolute;
        top: 32px;
        right: 0;
        display: block;
        font-size: 20px;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%)
    }

    #template-customizer .template-customizer-inner {
        position: relative;
        overflow: auto;
        -webkit-box-flex: 0;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        opacity: 1;
        -webkit-transition: opacity .2s;
        -o-transition: opacity .2s;
        transition: opacity .2s
    }

    #template-customizer .template-customizer-inner>div:first-child>hr:first-of-type {
        display: none !important
    }

    #template-customizer .template-customizer-inner>div:first-child>h5:first-of-type {
        padding-top: 0 !important
    }

    #template-customizer .template-customizer-themes-inner {
        position: relative;
        opacity: 1;
        -webkit-transition: opacity .2s;
        -o-transition: opacity .2s;
        transition: opacity .2s
    }

    #template-customizer .template-customizer-theme-item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -ms-flex-align: center;
        -webkit-box-flex: 1;
        -ms-flex: 1 1 100%;
        flex: 1 1 100%;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin-bottom: 10px;
        padding: 0 24px;
        width: 100%;
        cursor: pointer
    }

    #template-customizer .template-customizer-theme-item input {
        position: absolute;
        z-index: -1;
        opacity: 0
    }

    #template-customizer .template-customizer-theme-item input~span {
        opacity: .25;
        -webkit-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s
    }

    #template-customizer .template-customizer-theme-item .template-customizer-theme-checkmark {
        display: inline-block;
        width: 6px;
        height: 12px;
        border-right: 1px solid;
        border-bottom: 1px solid;
        opacity: 0;
        -webkit-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg)
    }

    [dir=rtl] #template-customizer .template-customizer-theme-item .template-customizer-theme-checkmark {
        border-right: none;
        border-left: 1px solid;
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg)
    }

    #template-customizer .template-customizer-theme-item input:checked:not([disabled])~span,
    #template-customizer .template-customizer-theme-item:hover input:not([disabled])~span {
        opacity: 1
    }

    #template-customizer .template-customizer-theme-item input:checked:not([disabled])~span .template-customizer-theme-checkmark {
        opacity: 1
    }

    #template-customizer .template-customizer-theme-colors span {
        display: block;
        margin: 0 1px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, .1) inset;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, .1) inset
    }

    #template-customizer.template-customizer-loading .template-customizer-inner,
    #template-customizer.template-customizer-loading-theme .template-customizer-themes-inner {
        opacity: .2
    }

    #template-customizer.template-customizer-loading .template-customizer-inner::after,
    #template-customizer.template-customizer-loading-theme .template-customizer-themes-inner::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 999;
        display: block
    }

    .layout-menu-100vh #template-customizer {
        height: 100vh
    }

    [dir=rtl] #template-customizer {
        right: auto;
        left: 0;
        -webkit-transform: translateX(-380px);
        -ms-transform: translateX(-380px);
        transform: translateX(-380px)
    }

    [dir=rtl] #template-customizer .template-customizer-open-btn {
        right: 0;
        left: auto;
        -webkit-transform: translateX(62px);
        -ms-transform: translateX(62px);
        transform: translateX(62px)
    }

    [dir=rtl] #template-customizer .template-customizer-close-btn {
        right: auto;
        left: 0
    }

    #template-customizer .template-customizer-layouts-options[disabled] {
        opacity: .5;
        pointer-events: none
    }

    [dir=rtl] .template-customizer-t-style_switch_light {
        padding-right: 0 !important
    }
</style>
<div id="template-customizer" class="invert-bg-white" style="visibility: visible"> <a href="javascript:customizer()" class="template-customizer-open-btn" tabindex="-1"></a>
    <div class="p-4 m-0 lh-1 border-bottom template-customizer-header">
        <h4 class="template-customizer-t-panel_header mb-2">TEMPLATE CUSTOMIZER</h4>
        <p class="template-customizer-t-panel_sub_header mb-0">Customize and preview in real time</p> <a href="javascript:close()" class="btn-close template-customizer-close-btn fw-light px-4 py-2 text-body" tabindex="-1"></a>
    </div>
    <div class="template-customizer-inner pt-4">
        <div class="template-customizer-theming">
            <h5 class="m-0 px-4 py-4 lh-1 text-light d-block"> <span class="template-customizer-t-theming_header">THEMING</span> </h5>
            <div class="m-0 px-4 pb-3 template-customizer-themes w-100"> <label for="customizerTheme" class="form-label template-customizer-t-theme_label">Themes</label>
                <div class="row row-cols-lg-auto g-3 align-items-center template-customizer-themes-options">
                    <div class="col-12">
                        <div class="form-check"><input class="form-check-input" type="radio" name="themeRadios" id="themeRadiostheme-default" value="theme-default" checked="checked"><label class="form-check-label" for="themeRadiostheme-default">Default</label></div>
                    </div>
                    <div class="col-12">
                        <div class="form-check"><input class="form-check-input" type="radio" name="themeRadios" id="themeRadiostheme-semi-dark" value="theme-semi-dark"><label class="form-check-label" for="themeRadiostheme-semi-dark">Semi Dark</label></div>
                    </div>
                    <div class="col-12">
                        <div class="form-check"><input class="form-check-input" type="radio" name="themeRadios" id="themeRadiostheme-bordered" value="theme-bordered"><label class="form-check-label" for="themeRadiostheme-bordered">Bordered</label></div>
                    </div>
                </div>
            </div>
            <div class="m-0 px-4 pb-3 pt-1 template-customizer-style w-100"> <label for="customizerStyle" class="form-label d-block template-customizer-t-style_label">Style (Mode)</label> <label class="switch switch-sm"> <span class="switch-label template-customizer-t-style_switch_light">Light</span> <input type="checkbox" class="switch-input" checked="checked"> <span class="switch-toggle-slider"> <span class="switch-on"></span> <span class="switch-off"></span> </span> <span class="switch-label template-customizer-t-style_switch_dark">Dark</span> </label> </div>
        </div>
        <div class="template-customizer-layout">
            <hr class="m-0">
            <h5 class="m-0 px-4 py-4 lh-1 text-light d-block"> <span class="template-customizer-t-layout_header">LAYOUT</span> </h5>
            <div class="m-0 px-4 pb-3 d-block template-customizer-layoutType"> <label for="customizerStyle" class="form-label d-block template-customizer-t-layout_label">Layout (Menu)</label>
                <div class="row row-cols-lg-auto g-3 align-items-center template-customizer-layouts-options">
                    <div class="col-12">
                        <div class="form-check"> <input class="form-check-input" type="radio" name="layoutRadios" id="layoutRadios-static" value="static"> <label class="form-check-label template-customizer-t-layout_static" for="layoutRadios-static">Static</label> </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check"> <input class="form-check-input" type="radio" name="layoutRadios" id="layoutRadios-fixed" value="fixed" checked="checked"> <label class="form-check-label template-customizer-t-layout_fixed" for="layoutRadios-fixed">Fixed</label> </div>
                    </div>
                </div>
            </div> <label class="m-0 px-4 pb-3 d-flex media align-items-middle justify-content-between template-customizer-layoutNavbarFixed"> <span class="template-customizer-t-layout_navbar_label">Fixed navbar</span> <label class="switch switch-sm pe-4"> <input type="checkbox" class="switch-input" checked="checked"> <span class="switch-toggle-slider"> <span class="switch-on"></span> <span class="switch-off"></span> </span> </label> </label> <label class="m-0 px-4 pb-3 d-flex media align-items-middle justify-content-between template-customizer-layoutFooterFixed"> <span class="template-customizer-t-layout_footer_label">Fixed footer</span> <label class="switch switch-sm pe-4"> <input type="checkbox" class="switch-input"> <span class="switch-toggle-slider"> <span class="switch-on"></span> <span class="switch-off"></span> </span> </label> </label> <label class="m-0 px-4 pb-3 d-flex media align-items-middle justify-content-between template-customizer-showDropdownOnHover"> <span class="template-customizer-t-layout_dd_open_label">Dropdown on hover</span> <label class="switch switch-sm pe-4"> <input type="checkbox" class="switch-input" checked="checked"> <span class="switch-toggle-slider"> <span class="switch-on"></span> <span class="switch-off"></span> </span> </label> </label>
        </div>
        <div class="template-customizer-misc">
            <hr class="m-0">
            <h5 class="m-0 px-4 py-4 lh-1 text-light d-block"> <span class="template-customizer-t-misc_header">MISC</span> </h5> <label class="m-0 px-4 pb-3 d-flex media align-items-middle justify-content-between template-customizer-rtl"> <span class="template-customizer-t-rtl_label">RTL direction</span> <label class="switch switch-sm pe-4"> <input type="checkbox" class="switch-input"> <span class="switch-toggle-slider"> <span class="switch-on"></span> <span class="switch-off"></span> </span> </label> </label>
        </div>
    </div>
</div>

</body>

</html>