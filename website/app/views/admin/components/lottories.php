<div class="col-md-3">
    <form  class="form-horizontal lot_form">
        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
            <label class="control-label">Name</label>
            <input type="text" style="display: none" name="id" value="<?=$lottery->lotteries_id?>">

            <input class="form-control rounded" name="name" value="<?=$lottery->name?>"  type="text" style="width: 70%; margin: 0 auto; text-align: center;">
        </div><!-- /.form-group -->
        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
            <label class="control-label">Start</label>
            <input class="form-control rounded datepicker" name="start" value="<?=$lottery->start?>" type="text" style="width: 70%; margin: 0 auto; text-align: center;" >
        </div><!-- /.form-group -->
        <div class="form-group col-md-12" style="margin: 0 auto; text-align: center;">
            <label class="control-label">End</label>
            <input class="form-control rounded datepicker" name="end" type="text" value="<?=$lottery->end?>" style="width: 70%; margin: 0 auto; text-align: center;" >
            <br>
        </div><!-- /.form-group -->
        <div class="form-footer">
            <div style="margin: 0 auto; text-align: center;">
                <button class="btn btn-success" type="submit">Save</button>
                <?php if(App::isLocal()):?>
                <button class="btn btn-danger" data-id="<?=$lottery->lotteries_id?>" type="submit">Delete</button>
                <?php endif?>
            </div>
            <div class="clearfix"></div>
        </div><!-- /.form-footer -->
    </form>
</div>