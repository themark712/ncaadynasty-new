</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= $filepath ?>_assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= $filepath ?>_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $filepath ?>_assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?= $filepath ?>_assets/vendor/echarts/echarts.min.js"></script>
<script src="<?= $filepath ?>_assets/vendor/quill/quill.js"></script>
<script src="<?= $filepath ?>_assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= $filepath ?>_assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= $filepath ?>_assets/vendor/php-email-form/validate.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="<?= $filepath ?>_assets/vendor/summernote/summernote-lite.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= $filepath ?>_assets/js/main.js"></script>

<script>
    $('#summernote').summernote({
        toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview', 'help']],
        ],
        placeholder: 'article text',
        tabsize: 2,
        fontsize: 4,
        height: 500
    });
    //$('#summernote').summernote('disable');
    $('#summernotea').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 200
    });
</script>
</body>

<script>
    window.addEventListener("load", function() {
        var breadcrumb = "<li class='breadcrumb-item'><a href='<?= ROOT ?>/home.php'>Home</a></li>";
        var jsArray = <?php echo json_encode($aryb); ?>;

        for (var i = 0; i < jsArray.length; i++) {
            if (jsArray[i][0] != "") {
                breadcrumb = breadcrumb + "<li class='breadcrumb-item'><a href='<?= ROOT ?>" + jsArray[i][0] + "'>" + jsArray[i][1] + "</a></li>";
            }
        }
        document.getElementById("breadcrumb").innerHTML = breadcrumb;
    });
</script>

</html>