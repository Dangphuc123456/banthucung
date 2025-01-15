<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin.css') }}">

    <title>ADMIN-PET-SHOP</title>

    <!-- Custom fonts for this template-->
    <link href="startbootstrap-sb-admin-2-4.1.4/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="startbootstrap-sb-admin-2-4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }

        .blinking-text {
            animation: blink 1s infinite;
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('Admin.components.slidebar')

        <div id="content-wrapper" class="d-flex flex-column">


            <div id="content">
                @include('Admin.components.navbar')

                <div class="container-fluid">
                    @yield('tile')
                    @yield('main')
                </div>
            </div>
            @include('Admin.components.footer')
        </div>
    </div>

    <script src="startbootstrap-sb-admin-2-4.1.4/vendor/jquery/jquery.min.js"></script>
    <script src="startbootstrap-sb-admin-2-4.1.4/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="startbootstrap-sb-admin-2-4.1.4/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="startbootstrap-sb-admin-2-4.1.4/js/sb-admin-2.min.js"></script>
    <script src="startbootstrap-sb-admin-2-4.1.4/vendor/chart.js/Chart.min.js"></script>
    <script src="startbootstrap-sb-admin-2-4.1.4/js/demo/chart-area-demo.js"></script>
    <script src="startbootstrap-sb-admin-2-4.1.4/js/demo/chart-pie-demo.js"></script>
</body>

</html>