
<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title card-header">รายการแจ้งชำระเงิน </h3>
            <div class="card-body">
                <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                    <thead>
                        <tr>



                            <th>เลขที่</th>
                            <th >ลูกค้า</th>
                            <th style="text-align: center">สถานะ</th>

                            <th >วันที่ </th>
                            <th  style="text-align: center"><?= __('ยกเลิก') ?></th>
                            <th  style="text-align: center"><?= __('รับเงินแล้ว') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $index => $payment): ?>
                            <tr>
                                <td><?= $payment->documentno ?></td>
                                <td><?= h($payment->user->firstname) ?></td>

                                <td style="text-align: center" class="">
                                    <span class="badge badge-<?php
                                    $displaynone = 'text-align: center';
                                    if ($payment->status == 'CO') {
                                        echo 'success';
                                        $displaynone = 'text-align: center;display: none';
                                    } else if ($payment->status == 'VO') {
                                        echo 'warning';
                                        $displaynone = 'text-align: center;display: none';
                                    } else {
                                        echo 'secondary';
                                    }
                                    ?>">
                                              <?= h($docStatusList[$payment->status]['name']) ?>
                                    </span>
                                </td>
                                <?php
                                $date = '';

                                if (!is_null($payment->paymentdate)) {
                                    $date = $payment->paymentdate->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                }
                                ?>

                                <td><?= h($date) ?></td>
                                <td style="text-align: center" >
                                    <?= $this->Form->postLink('<button type="button" class="btn btn-danger waves-effect"><i class=" fa fa-trash-o"></i></button> ', ['action' => 'delete', $payment->id], ['confirm' => __('ท่านต้องการยกเลิกรายการชำระเงิน ใช่ หรือ ไม่ '), 'escape' => false]) ?>

                                </td>
                                <td style="<?= $displaynone ?>" >
                                    <?= $this->Form->postLink('<button type="button" class="btn btn-success waves-effect"><i class=" fa fa-check"></i></button> ', ['action' => 'approve', $payment->id], ['escape' => false, 'label' => false]) ?>


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