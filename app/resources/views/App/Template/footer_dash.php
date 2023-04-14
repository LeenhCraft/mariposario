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
</script>
<?php
if (isset($data['js']) && !empty($data['js'])) {
    for ($i = 0; $i < count($data['js']); $i++) {
        echo '<script src="' . base_url() . $data['js'][$i] . '"></script>';
    }
}
?>
</body>

</html>