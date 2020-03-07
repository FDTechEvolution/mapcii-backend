<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 ">
            <h3 class="m-t-0 m-b-20  card-header">แพ็คเกจ </h3>
            <div class=" col-12 m-b-20"style="text-align: right">
                <?= $this->Html->link(BT_ADD, ['action' => 'add'], ['escape' => false]) ?>
            </div>

            <div class="form-group row ">
              
            </div>
            <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ชื่อ แพคเกจ</th>
                        <th>ขนาด</th>
                        <th>วันที่</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($packages as $index => $package): ?>
                        <tr>
                            <td><?= h($package->name) ?></td>
                            <td><?= h($package->size->width) ?> x <?= h($package->size->height) ?> px</td>
                            <td><?= h($package->created) ?></td>

                            <td style="text-align: right">
                                <?= $this->Html->link(BT_EDIT, ['action' => 'edit', $package->id], ['escape' => false, 'label' => false]) ?>
                                <?= $this->Form->postLink(BT_DELETE, ['action' => 'delete', $package->id], ['confirm' => __('ท่านต้องการลบข้อมูล ใช่ หรือ ไม่ '), 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
