<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ $Settings->name }} - Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/vendors.min.css">
    
    @stack('page_vendor_css')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
   

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/assets/css/style.css">
    <!-- END: Custom CSS-->
    {{-- <link rel="shortcut icon" href="{{ image_or_placeholder($Settings->favicon_full_path) }}" /> --}}
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css-rtl/custom-rtl.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/assets/css/style-rtl.css">

    @stack('page_styles')

    <style>
        * {
            font-family: 'Cairo', sans-serif;
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('dashboard.layouts.inc.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('dashboard.layouts.inc.main_menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
				@yield('route')					

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-body"> {{ $error }} </div>
                        </div>
                       
                    @endforeach
                @endif

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <div class="alert-body"> {{ session('success') }} </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-body"> {{ session('error') }} </div>
                    </div>
                @endif  

                @yield('content')
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    
    <!-- BEGIN: Footer-->
    @include('dashboard.layouts.inc.footer')
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    @stack('page_scripts_vendors')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @stack('page_scripts')
    <!-- END: Page JS-->

    <script>
        $(document).ready(function() {
            $('.but_delete_action').click(function( event ) {
                if (confirm('هل أنت متأكد من حذف هذا العنصر؟')) {
                    var deleteId = $(this).data('delete');
                    document.getElementById(deleteId).submit();
                }
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $('.but_update_action').click(function( event ) {
            var updateId = $(this).data('update');
            document.getElementById(updateId).submit();
        });
    });
</script>
    <script>
        $(document).ready(function() {
            @if (auth()->guard('web')->user()->dark_mode)
                $('html').removeClass('loading').addClass('loaded dark-layout');
            @else
                $('html').removeClass('loading').addClass('loaded light-layout');
            @endif
           
        });
    </script>
    
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

<script>
    $(document).ready(function() {
        $('#dark_mode').on("click", function() {
            $.ajax({
                url: "{{ route('dashboard.profile.dark-mode-update') }}",
                method: 'GET',
                data: {},
                success: function(data) {
                    // console.log(data);
                }
            });
        });
    });
</script>
    

</body>
<!-- END: Body-->

</html>