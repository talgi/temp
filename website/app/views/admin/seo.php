<!-- Start body content -->

<div class="body-content animated fadeIn">
    <div <?= Request::path() != CMS_NAME."/seo" ? "class='container'" :"" ;?> >
        <div class="row">
            <div class="col-md-12">

               <div class="panel panel-default seo">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title">SEO</h3>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-primary btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title="">
                                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body no-padding" <?= Request::path() != CMS_NAME."/seo" ? 'style="display:none;"' :"" ;?>>

                        <form id='seo_form' <?= isset($page_id) ? "data-page_id='{$page_id}' data-lang='{$lang}' " : ""?>>
                        <?php if(isset($lang_id)):?>
                            <input  type='hidden' id='lang_id' value="<?=$lang_id?>">
                        <?php endif;?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input class="form-control" name='seo_title' value="<?=$seo_title?>" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select name='seo_type' class=" input-sm mb-15">
                                    <?php 
                                        foreach (unserialize(SEO_TYPES) as  $value) {
                                            $checked = $value == $seo_type ? "checked" : "";
                                          echo "<option $checked  value='$value'>$value</option>";
                                        }
                                    ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput" data-name='seo_image'>
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <?=$seo_image ?  "<img src='".url("public/uploads/$seo_image")."' >"  : ""?>

                                        </div>
                                        <div>
                                            <span class="btn btn-info btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                            <input type="hidden" name="seo_image" >
                                            <input type="file" name="seo_image">
                                            </span>
                
                                        </div>
                                    </div>
                                </div>
                                <?php if(isset($seo_site_name)):?>
                                <div class="form-group">
                                    <label class="control-label">Site Name</label>
                                    <input class="form-control" name='seo_site_name' value='<?=$seo_site_name?>' type="text">
                                </div><!-- /.form-group -->
                            <?php endif;?>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <input class="form-control" name='seo_desc'  value='<?=$seo_desc?>' type="text">
                                </div><!-- /.form-group -->        

                                <div class="form-group">
                                    <label class="control-label">keywords</label>
                                    <input type="text" name='seo_keywords' value="<?=$seo_keywords?>" data-role="tagsinput" class="form-control" placeholder="Type and enter" >
                                </div><!-- /.form-group -->
                            </div><!-- /.form-body -->
                            <div class="form-footer">
                                <div class="pull-right">

                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- /.form-footer -->
                        </form>

                    </div><!-- /.panel-body -->
                </div>

            </div>
        </div><!-- /.row -->
    </div>
</div><!-- /.body-content -->
          