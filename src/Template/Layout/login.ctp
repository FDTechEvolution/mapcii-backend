
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= PAGE_TITLE ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="FDTech" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />


        <?= $this->Html->script('/assetdist/js/jquery.min.js'); ?>
        <?= $this->Html->css('/assetdist/plugins/switchery/switchery.min.css') ?>
        <?= $this->Html->css('/assetdist/plugins/bootstrap-sweetalert/sweet-alert.css') ?>
        <?= $this->Html->css('/assetdist/plugins/jquery-circliful/css/jquery.circliful.css') ?>

        <?= $this->Html->css('/assetdist/css/bootstrap.min.css') ?>
        <?= $this->Html->css('/assetdist/css/icons.css') ?>
        <?= $this->Html->css('/assetdist/css/style.css') ?>
        <?= $this->Html->script('/assetdist/js/modernizr.min.js'); ?>
        <?php $actionName = $this->request->getParam('action'); ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>
    <body style="padding-bottom: 0px;">


        <div class="">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>

        </div>

        <script>


            $(document).ready(function () {
                $(window).bind("beforeunload", function () {
                    $('#page-load').show();
                });


                $('button[type="submit"]').click(function () {
                    //$(this).show();
                });
            });
        </script>
        <!-- validate js -->
        <?= $this->Html->script('/assetdist/js/jquery.validate.min.js') ?>
        <!-- Notification js -->
        <?= $this->Html->script('/assetdist/plugins/notifyjs/dist/notify.min.js'); ?>
        <?= $this->Html->script('/assetdist/plugins/notifications/notify-metro.js'); ?>
        <!-- Plugins  -->
        <?= $this->Html->script('/assetdist/plugins/bootstrap-sweetalert/sweet-alert.min.js'); ?>
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