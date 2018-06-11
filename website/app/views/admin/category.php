<div class="body-content animated fadeIn">

    <div class="row">
        <div class="col-md-12">


            <!-- start my code  -->
            <div class="row">
                <div class="col-md-6">
                    <div class="panel rounded shadow">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h3 class="panel-title">Category</h3>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-down"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div><!-- /.panel-heading -->
                        <div class="panel-body no-padding" style="display: block;">
                            <form id="categories_form" class="form-horizontal">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Category Name</label>
                                            <input class="form-control rounded" name='name' type="text">
                                        </div><!-- /.form-group -->
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Upload Logo</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput" data-name='logo'>
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="hidden" value="" name="logo">
                                                    <input type="file" name="logo"></span>

                                                </div>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div>
                                <!--
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Upload Header</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput" data-name='banner'>
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                                                <div>
                                                            <span class="btn btn-info btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="hidden" value="" name="banner">
                                                                <input type="file" name="banner"></span>
                                                </div>
                                            </div>
                                        </div><!-- /.form-group
                                    </div>

-->


                                <div class="form-footer">
                                    <div class="pull-right">

                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.form-footer -->
                            </form>


                        </div><!-- /.panel-body -->
                    </div>
                </div><!-- /.col-md-6 -->
                <div class="col-md-6">

                    <!-- Start file input - horizontal form -->
                    <div class="panel rounded shadow">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h3 class="panel-title">Categories</h3>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div><!-- /.panel-heading -->
                        <div class="panel-body no-padding">


                                <div class="form-body">
                                    <div class="row" id="category-holder">
                                        <?=$cats?>
                                    </div>
                                </div><!-- /.form-body -->


                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                    <!-- End file input - horizontal form -->

                </div>
            </div>
            <!-- end my code  -->


        </div>
    </div><!-- /.row -->

</div><!-- /.body-content -->
<!--/ End body content -->
