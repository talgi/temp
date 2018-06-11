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
                <div class="col-md-3"></div>
                	<div class="col-md-6">
	                    <div class="panel rounded shadow">
	                        <div class="panel-heading">
	                            <div class="pull-left">
	                                <h3 class="panel-title">Video</h3>
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
	                                            <label class="control-label">Video Link</label>
	                                            <input type="text" class="form-control rounded" value="<?=$movie->youtube?>" name="youtube">
	                                        </div>
	                                    </div>
	                                   <div class="col-md-12">

                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" style="margin-top: 9px;" data-provides="fileinput" data-name='image'>
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 300px; height: 150px; line-height: 150px; display: block; margin: 0 auto;">
                                                            <?=$movie->image ?  "<img src='".url("../uploads/{$movie->image}")."' >"  : ""?>
                                                        </div>
                                                        <div>
                                                        <span class="btn btn-info btn-file" style="width: 150px; display: block; margin: 9px auto 0;"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                        <input type="hidden" name="image" >
                                                        <input type="file" name="image">
                                                        </span>

                                                        </div>
                                                    </div>
                                                </div>
	                                        </div>
	                                   </div>
	                                   <div class="col-md-12">
	                                        <div class="form-group">
	                                            <label class="control-label">Headline Text</label>
	                                            <input type="text" class="form-control rounded" value="<?=$movie->title?>" name="title">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-12">
	                                        <div class="form-group">
	                                            <label class="control-label">Text</label>
	                                            <div class="form-control rounded editor"  style="height: 300px"><?=$movie->text?></div>
	                                        </div>
	                                    </div>
		                               <div class="form-footer">
		                                   <div class="pull-right">
										<button class="btn btn-success" type="submit">edit</button>
		                                   </div>
		                                   <div class="clearfix"></div>
		                              </div>
	                            </form>
	                        </div>
	                    </div>
                <div class="col-md-3"></div>
	               </div>
          	</div>
     	</div>
	</div>
</div>
