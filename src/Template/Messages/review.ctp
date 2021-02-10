<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title"><strong><i class="ti-comment-alt"></i> จัดการรีวิว</strong></h4>
            <!-- <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Minton</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol> -->
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <table class="table table-responsive-lg " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>วันที่</th>
                        <th>ผู้ถาม</th>
                        <th>รายละเอียด</th>
                        <th>จากหัวข้อ</th>
                        <th class="text-center">สถานะ</th>
                        <th scope="col" class="actions"></th>
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
                            <td class="text-center"><small class='badge bg-success'>ส่งรีวิว</small></td>
                            <td class="actions text-center d-flex">
                                <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#verifyReviewModal"
                                    data-name="<?= h($userreviews[$index]->firstname) ?>"
                                    data-msg="<?= h($review->msg) ?>"
                                    data-asset="<?= h($review->asset->name) ?>"
                                    data-assetid="<?= h($review->asset_id) ?>"
                                >ตรวจสอบ</button>
                                <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#unReviewModal" 
                                    data-id="<?= h($review->id) ?>" 
                                    data-msg="<?= h($review->msg) ?>"
                                >ยกเลิก</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <?php if(empty($reviews)): ?>
                        <tr><td colspan="7" class="text-center">ไม่มีรายการรีวิว....</td></tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- VERIFY Review -------------------------------------->
<div class="modal fade" id="verifyReviewModal" role="dialog">
    <div class="modal-dialog modal-review-verify">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>รายละเอียดรีวิว : <u><span id="review_from_user"></span></u></strong></h4>
            </div>
            <div class="modal-body">
                <strong>รายละเอียด : </strong> <span id="review_msg"></span>
                <hr class="my-3" />
                <strong>จากประกาศ : </strong> <span id="review_asset"></span>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>


<!-- DELETE ARTICLE / NEWS -------------------------------------->
<div class="modal fade" id="unReviewModal" role="dialog">
    <div class="modal-dialog modal-article-delete">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Messages', 'action'=>'un-review'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_block']) ?>
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 id="un_review_msg"></h5>
                <input type="hidden" name="review_id" id="review_id">
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> ยืนยัน'), ['class' => 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>


<style scope>
    
</style>


<script>
    $(document).ready(function () {
        $('#unReviewModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Msg = $(e.relatedTarget).data('msg');
            
            document.getElementById('un_review_msg').innerHTML = 'ยืนยันการยกเลิกรีวิว<br/> <span class="text-danger">' + Msg + '</span> ?'
            $('#frm_block input[id="review_id"]').val(Id);
        });

        $('#verifyReviewModal').on('show.bs.modal', function (e) {
            let Name = $(e.relatedTarget).data('name');
            let Msg = $(e.relatedTarget).data('msg');
            let Asset = $(e.relatedTarget).data('asset');
            let AssetID = $(e.relatedTarget).data('assetid');

            document.getElementById('review_from_user').innerHTML = Name;
            document.getElementById('review_msg').innerHTML = Msg;
            document.getElementById('review_asset').innerHTML = '<a href="https://www.mapcii.com/property/view?id=' + AssetID + '" target="_blank">' + Asset + '</a>';
        });
    });
</script>