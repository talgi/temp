<div class="col-md-3">
    <form  class="form-horizontal lot_form">
        <input type="text" style="display: none" name='id' value="<?=$cat->lotteries_cat_id?>">
        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
            <label class="control-label">Required points</label>
            <input class="form-control rounded" name="required_points" type="text" value="<?=$cat->required_points?>" style="width: 50%; margin: 0 auto; ">
        </div><!-- /.form-group -->
        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
            <label class="control-label">Number of winners </label>
            <input class="form-control rounded" name="number_of_winners" value="<?=$cat->number_of_winners?>" type="number" style="width: 50%; margin: 0 auto;">
        </div><!-- /.form-group -->
        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
            <label class="control-label">Name</label>
            <input class="form-control rounded" name="name" type="text" value="<?=$cat->name?>" style="width: 50%; margin: 0 auto;">
        </div><!-- /.form-group -->
        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
            <label class="control-label">Text</label>
            <textarea class="form-control rounded" name="text" style="width: 50%; height: 60px; margin: 0 auto;"><?=$cat->text?></textarea>
        </div><!-- /.form-group -->
        <div class="col-md-12" style="margin: 0 auto; text-align: center;">
            <label class="control-label">Image</label>
            <div class="form-group">
                <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image'>
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                        <?=$cat->image ?  "<img src='".url("../uploads/{$cat->image}")."' >"  : ""?>

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
                <a href="<?=url(CMS_NAME."/lotteries-cat/{$cat->lotteries_cat_id}")?>" class="btn btn-primary">Manage lottorie</a>
                <button class="btn btn-success" type="submit">Save</button>
            </div>
            <div class="clearfix"></div>
        </div><!-- /.form-footer -->
    </form>
</div>