<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 card-body">
            <div class="col-12  m-b-20 " style="text-align: right">
                <?= $this->Html->link(BT_BACK, ['controller' => 'users'], ['escape' => false]) ?>
            </div>
            <?= $this->Form->create($user, ['id' => 'users']) ?>
            <div class="form-group row ">
                <div class="col-md-6 ">
                    <h2 class="prompt-400 "><i class="fa fa-address-card-o"></i> แก้ไขข้อมูลสมาชิก</h2>
                </div>


            </div>


            <div class="row" id="customer_box" >
                 <div class="col-md-3 form-group" >
                    <label for="role_id">คำนำหน้า </label>
                    <?= $this->Form->control('title', ['id'=>'title', 'class' => 'form-control', 'label' => false, 'options' => ['นาย'=>'นาย','นาง'=>'นาง','นางสาว'=>'นางสาว']]) ?>

                </div>
                <div class="col-md-3 form-group">
                    <label for="firstname">ชื่อจริง</label>
                    <?= $this->Form->control('firstname', ['class' => 'form-control', 'id' => 'firstname', 'label' => false]) ?>
                </div>
                <div class="col-md-3 form-group">
                    <label for="lastname">นามสกุล</label>
                    <?= $this->Form->control('lastname', ['class' => 'form-control', 'id' => 'lastname', 'label' => false]) ?>
                </div>
                 <div class="col-md-3 form-group">

                    <label >E-mail</label>

                    <?= $this->Form->control('email', ['id' => 'email', 'label' => false, 'class' => 'form-control']) ?>

                </div>
                
                <div class="col-md-3 form-group">
                    <label for="lastname">Line ID</label>
                    <?= $this->Form->control('lineid', ['class' => 'form-control', 'id' => 'lineid', 'label' => false]) ?>
                </div>
                <div class="col-md-3 form-group">
                    <label for="lastname">Fax</label>
                    <?= $this->Form->control('fax', ['class' => 'form-control', 'id' => 'fax', 'label' => false]) ?>
                </div>

               
               

                <div class="col-md-3 ">

                    <label class=" col-form-label text-right">Active </label>
                    <div class="checkbox">
                        <?= $this->Form->checkbox('isactive', ['hiddenField' => 'N', 'id' => 'isactive', 'value' => 'Y']) ?>
                        <label for="isactive"></label>
                    </div>
                </div>
                <div class="col-md-3 ">

                    <label class=" col-form-label text-right">Verify </label>
                    <div class="checkbox">
                        <?= $this->Form->checkbox('isverify', ['hiddenField' => 'N', 'id' => 'isverify', 'value' => 'Y']) ?>
                        <label for="isverify"></label>
                    </div>
                </div>
                <div class="col-md-3 ">

                    <label class=" col-form-label text-right">Lock </label>
                    <div class="checkbox">
                        <?= $this->Form->checkbox('islocked', ['hiddenField' => 'N', 'id' => 'islocked', 'value' => 'Y']) ?>
                        <label for="islocked"></label>
                    </div>
                </div>
                <div class="col-md-3 ">

                    <label class=" col-form-label text-right">Seller </label>
                    <div class="checkbox">
                        <?= $this->Form->checkbox('isseller', ['hiddenField' => 'N', 'id' => 'isseller', 'value' => 'Y']) ?>
                        <label for="isseller"></label>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <label class=" col-form-label ">Customer </label>
                    <div class="checkbox">
                        <?= $this->Form->checkbox('iscustomer', ['hiddenField' => 'N', 'id' => 'iscustomer', 'value' => 'Y']) ?>
                        <label for="iscustomer"></label>
                    </div> 
                </div>




            </div>




        </div>

        <div class="row m-t-20">

            <div class="col-md-12 text-center">
                <?= BT_SAVE ?>

            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
</div>

<script>

    $(function () {
        jQuery('#birthday').datepicker({
            //  language: 'th',
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

    });
    $(function () {
        jQuery('#startdate').datepicker({
            //  language: 'th',
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

    });

</script>

<script>

    $(function () {



        $("#users").validate({
            rules: {
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                startdate: {
                    required: true
                },
                email: {
                    required: true
                },
                birthday: {
                    required: true
                },

                plant_group_id: {
                    required: true
                },

                mobileno: {
                    required: true,
                    maxlength: 10,
                    minlength: 10
                }
            },
            messages: {
                firstname: {
                    required: "กรุณากรอก ชื่อ"
                },
                lastname: {
                    required: "กรุณากรอก นามสกุล"
                },

                plant_group_id: {
                    required: "Please choose PlantGroup"
                },
                startdate: {
                    required: "กรุณากรอก วันที่เริ่มทำงาน"
                },
                birthday: {
                    required: "กรุณากรอก วันเกิด"
                },
                email: {
                    required: "กรุณากรอก Email"
                },
                username: {
                    required: "Please Fill USERNAME",
                    languageTest: 'Invalid language'
                },
                password: {
                    required: "Please Fill PASSWORD"
                },

                mobileno: {
                    required: "กรุณากรอก หมายเลขโทรศัพท์"
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
