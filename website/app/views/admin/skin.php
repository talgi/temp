<?php include 'head.php'; ?>

<body class="page-sound">

<?php include 'components/loading.php'; ?>

        <!-- START @WRAPPER -->
        <section id="wrapper">
            <?php include 'components/header.php'; ?>
            <?php include 'components/sidebar.php'; ?>
            <section id="page-content">
                <?php include 'components/page_header.php'; ?>

               
                <?=$content ?>

                <?php include 'components/footer.php'; ?>
            </section>
        </section>

<?php include 'components/backtop.php'; ?>
<div id='error_alert'  class='hidden'>
    <?php
        foreach ($errors->all() as $value) {
            echo "<div>$value</div>";
        } 
    ?>
</div>

<!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <script type="text/javascript">
            var g_url ="<?=url()."/"?>"
            var CMS_NAME = "<?=CMS_NAME?>";
            var current_lang = "<?=Config::get("app.locale")?>";
        </script>
        <!-- START @CORE PLUGINS -->
        <script src="<?=url()."/public/"?>components/jquery/dist/jquery.min.js"></script>
        <script src="<?=url()."/public/"?>components/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?=url()."/public/"?>components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=url()."/public/"?>components/jpreloader/js/jpreloader.min.js"></script>
        <script src="<?=url()."/public/"?>components/jquery.easing/js/jquery.easing.min.js"></script>
        <script src="<?=url()."/public/"?>components/ionsound/js/ion.sound.min.js"></script>
        <script src="<?=url()."/public/"?>components/handlebars/handlebars.min.js"></script>
        <script src="<?=url()."/public/"?>components/typeahead.js/dist/typeahead.bundle.min.js"></script>
        <script src="<?=url()."/public/"?>components/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?=url()."/public/"?>components/dropzone/dist/dropzone.js"></script>
        <script src="<?=url()."/public/"?>components/holderjs/holder.min.js"></script>
        <script src="<?=url()."/public/"?>components/alertify/alertify.min.js"></script>
        <script src="<?=url()."/public/"?>components/select2/select2.min.js"></script>
        <script src="<?=url()."/public/"?>js/tai/jasny-bootstrap.js"></script>
        <script src="<?=url()."/public/"?>components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="<?=url()."/public/"?>components/jquery-ui/jquery-ui.js"></script>
        <script src="<?=url()."/public/"?>components/jquery-file-download/src/Scripts/jquery.fileDownload.js"></script>

        <script src="<?=url()."/public/"?>js/tai/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?=url()."/public/"?>js/tai/datatables/js/dataTables.bootstrap.js"></script>
        <script src="<?=url()."/public/"?>js/tai/datatables/js/datatables.responsive.js"></script>


        <?=  Assets::js();?>
        <!--/ END CORE PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="<?=url()."/public/"?>js/tai/apps.js"></script>
        <script src="<?=url()."/public/"?>js/tai/tai.js"></script>
        
        


        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->

    </body>
    <!--/ END BODY -->

</html>