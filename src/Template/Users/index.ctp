
<?= $this->element('Lib/data_table') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            

            <div class="form-group row ">
                <div class="col-md-6 ">
                    <h2 class="prompt-400 "><i class="fa fa-address-card"></i> รายชื่อสมาชิก</h2>
                </div>


            </div>
            <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                <thead>
                    <tr>

                        <th scope="col">Name</th>


                      

                        <th scope="col"style="text-align: center">Status</th>
                        <th  style="text-align: center"><?= __('เครื่องมือ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>

                            <td><?= h($user->firstname) ?></td>


                           

                            <td style="text-align: center"><?= $user->isactive == 'Y' ? ACTIVE : INACTIVE ?></td>
                            <td style="text-align: center" >
                                <?= $this->Html->link(BT_EDIT, ['action' => 'edit', $user->id], ['escape' => false, 'label' => false]) ?>
                                <?= $this->Form->postLink(BT_DELETE, ['action' => 'delete', $user->id], ['confirm' => __('ท่านต้องการลบข้อมูล ใช่ หรือ ไม่ '), 'escape' => false]) ?>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
