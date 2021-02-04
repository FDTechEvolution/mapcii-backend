<div class="row px-5 py-2">
    <div class="col-md-6">
        <div class="card m-b-20">
            <div class="card-body">
                <?= $this->Form->create('personaldata', ['controller' => 'Users', 'action' => 'update-personal-data']) ?>
                    <div class="row">
                        <div class="col-md-12 mb-3 py-2 px-4">
                            <div class="d-flex mb-2">
                                <strong class="w-100x mt-8x">ชื่อ</strong> <input type="text" class="form-control no-border" name="firstname" id="firstname" value="<?=$user->firstname ?>" required>
                            </div>
                            <div class="d-flex mb-2">
                                <strong class="w-100x mt-8x">นามสกุล</strong> <input type="text" class="form-control no-border" name="lastname" id="lastname" value="<?=$user->lastname ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 py-2 px-4">
                            <div class="d-flex mb-4">
                                <strong class="w-100x mt-8x">โทรศัพท์</strong> <input type="text" class="form-control no-border" name="phone" id="phone" value="<?=$user->phone ?>" required>
                            </div>
                            <div class="d-flex mb-4">
                                <strong class="w-100x mt-8x">LINE ID</strong> <input type="text" class="form-control no-border" name="lineid" id="lineid" value="<?=$user->lineid ?>">
                            </div>
                            <div class="d-flex mb-4">
                                <strong class="w-100x mt-8x">Email</strong> <input type="text" class="form-control no-border" name="email" id="email" value="<?=$user->email ?>" required>
                            </div>
                            <div class="d-flex mb-4">
                                <strong class="w-100x mt-8x">Facebook</strong> <input type="text" class="form-control no-border" name="facebook" id="facebook" value="<?=$user->facebook ?>">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-sm btn-success">แก้ไข</button>
                            </div>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <?= $this->Form->create('personaldata', ['controller' => 'Users', 'action' => 'update-personal-data', 'enctype' => 'multipart/form-data']) ?>
                    <div class="row no-gutters px-3">
                        <div class="col-md-4">
                            <?php if ($user->image == ''): ?>
                                <img src="<?=SITE_URL ?>img/mapcii_avatar.png" id="blah" class="w-100 peronal_user_img">
                            <?php else: ?>
                                <img src="<?=$user->image->url ?>" id="blah" class="w-100 peronal_user_img">
                            <?php endif ?>
                            <input id='image_file' name="image_file" type='file' onchange="readURL(this);" hidden/>
                            <button type="button" id="buttonid" class="btn btn-sm btn-secondary btn_user_img"><i class="fa fa-pencil"></i></button>
                        </div>
                        <div class="col-md-8">
                            <div class="mt-3 bg-light rounded-right px-3 py-2">
                                <h3 class="mb-2"><strong>หมายเลขสมาชิก</strong></h3>
                                <h2 class="text-dark"><i><?=$user->usercode ?></i></h2>
                            </div>
                        </div>
                        <div class="col-md-10 mt-2 d-webkit-box">
                            <strong class="mt-8x d-block">ชื่อผู้ใช้ (User Name) : </strong> <input type="text" class="form-control no-border w-50" name="username" id="username" value="<?=$user->username ?>" required>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="submit" class="btn btn-sm btn-success">แก้ไข</button>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-right">
                        <h4>เปลี่ยนรหัสผ่าน<h4>
                        <small>Password</small>
                    </div>
                    <div class="col-md-8">
                        <?= $this->Form->create('personalpassword', ['controller' => 'Users', 'action' => 'update-personal-password', 'id' => 'frm_password', 'onsubmit' => 'return checkNewPassword()']) ?>
                            <div class="mb-3">
                                <label for="old_password">รหัสผ่านเดิม</label>
                                <input type="password" name="old_password" class="form-control" id="old_password" required>
                                <span toggle="#old_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="mb-3">
                                <label for="new_password">รหัสผ่านใหม่</label>
                                <input type="password" name="new_password" class="form-control" id="new_password" required>
                                <span toggle="#new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password">ยืนยันรหัสผ่านใหม่</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                                <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">บันทึก</button>
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style scope>
    .w-100x {
        width: 100px;
    }
    .peronal_user_img {
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        border: 2px solid #eee;
    }
    .btn_user_img {
        border-radius: 50px;
        position: absolute;
        bottom: 0;
        right: 0;
        cursor: pointer;
    }
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }
    .no-border {
        border: none;
        border-bottom: 1px solid #ddd;
        border-radius: 0;
    }
    .input-bg-color {
        background-color: #f8f9fa;
    }
    .mt-8x {
        margin-top: 8px;
    }
    .d-webkit-box {
        display: -webkit-box;
    }
</style>


<script>
    $(document).ready(function () {

    });

    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));

        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    document.getElementById('buttonid').addEventListener('click', openDialog);

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function checkNewPassword() {
        var new_pass = document.forms["frm_password"]["new_password"].value;
        var confirn_pass = document.forms["frm_password"]["confirm_password"].value;
        if (new_pass !== confirn_pass) {
            alert("ยืนยันรหัสผ่านใหม่ ไม่ตรงกัน... กรุณาตรวจสอบ");
            return false;
        }
    }

    function openDialog() {
        document.getElementById('image_file').click();
    }
</script>
