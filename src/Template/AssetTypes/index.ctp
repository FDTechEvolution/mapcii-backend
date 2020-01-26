
<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <div class=" col-12 m-b-20"style="text-align: right">
                <?= $this->Html->link(BT_ADD, ['action' => 'add',$cate_id], ['escape' => false]) ?>
            </div>

            <div class="form-group row ">
              


            </div>
            <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                <thead>
                    <tr>

                        <th >#</th>


                        <th >ชื่อ</th>

                        <th >วันที่ สร้าง</th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assetTypes as $index => $assetType): ?>
                        <tr>
                            <td><?= h($index+1) ?></td>
                            <td><?= h($assetType->name) ?></td>
                            <?php
                            $date = '';

                            if (!is_null($assetType->created)) {
                                $date = $assetType->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                            }
                            ?>

                            <td><?= h($date) ?></td>


                            <td style="text-align: right">


                                <?= $this->Html->link(BT_EDIT, ['action' => 'edit', $assetType->id], ['escape' => false, 'label' => false]) ?>
                                <?= $this->Form->postLink(BT_DELETE, ['action' => 'delete', $assetType->id], ['confirm' => __('ท่านต้องการลบข้อมูล ใช่ หรือ ไม่ '), 'escape' => false]) ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
