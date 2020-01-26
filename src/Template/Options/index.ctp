
<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20  ">
            <h3 class="m-t-0 m-b-20 card-header">ส่วนเสริม </h3>
            <div class="col-12 bt-tool" style="text-align: right">
                <?= $this->Html->link(BT_ADD, ['action' => 'add'], ['escape' => false]) ?>
            </div>

            <div class="form-group row ">
              


            </div>
            <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                <thead>
                    <tr>

                        <th >#</th>


                        <th >รายละเอียด</th>

                        <th >ประเภท</th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($options as $index => $option): ?>
                        <tr>
                            <td><?= h($index+1) ?></td>
                            <td><?= h($option->name) ?></td>
                           

                            <td><?= h($type[$option->type]) ?></td>


                            <td style="text-align: right">


                                <?= $this->Html->link(BT_EDIT, ['action' => 'edit', $option->id], ['escape' => false, 'label' => false]) ?>
                                <?= $this->Form->postLink(BT_DELETE, ['action' => 'delete', $option->id], ['confirm' => __('ท่านต้องการลบข้อมูล ใช่ หรือ ไม่ '), 'escape' => false]) ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
