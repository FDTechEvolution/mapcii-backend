<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= isset($pageTitle) ? $pageTitle . '-' : '' ?><?= PAGE_TITLE ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="FDTech" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        
        <?= $this->Html->script('/assetdist/js/jquery.min.js'); ?>
        <?= $this->Html->css('/assetdist/plugins/switchery/switchery.min.css') ?>
        <?= $this->Html->css('/assetdist/plugins/jquery-circliful/css/jquery.circliful.css') ?>

        <?= $this->Html->css('/assetdist/css/bootstrap.min.css') ?>
        <?= $this->Html->css('/assetdist/css/icons.css') ?>
        <?= $this->Html->css('/assetdist/css/style.css') ?>
        <?= $this->Html->script('/assetdist/js/modernizr.min.js'); ?>
        <!-- validate js -->
        <?= $this->Html->script('/assetdist/js/jquery.validate.min.js') ?>
        <?php $actionName = $this->request->getParam('action'); ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
//            var branch_id = '<?= $this->request->session()->read('Global.branch_id') ?>';
//            var org_id = '<?= $this->request->session()->read('Global.org_id') ?>';
//            var seller = '<?= $this->request->session()->read('Auth.User.id') ?>';
            var site_url = '<?= SITE_URL ?>';
            var action_name = '<?= $actionName ?>';
        </script>
    </head>


    <body class="">


        <!-- Begin page -->
      
                    <div class="">
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>

                    </div>
             



        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->

        <?= $this->Html->script('/assetdist/js/popper.min.js'); ?>
        <?= $this->Html->script('/assetdist/js/bootstrap.min.js'); ?>
        <?= $this->Html->script('/assetdist/js/detect.js'); ?>
        <?= $this->Html->script('/assetdist/js/fastclick.js'); ?>
        <?= $this->Html->script('/assetdist/js/jquery.slimscroll.js'); ?>
        <?= $this->Html->script('/assetdist/js/jquery.blockUI.js'); ?>
        <?= $this->Html->script('/assetdist/js/waves.js'); ?>
        <?= $this->Html->script('/assetdist/js/wow.min.js'); ?>
        <?= $this->Html->script('/assetdist/js/jquery.nicescroll.js'); ?>
        <?= $this->Html->script('/assetdist/js/jquery.scrollTo.min.js'); ?>
        <?= $this->Html->script('/assetdist/plugins/switchery/switchery.min.js'); ?>

        <!-- Counter Up  -->
        <?= $this->Html->script('/assetdist/plugins/waypoints/lib/jquery.waypoints.min.js'); ?>
        <?= $this->Html->script('/assetdist/plugins/counterup/jquery.counterup.min.js'); ?>

        <!-- circliful Chart -->

        <?= $this->Html->script('/assetdist/plugins/jquery-circliful/js/jquery.circliful.min.js'); ?>
        <?= $this->Html->script('/assetdist/plugins/jquery-sparkline/jquery.sparkline.min.js'); ?>
        <!-- skycons -->

        <?= $this->Html->script('/assetdist/plugins/skyicons/skycons.min.js'); ?>
        <!-- Page js  -->
        <?= $this->Html->script('/assetdist/pages/jquery.dashboard.js'); ?>


        <!-- Custom main Js -->
        <?= $this->Html->script('/assetdist/js/jquery.core.js'); ?>
        <?= $this->Html->script('/assetdist/js/jquery.app.js'); ?>

<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>



    </body>
</html>