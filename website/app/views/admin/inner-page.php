
<div class="body-content animated fadeIn">


    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default seo">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Edit: <?=$view->page_name?></h3>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="panel-body no-padding" >

                    <form id='inner_pages_form'>
                        <div class="editor"><?=$view->content?></div>
                        <input name="page_name" value="<?=$view->page_name?>" style="display: none">

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

</div><!-- /.body-content -->
