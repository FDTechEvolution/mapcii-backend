
<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title"><i class="ti-crown"></i> รายการโฆษณา</h3>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="ads-tab" data-toggle="tab" href="#ads" role="tab" aria-controls="ads" aria-selected="true"><i class="ti-announcement"></i> ประกาศ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="banners-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="false"><i class="ti-image"></i> แบนเนอร์</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- ADS ------------------------------------------------>
                    <div class="tab-pane fade show active" id="ads" role="tabpanel" aria-labelledby="ads-tab">
                        <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>วันที่ลง</th>
                                    <th>รหัส</th>
                                    <th>ชื่อผู้ลง</th>
                                    <th>ประเภท</th>
                                    <th>หัวข้อ</th>
                                    <th class="text-center" width="7%">รูป</th>
                                    <th class="text-center">สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ads as $index => $ad): ?>
                                    <?php
                                        $date = '';
                                        if (!is_null($ad->startdate)) {
                                            $date = $ad->startdate->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $index +1 ?></td>
                                        <td><?= h($date) ?></td>
                                        <td><?= h($ad->code) ?></td>
                                        <td><?= h($ad->name) ?></td>
                                        <td><?= h($ad->type) ?></td>
                                        <td><?= h($ad->topic) ?><br/><small class="small-60"><strong>Package : </strong><?= h($ad->order_code) ?></small></td>
                                        <td><img src="<?= $assetImage[$index]->image->url ?>" class="rounded w-100"></td>
                                        <td class="text-center"><?= $userpackage[$index]->duration_name ?></td>
                                        <td class="text-center d-flex">
                                            <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#verifyAssetAdsModal" 
                                                    data-code="<?= $ad->code ?>" 
                                                    data-topic="<?= $ad->topic ?>"
                                                    data-name="<?= $ad->name ?>"
                                                    data-lname="<?= $ad->lname ?>"
                                                    data-startdate="<?= $date ?>"
                                                    data-adtype="<?= $ad->type ?>"
                                                    data-image="<?= $assetImage[$index]->image->url ?>"
                                                    data-order_code="<?= $ad->order_code ?>"
                                                    data-price="<?= $ad->price ?>"
                                                    data-discount="<?= $ad->discount ?>"
                                                    data-rental="<?= $ad->rental ?>"
                                            >ตรวจสอบ</button>
                                            <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#unAssetAdsModal" data-id="<?= $ad->id ?>" data-code="<?= $ad->code ?>" data-topic="<?= $ad->topic ?>">ยกเลิก</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Banner --------------------------------------->
                    <div class="tab-pane fade" id="banners" role="tabpanel" aria-labelledby="banners-tab">
                        <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>วันที่ลง</th>
                                    <th>ชื่อผู้ลง</th>
                                    <th>ประเภท</th>
                                    <th>หัวข้อ</th>
                                    <th class="text-center" width="7%">รูป</th>
                                    <th class="text-center">สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($banners as $bindex => $banner): ?>
                                    <?php
                                        $bdate = '';
                                        if (!is_null($banner->startdate)) {
                                            $bdate = $banner->startdate->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $bindex +1 ?></td>
                                        <td><?= h($bdate) ?></td>
                                        <td><?= h($banner->name) ?></td>
                                        <td><?= h($banner->type) ?></td>
                                        <td><?= h($banner->topic) ?><br/><small class="small-60"><strong>Package : </strong><?= h($banner->order_code) ?></small></td>
                                        <td><a href="#" data-toggle="modal" data-target="#imageModal" data-image="<?= $banner->image ?>"><img src="<?= $banner->image ?>" class="rounded w-100"></a></td>
                                        <td class="text-center"><?= $user_banner_package[$bindex]->duration_name ?></td>
                                        <td class="text-center d-flex">
                                            <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#unBannerAdsModal" data-id="<?= $banner->id ?>" data-banner="<?= $banner->image ?>" data-topic="<?= $banner->topic ?>">ยกเลิก</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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
</div>


<!-- ASSET DESCRIPTION ------------------------------->
<div class="modal fade" id="verifyAssetAdsModal" role="dialog">
    <div class="modal-dialog modal-banner modal-dialog-verify-ads">
        <div class="modal-content content-modal-verify-ads">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7 p-content">
                        <p><strong>รหัสประกาศ : </strong> <span id="code"></span></p>
                        <p><strong>หัวข้อ : </strong> <span id="topic"></span></p>
                        <p><strong>ผู้ประกาศ : </strong> <span id="name"></span> <span id="lname"></span></p>
                        <p><strong>ประเภท : </strong> <span id="type"></span> | <strong>วันที่ประกาศ : </strong> <span id="startdate"></span></p>
                        <p><strong>รหัสแพ็คเกจ : </strong> <span id="order_code"></span>
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
<div class="modal fade" id="unAssetAdsModal" role="dialog">
    <div class="modal-dialog modal-banner">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Assets', 'action'=>'un-asset-ads'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_block', 'onsubmit' => 'return reasonToDelete()']) ?>
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4 id="assetAdsContent"></h4>
                <hr class="mt-4 mb-2"/>
                <div class="form-group">
                  <label for="del_reason"><strong>เหตุผลในการยกเลิก <span class="text-danger">*</span></strong></label>
                  <input type="text" name="del_reason" id="del_reason" class="form-control" placeholder="โปรดระบุสาเหตุ">
                  <small class="float-right text-warning">สาเหตุในการยกเลิกจะถูกส่งไปเพื่อแจ้งแก่ผู้ลงโฆษณา...</small>
                </div>
                <input type="hidden" name="ads_id" id="ads_id">
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> ยืนยัน'), ['class' => 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>


<!-- DELETE BANNER ---------------------------------->
<div class="modal fade" id="unBannerAdsModal" role="dialog">
    <div class="modal-dialog modal-banner">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Assets', 'action'=>'un-banner-ads'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_block', 'onsubmit' => 'return reasonToDelete()']) ?>
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 id="bannerAdsContent"></h5>
                <img src="" id="bannerImage" class="w-100">
                <hr class="mt-4 mb-2"/>
                <div class="form-group">
                  <label for="del_reason"><strong>เหตุผลในการยกเลิก <span class="text-danger">*</span></strong></label>
                  <input type="text" name="del_reason" id="del_reason" class="form-control" placeholder="โปรดระบุสาเหตุ">
                  <small class="float-right text-warning">สาเหตุในการยกเลิกจะถูกส่งไปเพื่อแจ้งแก่ผู้ลงโฆษณา...</small>
                </div>
                <input type="hidden" name="banner_id" id="banner_id">
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> ยืนยัน'), ['class' => 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>


<!-- SHOW BANNER IMG =========================-->
<div class="modal fade" id="imageModal" role="dialog">
    <div class="modal-dialog modal-image">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="" id="imgModalContent" class="rounted w-100">
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ปิด'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('#unAssetAdsModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Topic = $(e.relatedTarget).data('topic');
            let Code = $(e.relatedTarget).data('code');
            
            document.getElementById("assetAdsContent").innerHTML = 'ยืนยันการยกเลิกประกาศโฆษณา<br/><br/> [<span class="text-danger">' + Code + '</span>] : <span class="text-danger">' + Topic + '</span> ?'
            $('#frm_block input[id="ads_id"]').val(Id);
        });

        $('#unBannerAdsModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Topic = $(e.relatedTarget).data('topic');
            let Image = $(e.relatedTarget).data('banner');
            
            document.getElementById("bannerAdsContent").innerHTML = 'ยืนยันการยกเลิกแบนเนอร์โฆษณา<br/><br/> <span class="text-danger">' + Topic + '</span> ?'
            document.getElementById("bannerImage").src = Image
            $('#frm_block input[id="banner_id"]').val(Id);
        });

        $('#verifyAssetAdsModal').on('show.bs.modal', function (e) {
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
            document.getElementById('order_code').innerHTML = orderCode
            document.getElementById('fullprice').innerHTML = price !== 0 ? '<strong>ราคาขาย : </strong>' + formatNumber(price) + '฿' : ''
            document.getElementById('discount').innerHTML = discount !== 0 ? '| <strong>ส่วนลด : </strong>' + formatNumber(discount) + '฿' : ''
            document.getElementById('isDiscount').innerHTML = discount !== 0 ? '<br/><strong>คงเหลือ : </strong>' + formatNumber(isDiscount) + '฿' : ''
            document.getElementById('rental').innerHTML = rental != '' ? '<strong>ราคาเช่า : </strong>' + formatNumber(rental) + '฿/เดือน' : ''
        });

        $('#imageModal').on('show.bs.modal', function (e) {
            let Image = $(e.relatedTarget).data('image');
            
            document.getElementById('imgModalContent').src = Image
        });
    });

    function reasonToDelete() {
        var x = document.forms["frm_block"]["del_reason"].value;
        if (x == "") {
            alert("กรุณาระบุเหตุผลในการยกเลิก...");
            return false;
        }
    }

    function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
</script>

<style scope>
    .modal-dialog-verify-ads {
        display: contents;
    }
    .content-modal-verify-ads {
        width: 40%;
        margin-left: 30%;
        margin-top: 3%;
    }
    .p-content p {
        margin-bottom: 8px;
    }
    .small-60 {
        font-size: 60%;
    }
</style>