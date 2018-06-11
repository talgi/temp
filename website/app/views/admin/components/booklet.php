
<div class="row">
    <div class="col-md-12">
        <!-- Start table horizontal scroll -->
        <h4 class="mt-0">Booklets</h4>
        <div class="table-responsive mb-20">
            <form>
                <table id="pages-table" class="table table-striped table-teal">
                    <thead>
                    <tr>
                        <th class="text-center border-right">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">View/Edit</th>
                        <th class="text-center">Group</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach ($booklets  as $obj) :?>
                        <tr>
                            <td class="text-center border-right"><?=$obj->id?></td>
                            <td class="text-center border-right">
                                <span><?=$obj->title?></span>
                            </td>

                            <td class="text-center border-right">

                                <a target="_blank" class="btn" href="<?=url(CMS_NAME."/booklets/{$obj->booklets_id}")?>" class="gallery-img">Click here to open</a>

                            </td>

                            <td class="text-center border-right">
                                <select class="select noSelect groups_select" data-id="<?=$obj->id?>">
                                    <option value="0">select page</option>
                                <?php foreach($groups as $key => $val):?>
                                    <option value="<?=$val->id?>" <?=$val->id == $obj->group_id ? "selected" :""?>><?=$val->page_number?></option>
                                <?php endforeach;?>

                                </select>
                            </td>
                        </tr>
                    <?php endforeach;?>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="text-center border-right">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">View/Edit</th>
                        <th class="text-center">Group</th>
                    </tr>
                    </tfoot>
                </table>
            </form>
            </div><!-- /.table-responsive -->
            <!--/ End table horizontal scroll -->
        </div>
    </div>

</div>