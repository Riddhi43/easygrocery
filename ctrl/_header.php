<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="dashboard.php"><img src="img/logo/admin-logo.png" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav notika-top-nav mt-9">
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link">
                                <span>
                                    <?php
                                    $roles = GetXArrFromYID("SELECT id, title FROM user_role", 3);
                                    echo 'Hello ' . $sess_user_name;

                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <span>
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Header Top Area -->