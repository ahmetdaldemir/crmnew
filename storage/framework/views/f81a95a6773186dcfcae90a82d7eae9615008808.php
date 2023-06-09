<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content=""/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.ico')); ?>"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/fonts/boxicons.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/core.css')); ?>" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/theme-default.css')); ?>" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/demo.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/apex-charts/apex-charts.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/sweetalert2/sweetalert2.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/select2/select2.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/tagify/tagify.css')); ?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-message-box@3.2.2/dist/messagebox.min.css"/>
    <script src="<?php echo e(asset('assets/vendor/js/helpers.js')); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-sanitize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-utils/0.1.1/angular-ui-utils.min.js" class=""></script>
    <script> var app = angular.module("app", ['ngSanitize']);
        app.filter('unsafe', function ($sce) {
            return $sce.trustAsHtml;
        });
    </script>
    <script src="<?php echo e(asset('assets/js/config.js')); ?>"></script>
    <?php echo $__env->yieldContent('custom-css'); ?>
</head>

<body ng-app="app" ng-controller="mainController">
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
<?php echo $__env->make('layouts.components.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="layout-page">
            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar"
            >
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                                type="text"
                                class="form-control border-0 shadow-none"
                                placeholder="Arama..."
                                aria-label="Arama..."
                            />
                        </div>
                    </div>
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->
                        <li class="nav-item lh-1 me-3">
                            <a
                                class="github-button"
                                href="https://github.com/themeselection/sneat-html-admin-template-free"
                                data-icon="octicon-star"
                                data-size="large"
                                data-show-count="true"
                                aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                            ><?php echo e(\Carbon\Carbon::now()); ?></a
                            >
                        </li>

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                               data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle"/>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="../assets/img/avatars/1.png" alt
                                                         class="w-px-40 h-auto rounded-circle"/>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block"><?php echo e(\Illuminate\Support\Facades\Auth::user()->name); ?></span>
                                                <small class="text-muted"><?php echo e(\Illuminate\Support\Facades\Auth::user()->getRoleNames()); ?></small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('settings.index')); ?>">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>
            <div class="content-wrapper">
                <?php echo $__env->yieldContent('content'); ?>
                <?php echo $__env->make('layouts.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?php echo e(asset('assets/vendor/libs/jquery/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/popper/popper.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/js/bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/js/menu.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/sweetalert2/sweetalert2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/i18n.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/cleave/cleave.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/cleave/cleave-phone.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/tagify/tagify.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-message-box@3.2.2/dist/messagebox.min.js"></script>
<?php echo $__env->yieldContent('custom-js'); ?>

<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/forms-selects.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dashboards-analytics.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/forms-tagify.js')); ?>"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
<?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/layouts/admin.blade.php ENDPATH**/ ?>