<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description"
        content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Halaman Login </title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/favicon-32x32.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon2.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
    class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div
                                        class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-0">Selamat Datang</h4>
                                                <p class="text-center">Federasi Supra Indonesia Merchandise Order</p>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                @if (session()->has('success'))
                                                    <div class="alert border-primary alert-dismissible mb-2"
                                                        role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="d-flex align-items-center">
                                                            <i class="bx bx-star"></i>
                                                            <span>
                                                                {{ session('success') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (session()->has('LoginError'))
                                                <div class="alert border-danger alert-dismissible mb-2"
                                                role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="d-flex align-items-center">
                                                    <i class="bx bxs-error-circle"></i>
                                                    <span>
                                                        {{ session('LoginError') }}
                                                    </span>
                                                </div>
                                            </div>
                                                @endif

                                                <form action="/login" method="POST">
                                                    @csrf
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" for="exampleInputEmail1">Email
                                                            address</label>
                                                        <input class="form-control @error('email') is-invalid @enderror"
                                                            type="email" name="email" id="email" required=""
                                                            placeholder="Email" autofocus>
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600"
                                                            for="exampleInputPassword1">Password</label>
                                                        <input
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            type="password" name="password" id="password"
                                                            required="" placeholder="Password">
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div
                                                        class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                        <div class="text-left">
                                                            <div class="checkbox checkbox-sm">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="exampleCheck1">
                                                                <label class="checkboxsmall"
                                                                    for="exampleCheck1"><small>Keep me logged
                                                                        in</small></label>
                                                            </div>
                                                        </div>
                                                        <div class="text-right"><a href="auth-forgot-password.html"
                                                                class="card-link"><small>Forgot Password?</small></a>
                                                        </div>
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-primary glow w-100 position-relative">Login<i
                                                            id="icon-arrow"
                                                            class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                                <hr>
                                                <div class="text-center"><small class="mr-25">Don't have an
                                                        account?</small><a href="register"><small>Sign
                                                            up</small></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div class="card-content">
                                        <img class="img-fluid" src="/app-assets/images/pages/3582346.jpg"
                                            alt="branding logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/scripts/configs/vertical-menu-light.js"></script>
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <script src="/app-assets/js/scripts/components.js"></script>
    <script src="/app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
