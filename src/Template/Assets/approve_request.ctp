
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
                            <th ></th>
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
                                    <?=$this->Html->link('Approve',['controller'=>'assets','action'=>'approve',$asset->id],['class'=>'btn btn-primary waves-effect waves-light'])?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>