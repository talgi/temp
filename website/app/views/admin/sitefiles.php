<!-- Start body content -->
<div class="body-content animated fadeIn">

    <div class="row">
        <div class="col-md-12">
        <!-- Start dropzone js -->
            <div class="panel rounded shadow">
                <div class="panel-sub-heading">
                    <div class="callout callout-info"><h3>Drop files here or click to upload.</h3></div>
                </div> <!-- /.panel-subheading -->
                <div class="panel-body">
                    <div id="dropzone" class="dropzone">
                
                    </div>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        <!--/ End dropzone js -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <!-- Start table horizontal scroll -->
        <h4 class="mt-0">Files List</h4>
            <div class="table-responsive mb-20">
            <form id="site_files_table">
                <?php echo  View::make("admin.components.site_files_table",array("files" =>$files));?>
                </form>
            </div><!-- /.table-responsive -->
        <!--/ End table horizontal scroll -->
        </div>
    </div>

</div>
<!--/ End body content -->
