<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <?php
                        if (!empty($menu)) {
                            echo '<ul class="mobile-menu-nav">';

                            foreach ($menu as $_marr) {
                                $title = $_marr['title'];
                                $link = $_marr['link'];
                                $icon = $_marr['icon'];
                                $has_dropdown = $_marr['has_dropdown'];
                                $dropdown = isset($_marr['dropdown']) ? $_marr['dropdown'] : array();
                                $urls = isset($_marr['URLS']) ? $_marr['URLS'] : array();

                                echo '<li>';
                                echo '<a data-toggle="collapse" data-target="#Charts" href="' . $link . '">' . $title . '</a>';

                                if ($has_dropdown == 'Y' && !empty($dropdown)) {

                                    echo '<ul class="collapse dropdown-header-top">';
                                    echo '<a class="mean-expand mean-clicked" href="#" style="font-size: 18px">-</a>';

                                    foreach ($dropdown as $_marr2) {
                                        $sub_title = $_marr2['title'];
                                        $sub_link = $_marr2['link'];
                                        $sub_icon = $_marr2['icon'];

                                        echo '<li><a href="' . $sub_link . '">' . $sub_title . '</a></li>';
                                    }

                                    echo '</ul>';
                                }

                                echo '</li>';
                            }

                            echo '</ul>';
                        }
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                if (!empty($menu)) {
                    echo '<ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">';
                    foreach ($menu as $_marr) {
                        $title = $_marr['title'];
                        $link = $_marr['link'];
                        $icon = $_marr['icon'];
                        $has_dropdown = $_marr['has_dropdown'];
                        $dropdown = isset($_marr['dropdown']) ? $_marr['dropdown'] : array();
                        $urls = isset($_marr['URLS']) ? $_marr['URLS'] : array();
                        $tab_name = "tab-" . GetUrlName($title);

                        // active
                        $m_active = ($fname == $link || in_array($fname, $urls)) ? "active" : "";
                        echo '<li class="' . $m_active . '">';

                        if ($has_dropdown == "Y") {
                            echo '<a data-toggle="tab" href="#' . $tab_name . '">' . $icon . $title . '</a>';
                        } else {
                            echo '<a href="' . $link . '">' . $icon . $title . '</a>';
                        }

                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '<div class="tab-content custom-menu-content">';

                    foreach ($menu as $_marr) {
                        $title = $_marr['title'];
                        $link = $_marr['link'];
                        $has_dropdown = $_marr['has_dropdown'];
                        $dropdown = isset($_marr['dropdown']) ? $_marr['dropdown'] : array();
                        $urls = isset($_marr['URLS']) ? $_marr['URLS'] : array();
                        $tab_name = "tab-" . GetUrlName($title);

                        if ($has_dropdown == 'Y' && !empty($dropdown)) {
                            $m_subactive = ($fname == $link || in_array($fname, $urls)) ? "active" : "";
                            echo '<div id="' . $tab_name . '" class="tab-pane in ' . $m_subactive . ' notika-tab-menu-bg animated flipInX">';
                            echo '<ul class="notika-main-menu-dropdown">';

                            foreach ($dropdown as $_marr2) {
                                $sub_title = $_marr2['title'];
                                $sub_link = $_marr2['link'];
                                $sub_icon = $_marr2['icon'];
                                echo '<li>';
                                echo '<a href="' . $sub_link . '">' . $sub_title . '</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Main Menu area End-->