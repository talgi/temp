<?php include 'head.php'; ?>

    <body class="bg-light page-sound">
        

        <?=$content ?>


        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- START @CORE PLUGINS -->

        <script type="text/javascript"> var g_url = "<?=url()?>"</script>
        <script src="<?=url()."/public/"?>components/jquery/dist/jquery.min.js"></script>
        <script src="<?=url()."/public/"?>components/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?=url()."/public/"?>components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=url()."/public/"?>components/jpreloader/js/jpreloader.min.js"></script>
        <script src="<?=url()."/public/"?>components/jquery.easing/js/jquery.easing.min.js"></script>
        <script src="<?=url()."/public/"?>components/ionsound/js/ion.sound.min.js"></script>
        <!--/ END CORE PLUGINS -->

      
        <script src="<?=url()."/public/"?>components/jquery.validate/dist/jquery.validate.min.js"></script>
   


        <script src="<?=url()."/public/"?>js/tai/apps.js"></script>
        <script src="<?=url()."/public/"?>js/tai/pages/blankon.sign.js"></script>
  

    </body>
    <!-- END BODY -->

</html>