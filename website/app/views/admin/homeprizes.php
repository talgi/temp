<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 22/07/2015
 * Time: 10:43
 */
?>
<div class="body-content animated fadeIn">
	<div class="row">
     	<div class="col-md-12">
     		<div class="row">
                	<div class="col-md-3">
	                    <div class="panel rounded shadow">
	                        <div class="panel-heading">
	                            <div class="pull-left">
	                                <h3 class="panel-title">Prizes</h3>
	                            </div>
	                            <div class="pull-right">
	                                <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
	                            </div>
	                            <div class="clearfix"></div>
	                        </div>
	                        <div class="panel-body no-padding" style="display: block;">
	                            <form id="categories_form" class="form-horizontal">
                                   	<div class="col-md-12">
                                        <label class="control-label"></label>
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
	                                   <div class="col-md-12">
	                                        <div class="form-group">
	                                            <label class="control-label">Text</label>
	                                            <textarea rows="5" class="form-control rounded" name="text" style="height: 100px;"></textarea>
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
	               <div class="col-md-9">
	                    <div class="panel rounded shadow">
	                        <div class="panel-heading">
	                            <div class="pull-left">
	                                <h3 class="panel-title">Prizes</h3>
	                            </div>
	                            <div class="pull-right">
	                                <button class="btn btn-sm" data-container="body" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
	                            </div>
	                            <div class="clearfix"></div>
	                        </div>
	                        <div class="panel-body no-padding right-side" style="display: block;">

	                              <?php
                                  foreach($prizes as $prize){
                                     echo  View::make("admin.components.homeprizesitem",array("prize" => $prize))->render();
                                  }

                                  ?>
	                        </div>
	                    </div>
	               </div>
          	</div>
     	</div>
	</div>
</div>
