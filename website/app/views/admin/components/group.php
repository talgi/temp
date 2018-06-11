<div class='col-mid-3'>
    <form  class="form-horizontal groups_form">
        <input type="text" style="display: none" name="tag_id"  value="<?=$group->tag_id?>">
        <input type="text" style="display: none" name="id"  value="<?=$group->id?>">

        <div class="form-group col-md-6">
            <label class="control-label">Page number</label>
            <input class="form-control rounded" name="page_number" value="<?=$group->page_number?>" type="text">
        </div><!-- /.form-group -->
        <div class="form-group col-md-6">
            <label class="control-label">Reword</label>
            <input class="form-control rounded" name="reword" value="<?=$group->reword?>" type="text">
        </div><!-- /.form-group -->

        <div class="form-footer">
            <div class="pull-right">
                <button class="btn btn-success" type="submit">Save</button>
                <button class="btn btn-danger" data-id='<?=$group->id?>' type="submit">Delete</button>
            </div>
            <div class="clearfix"></div>
        </div><!-- /.form-footer -->
    </form>
</div>