
<!-- Start body content -->
<div class="body-content animated fadeIn">

    <div class="row">


                <div class="col-md-7">
                        <div class="panel rounded shadow">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h3 class="panel-title">update Booklet <?=$booklet->title?></h3>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- /.panel-heading -->
                            <div class="panel-body no-padding" style="display: block;">
                                <form id="booklet_update_form" class="form-horizontal">
                                    <input type="text" style="display: none" name="booklets_id"  value="<?=$booklet->booklets_id?>">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Name of the Title</label>
                                        <input class="form-control rounded" name="title" value="<?=$booklet->title?>" type="text">
                                    </div><!-- /.form-group -->
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Points</label>
                                        <input class="form-control rounded" name="points"  value="<?=$booklet->points?>" type="text">
                                    </div><!-- /.form-group -->
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Text</label>
                                        <input class="form-control rounded" name="text1"  value="<?=$booklet->text1?>" type="text">
                                    </div><!-- /.form-group -->
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Optional text</label>
                                        <input class="form-control rounded" name="text2"  value="<?=$booklet->text2?>" type="text">
                                    </div><!-- /.form-group -->

                                    <div class="form-group col-md-6">
                                        <label class="control-label">Image</label>
                                        <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image1'>
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                                <?=$booklet->image1 ?  "<img src='".url("../uploads/{$booklet->image1}")."' >"  : ""?>

                                            </div>
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
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                                <?=$booklet->image2 ?  "<img src='".url("public/uploads/{$booklet->image2}")."' >"  : ""?>

                                            </div>
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
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                                <?=$booklet->image3 ?  "<img src='".url("public/uploads/{$booklet->image3}")."' >"  : ""?>

                                            </div>
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

                </div><!-- /.row -->

        <div class="col-md-5">
            <div class="panel rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">add/download Booklet Codes </h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding" style="display: block;">

                    <form id="codes_form" class="form-horizontal">
                        <div class="form-group col-md-6">
                            <label class="control-label">chose the code date you want to exportcd pub</label>
                            <input type="text" style="display: none" id="booklets_id"  value="<?=$booklet->booklets_id?>">

                            <select id="code_date">
                                <?php
                                foreach($codes as $obj)
                                {
                                    echo "<option value='{$obj->created_at}'>{$obj->created_at}</option>";
                                }

                                ?>

                            </select>
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

        </div><!-- /.row -->
            </div>
        </div><!-- /.body-content -->
