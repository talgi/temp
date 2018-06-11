<?php foreach($cats as $obj):?>
    <div class="col-md-6">
            <div class="gallery-item rounded shadow">
                <img src="<?=url("../uploads/{$obj->logo}")?>" class="img-responsive full-width" alt="...">
                <div class="gallery-details">
                    <div class="gallery-summary">
                        <a href="<?=url(CMS_NAME."/categories/{$obj->category_id}")?>" class="btn btn-primary">Manage <?=$obj->name?></a>
                    </div>
                </div>
            </div><!-- /.gallery-item -->

    </div>
<?php endforeach;?>
