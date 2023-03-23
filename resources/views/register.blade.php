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
                                                <h4 class="text-center mb-0">Registrasi</h4>
                                                <p class="text-center">Federasi Supra Indonesia Merchandise Order</p>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="form-horizontal mt-3" action="/register" method="POST">                               
                                                    @csrf
                                                    <div class="form-group mb-1 row">
                                                        <div class="col-12">
                                                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" required="" placeholder="Email">
                                                            @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                              </div>
                                                            @enderror
                                                        </div>                                   
                                                    </div>                                    
                        
                                                    <div class="form-group mb-1 row">
                                                        <div class="col-12">
                                                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" required="" placeholder="Password">
                                                            @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                              </div>
                                                            @enderror
                                                        </div>                                   
                                                    </div> 
                                                    
                                                    <div class="form-group mb-1 row">                               
                                                        <div class="col-md-6 captcha">
                                                            <span>{!! captcha_img('flat') !!}</span>
                                                            <button type="button" class="btn btn-warning" class="reload" id="reload">
                                                            &#x21bb;
                                                            </button>
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group mb-1 row">
                                                        <div class="col-12">
                                                            <input class="form-control @error('captcha') is-invalid @enderror" type="text" name="captcha" id="captcha" required="" placeholder="Ketikan Captcha">
                                                            @error('captcha')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                          </div>
                                                        @enderror
                                                        </div>                                    
                                                    </div> 
                        
                                                    <div class="form-group text-center row mt-3 pt-1">
                                                        <div class="col-12">
                                                            <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Daftar</button>
                                                        </div>
                                                    </div>
                        
                                                    <div class="form-group mt-2 mb-0 row">
                                                        <div class="col-12 mt-3 text-center">
                                                            <a href="/login" class="text-muted">Sudah memiliki akun?</a>
                                                        </div>
                                                    </div>
                                                </form>                                                                                                
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

    <script type="text/javascript">
            $('#reload').click(function () {
                $.ajax({
                    type: 'GET',
                    url: 'reload-captcha',
                    success: function (data) {
                        $(".captcha span").html(data.captcha);
                    }
                });
            });
        </script>

</body>
<!-- END: Body-->

</html>
