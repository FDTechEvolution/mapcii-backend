<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 card-body">

            <?= $this->Form->create($financialAccount, ['id' => 'financialAccount']) ?>
                <div class="form-group row ">
                    <div class="col-lg-6 ">
                        <h2 class="prompt-400 "><i class="ti-package"></i> เพิ่มบัญชี </h2>
                    </div>
                    <div class="col-lg-6   " style="text-align: right">
                        <?= $this->Html->link(BT_BACK, ['action' => 'index'], ['escape' => false]) ?>
                    </div>
                </div>
                <div class="row justify-content-md-center" id="customer_box" >
                    <div class="col-lg-4 col-md-3 form-group" >
                        <label for="username"  >ชื่อบัญชี / ธนาคาร /สาขา<?= REQUIRE_FIELD ?></label>
                        <?= $this->Form->control('name', ['id' => 'name', 'class' => 'form-control', 'label' => false]) ?>
                    </div>
                    <div class="col-lg-3 col-md-3 form-group" >
                        <label for="username"  >ประเภท <?= REQUIRE_FIELD ?></label>
                        <?= $this->Form->select(
                            'type',
                            ['BANK' => 'BANK', 'PAYPAL' => 'PAYPAL', 'DEBIT/CREDIT' => 'DEBIT/CREDIT'],
                            ['empty' => '(เลือกประเภท)', 'id' => 'type', 'class' => 'form-control']
                        ); ?>
                    </div>
                    <div class="col-lg-3 col-md-3 form-group" >
                        <label for="role_id">เลขบัญชี <?= REQUIRE_FIELD ?></label>
                        <?= $this->Form->control('accountno', ['id' => 'accountno', 'class' => 'form-control', 'label' => false]) ?>
                    </div>                
                </div>
                <div class="row m-t-20">
                    <div class="col-lg-12 text-center">
                        <?= BT_SAVE ?>
                        <?= BT_RESET ?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        $("#financialAccount").validate({
            rules: {

                name: {
                    required: true
                },
                type: {
                    required: true
                },
                accountno: {
                    required: true
                }
            },
            messages: {

                name: {
                    required: "กรุณากรอกชื่อบัญชี"
                },
                type: {
                    required: "กรุณาเลือกประเภทบัญชี"
                },
                accountno: {
                    required: "กรุณากรอกเลขบัญชี"
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>