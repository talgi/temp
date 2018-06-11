<!-- Start body content -->
<div class="body-content animated fadeIn">
<div class='row well' >

    <?php foreach (Config::get("app.languages") as $value) :?>
        <?php if(Request::segment(4) != $value):?>
            <a   class="lang-sm lang-lbl-en " lang="<?=$value == 'he' ? "iw" : $value?>" href="<?=url(CMS_NAME."/menus/show/".$value."/".Request::segment(5))?>"></a> 
        <?php endif;?>
    <?php endforeach;?>

</div>

    <div class="row">

        <?php  for ($i=1; $i <= $numberOfPlaces ; $i++) :?>
        <div class="col-md-2">
            <ul data-id='<?=$i?>' class='well well-lg sort-container list-unstyled' style='padding:5px;'>
                <?php  if(isset($menuLinks[$i])) foreach ($menuLinks[$i] as  $obj):?>
                <?=View::make("admin.components.menu_edit_component",array('obj' => $obj ))?>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endfor;?>
</div>

<div class="panel panel-default seo">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title">Add external links</h3>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-primary btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title="">
                                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body no-padding" style="display:none;">

                        <form id='form_new_link'>
                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Link Name</label>
                                            <input class="form-control" name='name' type="text">
                                        </div>
                                        <input class="form-control" name='external' value='1' type="hidden">
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





    <h5>Unuse Menu items</h5>
    <ul class="list-unstyled row sort-container well well-lg" id='unuse_links' data-id='delete'>

        <?php foreach ($links as $obj) :?>
            <li class="col-md-2" data-id='<?=$obj->id?>' data-external='<?=isset($obj->external) ? 1 : 0?>' data-link='<?=$obj->url?>'>
                <!-- Start collapsible panel -->
                <div class="panel">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title"><?=$obj->name?></h3>
                            <?php if(isset($obj->external)):?>
                            <div class="fa fa-times delete_extrnal" style="position: absolute;top:-6px;right: -4px;z-index: 1;"></div>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                </div><!-- /.panel -->
                <!--/ End collapsible panel -->
            </li>
        <?php endforeach;?>
    </ul>
            

</div><!-- /.body-content -->
<!--/ End body content -->