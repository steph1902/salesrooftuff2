<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ROOFTUFF SALES SYSTEM - SALES</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('sbadmin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <style>
        body
        {
            font-size: 0.7rem !important;
        }
    </style>

</head>
    
    {{-- <body id="page-top"> --}}
        <body id="page-top" class="sidebar-toggled sb-nav-fixed">
            {{-- <body class="sb-nav-fixed"> --}}


    
        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
               
    
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">SALES</div>
                </a>


                
    
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
    
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
    
                <!-- Divider -->
                <hr class="sidebar-divider">
    
                <!-- Heading -->
                <div class="sidebar-heading">
                    Data
                </div>


                {{-- <div class="container">
                    <div class="row">
                        <div class="col-md-12">                
                            <a href="{{ route('visits.showVisitedStoreData') }}">Cek daftar toko yang sudah di visit</a>
                        </div>
                        <div class="col-md-12">                
                            <a href="{{ url('sales-report/?bulan=10&tahun=2023') }}">Cek laporan toko yang sudah di visit</a>
                        </div>
                    </div>
                </div> --}}
    
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Data Toko</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Toko Sales:</h6>
                            <a class="collapse-item" href="{{ route('visits.showVisitedStoreData') }}">Lihat Data Kunjungan Toko</a>
                            <a class="collapse-item" href="{{ url('sales-report/?bulan=10&tahun=2023') }}">Cek Laporan Toko</a>
                            <hr>
                            <a class="collapse-item" href="{{ route('shops.create') }}">Tambah Data Toko</a>
                            <hr>
                            <a class="collapse-item" href="{{ route('update.password.form') }}">Ubah Password</a>                            
                            <hr>
                            {{-- <a class="collapse-item" href="{{ url('sales-report/?bulan=10&tahun=2023') }}">Logout</a> --}}
                            <a class="collapse-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </a>
                            
                        </div>
                    </div>
                </li>
                    
            </ul>
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
                        <!-- Sidebar Toggle (Topbar) -->
                        <form class="form-inline">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </form>
                    </nav>
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
    
                        {{-- main content --}}
                        @yield('content')
    
                    </div>
                    <!-- /.container-fluid -->
    
                </div>
                <!-- End of Main Content -->
    
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; ROOFTUFF SALES MONITORING SYSTEM</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
    
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
    
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    
       
    
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('sbadmin/vendor/jquery/jquery.min.js')}}"></script>        
        <script src="{{asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        
    
        <!-- Core plugin JavaScript-->
        <script src="{{asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>            
        <!-- Custom scripts for all pages-->
        <script src="{{asset('sbadmin/js/sb-admin-2.min.js')}}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHo6LKAyX7jDR0zB7IpbhaId6itpjCP-Y&libraries=places"></script>

            

<script>
    $(document).ready(function() {
      $('#sidebarToggle').on('click', function() {
        $('body').toggleClass('sb-sidenav-toggled');
        $('.sb-sidenav').toggleClass('collapsed');
      });
    });
  </script>


<script src="{{asset('sbadmin/vendor/jquery/jquery.min.js')}}"></script>    
<script src="{{asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('sbadmin/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('sbadmin/js/demo/datatables-demo.js')}}"></script>
  
        
    
    </body>
    
    </html>