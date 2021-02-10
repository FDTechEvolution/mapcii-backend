<?= ''//$this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title"><strong><i class="ti-announcement"></i> จัดการประกาศฟรี</strong></h4>
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
                <table class="table table-responsive-lg " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>วันที่ลง</th>
                            <th>รหัส</th>
                            <th>ชื่อผู้ลง</th>
                            <th>หัวข้อ</th>
                            <th class="text-center" width="7%">รูป</th>
                            <th class="text-center" width="10%">ระยะเวลา</th>
                            <th class="text-center">สถานะ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assetFree as $index => $asset): ?>
                            <?php
                                $date = '';
                                if (!is_null($asset->startdate)) {
                                    $date = $asset->startdate->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                }

                                $date_now = date_create(date("Y-m-d"));
                                $startdate = date_create(date_format($asset->startdate, "Y-m-d"));
                                $diff = date_diff($date_now, $startdate);
                            ?>
                            <tr>
                                <td><?= $index +1 ?></td>
                                <td><?= h($date) ?></td>
                                <td><?= h($asset->code) ?></td>
                                <td><?= h($asset->user->firstname) ?></td>
                                <td><?= h($asset->name) ?></td>
                                <td><img src="<?= $assetFreeImage[$index]->image->url ?>" class="rounded w-100"></td>
                                <td class="text-center"><?= h($diff->format('%R%a')) ?> <small>วัน</small></td>
                                <td class="text-center">
                                    <?php 
                                        if($diff->format('%R%a') <= 0){
                                            echo "<small class='badge bg-danger'>หมดอายุ</small>";
                                        }else{
                                            echo "<small class='badge bg-success'>กำลังเผยแพร่</small>";
                                        }
                                    ?></td>
                                <td class="text-center d-flex">
                                    <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#verifyAssetModal" 
                                            data-code="<?= $asset->code ?>" 
                                            data-topic="<?= $asset->name ?>"
                                            data-name="<?= $asset->user->firstname ?>"
                                            data-lname="<?= $asset->user->lastname ?>"
                                            data-startdate="<?= $date ?>"
                                            data-adtype="<?= $asset->type ?>"
                                            data-image="<?= $assetFreeImage[$index]->image->url ?>"
                                            data-order_code="<?= $asset->order_code ?>"
                                            data-price="<?= $asset->price ?>"
                                            data-discount="<?= $asset->discount ?>"
                                            data-rental="<?= $asset->rental ?>"
                                    >ตรวจสอบ</button>
                                    <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#unAssetModal" data-id="<?= $asset->id ?>" data-code="<?= $asset->code ?>" data-topic="<?= $asset->name ?>">ยกเลิก</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($assetFree)): ?>
                            <tr><td colspan="7" class="text-center">ไม่มีรายการประกาศฟรี....</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- ASSET VERIFY ------------------------------->
<div class="modal fade" id="verifyAssetModal" role="dialog">
    <div class="modal-dialog modal-banner modal-dialog-verify-asset">
        <div class="modal-content content-modal-verify-asset">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7 p-content">
                        <p><strong>รหัสประกาศ : </strong> <span id="code"></span></p>
                        <p><strong>หัวข้อ : </strong> <span id="topic"></span></p>
                        <p><strong>ผู้ประกาศ : </strong> <span id="name"></span> <span id="lname"></span></p>
                        <p><strong>ประเภท : </strong> <span id="type"></span> | <strong>วันที่ประกาศ : </strong> <span id="startdate"></span></p>
                        <p><span id="fullprice"></span> <span id="discount"></span> <span id="isDiscount"></span>
                        <p><span id="rental"></span>
                    </div>
                    <div class="col-md-5">
                        <img src="" id="image" class="img-thumbnail w-100">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>

<!-- DELETE ASSET -------------------------------------->
<div class="modal fade" id="unAssetModal" role="dialog">
    <div class="modal-dialog modal-banner">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Assets', 'action'=>'un-asset-free'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_block', 'onsubmit' => 'return reasonToDelete()']) ?>
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4 id="assetContent"></h4>
                <hr class="mt-4 mb-2"/>
                <div class="form-group">
                  <label for="reason_del"><strong>เหตุผลในการยกเลิก <span class="text-danger">*</span></strong></label>
                  <input type="text" name="reason_del" id="reason_del" class="form-control" placeholder="โปรดระบุสาเหตุ" required>
                  <small class="float-right text-warning">สาเหตุในการยกเลิกจะถูกส่งไปเพื่อแจ้งแก่ผู้ลงโฆษณา...</small>
                </div>
                <input type="hidden" name="asset_id" id="asset_id">
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> ยืนยัน'), ['class' => 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#unAssetModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Topic = $(e.relatedTarget).data('topic');
            let Code = $(e.relatedTarget).data('code');
            
            document.getElementById("assetContent").innerHTML = 'ยืนยันการยกเลิกประกาศ<br/><br/> [<span class="text-danger">' + Code + '</span>] : <span class="text-danger">' + Topic + '</span> ?'
            $('#frm_block input[id="asset_id"]').val(Id);
        });


        $('#verifyAssetModal').on('show.bs.modal', function (e) {
            let Topic = $(e.relatedTarget).data('topic');
            let Code = $(e.relatedTarget).data('code');
            let Name = $(e.relatedTarget).data('name');
            let Lname = $(e.relatedTarget).data('lname');
            let startDate = $(e.relatedTarget).data('startdate');
            let Type = $(e.relatedTarget).data('adtype');
            let Image = $(e.relatedTarget).data('image');
            let orderCode = $(e.relatedTarget).data('order_code');
            let price = $(e.relatedTarget).data('price');
            let discount = $(e.relatedTarget).data('discount');
            let rental = $(e.relatedTarget).data('rental');

            let isDiscount = (price !== 0) ? (price - discount) : 0

            document.getElementById('topic').innerHTML = Topic
            document.getElementById('code').innerHTML = Code
            document.getElementById('name').innerHTML = Name
            document.getElementById('lname').innerHTML = Lname
            document.getElementById('startdate').innerHTML = startDate
            document.getElementById('type').innerHTML = Type
            document.getElementById('image').src = Image
            document.getElementById('fullprice').innerHTML = price !== 0 ? '<strong>ราคาขาย : </strong>' + formatNumber(price) + '฿' : ''
            document.getElementById('discount').innerHTML = (discount !== 0 && discount !== '') ? '| <strong>ส่วนลด : </strong>' + formatNumber(discount) + '฿' : ''
            document.getElementById('isDiscount').innerHTML = (discount !== 0 && discount !== '') ? '<br/><strong>คงเหลือ : </strong>' + formatNumber(isDiscount) + '฿' : ''
            document.getElementById('rental').innerHTML = rental != '' ? '<strong>ราคาเช่า : </strong>' + formatNumber(rental) + '฿/เดือน' : ''
        });
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function reasonToDelete() {
        var x = document.forms["frm_block"]["reason_del"].value;
        if (x == "") {
            alert("กรุณาระบุเหตุผลในการยกเลิก...");
            return false;
        }
    }
</script>



<style scope>
    .modal-dialog-verify-asset {
        display: contents;
    }
    .content-modal-verify-asset {
        width: 60%;
        margin-left: 20%;
        margin-top: 3%;
    }
</style>