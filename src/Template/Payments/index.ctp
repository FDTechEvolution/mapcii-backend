<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title card-header">รายการแจ้งชำระเงิน </h3>

            <div class="card-body">
                <div class="row" style="padding: 0 20px; font-weight: 700;">
                    <div class="col-md-3">Package</div>
                    <div class="col-md-4">ลูกค้า</div>
                    <div class="col-md-2 text-center">วันหมดอายุ</div>
                    <div class="col-md-2 text-center">สถานะ</div>
                    <div class="col-md-1"></div>
                </div>
                <hr>
                <div id="sidebar-menu" style="padding-top: 0;">
                    <ul>
                    <?php foreach ($payments as $index => $payment): ?>
                    <?php $notice = $notificationPayment->getNoificationPayment($payment->id) ?>
                    <li class="has_sub <?php if($notice == 1) { ?>notification-alert<?php } ?>" style="margin: 10px 0;">
                            <a href="javascript:void(0);" class="waves-effect waves-primary left-border">
                                <div class="row">
                                    <?php
                                        $duration = '-';
                                        if (!is_null($payment->duration)) {
                                            $duration = $payment->duration->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                        }
                                    ?>
                                    <div class="col-md-3">
                                        <?= $payment->package->name ?> <br> <span class="payment-second-text">( <?= $payment->package_duration ?> : <?= number_format($payment->package_amount) ?> บาท )</span>
                                    </div>
                                    <div class="col-md-4">
                                        <?= h($payment->user->firstname) ?> <?= h($payment->user->lastname) ?><br>
                                        <span class="payment-second-text-2">( <?= h($payment->user->email) ?> - <?= h($payment->user->phone) ?> )</span>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <?= h($duration) ?>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <span class="badge badge-<?php
                                        $displaynone = 'text-align: center';
                                        if ($payment->status == 'CO') {
                                            echo 'success';
                                            $displaynone = 'text-align: center;display: none';
                                        } else if ($payment->status == 'VO') {
                                            echo 'warning';
                                            $displaynone = 'text-align: center;display: none';
                                        } else if ($payment->status == 'EX') {
                                            echo 'danger';
                                        } else {
                                            echo 'secondary';
                                        }
                                        ?>">
                                              <?= h($docStatusPayment[$payment->status]['name']) ?>
                                        </span>
                                    </div>
                                    <div class="col-md-1"><span class="menu-arrow"></span></div>
                                </div>
                            </a>
                            <ul class="list-unstyled" style="padding: 2%; margin-left: 10px; border-left: 1px solid rgb(59, 175, 218); background-color: #fafeff;">
                                <div class="row" style="padding: 0 20px; font-weight: 700;">
                                    <div class="col-md-3">เลขที่</div>
                                    <div class="col-md-4">รายละเอียด</div>
                                    <div class="col-md-1 text-center">สลิป</div>
                                    <div class="col-md-2 text-center">สถานะ</div>
                                    <div class="col-md-1 text-center">ยกเลิก</div>
                                    <div class="col-md-1 text-center">รับเงิน</div>
                                </div>
                                <hr style="border: 1px solid #333;">
                                <?php foreach ($paymentlines as $index => $paymentline): ?>
                                <li>
                                    <?php if ($payment->id == $paymentline->payment_id) { ?>
                                        <?php
                                            $date = '';
                                            if (!is_null($paymentline->payment_date)) {
                                                $date = $paymentline->payment_date->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                            }
                                        ?>
                                        <div class="row <?php if ($paymentline->status == 'DR') {?> payment-notification <?php } ?>" style="padding: 15px 20px;">
                                            <div class="col-md-3">
                                                <?= $paymentline->documentno ?>
                                            </div>
                                            <div class="col-md-4" style="line-height: 20px;">
                                                วันที่ : <?= h($date) ?><br>
                                                <?= $paymentline->package_name ?> - <?= $paymentline->package_duration ?> : <?= number_format($paymentline->amount) ?> บาท<br>
                                                <span class="payment-second-text-2"><?= h($paymentline->description) ?></span>
                                            </div>
                                            <div class="col-md-1 text-center">
                                                <button class="g-px-0 g-pt-0 g-pb-2 openImageDialog" type="button" data-toggle="modal" data-target="#modalSlip" data-id="<?= $paymentline->image->url ?>"><i class="fa fa-image g-font-size-20"></i></button>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <span class="badge badge-<?php
                                                    $displaynone = 'text-align: center';
                                                        if ($paymentline->status == 'CO') {
                                                            echo 'success';
                                                            $displaynone = 'text-align: center;display: none';
                                                        } else if ($paymentline->status == 'VO') {
                                                            echo 'warning';
                                                            $displaynone = 'text-align: center;display: none';
                                                        } else {
                                                            echo 'secondary';
                                                        }
                                                    ?>">
                                                    <?= h($docStatusList[$paymentline->status]['name']) ?>
                                                </span>
                                            </div>
                                            <div class="col-md-1 text-center">
                                                <?= $this->Form->postLink('<button type="button" class="btn btn-sm btn-danger waves-effect"><i class="fa fa-trash-o" style="margin-right: 3px;"></i></button> ', ['action' => 'delete', $paymentline->id], ['style' => 'padding: 0;', 'confirm' => __('ท่านต้องการยกเลิกรายการชำระเงิน ใช่ หรือ ไม่ '), 'escape' => false]) ?>
                                            </div>
                                            <div class="col-md-1 text-center" style="<?= $displaynone ?>">
                                                <?= $this->Form->postLink('<button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-check" style="margin-right: 3px;"></i></button> ', ['action' => 'approve', $paymentline->id], ['style' => 'padding: 0;', 'escape' => false, 'label' => false]) ?>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php } ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="modalSlip" role="dialog">
                <div class="modal-dialog">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close g-font-size-20 g-color-red"></i></button>
                    </div>
                    <div class="modal-body">
                        <img id="slipImage" class="img-fluid" src="">
                    </div>
                </div>
                
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .payment-second-text {
        font-size: 12px;
        color: #dd0000;
    }
    .payment-second-text-2 {
        font-size: 12px;
        color: #969696;
    }
    #sidebar-menu > ul > li > a.left-border {
        border-left: 3px solid #d5e9ff;
    }
    #sidebar-menu > ul > li > a.left-border:hover {
        background-color: #f5f5f5;
    }
    #sidebar-menu .subdrop {
        border-left: 3px solid #3bafda !important;
    }
    .payment-notification {
        background-color: #ecf5ff;
    }
    .notification-alert:before {
        content: 'N';
        padding: 3px 4px;
        font-size: 10px;
        background-color: #dd0000;
        color: #fff;
        font-weight: 700;
        border-radius: 50px;
        margin-left: -10px;
        margin-top: 1px;
        position: absolute;
        z-index: 99;
    }
</style>

<script>
    let paymentlines = new Vue ({
        data () {
            return {

            }
        },
        methods: {
            loadpaymentline: function (id) {
                axios.get(site_url + 'payments/paymentline?id=' + id)
                .then((response) => {
                    console.log(response)
                })
                .catch(e => {
                    console.log(e)
                })
            }
        }
    })
</script>

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

    $(document).on("click", ".openImageDialog", function () {
        var myImageId = $(this).data('id');
        $(".modal-body #slipImage").attr("src", myImageId);
    });
</script>