<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
 ?>
    <script>
        $(document).ready(function () {
            //  $.Notification.autoHideNotify('success', 'top right', 'เรียบร้อย', '<?= $message ?>');
            var successOptions = {
                autoHideDelay: 2000,
                showAnimation: "fadeIn",
                hideAnimation: "fadeOut",
                hideDuration: 700,
                arrowShow: false,
                className: "success",
            };
            $.notify("<?= $message ?>", successOptions);
        });




     

    </script>



