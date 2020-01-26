<!-- Navbar-->
<header class="app-header ">
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="#" class="logo"><i class="mdi mdi-radar"></i> <span>MapCii</span></a>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">

                <li class="list-inline-item notification-list hide-phone">
                    <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
                        <i class="mdi mdi-crop-free noti-icon"></i>
                    </a>
                </li>

                <?php $userid = $this->request->getSession()->read('Auth.User.id') ?>



                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                           <?= 'Admin' ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                        <!-- item-->

                     

                        <!-- item-->


                        <!-- item-->
                        <?= $this->Html->link('<i class=" fa fa-key "></i>  <span>Change Password</span>', ['controller' => 'users', 'action' => 'changepassword', $userid],['class' => 'dropdown-item notify-item', 'escape' => false]) ?>
                        <?= $this->Html->link('<i class="mdi mdi-logout"></i> <span>Logout</span>', ['controller' => 'logout'], ['class' => 'dropdown-item notify-item', 'escape' => false]) ?>
                    </div>
                </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
                <li class="hide-phone app-search">
                    <form role="search" class="">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li>
            </ul>

        </nav>

    </div>
</header>
