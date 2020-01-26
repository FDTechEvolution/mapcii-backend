
<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 card-body">

            <?= $this->Form->create($assetCategory, ['id' => 'assetCategory']) ?>
            <div class="form-group row ">
                <div class="col-lg-6 ">
                    <h2 class="prompt-400 "><i class="fa fa-address-card-o"></i> แก้ไขหมวดหมู่อสังหาริมทรัพย์ </h2>
                </div>
                <div class="col-lg-6   " style="text-align: right">
                    <?= $this->Html->link(BT_BACK, ['action' => 'index'], ['escape' => false]) ?>
                </div>

            </div>

            <div class="row" id="customer_box" >
                <div class="col-lg-4 col-md-4   form-group" ></div>
                <div class="col-lg-4 col-md-4 form-group" >
                    <label for="username"  >ชื่อหมวดหมู่อสังหาริมทรัพย์<?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('name', ['id' => 'name', 'class' => 'form-control', 'label' => false]) ?>
                </div>
               
                 <div class="col-lg-4 col-md-4   form-group" ></div>
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
               
            },
            messages: {

                name: {
                    required: "กรุณากรอกชื่อหมวดหมู่"
                },
               
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>

