<?= ''//$this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title"><strong><i class="ti-receipt"></i> รายการแจ้งชำระเงิน</strong></h4>
            <!-- <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Minton</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol> -->
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="padding: 0 20px; font-weight: 700;">
                    <div class="col-md-2"># หมายเลขใบเสร็จ</div>
                    <div class="col-md-2">ลูกค้า</div>
                    <div class="col-md-1 text-center">รูปแบบ</div>
                    <div class="col-md-1 text-center">หลักฐาน</div>
                    <div class="col-md-2 text-center">วันที่</div>
                    <div class="col-md-2 text-center">สถานะ</div>
                    <div class="col-md-2"></div>
                </div>
                <hr>
                <?php foreach ($payments as $index => $payment): ?>
                    <div class="row" style="padding: 7px 20px;">
                        <div class="col-md-2"><?= h($index + 1) ?>. <?= h($payment->documentno) ?></div>
                        <div class="col-md-2"><?= h($payment->user_package_line->user_package->user->firstname) ?> <?= h($payment->user_package_line->user_package->user->lastname) ?></div>
                        <div class="col-md-1 text-center"><?= h($payment->payment_method) ?></div>
                        <div class="col-md-1 text-center">
                            <button class="openImageDialog" type="button" data-toggle="modal" data-target="#modalSlip" data-id="<?= h($payment->image->url) ?>">
                                <img src="<?= h($payment->image->url) ?>" style="width: 26px; height: 26px; border-radius: 5px;">
                            </button>
                        </div>
                        <div class="col-md-2 text-center"><?= h($payment->modified) ?></div>
                        <div class="col-md-2 text-center">
                            <?php 
                                if($payment->status == 'CK') { ?> <span class="text-warning">รอตรวจสอบ</span> <?php } 
                                if($payment->status == 'CO') { ?> <span class="text-success">เรียบร้อย</span> <?php }
                            ?>
                        </div>
                        <div class="col-md-2">
                            <?php if($payment->status == 'CK') { ?>
                                <?= $this->Html->link(__('<i class="fa fa-check"></i>'), ['action' => 'paymentconfirm', $payment->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?> 
                                <?= $this->Html->link(__('<i class="fa fa-times"></i>'), ['action' => 'delete', $payment->id], ['class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php endforeach ?>
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
    .openImageDialog {
        display: contents;
        cursor: pointer;
    }
</style>


<script>
    $(document).ready(function () {
        $("input[name = 'isactive']").change(function () {
            var id = $(this).attr('id');
            $.get(site_url + "banners/saveactive/", {id: id}).done(function (_data) {
                // console.log(_data);
                alert(_data);
            });
        });
    });

    $(document).on("click", ".openImageDialog", function () {
        var myImageId = $(this).data('id');
        $(".modal-body #slipImage").attr("src", myImageId);
    });
</script>