

<div class="wrapper-page" >

    <div class="text-center">
        <a href="index.html" class="logo-lg"><i class="mdi mdi-radar"></i> <span><?= PAGE_TITLE ?></span> </a>
    </div>


    <?= $this->Form->create('login', ['id' => 'recoverpw', 'url' => ['controller' => 'login', 'action' => 'recoverpw'], 'class' => 'login-form m-t-20']) ?>

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Enter Email" required="" name="email">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <div id="html_element" class="g-recaptcha" data-sitekey="<?= SITE_KEY ?>" data-callback="makeaction"></div>
            </div>
        </div>
    </div>
    <div class="form-group row" >
        <div class="col-12">


            <button  type="submit" disabled  id="btn_sub" class="btn btn-email btn-primary waves-effect waves-light" >Reset</button> 

        </div>
    </div>

    <?= $this->Form->end() ?>

</div>


<script>
    function makeaction() {

        document.getElementById('btn_sub').disabled = false;
    }
</script>


<script>
    var resizefunc = [];
</script>

