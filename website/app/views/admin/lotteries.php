
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
                        <input type="text" style="display: none" name="lotteries_cat_id" value="<?=$catID?>">
                         <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
                            <label class="control-label">Name</label>
                            <input class="form-control rounded" name="name" type="text" style="width: 70%; margin: 0 auto;">
                        </div><!-- /.form-group -->
                        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
                            <label class="control-label">Start</label>
                            <input class="form-control rounded datepicker" name="start" type="text" style="width: 70%; margin: 0 auto; ">
                        </div><!-- /.form-group -->
                        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
                            <label class="control-label">End</label>
                            <input class="form-control rounded datepicker" name="end" type="text" style="width: 70%; margin: 0 auto;">
                            <br>
                        </div><!-- /.form-group -->
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
                        <div class="row lotteries_container">

                            <?php
                            foreach($lotteries as $lottery){
                                echo  View::make("admin.components.lottories",array("lottery" =>$lottery))->render();
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
