<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 card-body">

            <?= $this->Form->create($option, ['id' => 'option']) ?>
            <div class="form-group row ">
                <div class="col-lg-6 ">
                    <h2 class="prompt-400 "><i class="fa fa-address-card-o"></i> แก้ไขส่วนเสริม </h2>
                </div>
                <div class="col-lg-6   " style="text-align: right">
                    <?= $this->Html->link(BT_BACK, ['action' => 'index'], ['escape' => false]) ?>
                </div>

            </div>

            <div class="row" id="customer_box" >
                <div class="col-lg-3 col-md-3 form-group" ></div>
                <div class="col-lg-3 col-md-3 form-group" >
                    <label for="username"  >รายละเอียด<?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('name', ['id' => 'name', 'class' => 'form-control', 'label' => false]) ?>
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                    <label for="role_id">ประเภท <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('type', [ 'id' => 'type', 'class' => 'form-control', 'label' => false, 'options' => $type]) ?>

                </div>
                 <div class="col-lg-3 col-md-3   form-group" ></div>
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



        $("#option").validate({
            rules: {

                name: {
                    required: true
                },
                type: {
                    required: true
                },
            },
            messages: {

                name: {
                    required: "กรุณากรอกรายละเอียด"
                },
                type: {
                    required: "กรุณาเลือก"
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
