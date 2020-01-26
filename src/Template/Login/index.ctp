
<div class="wrapper-page">

    <div class="text-center">
        <a href="index.html" class="logo-lg"><i class="mdi mdi-radar"></i> <span><?= PAGE_TITLE ?></span> </a>
    </div>


    <?= $this->Form->create('login', ['id' => 'login', 'novalidate' => true, 'class' => 'g-py-15']) ?>
    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-account"></i></span>
                <input class="form-control" type="email" required="" placeholder="email" name="email">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="mdi mdi-radar"></i></span>
                <input class="form-control" type="password" required="" placeholder="Password" name="password">
            </div>
        </div>
    </div>



    <div class="form-group row text-right m-t-20">
        <div class="col-12">
            <button class="btn btn-primary btn-block btn-custom w-md waves-effect waves-light" type="submit">เข้าสู่ระบบ
            </button>
        </div>
    </div>

    <div class="form-group row m-t-30">
        <div class="col-sm-7">

            <?= $this->Html->link('Forgot Password', ['action' => 'recoverpw'], ['escape' => false, 'label' => false]) ?>
        </div>

    </div>
</form>
</div>
<script>
    var resizefunc = [];
</script>
