<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 card-body">

            <?= $this->Form->create($assetType, ['id' => 'assetType']) ?>
            <div class="form-group row ">
                <div class="col-lg-6 ">
                    <h2 class="prompt-400 "><i class="fa fa-address-card-o"></i> แก้ไขประเภทของทรัพย์สิน </h2>
                </div>
                <div class="col-lg-6   " style="text-align: right">
                    <?= $this->Html->link(BT_BACK, ['action' => 'index',$assetType->asset_category_id], ['escape' => false]) ?>
                </div>

            </div>

            <div class="row" id="customer_box" >
                <div class="col-lg-3 col-md-3 form-group" ></div>
                <div class="col-lg-3 col-md-3 form-group" >
                    <label for="username"  >ชื่อประเภททรัพย์สิน<?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('name', ['id' => 'name', 'class' => 'form-control', 'label' => false]) ?>
                </div>
                <div class="col-lg-3 col-md-3 form-group">
                    <label for="role_id">Categorie <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('asset_category_id', [ 'id' => 'asset_category_id', 'class' => 'form-control', 'label' => false, 'options' => $assetCategories]) ?>

                </div>
                 <div class="col-lg-3 col-md-3  form-group" ></div>
            </div>



            <div class="row m-t-20">

                <div class="col-lg-12 text-center">

                    <?= BT_SAVE ?>
                  
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>

    $(function () {



        $("#assetType").validate({
            rules: {

                name: {
                    required: true
                },
                asset_category_id: {
                    required: true
                },
            },
            messages: {

                name: {
                    required: "กรุณากรอกชื่อประเภท"
                },
                asset_category_id: {
                    required: "กรุณาเลือก"
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
