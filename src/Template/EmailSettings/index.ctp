<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 card-body">

            <?= $this->Form->create($emailSettings, ['id' => 'emailSettings']) ?>
            <div class="form-group row ">
                <div class="col-lg-6 ">
                    <h2 class="prompt-400 "><i class="ti-package"></i> ตั้งค่า E-mail </h2>
                </div>
                <div class="col-lg-6   " style="text-align: right">
                    <?= $this->Html->link(BT_BACK, ['controller'=>'home','action' => 'index'], ['escape' => false]) ?>
                    <?= $this->Html->link('<button type="button" class="btn btn-secondary waves-effect">Send E-mail</button>', ['action' => 'sendemail'], ['escape' => false]) ?>
                </div>

            </div>

            <div class="row" id="customer_box" >
                <div class="col-lg-3 col-md-3 form-group"></div>
                <div class="col-lg-3 col-md-3 form-group" style="text-align: center">
                    <label for="username"  >Server <?= REQUIRE_FIELD ?></label>
                  
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                  
                    <?= $this->Form->control('email_server', ['id' => 'email_server', 'class' => 'form-control', 'label' => false]) ?>

                </div>
               
                
            </div>
             <div class="row" id="customer_box" >
                <div class="col-lg-3 col-md-3 form-group"></div>
                <div class="col-lg-3 col-md-3 form-group" style="text-align: center">
                    <label for="username"  >Port <?= REQUIRE_FIELD ?></label>
                  
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                  
                    <?= $this->Form->control('email_port', ['id' => 'email_port', 'class' => 'form-control', 'label' => false]) ?>

                </div>
               
                
            </div>
             <div class="row" id="customer_box" >
                <div class="col-lg-3 col-md-3 form-group"></div>
                <div class="col-lg-3 col-md-3 form-group" style="text-align: center">
                    <label for="username"  >Username <?= REQUIRE_FIELD ?></label>
                  
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                  
                    <?= $this->Form->control('email_username', ['id' => 'email_username', 'class' => 'form-control', 'label' => false]) ?>

                </div>
               
                
            </div>
             <div class="row" id="customer_box" >
                <div class="col-lg-3 col-md-3 form-group"></div>
                <div class="col-lg-3 col-md-3 form-group" style="text-align: center">
                    <label for="username"  >Password <?= REQUIRE_FIELD ?></label>
                  
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                  
                    <?= $this->Form->control('email_password', ['id' => 'email_password', 'class' => 'form-control', 'label' => false]) ?>

                </div>
               
                
            </div>
            <div class="row" id="customer_box" >
                <div class="col-lg-3 col-md-3 form-group"></div>
                <div class="col-lg-3 col-md-3 form-group" style="text-align: center">
                    <label for="username"  >From Email <?= REQUIRE_FIELD ?></label>
                  
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                  
                    <?= $this->Form->control('email_address', ['id' => 'email_address', 'class' => 'form-control', 'label' => false]) ?>

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



        $("#emailSettings").validate({
            rules: {

                email_server: {
                    required: true
                },
                email_port: {
                    required: true
                },
                email_username: {
                    required: true
                },
                email_password: {
                    required: true
                },
                email_address: {
                    required: true
                },
            },
            messages: {

                email_server: {
                    required: "กรุณากรอกข้อมูล"
                },
                email_port: {
                    required: "กรุณากรอกข้อมูล"
                },
                email_username: {
                    required: "กรุณากรอกข้อมูล"
                },
                email_password: {
                    required: "กรุณากรอกข้อมูล"
                },
                email_address: {
                    required: "กรุณากรอกข้อมูล"
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
