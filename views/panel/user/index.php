<!DOCTYPE html>
<html lang="fa">

<head>
    <?php require viewPath("panel>layout>heade")?>
</head>

<body>

<!-- Begin page -->
<div id="wrapper">


    <!-- Topbar Start -->
    <?php require viewPath("panel>layout>nav")?>
    <!-- end Topbar -->


    <!-- ========== Left Sidebar Start ========== -->
    <?php require viewPath("panel>sideMenu")?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?= route('panel') ?>">پنل</a></li>
                                    <li class="breadcrumb-item active">لیست کاربران</li>
                                </ol>
                            </div>
                            <h4 class="page-title">صفحه شروع (خالی)</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

            </div> <!-- end container-fluid -->

        </div> <!-- end content -->



        <!-- Footer Start -->
        <?php require viewPath("panel>layout>footer")?>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Vendor js -->
<script src="/assets/js/vendor.min.js"></script>

<!--C3 Chart-->
<script src="/assets/libs/d3/d3.min.js"></script>
<script src="/assets/libs/c3/c3.min.js"></script>

<script src="/assets/libs/echarts/echarts.min.js"></script>

<script src="/assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="/assets/js/app.min.js"></script>

</body>

</html>