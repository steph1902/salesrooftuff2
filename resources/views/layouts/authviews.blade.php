<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{asset('sbadmin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <style>
        body
        {
            font-size: 0.7rem !important;
        }
    </style>

</head>
    

        <body id="page-top" class="sidebar-toggled sb-nav-fixed">
    
        <div id="wrapper" class="container d-flex align-items-center justify-content-center" style="height: 100vh;">        
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <div class="container-fluid">
                        @yield('content')    
                    </div>                    
                </div>
                
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; ROOFTUFF SALES MONITORING SYSTEM</span>
                        </div>
                    </div>
                </footer>                
            </div>            
        </div>
                
        <script src="{{asset('sbadmin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>                    
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
  
        
    
    </body>
    
    </html>