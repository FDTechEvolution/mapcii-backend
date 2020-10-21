<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="row p-20 pb-10">
                <div class="col-md-12" style="display: flex;">
                    <h3 class="m-t-0 m-b-0">แพ็คเกจ ประกาศ AD</h3>
                    <?= $this->Html->link('<i class=" fa fa-pencil"></i> แก้ไข', ['action' => 'announce-ad-edit'], ['class' => 'btn btn-secondary waves-effect', 'style' => 'margin-left: 20px; padding: 5px 10px;', 'escape' => false]) ?>
                </div>
            </div>

            <div class="row p-20 pt-0">
                <div class="col-md-12">
                    <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>รายการแพคเกจ</th>
                                <th class="text-center">ขนาด</th>
                                <th class="text-center">ราคา / เครดิต</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($packagelines as $index => $packageline): ?>
                                <tr>
                                    <?php if($packageline->package_duration->duration_name == '1 เดือน'): ?>
                                        <td><?= h($packageline->package->name) ?> - <?= h($packageline->package_duration->duration_name) ?> ( <?= h($packageline->package_duration->duration_exp) ?> วัน )</td>
                                        <td class="text-center"><?= h($packageline->size->name) ?></th>
                                        <td class="text-center"><?= number_format(h($packageline->isprice)) ?> ฿ | <?= h($packageline->iscredit) ?> ประกาศ</td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr><td colspan="3"></td></tr>
                            <?php foreach ($packagelines as $index => $packageline): ?>
                                <tr>
                                    <?php if($packageline->package_duration->duration_name == '1 ปี'): ?>
                                        <td><?= h($packageline->package->name) ?> - <?= h($packageline->package_duration->duration_name) ?> ( <?= h($packageline->package_duration->duration_exp) ?> วัน )</td>
                                        <td class="text-center"><?= h($packageline->size->name) ?></th>
                                        <td class="text-center"><?= number_format(h($packageline->isprice)) ?> ฿ | <?= h($packageline->iscredit) ?> ประกาศ</td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
