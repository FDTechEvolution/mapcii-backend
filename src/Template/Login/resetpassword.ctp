
<div class="wrapper-page">

    <div class="text-center">
        <a href="index.html" class="logo-lg"><i class="mdi mdi-radar"></i> <span>กรุณาตั้งรหัสผ่านใหม่</span> </a>
    </div>


    <?= $this->Form->create('', ['id' => 'resetpass', 'class' => 'g-py-15']) ?>
    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-account"></i></span>
                <input class="form-control" type="password" required="" placeholder="New Password" name="npassword">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-radar"></i></span>
                <input class="form-control" type="password" required="" placeholder="Confirm Password" name="cpassword">
            </div>
        </div>
    </div>



    <div class="form-group row text-right m-t-20">
        <div class="col-12">
            <button class="btn btn-primary btn-block btn-custom w-md waves-effect waves-light" type="submit">บันทึก
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



        $("#resetpass").validate({
            rules: {
                npassword: {
                    required: true
                },
                cpassword: {
                    required: true,
                    equalTo: "#npassword"
                }
            },
            messages: {
                npassword: {
                    required: "กรูณากรอกรหัสผ่านใหม่"
                },
                cpassword: {
                    required: "กรูณากรอกยืนยันรหัสผ่าน",
                    equalTo: "รหัสผ่านไม่ตรงกัน"
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>