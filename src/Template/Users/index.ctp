
<?= $this->element('Lib/data_table') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h2 class="prompt-400 "><i class="fa fa-address-card"></i> จัดการสมาชิก</h2>

            <div class="card-body">
                <table class="table table-hover">
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
                            <?php if($user->isactive == 'Y'): ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>
                                    <td class="text-center"><?= $regisDate ?></td>
                                    <td><?= $user->usercode ?></td>
                                    <td><?= $user->firstname ?></td>
                                    <td class="text-center"><?= $user->phone ?></td>
                                    <td class="text-center"><a href="https://line.me/ti/p/~<?= $user->lineid ?>" target="_blank" class="text-dark"><?= $user->lineid ?></td>
                                    <td class="text-center"><img src="<?= $user->image != null ? $user->image->url : '' ?>" class="w-100"></td>
                                    <td class="text-center"><?= !empty($user->user_packages) ? "<small class='badge bg-success'>ลงโฆษณา</small>" : "<small class='badge bg-warning'>ประกาศฟรี</small>" ?></td>
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
                                        <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#unMemberModal" data-id="<?= $user->id ?>" data-name="<?= $user->firstname ?>" data-code="<?= $user->usercode ?>">ยกเลิก</button>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

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
                        <img src="" id="image" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unMemberModal" role="dialog">
    <div class="modal-dialog modal-banner">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Users', 'action'=>'un-member'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_block']) ?>
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4 id="memberContent"></h4>
                <input type="hidden" name="user_id" id="user_id">
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
    .modal-dialog-verify-member {
        display: contents;
    }
    .content-modal-verify-member {
        width: 50%;
        margin-left: 25%;
        margin-top: 3%;
    }
    .p-content p {
        margin-bottom: 7px;
    }
</style>


<script>
    $(document).ready(function () {

        $('#unMemberModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Name = $(e.relatedTarget).data('name');
            let Code = $(e.relatedTarget).data('code');
            
            document.getElementById("memberContent").innerHTML = 'ยืนยันการยกเลิกสมาชิก [<span class="text-danger">' + Code + '</span>] : <span class="text-danger">' + Name + '</span> ?'
            $('#frm_block input[id="user_id"]').val(Id);
        });

        $('#verifyMemberModal').on('show.bs.modal', function (e) {
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
            document.getElementById("image").src = image !== null ? image : '-'
            document.getElementById("regisdate").innerHTML = regisdate
            document.getElementById("linklineid").href = 'https://line.me/ti/p/~' + lineid
            document.getElementById("linkfacebook").href = facebook
        });
    });
</script>
