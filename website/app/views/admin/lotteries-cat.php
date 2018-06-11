
<!-- Start body content -->
<div class="body-content animated fadeIn">



    <div class="row">
        <div class="col-md-3">
            <div class="panel rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Create lotterie category</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding" style="display: block;">
                    <form id="lot_form" class="form-horizontal">
                         <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
                            <label class="control-label">Required points</label>
                            <input class="form-control rounded" name="required_points" type="text" style="width: 50%; margin: 0 auto;">
                        </div><!-- /.form-group -->
                        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
                            <label class="control-label">Number of winners </label>
                            <input class="form-control rounded" name="number_of_winners" type="number" style="width: 50%; margin: 0 auto;">
                        </div><!-- /.form-group -->
                        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
                            <label class="control-label">Name</label>
                            <input class="form-control rounded" name="name" type="text" style="width: 50%; margin: 0 auto;">
                        </div><!-- /.form-group -->
                        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
                            <label class="control-label">Text</label>
                            <textarea class="form-control rounded" name="text" style="width: 50%; height: 80px; margin: 0 auto; "></textarea>
                        </div><!-- /.form-group -->
                        <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                            <label class="control-label">Image</label>
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image'>
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                    </div>
                                <div>
                                <span class="btn btn-info btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                <input type="hidden" name="image" >
                                <input type="file" name="image">
                                </span>
                            </div>
                        </div>
                            </div>
                           </div>

                        <div class="form-footer">
                            <div style="margin: 0 auto; text-align: center;">
                                <button class="btn btn-success" type="submit">Create</button>
                            </div>
                            <div class="clearfix"></div>
                        </div><!-- /.form-footer -->
                    </form>


                </div><!-- /.panel-body -->
            </div>
        </div>
        <div class="col-md-9">
        </div>
    </div><!-- /.panel -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Lottorie Catagoris</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-down"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding groups_container" style="display: block;">
                    <div class="form-horizontal">
                        <div class="row lot_container">

                            <?php
                            foreach($cats as $cat) {
                                echo View::make("admin.components.createlottorie",array("cat"=>$cat))->render();
                            }
                            ?>

                        </div>
                    </div>
<!-- 
                    <?php
/*
                    foreach($groups as $obj)
                    {

                        echo  View::make("admin.components.group",array("group" => $obj))->render();

                    }
                    */
                    ?> -->



                </div><!-- /.panel-body -->
            </div>
        </div>
    </div>


    

</div>
<!-- end my code  -->


</div>
</div><!-- /.row -->

</div><!-- /.body-content -->
