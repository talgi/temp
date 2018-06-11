<div class="col-md-4 prize-item">
    <form class="prize_form">
    <div class="form-body">
        <input type="text" name='id' style="display: none" value="<?=$prize->id?>">
        <div class="col-md-12">
            <label class="control-label"></label>
            <div class="form-group">
                <div class="fileinput fileinput-new" data-provides="fileinput" data-name='image'>
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                        <?=$prize->image ?  "<img src='".url("../uploads/{$prize->image}")."' >"  : ""?>
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
                <textarea rows="5" class="form-control rounded" name="text" style="height: 100px;"><?=$prize->text?></textarea>
            </div>
        </div>
        <div class="form-footer">
            <div class="pull-right">
                <button class="btn btn-success" type="submit">Edit</button>
                <button class="btn btn-danger delete-item" data-deleteid="<?=$prize->id?>" type="">Delete</button>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    </form>
</div>