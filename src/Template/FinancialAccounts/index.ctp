<?= ''//$this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title"><strong><i class="ti-receipt"></i> วิธีการชำระเงิน</strong></h4>
            <!-- <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Minton</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol> -->
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div id="financial" class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class=" col-12 my-2"style="text-align: right">
                <?= $this->Html->link(BT_ADD, ['action' => 'add'], ['escape' => false]) ?>
            </div>
            <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">ชื่อบัญชี</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">เลขบัญชี</th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($financialAccounts as $financialAccount): ?>
                    <tr>
                        <td><?= h($financialAccount->name) ?></td>
                        <td><?= h($financialAccount->type) ?></td>
                        <td><?= h($financialAccount->accountno) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(BT_EDIT, ['action' => 'edit', $financialAccount->id], ['escape' => false, 'label' => false]) ?>
                            <?= $this->Form->postLink(BT_DELETE, ['action' => 'delete', $financialAccount->id], ['confirm' => __('ท่านต้องการลบข้อมูล ใช่ หรือ ไม่ '), 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
