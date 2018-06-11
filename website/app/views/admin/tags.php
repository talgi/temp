
                <!-- Start body content -->
                <div class="body-content animated fadeIn">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Update Category <?=$cat->name?></h3>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-down"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body no-padding" style="display: none;">
                                    <form id="categories_update_form" class="form-horizontal">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Category Name</label>
                                                <input class="form-control rounded" value="<?=$cat->name?>" name='name' type="text">
                                            </div><!-- /.form-group -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Upload Logo</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput" data-name='logo'>
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                                         <?=$cat->logo ?  "<img src='".url("public/uploads/{$cat->logo}")."' >"  : ""?>
                                                    </div>
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
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                                        <?=$cat->banner ?  "<img src='".url("public/uploads/{$cat->banner}")."' >"  : ""?>
                                                    </div>
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


                        <!-- start my code  -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Create Tags</h3>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body no-padding" style="display: block;">
                                        <form id="tags_form" class="form-horizontal">
                                            <input type="hidden" value="<?=$cat->category_id?>" name="category_id">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tag Name</label>
                                                    <input class="form-control rounded" name="name" type="text">
                                                </div><!-- /.form-group -->
                                            </div>
                                            <div class="col-md-6">


                                            <div class="form-group">
                                                <label class="control-label">Tag Image</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image'>
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="hidden" value="" name="image">
                                                            <input type="file" name="image"></span>
                                                    </div>
                                                </div>
                                            </div><!-- /.form-group -->
                                          </div>


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
                                
                            </div><!-- /.panel -->
                            <!-- End file input - horizontal form -->




                        </div>

                            </div>
                        <!-- end my code  -->
                    <?=$tags?>

                        </div>
                    </div><!-- /.row -->

                </div><!-- /.body-content -->
                <!--/ End body content -->
