<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 card-body">

            <?= $this->Form->create($package, ['id' => 'package']) ?>
            <div class="form-group row ">
                <div class="col-lg-6 ">
                    <h2 class="prompt-400 "><i class="ti-package"></i> แก้ไขแพ็คเกจ </h2>
                </div>
                <div class="col-lg-6   " style="text-align: right">
                    <?= $this->Html->link(BT_BACK, ['action' => 'index'], ['escape' => false]) ?>
                </div>

            </div>

            <div class="row" id="customer_box" >
                
                <div class="col-lg-3 col-md-3 form-group" >
                    <label for="username"  >ชื่อ แพ็คเกจ<?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('name', ['id' => 'name', 'class' => 'form-control', 'label' => false]) ?>
                </div>
                <div class="col-lg-6 col-md-6 form-group">
                    <label for="role_id">รายละเอียด </label>
                    <?= $this->Form->control('description', ['id' => 'description', 'class' => 'form-control', 'label' => false]) ?>

                </div>
                <div class="col-lg-3 col-md-3   form-group" >
                    
                </div>
                
            </div>
            <div class="row" id="customer_box" >
                
                <div class="col-lg-3 col-md-3 form-group" >
                    <label for="username"  >ราคา 1 เดือน <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('monthly_price', ['id' => 'monthly_price', 'class' => 'form-control', 'label' => false, 'type' => 'number']) ?>
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                    <label for="role_id">ราคา 3 เดือน <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('quarterly_price', ['id' => 'quarterly_price', 'class' => 'form-control', 'label' => false, 'type' => 'number']) ?>

                </div>
                <div class="col-lg-3 col-md-3   form-group" >
                     <label for="role_id">ราคา 6 เดือน <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('semiannual_price', ['id' => 'semiannual_price', 'class' => 'form-control', 'label' => false, 'type' => 'number']) ?>

                </div>
                <div class="col-lg-3 col-md-3 form-group" >
                     <label for="role_id">ราคา 1 ปี <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('annual_price', ['id' => 'annual_price', 'class' => 'form-control', 'label' => false, 'type' => 'number']) ?>

                </div>
            </div>



            <div class="row m-t-20">

                <div class="col-lg-12 text-center">

                    <?= BT_SAVE ?>
                    <?= BT_RESET ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<script>

    $(function () {



        $("#package").validate({
            rules: {

                name: {
                    required: true
                },
                monthly_price: {
                    required: true
                },
                quarterly_price: {
                    required: true
                },
                semiannual_price: {
                    required: true
                },
                annual_price: {
                    required: true
                }
            },
            messages: {

                name: {
                    required: "กรุณากรอกชื่อแพ็คเกจ"
                },
                monthly_price: {
                    required: "กรุณากรอกราคา รายเดือน"
                },
                quarterly_price: {
                    required: "กรุณากรอกราคา ราย 3 เดือน"
                },
                semiannual_price: {
                    required: "กรุณากรอกราคา ราย 6 เดือน"
                },
                annual_price: {
                    required: "กรุณากรอกราคา ราย 1 ปี"
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
