<div class="media-library LTR">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-tab rounded shadow">
                <div class="panel-heading no-padding">
                    <ul class="nav nav-tabs media-tabs">
                        <li>
                            <a href="#tab1-2" data-toggle="tab">
                                <i class="fa fa-upload"></i>
                                <span>Upload</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#tab1-1" id="img-gal-tab" data-toggle="tab">
                                <i class="fa fa-picture-o"></i>
                                <span>Gallery</span>
                            </a>
                        </li>
                        <li >
                            <a href="#tab1-3" id="img-gal-tab" data-toggle="tab">
                                <i class="fa fa-tags"></i>
                                <span>Mange Tags</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>                             
                <div class="panel-body" style="height: 400px;overflow-y:auto ">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label">Tag: </label>
                                            <select name="choseTage" class="noSelect">
                                                <option value="0">All</option>
                                                <?php foreach($tags as $tag):?>
                                                    <option value="<?=$tag->id?>"><?=$tag->name?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <?php echo View::make('admin.components.media_gal', array('images'=>$images , "pageTag" => $pageTag)); ?>
                                
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                                    
                                    <div class="image-details" style="background-color: rgb(217, 217, 217); padding: 15px;">
                                        <h3>Image Details</h3>
                                        <div class="attachment-info">
                                            <img src="" class="img-responsive" alt="Image">

                                            <div class="details">
                                                <div class="filename"></div>
                                                <div class="file-size"></div>
                                                <div class="dimensions"></div>

                                                <a class="btn btn-danger" href="#">Delete Permanently</a>
                                            </div>
                                        </div>

                                        <form action="#">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label">URL</label>
                                                    <input class="form-control" name="url" value="" type="text" readonly="readonly">
                                                </div>
                                                <div class="form-group">

                                                    <label class="control-label">Tag</label>
                                                    <select name="tag_id" class="noSelect">
                                                        <option value="0">All</option>
                                                        <?php foreach($tags as $tag):?>
                                                            <option value="<?=$tag->id?>"><?=$tag->name?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Title</label>
                                                    <input class="form-control" name="title" value="" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Caption</label>
                                                    <input class="form-control" name="caption" value="" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Alt Text</label>
                                                    <input class="form-control" name="alt" value="" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Description</label>
                                                    <textarea class="form-control" name="description" rows="5"></textarea>
                                                </div>
                                                <?php if(Request::ajax()):?>
                                                <button class="btn btn-success" id="use-img">Use image</button>
												<?php endif;?>
                                                <button class="btn btn-success" href="#">Save</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>          

                        <div class="tab-pane fade" id="tab1-2">

                            <div class="media-upload">
                            		<!-- Start dropzone js -->
		                            <div class="panel rounded shadow">
		                                <div class="panel-sub-heading">
		                                    <div class="callout callout-info"><h3>Drop files here or click to upload.</h3></div>
		                                </div> <!-- /.panel-subheading -->
		                                <div class="panel-body">
											<div id="dropzone" class="dropzone">
                                        
                                            </div>

		
		                                </div><!-- /.panel-body -->
		                            </div><!-- /.panel -->
		                            <!--/ End dropzone js -->
                            </div>                           
                        </div>
                        <div class="tab-pane fade" id="tab1-3">

                            <div class="media-upload">
                                <!-- Start dropzone js -->
                                <div class="panel rounded shadow">
                                    <div class="panel-body">
                                        <form id='media_tags_form' >
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label">Tag Name</label>
                                                    <input class="form-control" name='tag' value='' type="text">
                                                </div><!-- /.form-group -->

                                            </div>
                                            <div class="form-footer">
                                                <div class="pull-right">

                                                    <button class="btn btn-success" type="submit">Create</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div><!-- /.form-footer -->
                                        </form>
                                        <form id='media_tags_form_delete' >
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label">Tag Name</label>
                                                    <select name="tag" class="noSelect">
                                                        <?php foreach($tags as $tag):?>
                                                        <option value="<?=$tag->id?>"><?=$tag->name?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div><!-- /.form-group -->

                                            </div>
                                            <div class="form-footer">
                                                <div class="pull-right">

                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div><!-- /.form-footer -->
                                        </form>
                                    </div><!-- /.panel-body -->
                                </div><!-- /.panel -->
                                <!--/ End dropzone js -->
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>

        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>