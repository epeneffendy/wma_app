<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
    <head>
        <meta charset="utf-8" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Dashboard - Analytics | Materio - Bootstrap Material Design Admin Template</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />
        @includeIf('layouts.admin.partials.css')
        @yield('styles')
    </head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- main-sidebar -->
			@includeIf('layouts.admin.partials.sidebar-layout')
			<!-- main-sidebar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- main-header -->
                @includeIf('layouts.admin.partials.header-layout')
                <!-- /main-header -->

                <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl">
                    <div
                    class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                    <div class="text-body mb-2 mb-md-0">
                        ©
                        <script>
                        document.write(new Date().getFullYear());
                        </script>
                        , made with <span class="text-danger"><i class="tf-icons mdi mdi-heart"></i></span> by
                        <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium"
                        >ThemeSelection</a
                        >
                    </div>
                    <div class="d-none d-lg-inline-block">
                        <a href="https://themeselection.com/license/" class="footer-link me-3" target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-3">More Themes</a>

                        <a
                        href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/"
                        target="_blank"
                        class="footer-link me-3"
                        >Documentation</a
                        >

                        <a
                        href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free/issues"
                        target="_blank"
                        class="footer-link me-3"
                        >Support</a
                        >
                    </div>
                    </div>
                </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->

        </div>
    </div>
    @includeIf('layouts.admin.partials.js')
    @yield('scripts')
</body>



