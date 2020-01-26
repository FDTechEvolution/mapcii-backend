
<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title card-header">รายการ Banner </h3>
            <div class="card-body">
                <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                    <thead>
                        <tr>



                            <th>ประเภท</th>
                            <th >ลูกค้า</th>
                            <th>ตำแหน่ง</th>

                            <th >วันที่ สร้าง</th>
                            <th >Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banners as $index => $banner): ?>
                            <tr>
                                <td><?= $banner->type ?></td>
                                <td><?= h($banner->user->firstname) ?></td>
                                <td><?= h($banner->position) ?></td>
                                <?php
                                $date = '';

                                if (!is_null($banner->created)) {
                                    $date = $banner->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                }
                                ?>
                                
                                <td><?= h($date) ?></td>


                                <td>

                                    <div class="checkbox">

                                        <?= $this->Form->checkbox('isactive', ['hiddenField' => 'N', 'id' => $banner->id, 'value' => 'Y', $banner->isactive == 'Y' ? 'checked' : ""]) ?>
                                        <label for="<?= $banner->id ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $("input[name = 'isactive']").change(function () {
            var id = $(this).attr('id');
            $.get(site_url + "banners/saveactive/", {id: id}).done(function (_data) {
                console.log(_data);
                 alert(_data);
              

            });
        });
    });
</script>