<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= SITE_URL . 'home' ?>" class="waves-effect waves-primary"><i
                            class="ti-home"></i><span> Dashboard </span></a>
                </li>
                <li>
                    <a href="<?= SITE_URL . 'users' ?>" class="waves-effect waves-primary"><i
                            class="ti-user"></i><span> สมาชิก </span></a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-home"></i> <span> จัดการอสังหา </span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><?=$this->Html->link('รายการรออนุมัติ',['controller'=>'assets','action'=>'approve-request'])?></li>
                        <li><a href="<?= SITE_URL . 'assets' ?>">รายการอสังหาทั้งหมด</a></li>
                        <li><a href="<?= SITE_URL . 'asset-categories' ?>">ประเภทอสังหา</a></li>
                        <li><a href="<?= SITE_URL . 'options' ?>">ส่วนเสริม</a></li>


                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-layout-media-overlay-alt"></i> <span> จัดการ Banner </span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?= SITE_URL . 'banners' ?>">Banner ทั้งหมด</a></li>

                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-receipt"></i> <span> Invoice/Payment </span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="<?= SITE_URL . 'payments' ?>">รายการแจ้งชำระเงิน</a></li>
                        <li><a href="<?= SITE_URL . 'financial-accounts' ?>">วิธีการชำระเงิน</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= SITE_URL . 'packages' ?>" class="waves-effect waves-primary"><i
                            class="ti-package"></i><span> Package </span></a>
                </li>
                <li>
                    <a href="<?= SITE_URL . 'articles' ?>" class="waves-effect waves-primary"><i
                            class="ti-package"></i><span> บทความ </span></a>
                </li>
                <li>
                    <a href="#" class="waves-effect waves-primary"><i
                            class="ti-settings"></i><span> ตั้งค่าระบบ </span></a>
                </li>
                <li>
                    <a href="<?= SITE_URL . 'email-settings' ?>" class="waves-effect waves-primary"><i
                            class="ti-layout-cta-btn-right"></i><span> Email </span></a>
                </li>

            </ul>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>