
<div class="row">
    <div class="col-md-12">
        <!-- Start table horizontal scroll -->
        <h4 class="mt-0">Tags</h4>
        <div class="table-responsive mb-20">
            <form>
                <table id="pages-table" class="table table-striped table-teal">
                    <thead>
                    <tr>
                        <th class="text-center border-right">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">View/Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach ($tags  as $obj) :?>
                        <tr>
                            <td class="text-center border-right"><?=$obj->id?></td>
                            <td class="text-center border-right">
                                <span><?=$obj->name?></span>
                            </td>

                            <td class="text-center">

                                <a target="_blank" class="btn" href="<?=url(CMS_NAME."/tags/{$obj->category_tags_id}")?>" class="gallery-img">Click here to open</a>

                            </td>


                        </tr>
                    <?php endforeach;?>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="text-center border-right">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">View/Edit</th>

                    </tr>
                    </tfoot>
                </table>
            </form>
        </div><!-- /.table-responsive -->
        <!--/ End table horizontal scroll -->
    </div>
</div>

</div>