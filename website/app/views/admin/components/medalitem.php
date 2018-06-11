<div class="col-md-6">
<form class="medal_form" class="form-horizontal">
    <input type="text" name='id' style="display: none" value="<?=$medal->id?>">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">Text</label>
            <input  class="form-control rounded" name="text" value="<?=$medal->text?>" style="height: 100px;"></textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">Notification text</label>
            <textarea  class="form-control " name="notification_text" style="height: 100px;"><?=$medal->notification_text?></textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">Number of views needed to get this medal</label>
            <input  class="form-control rounded" name="views" value="<?=$medal->views?>" >
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">Reword</label>
            <input  class="form-control rounded" name="reword" value="<?=$medal->reword?>" >
        </div>
    </div>
    <div class="form-footer">
        <div class="pull-right">
            <button class="btn btn-success" type="submit">Edit</button>
            <button class="btn btn-danger delete-item" data-deleteid="<?=$medal->id?>" type="">Delete</button>
        </div>
        <div class="clearfix"></div>
    </div>
</form>
</div>