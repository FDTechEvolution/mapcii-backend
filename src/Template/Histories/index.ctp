<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title"><i class="ti-receipt"></i> ประวัติการจัดการ</h3>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true"><i class="ti-user"></i> สมาชิก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ads-tab" data-toggle="tab" href="#ads" role="tab" aria-controls="ads" aria-selected="true"><i class="ti-star"></i> ประกาศโฆษณา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="free-tab" data-toggle="tab" href="#free" role="tab" aria-controls="free" aria-selected="true"><i class="ti-announcement"></i> ประกาศฟรี</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="banners-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="false"><i class="ti-image"></i> แบนเนอร์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="news" aria-selected="false"><i class="ti-write"></i> บทความ/ข่าว</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="questions-tab" data-toggle="tab" href="#questions" role="tab" aria-controls="questions" aria-selected="false"><i class="ti-comments"></i> ถาม-ตอบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false"><i class="ti-comment-alt"></i> รีวิว</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- USERS ------------------------------------------------>
                    <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center" style="line-height: 16px;">วันที่<br/><small>สมัครสมาชิก</small></th>
                                    <th>หมายเลข</th>
                                    <th>ชื่อ</th>
                                    <th class="text-center">เบอร์ติดต่อ</th>
                                    <th class="text-center">LINE ID</th>
                                    <th class="text-center" width="5%">รูป</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $index => $user): ?>
                                <?php 
                                    $ex_date = explode(',',$user->created);
                                    $regisDate = date_format(date_create($ex_date[0]),'d-m-Y');
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $index + 1 ?></td>
                                        <td class="text-center"><?= $regisDate ?></td>
                                        <td><?= $user->usercode ?></td>
                                        <td><?= $user->firstname ?></td>
                                        <td class="text-center"><?= $user->phone ?></td>
                                        <td class="text-center"><a href="https://line.me/ti/p/~<?= $user->lineid ?>" target="_blank" class="text-dark"><?= $user->lineid ?></td>
                                        <td class="text-center"><img src="<?= $user->image != null ? $user->image->url : '' ?>" class="w-100"></td>
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
                                        <td class="text-center d-flex">
                                            <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#verifyMemberModal" 
                                                data-id="<?= $user->id ?>"
                                                data-code="<?= $user->usercode ?>"
                                                data-name="<?= $user->firstname ?>"
                                                data-lname="<?= $user->lastname ?>"
                                                data-phone="<?= $user->phone ?>"
                                                data-lineid="<?= $user->lineid ?>"
                                                data-email="<?= $user->email ?>"
                                                data-facebook="<?= $user->facebook ?>"
                                                data-image="<?= $user->image != null ? $user->image->url : null ?>"
                                                data-regisdate="<?= $regisDate ?>"
                                            >ตรวจสอบ</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <?php if(empty($users)): ?>
                                    <tr><td colspan="9" class="text-center">ไม่มีรายการยกเลิกสมาชิก....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ADS ------------------------------------------------>
                    <div class="tab-pane fade" id="ads" role="tabpanel" aria-labelledby="ads-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
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
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
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
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($ads)): ?>
                                    <tr><td colspan="9" class="text-center">ไม่มีรายการยกเลิกประกาศโฆษณา....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- FREE ------------------------------------------------>
                    <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>วันที่ลง</th>
                                    <th>รหัส</th>
                                    <th>ชื่อผู้ลง</th>
                                    <th class="text-center" width="7%">รูป</th>
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
                                    ?>
                                    <tr>
                                        <td><?= $index +1 ?></td>
                                        <td><?= h($date) ?></td>
                                        <td><?= h($asset->code) ?></td>
                                        <td><?= h($asset->name) ?></td>
                                        <td><img src="<?= $assetFreeImage[$index]->image->url ?>" class="rounded w-100"></td>
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
                                        <td class="text-center d-flex">
                                            <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#verifyAssetAdsModal" 
                                                    data-code="<?= $asset->code ?>" 
                                                    data-topic="<?= $asset->topic ?>"
                                                    data-name="<?= $asset->name ?>"
                                                    data-lname="<?= $asset->lname ?>"
                                                    data-startdate="<?= $date ?>"
                                                    data-adtype="<?= $asset->type ?>"
                                                    data-image="<?= $assetFreeImage[$index]->image->url ?>"
                                                    data-order_code="<?= $asset->order_code ?>"
                                                    data-price="<?= $asset->price ?>"
                                                    data-discount="<?= $asset->discount ?>"
                                                    data-rental="<?= $asset->rental ?>"
                                            >ตรวจสอบ</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($assetFree)): ?>
                                    <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกประกาศฟรี....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Banner --------------------------------------->
                    <div class="tab-pane fade" id="banners" role="tabpanel" aria-labelledby="banners-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>วันที่ลง</th>
                                    <th>ชื่อผู้ลง</th>
                                    <th>ประเภท</th>
                                    <th>หัวข้อ</th>
                                    <th class="text-center" width="7%">รูป</th>
                                    <th class="text-center">สถานะ</th>
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
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
                                    </tr>
                                <?php endforeach ?>
                                <?php if(empty($banners)): ?>
                                    <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกแบนเนอร์....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- NEWS ------------------------------------------------>
                    <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
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
                                
                            </tbody>
                        </table>
                    </div>

                    <!-- QUESTIONS ------------------------------------------------>
                    <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="questions-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
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
                                
                            </tbody>
                        </table>
                    </div>

                    <!-- REVIEW ------------------------------------------------>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
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
                                
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- SHOW IMAGE =========================-->
<div class="modal fade" id="imageModal" role="dialog">
    <div class="modal-dialog modal-image">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="" id="imgModalContent" class="rounted w-100">
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('#imageModal').on('show.bs.modal', function (e) {
            let Image = $(e.relatedTarget).data('image');
            
            document.getElementById('imgModalContent').src = Image
        });
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>

<style scope>
    .small-60 {
        font-size: 60%;
    }
</style>