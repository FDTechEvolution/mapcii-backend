
<div class="wrapper-page">

    <div class="text-center">
        <a href="index.html" class="logo-lg"><i class="mdi mdi-key"></i> <span><?= 'CHANGE PASSWORD' ?></span> </a>
    </div>


    <?= $this->Form->create('change', ['id' => 'change', 'url' => ['controller' => 'users', 'action' => 'changepassword'], 'class' => 'login-form']) ?>
    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-key"></i></span>

                <input class="form-control" type="password" placeholder="Old Password" autofocus name="opassword">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-radar"></i></span>
                <input class="form-control" type="password" placeholder="New Password" name="npassword" id="npassword">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-radar"></i></span>
                <input class="form-control" type="password" placeholder="Confirm Password" name="cpassword" id="cpassword">
            </div>
        </div>
    </div>
    <input class="form-control" type="hidden"  name="userid" id="userid" value="<?= $id ?>">


    <div class="form-group row text-right m-t-20">
        <div class="col-12">
            <button class="btn btn-primary btn-block btn-custom w-md waves-effect waves-light" id="btsub" type="submit">CHANGE
            </button>
        </div>
    </div>


</form>
</div>
<script>
    var resizefunc = [];
</script>



<script>

    $(function () {



        $("#change").validate({
            rules: {
                opassword: {
                    required: true
                },
                npassword: {
                    required: true
                },
                cpassword: {
                    required: true
                }

            },
            messages: {
                opassword: {
                    required: "กรุณากรอก รหัสผ่านเดิม"
                },
                npassword: {
                    required: "กรุณากรอก รหัสผ่านใหม่"
                },

                cpassword: {
                    required: "กรุณายืนยันรหัสผ่าน"

                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
<script>
    $('#cpassword').on('change', function () {
        var np = $('#npassword').val();
        var cp = $('#cpassword').val();
        if (np !== '') {
            if (np !== cp) {
                swal("ยืนยันรหัสไม่ถูกต้อง!", "กรุณากรอกรหัสผ่านให้ถูกต้อง!", "error");
                return false;
            }
        }
    });
    $('#btsub').on('click', function () {
        var np = $('#npassword').val();
        var cp = $('#cpassword').val();
        var op = $('#opassword').val();

        if (np === '' || cp === '' || op === '') {
            swal("ไม่ถูกต้อง!", "กรุณากรอกข้อมูลให้ครบถ้วน!", "error");
            return false;
        } else {
            $("#change").submit();
        }

    });
</script>
