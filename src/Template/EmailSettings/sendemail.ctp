<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">

            <?= $this->Form->create('', ['id' => 'emailSettings']) ?>
            <div class="form-group row ">
                <div class="col-lg-6 ">
                    <h2 class="prompt-400 "><i class="ion-paper-airplane"></i> ส่ง E-mail </h2>
                </div>
                <div class="col-lg-6   " style="text-align: right">
                    <?= $this->Html->link(BT_BACK, ['controller' => 'home', 'action' => 'index'], ['escape' => false]) ?>
                </div>

            </div>

            <div class="row" id="customer_box" >
                <div class="col-lg-4 col-md-4 form-group" ></div>
                <div class="col-lg-4 col-md-4 form-group" >
                    <label for="username"  >To <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('to', ['id' => 'to', 'class' => 'form-control', 'label' => false]) ?>
                </div>
                <div class="col-lg-4 col-md-4 form-group" ></div>
            </div>
            <div class="row" id="customer_box" >
                <div class="col-lg-4 col-md-4 form-group" ></div>
                <div class="col-lg-4 col-md-4 form-group" >
                    <label for="username"  >title <?= REQUIRE_FIELD ?></label>

                    <?= $this->Form->control('title', ['id' => 'title', 'class' => 'form-control', 'label' => false]) ?>


                </div>
                <div class="col-lg-4 col-md-4 form-group" ></div>
            </div>
            <div class="row" id="customer_box" >
                <div class="col-lg-4 col-md-4 form-group" ></div>
                <div class="col-lg-4 col-md-4 form-group" >

                    <label for="username"  >ข้อความ </label>

                    <?= $this->Form->control('message', ['id' => 'message', 'class' => 'form-control', 'label' => false, 'type' => 'textarea']) ?>

                </div>
                <div class="col-lg-4 col-md-4 form-group" ></div>
            </div>







            <div class="row m-t-20">

                <div class="col-lg-12 text-center">

                    <?= BT_SEND ?>

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

                to: {
                    required: true
                },
                title: {
                    required: true
                }
            },
            messages: {

                to: {
                    required: "กรุณากรอกข้อมูล"
                },
                title: {
                    required: "กรุณากรอกข้อมูล"
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
