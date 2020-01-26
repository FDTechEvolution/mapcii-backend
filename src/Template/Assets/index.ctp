
<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title card-header">รายการอสังหาริมทรัพย์ </h3>
            <div class="card-body">
                <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                    <thead>
                        <tr>



                            <th>รหัส</th>
                            <th >ชื่อ</th>
                            <th>ประเภท</th>

                            <th >วันที่ สร้าง</th>
                            <th >Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assets as $index => $asset): ?>
                            <tr>
                                <td><?= $asset->code ?></td>
                                <td><?= h($asset->name) ?></td>
                                <?php
                                $date = '';

                                if (!is_null($asset->created)) {
                                    $date = $asset->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                }
                                ?>
                                <td><?= h($asset->asset_type->name) ?></td>
                                <td><?= h($date) ?></td>


                                <td>

                                    <div class="checkbox">

                                        <?= $this->Form->checkbox('isactive', ['hiddenField' => 'N', 'id' => $asset->id, 'value' => 'Y', $asset->isactive == 'Y' ? 'checked' : ""]) ?>
                                        <label for="<?= $asset->id ?>"></label>
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
            $.get(site_url + "assets/saveactive/", {id: id}).done(function (_data) {
                console.log(_data);
                 alert(_data);
              

            });
        });
    });
</script>