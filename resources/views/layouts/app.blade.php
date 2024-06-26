 @include('layouts.header')

 <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

     @include('layouts.topbar')

     <!-- ========== Left Sidebar Start ========== -->
     <div class="left-side-menu">

         <div class="h-100" data-simplebar>

             <!-- User box -->
             <div class="user-box text-center">
                 <img src="../assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
                 <div class="dropdown">
                     <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Geneva Kennedy</a>
                     <div class="dropdown-menu user-pro-dropdown">

                         <!-- item-->
                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                             <i class="fe-user mr-1"></i>
                             <span>My Account</span>
                         </a>

                         <!-- item-->
                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                             <i class="fe-settings mr-1"></i>
                             <span>Settings</span>
                         </a>

                         <!-- item-->
                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                             <i class="fe-lock mr-1"></i>
                             <span>Lock Screen</span>
                         </a>

                         <!-- item-->
                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                             <i class="fe-log-out mr-1"></i>
                             <span>Logout</span>
                         </a>

                     </div>
                 </div>
                 <p class="text-muted">Admin Head</p>
             </div>

             @include('layouts.menu')
             <!-- End Sidebar -->

             <div class="clearfix"></div>

         </div>
         <!-- Sidebar -left -->

     </div>
     <!-- Left Sidebar End -->

     <!-- ============================================================== -->
     <!-- Start Page Content here -->
     <!-- ============================================================== -->

     <div class="content-page">
         @yield('content')

         <!-- Footer Start -->
         @include('layouts.footer')

         <!-- ============================================================== -->
         <!-- End Page content -->
         <!-- ============================================================== -->


         <!-- END wrapper -->

         <!-- Right Sidebar -->
         @include('layouts.right_sidebar')
         @include('sweetalert::alert')

         <!-- Right bar overlay-->
         <div class="rightbar-overlay"></div>

         <script src="{{ asset('/sw.js') }}"></script>
         <script>
             if ("serviceWorker" in navigator) {
                 // Register a service worker hosted at the root of the
                 // site using the default scope.
                 navigator.serviceWorker.register("/sw.js").then(
                     (registration) => {
                         console.log("Service worker registration succeeded:", registration);
                     },
                     (error) => {
                         console.error(`Service worker registration failed: ${error}`);
                     },
                 );
             } else {
                 console.error("Service workers are not supported.");
             }
         </script>

         <!-- Vendor js -->
         <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

         <!-- third party js -->
         <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
         <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
         <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
         <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
         <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
         <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
         <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
         <script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
         <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
         <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
         <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
         <!-- third party js ends -->

         <!-- Datatables init -->
         <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

         <!-- Plugins js-->
         <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
         <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

         <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>

         <!-- Dashboar 1 init js-->
         <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>
         <script src="{{ asset('assets/validator/validator.min.js') }}"> </script>

         <!-- App js-->
         <script src="{{ asset('assets/js/app.min.js') }}"></script>
         <script src="{{ asset('assets/js/support_app.js') }}"></script>
         <script src="{{ asset('assets/js/fetchData.js') }}"></script>
         <script src="{{ asset('assets/js/fetchDataUser.js') }}"></script>
         <script src="{{ asset('assets/js/fetchDataKaryawan.js') }}"></script>

         <!-- plugin js -->
         <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
         <script src="{{ asset('assets/libs/@fullcalendar/core/main.min.js') }}"></script>
         <script src="{{ asset('assets/libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
         <script src="{{ asset('assets/libs/@fullcalendar/daygrid/main.min.js') }}"></script>
         <script src="{{ asset('assets/libs/@fullcalendar/timegrid/main.min.js') }}"></script>
         <script src="{{ asset('assets/libs/@fullcalendar/list/main.min.js') }}"></script>
         <script src="{{ asset('assets/libs/@fullcalendar/interaction/main.min.js') }}"></script>

         <!-- Calendar init -->
         <script src="{{ asset('assets/js/pages/calendar.init.js') }}"></script>
         <!-- Wizard Form -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
         <script>
             $(document).ready(function() {
                 $('#example').DataTable({
                     dom: 'Bfrtip',
                     buttons: [
                         'excel', 'pdf', 'print'
                     ]
                 });
             });
             @section('js')
         </script>
         @show

         @stack('js')
 </body>

 </html>