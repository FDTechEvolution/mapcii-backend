<div class="row">
    <div class="col-md-12">
        <div id="package-form" class="card m-b-20 card-body">

            <?= $this->Form->create($package, ['id' => 'package']) ?>
                <div class="form-group row ">
                    <div class="col-lg-6 ">
                        <h2 class="prompt-400 "><i class="ti-package"></i> แก้ไขแพ็คเกจ Banner B</h2>
                    </div>
                    <div class="col-lg-6   " style="text-align: right">
                        <?= $this->Html->link(BT_BACK, array('controller' => 'packages', 'action'=> 'announce-ad-index'), ['escape' => false]) ?>
                    </div>
                </div>

                <div class="row justify-content-md-center" id="customer_box" >
                    <div class="col-md-10 form-group" >
                        <label for="username"  >ชื่อ แพ็คเกจ<?= REQUIRE_FIELD ?></label>
                        <?= $this->Form->control('name', ['id' => 'name', 'class' => 'form-control', 'value' => $package->name, 'label' => false, 'readonly']) ?>
                    </div>
                    <div class="col-md-10 form-group mt-2 border-top">
                        ราคาและจำนวนเครดิต
                        <div class="row justify-content-md-center mt-2 mb-2" style="border-bottom: 1px solid #ddd; font-weight: 700;">
                            <div class="col-md-2">ระยะเวลา</div>
                            <div class="col-md-2 text-center">เครดิต</div>
                            <div class="col-md-2 text-center">ราคา</div>
                            <div class="col-md-2 text-center">โปรโมชั่นเครดิต</div>
                            <div class="col-md-2 text-center">โปรโมชั่นราคา</div>
                        </div>
                        <ul class="pl-0">
                            <?php foreach ($package->package_lines as $key => $packageline): ?>
                                <li class="row justify-content-md-center mt-3 mb-3">
                                    <div class="col-md-2 pt-1">
                                        <strong><?= h($packageline->package_duration->duration_name); ?> ( <?= h($packageline->package_duration->duration_exp) ?> วัน )</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="iscredit[]" id="iscredit" class="form-control" value="<?= $packageline->iscredit ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="isprice[]" id="isprice" class="form-control" value="<?= $packageline->isprice ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="procredit[]" id="procredit" class="form-control" style="border-color: #00b19d;" value="<?= $packageline->proprice ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="proprice[]" id="proprice" class="form-control" style="border-color: #00b19d;" value="<?= $packageline->procredit ?>">
                                    </div>
                                </li>
                                <input type="hidden" name="id[]" value="<?=$packageline->id?>">
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-lg-12 text-center">
                        <?= BT_SAVE ?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
let packageForm = new Vue ({
    el: '#package-form',
    data () {
        return {
            promotionChecked: false
        }
    },
    mounted () {

    },
    methods: {
        selectSize: function () {

        }
    }
})
</script>

<script>
    $(function () {
        $("#package").validate({
            rules: {

                name: {
                    required: true
                },
                package_duration_id: {
                    required: true
                },
                isprice: {
                    required: true
                },
                isqty: {
                    required: true
                },
                showpage: {
                    required: true
                }
            },
            messages: {

                name: {
                    required: "กรุณากรอกชื่อแพ็คเกจ"
                },
                package_duration_id: {
                    required: "กรุณาเลือกระยะเวลา"
                },
                isprice: {
                    required: "กรุณาระบุราคา"
                },
                isqty: {
                    required: "กรุณาระบุจำนวนประกาศ"
                },
                showpage: {
                    required: "กรุณาระบุหน้าแสดงแพ็คเกจ"
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
