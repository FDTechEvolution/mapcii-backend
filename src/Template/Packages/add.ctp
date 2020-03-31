<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 card-body">

            <?= $this->Form->create($package, ['id' => 'package']) ?>
            <div class="form-group row ">
                <div class="col-lg-6 ">
                    <h2 class="prompt-400 "><i class="ti-package"></i> เพิ่มแพ็คเกจ </h2>
                </div>
                <div class="col-lg-6   " style="text-align: right">
                    <?= $this->Html->link(BT_BACK, ['action' => 'index'], ['escape' => false]) ?>
                </div>
            </div>

            <div class="row justify-content-md-center" id="customer_box" >
                <div class="col-lg-4 col-md-3 form-group" >
                    <label for="username"  >ชื่อ แพ็คเกจ<?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('name', ['id' => 'name', 'class' => 'form-control', 'label' => false]) ?>
                </div>
                <div class="col-lg-3 col-md-3 form-group" >
                    <label for="username"  >ราคา 1 เดือน (บาท) <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('monthly_price', ['id' => 'monthly_price', 'class' => 'form-control', 'label' => false, 'type' => 'number']) ?>
                </div>
                <div class="col-lg-3 col-md-3 form-group" >
                     <label for="role_id">ราคา 1 ปี (บาท) <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->control('annual_price', ['id' => 'annual_price', 'class' => 'form-control', 'label' => false, 'type' => 'number']) ?>
                </div>                
            </div>
            <div class="row justify-content-md-center" id="customer_box" >
                <div class="col-lg-5 col-md-6 form-group">
                    <label for="role_id">หน้าที่แสดง <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->textarea('showpage', ['id' => 'showpage', 'class' => 'form-control', 'label' => false]) ?>
                </div>
                <div class="col-lg-5 col-md-6 form-group">
                    <label for="role_id">รายละเอียดการแสดงผล <?= REQUIRE_FIELD ?></label>
                    <?= $this->Form->textarea('showcase', ['id' => 'showcase', 'class' => 'form-control', 'label' => false, 'placeholder'=>'1. เป็นการสุ่มแสดง Banner ตอนเริ่มต้น จากนั้นจะแสดง Banner ต่อไปแบบเรียลำดับ
2. สามารถลง Banner และแก้ไขได้ด้วยตนเอง ตลอด 24 ชั่วโมง']) ?>
                </div>
            </div>
            <div id="package-form">
                <div class="row justify-content-md-center" id="customer_box">
                    <div class="col-md-3 form-group">
                        <label for="role_id">ขนาดที่แสดง <?= REQUIRE_FIELD ?></label>
                        <select class="form-control" name="size_id" id="size_id" required>
                            <option value="" disabled selected>เลือกขนาด</option>
                        <?php foreach ($sizes as $size): ?>
                            <option value="<?= h($size->id); ?>"><?= h($size->width); ?> x <?= h($size->height); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="role_id">ตำแหน่งการแสดงผล <?= REQUIRE_FIELD ?></label>
                        <select class="form-control" name="position_id" id="position_id" required>
                            <option value="" disabled selected>เลือกตำแหน่ง</option>
                        <?php foreach ($positions as $position): ?>
                            <option value="<?= h($position->id); ?>"><?= h($position->position); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="role_id">ประเภท <?= REQUIRE_FIELD ?></label>
                        <select class="form-control" name="package_type_id" id="package_type_id" required>
                            <option value="" disabled selected>เลือกประเภท</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= h($type->id); ?>"><?= h($type->name); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
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
let packageForm = new Vue ({
    el: '#package-form',
    data () {
        return {
            sizes: null
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
                monthly_price: {
                    required: true
                },
                annual_price: {
                    required: true
                },
                showpage: {
                    required: true
                },
                showcase: {
                    required: true
                },
                size_id: {
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
                annual_price: {
                    required: "กรุณากรอกราคา ราย 1 ปี"
                },
                showpage: {
                    required: "กรุณาระบุหน้าแสดงแพ็คเกจ"
                },
                showcase: {
                    required: "กรุณาระบุการแสดงผล"
                },
                size_id: {
                    required: "กรุณาเลือกขนาดของการแสดงผล"
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
