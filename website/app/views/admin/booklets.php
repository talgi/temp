
                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel rounded shadow">
                                        <div class="panel-heading">
                                            <div class="pull-left">
                                                <h3 class="panel-title">Update Tag <?=$tag->name?></h3>
                                            </div>
                                            <div class="pull-right">
                                                <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-down"></i></button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><!-- /.panel-heading -->
                                        <div class="panel-body no-padding" style="display: none;">
                                            <form id="tags_update_form" class="form-horizontal">
                                                <input type="hidden" id ="tag_lang_id"  value="<?=$tag->id?>">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tag Name</label>
                                                        <input class="form-control rounded" disabled="disabled" value="<?=$tag->name?>" name="name" type="text">
                                                    </div><!-- /.form-group -->
                                                </div>
                                                <div class="col-md-6">


                                                    <div class="form-group">
                                                        <label class="control-label">Tag Image</label>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image'>
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                                                <?=$tag->image ?  "<img src='".url("public/uploads/{$tag->image}")."' >"  : ""?>
                                                            </div>
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

                        </div>


                        <div class="col-md-6">


                        <!-- start my code  -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Create Booklets</h3>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-down"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body no-padding" style="display: none;">
                                        <form id="booklet_form" class="form-horizontal">
                                            <input type="text" style="display: none" name="tag_id"  value="<?=$tag->category_tags_id?>">
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Name of the Title</label>
                                                <input class="form-control rounded" name="title" type="text">
                                            </div><!-- /.form-group -->
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Points</label>
                                                <input class="form-control rounded" name="points" type="text">
                                            </div><!-- /.form-group -->
                                            <div class="form-group col-md-12">
                                                <label class="control-label">Text</label>
                                                <input class="form-control rounded" name="text1" type="text">
                                            </div><!-- /.form-group -->
                                            <div class="form-group col-md-12">
                                                <label class="control-label">Optional text</label>
                                                <input class="form-control rounded" name="text2" type="text">
                                            </div><!-- /.form-group -->
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Prefix</label>
                                                <input class="form-control rounded" name="prefix" type="text">
                                            </div><!-- /.form-group -->

                                            <div class="form-group col-md-6">
                                                <label class="control-label">Number of copies</label>
                                                <input class="form-control rounded" name="copies" type="text">
                                            </div><!-- /.form-group -->


                                            <div class="form-group col-md-6">
                                                <label class="control-label">Image</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image1'>
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="hidden" value="" name="image1">
                                                            <input type="file" name="image1"></span>
                                                    </div>
                                                </div>
                                            </div><!-- /.form-group
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Image</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image2'>
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="hidden" value="" name="image2">
                                                            <input type="file" name="image2"></span>
                                                    </div>
                                                </div>
                                            </div><!-- /.form-group 
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Image</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image3'>
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="hidden" value="" name="image3">
                                                            <input type="file" name="image3"></span>
                                                    </div>
                                                </div>
                                            </div><!-- /.form-group -->



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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel rounded shadow">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h3 class="panel-title">Create group</h3>
                                        </div>
                                        <div class="pull-right">
                                            <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-down"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div><!-- /.panel-heading -->
                                    <div class="panel-body no-padding" style="display: none;">
                                        <form id="groups_form" class="form-horizontal">
                                            <input type="text" style="display: none" name="tag_id"  value="<?=$tag->category_tags_id?>">
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Page number</label>
                                                <input class="form-control rounded" name="page_number" type="text">
                                            </div><!-- /.form-group -->
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Reword</label>
                                                <input class="form-control rounded" name="reword" type="text">
                                            </div><!-- /.form-group -->

                                            <div class="form-footer">
                                                <div class="pull-right">
                                                    <button class="btn btn-success" type="submit">Create</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div><!-- /.form-footer -->
                                        </form>


                                    </div><!-- /.panel-body -->
                                </div>
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="panel rounded shadow">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h3 class="panel-title">Tag groups</h3>
                                        </div>
                                        <div class="pull-right">
                                            <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-down"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div><!-- /.panel-heading -->
                                    <div class="panel-body no-padding groups_container" style="display: none;">

                                        <?php

                                        foreach($groups as $obj)
                                        {

                                            echo  View::make("admin.components.group",array("group" => $obj))->render();

                                        }
                                        ?>



                                    </div><!-- /.panel-body -->
                                </div>
                            </div>
                        </div><!-- /.panel -->


                        <?=$booklets?>

                            </div>
                        <!-- end my code  -->


                        </div>
                    </div><!-- /.row -->

                </div><!-- /.body-content -->
