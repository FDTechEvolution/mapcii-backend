<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">จัดการถาม/ตอบ</h4>

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
                            <td class="text-center">
                                <?php if($contact->status == 'DR') { ?>
                                    <small class='badge bg-warning'>รอคำตอบ</small>
                                <?php }else if($contact->status == 'CO') { ?>
                                    <small class='badge bg-success'>ตอบแล้ว</small>
                                <?php } ?>
                            </td>
                            <td class="actions text-center d-flex">
                                <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#verifyContactModal"
                                    data-id=<?= h($contact->id) ?>
                                    data-name="<?= h($usercontacts[$index]->firstname) ?>"
                                    data-msg="<?= h($contact->msg) ?>"
                                    data-asset="<?= h($contact->asset->name) ?>"
                                    data-assetid="<?= h($contact->asset_id) ?>"
                                    data-status="<?= h($contact->status) ?>"
                                    data-answer=<?= h($contact->answer) ?>
                                >ตรวจสอบ</button>
                                <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#unContactModal" data-id="<?= h($contact->id) ?>" data-msg="<?= h($contact->msg) ?>">ยกเลิก</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <?php if(empty($contacts)): ?>
                        <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกคำถาม....</td></tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- VERIFY CONTACT -------------------------------------->
<div class="modal fade" id="verifyContactModal" role="dialog">
    <div class="modal-dialog modal-contact-verify">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Messages', 'action'=>'contact-answer'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_verify']) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>รายละเอียดคำถามจากคุณ : <u><span id="contact_from_user"></span></u></strong></h4>
            </div>
            <div class="modal-body">
                <strong>รายละเอียด : </strong> <span id="contact_msg"></span><br/><br/>
                <input type="text" name="contact_ans" id="contact_ans" class="" placeholder="ตอบกลับ...(คำตอบจะถูกส่งไปยังอีเมล์ของผู้ถาม)">
                <span id="isAnswer" class=""></span>
                <input type="hidden" name="contact_id" id="contact_id">
                <hr class="my-3" />
                <strong>จากประกาศ : </strong> <span id="contact_asset"></span>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> ยืนยัน'), ['class' => '', 'id' => 'btn-answer', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>


<!-- DELETE CONTACT -------------------------------------->
<div class="modal fade" id="unContactModal" role="dialog">
    <div class="modal-dialog modal-contact-delete">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Messages', 'action'=>'un-contact'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_block']) ?>
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 id="un_contact_msg"></h5>
                <input type="hidden" name="contact_id" id="contact_id">
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
    .modal-dialog.modal-contact-verify {
        display: contents;
    }
    .modal-dialog.modal-contact-verify .modal-content {
        width: 60%;
        margin-left: 20%;
        margin-top: 3%;
        margin-bottom: 3%;
    }
    .display-none {
        display: none;
    }
</style>


<script>
    $(document).ready(function () {
        $('#unContactModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Msg = $(e.relatedTarget).data('msg');
            
            document.getElementById('un_contact_msg').innerHTML = 'ยืนยันการยกเลิก<br/> <span class="text-danger">' + Msg + '</span> ?'
            $('#frm_block input[id="contact_id"]').val(Id);
        });

        $('#verifyContactModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Name = $(e.relatedTarget).data('name');
            let Msg = $(e.relatedTarget).data('msg');
            let Asset = $(e.relatedTarget).data('asset');
            let AssetID = $(e.relatedTarget).data('assetid');
            let Status = $(e.relatedTarget).data('status');
            let Answer = $(e.relatedTarget).data('answer');

            $('#frm_verify input[id="contact_id"]').val(Id);
            document.getElementById('contact_from_user').innerHTML = Name;
            document.getElementById('contact_msg').innerHTML = Msg;
            document.getElementById('contact_asset').innerHTML = '<a href="https://www.mapcii.com/property/view?id=' + AssetID + '" target="_blank">' + Asset + '</a>';
            document.getElementById('isAnswer').innerHTML = Status === 'CO' ? '<strong>ตอบกลับ : </strong>' + Answer : ''
            document.getElementById('contact_ans').className = Status === 'CO' ? 'display-none' : 'form-control'
            document.getElementById('btn-answer').className = Status === 'CO' ? 'display-none' : 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5'
        });
    });
</script>