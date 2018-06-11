
<div class="body-content animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel rounded shadow">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h3 class="panel-title">Create Group</h3>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body no-padding" style="display: block;">
                            <form id="categories_form" class="form-horizontal">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Page number </label>
                                        <input  class="form-control rounded" name="number" style="height: 100px;"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Number of views needed to get this medal</label>
                                        <input  class="form-control rounded" name="views" style="height: 100px;"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Reword</label>
                                        <input  class="form-control " name="reword" style="height: 100px;"></textarea>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="pull-right">
                                        <button class="btn btn-success" type="submit">Add</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel rounded shadow">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h3 class="panel-title">Medals</h3>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body no-padding right-side" style="display: block;">

                            <?php
                            foreach($medals as $medal){
                                echo  View::make("admin.components.medalitem",array("medal" => $medal))->render();
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
