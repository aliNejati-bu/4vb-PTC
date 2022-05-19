<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">پنل مدیریت</li>

                <li <?= $currentPage == "panel" ? "class='mm-active'" : "" ?>>
                    <a href="<?= route('panel') ?>" <?= $currentPage == "panel" ? "class='active'" : "" ?> >
                        <i class="fe-airplay"></i>
                        <span>داشبورد</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>