<?= ''//$this->element('Lib/data_table') ?>
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

                        <!-- VERIFY MEMBER -------------------------------------->
                        <div class="modal fade" id="verifyMemberModal" role="dialog">
                            <div class="modal-dialog modal-banner modal-dialog-verify-member">
                                <div class="modal-content content-modal-verify-member">
                                    <div class="modal-header">
                                        <h3 class="modal-title"><i class="fa fa-address-card"></i> รายละเอียดสมาชิก</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8 px-3 py-1 p-content">
                                                <p><strong>รหัสสมาชิก :</strong> <span id="usercode"></span></p>
                                                <p><strong>ชื่อ-สกุล :</strong> <span id="firstname"></span> <span id="lastname"></span></p>
                                                <p><strong>โทรศัพท์ :</strong> <span id="phone"></span></p>
                                                <p><strong>Email :</strong> <span id="email"></span></p>
                                                <p><strong>LINE :</strong> <a href="" id="linklineid" target="_blank"><span id="lineid"></span></a></p>
                                                <p><strong>Facebook :</strong> <a href="" id="linkfacebook" target="_blank"><span id="facebook"></span></a></p>
                                                <p><strong>วันที่สมัครสมาชิก :</strong> <span id="regisdate"></span></p>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <img src="" id="image_user" class="img-thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ================================================= -->
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
                                                    data-reason="<?= $ad->reason_del ?>"
                                            >ตรวจสอบ</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($ads)): ?>
                                    <tr><td colspan="9" class="text-center">ไม่มีรายการยกเลิกประกาศโฆษณา....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>

                        <!-- ADS VERIFY ------------------------------->
                        <div class="modal fade" id="verifyAssetAdsModal" role="dialog">
                            <div class="modal-dialog modal-banner modal-dialog-verify-ads">
                                <div class="modal-content content-modal-verify-ads">
                                    <div class="modal-header">
                                        <h4><strong style="color: #000;">เหตุผลที่ถูกยกเลิก : </strong><strong class="text-danger"><span id="ads_reason_del"></span></strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-7 p-content">
                                                <p><strong>รหัสประกาศ : </strong> <span id="ads_code"></span></p>
                                                <p><strong>หัวข้อ : </strong> <span id="ads_topic"></span></p>
                                                <p><strong>ผู้ประกาศ : </strong> <span id="ads_name"></span> <span id="ads_lname"></span></p>
                                                <p><strong>ประเภท : </strong> <span id="ads_type"></span> | <strong>วันที่ประกาศ : </strong> <span id="ads_startdate"></span></p>
                                                <p><strong>รหัสแพ็คเกจ : </strong> <span id="ads_order_code"></span>
                                                <p><span id="ads_fullprice"></span> <span id="ads_discount"></span> <span id="ads_isDiscount"></span>
                                                <p><span id="ads_rental"></span>
                                            </div>
                                            <div class="col-md-5">
                                                <img src="" id="ads_image" class="img-thumbnail w-100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- =================================================== -->
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
                                    <th>หัวข้อ</th>
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
                                        <td><?= h($asset->user->firstname) ?> </td>
                                        <td><?= h($asset->name) ?></td>
                                        <td><img src="<?= $assetFreeImage[$index]->image->url ?>" class="rounded w-100"></td>
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
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
                                                    data-reason="<?= $asset->reason_del ?>"
                                            >ตรวจสอบ</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($assetFree)): ?>
                                    <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกประกาศฟรี....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>

                        <!-- FREE VERIFY ------------------------------->
                        <div class="modal fade" id="verifyAssetModal" role="dialog">
                            <div class="modal-dialog modal-banner modal-dialog-verify-asset">
                                <div class="modal-content content-modal-verify-asset">
                                    <div class="modal-header">
                                        <h4><strong style="color: #000;">เหตุผลที่ถูกยกเลิก : </strong><strong class="text-danger"><span id="free_reason_del"></span></strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-7 p-content">
                                                <p><strong>รหัสประกาศ : </strong> <span id="free_code"></span></p>
                                                <p><strong>หัวข้อ : </strong> <span id="free_topic"></span></p>
                                                <p><strong>ผู้ประกาศ : </strong> <span id="free_name"></span> <span id="free_lname"></span></p>
                                                <p><strong>ประเภท : </strong> <span id="free_type"></span> | <strong>วันที่ประกาศ : </strong> <span id="free_startdate"></span></p>
                                                <p><span id="free_fullprice"></span> <span id="free_discount"></span> <span id="free_isDiscount"></span>
                                                <p><span id="free_rental"></span>
                                            </div>
                                            <div class="col-md-5">
                                                <img src="" id="free_image" class="img-thumbnail w-100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- =========================================== -->
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
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
                                        <td class="text-center d-flex">
                                            <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#verifyBannerModal" 
                                                    data-topic="<?= $banner->topic ?>"
                                                    data-image="<?= $banner->image ?>"
                                                    data-order_code="<?= $banner->order_code ?>"
                                                    data-reason="<?= $banner->reason_del ?>"
                                            >ตรวจสอบ</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <?php if(empty($banners)): ?>
                                    <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกแบนเนอร์....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>

                        <!-- BANNER VERIFY ------------------------------->
                        <div class="modal fade" id="verifyBannerModal" role="dialog">
                            <div class="modal-dialog modal-banner modal-dialog-verify-banner">
                                <div class="modal-content content-modal-verify-banner">
                                    <div class="modal-header">
                                        <h4><strong style="color: #000;">เหตุผลที่ถูกยกเลิก : </strong><strong class="text-danger"><span id="banner_reason_del"></span></strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 p-content text-center">
                                                <p class="mb-2"><strong>หัวข้อ : </strong> <span id="banner_topic"></span></p>
                                                <p><strong>เลขแพ็คเกจ : </strong> <span id="banner_code"></span></p>
                                                <img src="" id="banner_image" class="img-thumbnail w-100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- =========================================== -->
                    </div>

                    <!-- ARTICLES / NEWS ------------------------------------------------>
                    <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>วันที่ลง</th>
                                    <th class="text-center">ผู้ประกาศ</th>
                                    <th>หัวข้อ</th>
                                    <th>รายละเอียด</th>
                                    <th class="text-center" width="7%">รูป</th>
                                    <th class="text-center">สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($articles as $index => $article): ?>
                                    <?php
                                        $date = '';
                                        if (!is_null($article->created)) {
                                            $date = $article->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $index +1 ?></td>
                                        <td><?= h($date) ?></td>
                                        <td><?= h($article->user->firstname) ?></td>
                                        <td><?= h($article->title) ?></td>
                                        <td><?= h($article->short_content) ?></td>
                                        <td><a href="#" data-toggle="modal" data-target="#imageModal" data-image="<?= $article->image->url ?>"><img src="<?= $article->image->url ?>" class="rounded w-100"></a></td>
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
                                        <td class="actions">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#verifyArticleModal" 
                                                data-topic="<?= h($article->title) ?>"
                                                data-name="<?= h($article->user->firstname) ?>"
                                                data-content="<?= h($article->content) ?>"
                                                data-image="<?= h($article->image->url) ?>"
                                            >ตรวจสอบ</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <?php if(empty($articles)): ?>
                                    <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกบทความ/ข่าวสาร....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>

                        <!-- VERIFY ARTICLE / NEWS -------------------------------------->
                        <div class="modal fade" id="verifyArticleModal" role="dialog">
                            <div class="modal-dialog modal-article-verify">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <strong><p id="articleTitle" class="mb-0"></p></strong>
                                        <p id="articleWrite"></p>
                                        <img src="" id="articleImage" class="w-100">
                                        <span id="articleContent"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- QUESTIONS ------------------------------------------------>
                    <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="questions-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>วันที่</th>
                                    <th>ผู้ถาม</th>
                                    <th>รายละเอียด</th>
                                    <th>จากหัวข้อ</th>
                                    <th class="text-center">สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($contacts as $index => $contact): ?>
                                    <?php
                                        $date = '';
                                        if (!is_null($contact->created)) {
                                            $date = $contact->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $index +1 ?></td>
                                        <td><?= h($date) ?></td>
                                        <td><?= h($usercontacts[$index]->firstname) ?></td>
                                        <td><?= h($contact->msg) ?></td>
                                        <td><?= h($contact->asset->name) ?></td>
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
                                    </tr>
                                <?php endforeach ?>
                                <?php if(empty($contacts)): ?>
                                    <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกคำถาม....</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- REVIEW ------------------------------------------------>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <table class="table table-responsive-lg " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>วันที่</th>
                                    <th>ผู้ถาม</th>
                                    <th>รายละเอียด</th>
                                    <th>จากหัวข้อ</th>
                                    <th class="text-center">สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reviews as $index => $review): ?>
                                    <?php
                                        $date = '';
                                        if (!is_null($review->created)) {
                                            $date = $review->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $index +1 ?></td>
                                        <td><?= h($date) ?></td>
                                        <td><?= h($userreviews[$index]->firstname) ?></td>
                                        <td><?= h($review->msg) ?></td>
                                        <td><?= h($review->asset->name) ?></td>
                                        <td class="text-center"><small class='badge bg-dark'>ยกเลิกแล้ว</small></td>
                                    </tr>
                                <?php endforeach ?>
                                <?php if(empty($reviews)): ?>
                                    <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกรีวิว....</td></tr>
                                <?php endif ?>
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


<style scope>
    .modal-dialog-verify-member, .modal-dialog-verify-ads {
        display: contents;
    }
    .content-modal-verify-member, .content-modal-verify-ads {
        width: 50%;
        margin-left: 25%;
        margin-top: 3%;
    }
    .modal-dialog.modal-article-verify {
        display: contents;
    }
    .modal-dialog.modal-article-verify .modal-content {
        width: 60%;
        margin-left: 20%;
        margin-top: 3%;
        margin-bottom: 3%;
    }
</style>

<script>
    $(document).ready(function () {
        $('#verifyMemberModal').on('show.bs.modal', function (e) { // MEMBER
            let Id = $(e.relatedTarget).data('id');
            let code = $(e.relatedTarget).data('code');
            let name = $(e.relatedTarget).data('name');
            let lname = $(e.relatedTarget).data('lname');
            let phone = $(e.relatedTarget).data('phone');
            let lineid = $(e.relatedTarget).data('lineid');
            let facebook = $(e.relatedTarget).data('facebook');
            let email = $(e.relatedTarget).data('email');
            let image = $(e.relatedTarget).data('image');
            let regisdate = $(e.relatedTarget).data('regisdate');

            document.getElementById("usercode").innerHTML = code
            document.getElementById("firstname").innerHTML = name
            document.getElementById("lastname").innerHTML = lname
            document.getElementById("phone").innerHTML = phone !== '' ? phone : '-'
            document.getElementById("email").innerHTML = email !== '' ? email : '-'
            document.getElementById("lineid").innerHTML = lineid !== '' ? lineid : '-'
            document.getElementById("facebook").innerHTML = facebook !== '' ? facebook : '-'
            document.getElementById("image_user").src = image !== null ? image : '-'
            document.getElementById("regisdate").innerHTML = regisdate
            document.getElementById("linklineid").href = 'https://line.me/ti/p/~' + lineid
            document.getElementById("linkfacebook").href = facebook
        });


        $('#verifyAssetAdsModal').on('show.bs.modal', function (e) { // ADS
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
            let reason = $(e.relatedTarget).data('reason')

            let isDiscount = (price !== 0) ? (price - discount) : 0

            document.getElementById('ads_topic').innerHTML = Topic
            document.getElementById('ads_code').innerHTML = Code
            document.getElementById('ads_name').innerHTML = Name
            document.getElementById('ads_lname').innerHTML = Lname
            document.getElementById('ads_startdate').innerHTML = startDate
            document.getElementById('ads_type').innerHTML = Type
            document.getElementById('ads_image').src = Image
            document.getElementById('ads_order_code').innerHTML = orderCode
            document.getElementById('ads_fullprice').innerHTML = price !== 0 ? '<strong>ราคาขาย : </strong>' + formatNumber(price) + '฿' : ''
            document.getElementById('ads_discount').innerHTML = discount !== 0 ? '| <strong>ส่วนลด : </strong>' + formatNumber(discount) + '฿' : ''
            document.getElementById('ads_isDiscount').innerHTML = discount !== 0 ? '<br/><strong>คงเหลือ : </strong>' + formatNumber(isDiscount) + '฿' : ''
            document.getElementById('ads_rental').innerHTML = rental != '' ? '<strong>ราคาเช่า : </strong>' + formatNumber(rental) + '฿/เดือน' : ''
            document.getElementById('ads_reason_del').innerHTML = reason
        });


        $('#verifyAssetModal').on('show.bs.modal', function (e) { // FREE
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
            let reason = $(e.relatedTarget).data('reason');

            let isDiscount = (price !== 0) ? (price - discount) : 0

            document.getElementById('free_topic').innerHTML = Topic
            document.getElementById('free_code').innerHTML = Code
            document.getElementById('free_name').innerHTML = Name
            document.getElementById('free_lname').innerHTML = Lname
            document.getElementById('free_startdate').innerHTML = startDate
            document.getElementById('free_type').innerHTML = Type
            document.getElementById('free_image').src = Image
            document.getElementById('free_fullprice').innerHTML = price !== 0 ? '<strong>ราคาขาย : </strong>' + formatNumber(price) + '฿' : ''
            document.getElementById('free_discount').innerHTML = (discount !== 0 && discount !== '') ? '| <strong>ส่วนลด : </strong>' + formatNumber(discount) + '฿' : ''
            document.getElementById('free_isDiscount').innerHTML = (discount !== 0 && discount !== '') ? '<br/><strong>คงเหลือ : </strong>' + formatNumber(isDiscount) + '฿' : ''
            document.getElementById('free_rental').innerHTML = rental != '' ? '<strong>ราคาเช่า : </strong>' + formatNumber(rental) + '฿/เดือน' : ''
            document.getElementById('free_reason_del').innerHTML = reason
        });


        $('#verifyBannerModal').on('show.bs.modal', function (e) { // BANNER
            let Topic = $(e.relatedTarget).data('topic');
            let Image = $(e.relatedTarget).data('image');
            let orderCode = $(e.relatedTarget).data('order_code');
            let reason = $(e.relatedTarget).data('reason');

            document.getElementById('banner_topic').innerHTML = Topic
            document.getElementById('banner_code').innerHTML = orderCode
            document.getElementById('banner_image').src = Image
            document.getElementById('banner_reason_del').innerHTML = reason
        });


        $('#verifyArticleModal').on('show.bs.modal', function (e) { // ARTICLE
            let Title = $(e.relatedTarget).data('topic');
            let Name = $(e.relatedTarget).data('name');
            let Content = $(e.relatedTarget).data('content');
            let Image = $(e.relatedTarget).data('image');
            
            document.getElementById("articleTitle").innerHTML = Title
            document.getElementById("articleWrite").innerHTML = 'โดย : ' + Name
            document.getElementById("articleImage").src = Image
            document.getElementById("articleContent").innerHTML = Content
        });


        $('#imageModal').on('show.bs.modal', function (e) {
            let Image = $(e.relatedTarget).data('image');
            
            document.getElementById('imgModalContent').src = Image
        });
    });

    // function formatNumber(num) {
    //     return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    // }

    // Arrow function -> functionName = () => { ...someting to return }
    const formatNumber = (num) => num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

    // Chain function test
    var add = function(a){
        return (b) => a + b
    }
    var add2 = add(2);
    var ans = add2(3);

    // console.log(this)
</script>

<style scope>
    .small-60 {
        font-size: 60%;
    }
    .modal-dialog-verify-asset {
        display: contents;
    }
    .content-modal-verify-asset {
        width: 60%;
        margin-left: 20%;
        margin-top: 3%;
    }
</style>