<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
	 <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>@yield('pageTitle')</title>

	<!-- Site Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/site/' . (settings()->site_favicon ?? 'default-favicon.png')) }}">
    <!-- Custom fonts for this template-->
    <link href="{{asset('sb2/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
	<!-- THIS STYLE FOR TESTING -->
	<link rel="stylesheet" href="{{ asset('back/custom/style.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendors/styles/core.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendors/styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('extra-assets/jquery-ui-1.14.0/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('extra-assets/jquery-ui-1.14.0/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('extra-assets/jquery-ui-1.14.0/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('extra-assets/ijabo/css/ijabo.min.css') }}">
		<!-- og -->
    <link rel="stylesheet" href="{{ asset('back/custom/style.css') }}">
	 <link rel="stylesheet" href="{{ asset('back/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('extra-assets/ijabo/css/ijabo.min.css') }}">
    <!-- Custom styles for this template-->
    <link href="{{asset('sb2/css/sb-admin-2.min.css')}}" rel="stylesheet">
	 <!-- Additional Styles -->
    @stack('stylesheets')
    @stack('styles')
    @kropifyStyles

</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
			<div class="sidebar-brand-icon">
				<img 
					src="/images/site/{{ settings()->site_logo ? settings()->site_logo : 'default-logo.jpg' }}" 
					alt="Site Logo" 
					class="site-logo"
					style="height: 40px; width: auto;"
				/>
			</div>
		</a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            @if(auth()->user()->type == 'superAdmin')
    <li class="nav-item {{ request()->routeIs('admin.list_inventory', 'admin.create_inventory') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory"
           aria-expanded="{{ request()->routeIs('admin.list_inventory', 'admin.create_inventory') ? 'true' : 'false' }}" 
           aria-controls="collapseInventory">
            <i class="fas fa-fw fa-cogs"></i> <!-- Inventory icon -->
            <span>Inventory Management</span>
        </a>
        <div id="collapseInventory" class="collapse {{ request()->routeIs('admin.list_inventory', 'admin.create_inventory') ? 'show' : '' }}"
             aria-labelledby="headingInventory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Inventory:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.list_inventory') ? 'active' : '' }}" 
                   href="{{ route('admin.list_inventory') }}">View Products</a>
                <a class="collapse-item {{ request()->routeIs('admin.create_inventory') ? 'active' : '' }}" 
                   href="{{ route('admin.create_inventory') }}">Add Product</a>
            </div>
        </div>
    </li>


                
                <!-- Nav Item - Manage Users Collapse Menu -->
                <li class="nav-item {{ request()->routeIs('admin.register-users') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                        aria-expanded="{{ request()->routeIs('admin.register-users') ? 'true' : 'false' }}" aria-controls="collapseUsers">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Manage Users</span>
                    </a>
                    <div id="collapseUsers" class="collapse {{ request()->routeIs('admin.register-users') ? 'show' : '' }}" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Users:</h6>
                            <a class="collapse-item {{ request()->routeIs('admin.register-users') ? 'active' : '' }}" href="{{ route('admin.register-users') }}">Register Users</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Manage Doctors Collapse Menu -->
                <li class="nav-item {{ request()->routeIs('admin.create-doctor', 'admin.list-doctors') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDoctors"
                        aria-expanded="{{ request()->routeIs('admin.create-doctor', 'admin.list-doctors') ? 'true' : 'false' }}" aria-controls="collapseDoctors">
                        <i class="fas fa-fw fa-user-md"></i>
                        <span>Manage Doctors</span>
                    </a>
                    <div id="collapseDoctors" class="collapse {{ request()->routeIs('admin.create-doctor', 'admin.list-doctors') ? 'show' : '' }}" aria-labelledby="headingDoctors" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Doctors:</h6>
                            <a class="collapse-item {{ request()->routeIs('admin.create-doctor') ? 'active' : '' }}" href="{{ route('admin.create-doctor') }}">Add Doctor</a>
                            <a class="collapse-item {{ request()->routeIs('admin.list-doctors') ? 'active' : '' }}" href="{{ route('admin.list-doctors') }}">All Doctors</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Manage Receptionist Collapse Menu -->
                <li class="nav-item {{ request()->routeIs('admin.create-receptionist', 'admin.list-receptionist') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReceptionist"
                        aria-expanded="{{ request()->routeIs('admin.create-receptionist', 'admin.list-receptionist') ? 'true' : 'false' }}" aria-controls="collapseReceptionist">
                        <i class="fas fa-fw fa-user-tie"></i>
                        <span>Manage Receptionist</span>
                    </a>
                    <div id="collapseReceptionist" class="collapse {{ request()->routeIs('admin.create-receptionist', 'admin.list-receptionist') ? 'show' : '' }}" aria-labelledby="headingReceptionist" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Receptionist:</h6>
                            <a class="collapse-item {{ request()->routeIs('admin.create-receptionist') ? 'active' : '' }}" href="{{ route('admin.create-receptionist') }}">Add Receptionist</a>
                            <a class="collapse-item {{ request()->routeIs('admin.list-receptionist') ? 'active' : '' }}" href="{{ route('admin.list-receptionist') }}">All Receptionists</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Manage Payment Collapse Menu -->
                <li class="nav-item {{ request()->routeIs('admin.payment-records') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayment"
                        aria-expanded="{{ request()->routeIs('admin.payment-records') ? 'true' : 'false' }}" aria-controls="collapsePayment">
                        <i class="fas fa-fw fa-credit-card"></i>
                        <span>Manage Payment</span>
                    </a>
                    <div id="collapsePayment" class="collapse {{ request()->routeIs('admin.payment-records') ? 'show' : '' }}" aria-labelledby="headingPayment" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Payments:</h6>
                            <a class="collapse-item {{ request()->routeIs('admin.payment-records') ? 'active' : '' }}" href="{{ route('admin.payment-records') }}">Payment Records</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Manage Fee & Medicals Collapse Menu -->
                <li class="nav-item {{ Request::is('admin/registration-fee*') || Request::is('admin/create-medicals*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFeeMedicals"
                        aria-expanded="{{ Request::is('admin/registration-fee*') || Request::is('admin/create-medicals*') ? 'true' : 'false' }}"
                        aria-controls="collapseFeeMedicals">
                        <i class="fas fa-fw fa-dollar-sign"></i>
                        <span>Manage Fee & Medicals</span>
                    </a>
                    <div id="collapseFeeMedicals" class="collapse {{ Request::is('admin/registration-fee*') || Request::is('admin/create-medicals*') ? 'show' : '' }}"
                        aria-labelledby="headingFeeMedicals" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Medicals & Fee:</h6>
                            <a class="collapse-item {{ Request::is('admin/registration-fee') ? 'active' : '' }}" href="{{ route('admin.registration-fee') }}">Add Fee</a>
                            <a class="collapse-item {{ Request::is('admin/create-medicals') ? 'active' : '' }}" href="{{ route('admin.create-medicals') }}">Medical</a>
                        </div>
                    </div>
                </li>
            @endif

        @if(auth()->user()->type == 'receptionist' || auth()->user()->type == 'doctor')
                <li class="nav-item {{ Request::is('admin/create-patient') || Request::is('admin/list-patients') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="{{ Request::is('admin/create-patient') || Request::is('admin/list-patients') ? 'true' : 'false' }}"
                        aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-user-injured"></i> 
                        <span>Manage Patients</span>
                    </a>
                    <div id="collapseUtilities" class="collapse {{ Request::is('admin/create-patient') || Request::is('admin/list-patients') ? 'show' : '' }}"
                        aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Patients:</h6>
                            @if(auth()->user()->type == 'receptionist')
                                <a class="collapse-item {{ Request::is('admin/create-patient') ? 'active' : '' }}" href="{{ route('admin.create-patient') }}">Register Patient</a>
                            @endif
                            <a class="collapse-item {{ Request::is('admin/list-patients') ? 'active' : '' }}" href="{{ route('admin.list-patients') }}">All Patients</a>
                        </div>
                    </div>
                </li>
            @endif
            @if(auth()->user()->type == 'doctor')
            <!-- Manage Appointments -->
            <li class="nav-item {{ Request::is('admin/list-appointment') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppointments"
                    aria-expanded="{{ Request::is('admin/list-appointment') ? 'true' : 'false' }}"
                    aria-controls="collapseAppointments">
                    <i class="fas fa-fw fa-calendar-check"></i> 
                    <span>Manage Appointments</span>
                </a>
                <div id="collapseAppointments" class="collapse {{ Request::is('admin/list-appointment') ? 'show' : '' }}"
                    aria-labelledby="headingAppointments" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Appointments:</h6>
                        <a class="collapse-item {{ Request::is('admin/list-appointment') ? 'active' : '' }}" href="{{ route('admin.list-appointment') }}">All Appointments</a>
                    </div>
                </div>
            </li>

            <!-- Manage Diagnoses -->
            <li class="nav-item {{ Request::is('admin/list-diagnosis') || Request::is('admin/add-diagnosis') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDiagnoses"
                    aria-expanded="{{ Request::is('admin/list-diagnosis') || Request::is('admin/add-diagnosis') ? 'true' : 'false' }}"
                    aria-controls="collapseDiagnoses">
                    <i class="fas fa-fw fa-stethoscope"></i> 
                    <span>Manage Diagnoses</span>
                </a>
                <div id="collapseDiagnoses" class="collapse {{ Request::is('admin/list-diagnosis') || Request::is('admin/add-diagnosis') ? 'show' : '' }}"
                    aria-labelledby="headingDiagnoses" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Diagnoses:</h6>
                        <a class="collapse-item {{ Request::is('admin/add-diagnosis') ? 'active' : '' }}" href="#">Add Diagnosis</a>
                        <a class="collapse-item {{ Request::is('admin/list-diagnosis') ? 'active' : '' }}" href="{{ route('admin.list-diagnosis') }}">All Diagnoses</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->type == 'doctor' || auth()->user()->type == 'receptionist')
        <li class="nav-item {{ Request::is('admin/create-prescriptions') || Request::is('admin/list-prescriptions') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePrescriptions"
                aria-expanded="{{ Request::is('admin/create-prescriptions') || Request::is('admin/list-prescriptions') ? 'true' : 'false' }}"
                aria-controls="collapsePrescriptions">
                <i class="fas fa-fw fa-pills"></i> 
                <span>Manage Prescriptions</span>
            </a>
            <div id="collapsePrescriptions" class="collapse {{ Request::is('admin/prescriptions/create') || Request::is('admin/prescriptions') ? 'show' : '' }}"
                aria-labelledby="headingPrescriptions" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Prescriptions:</h6>
                    @if(auth()->user()->type == 'doctor')
                        <a class="collapse-item {{ Request::is('admin/prescriptions/create') ? 'active' : '' }}" href="{{ route('admin.create-prescriptions') }}">Add Prescription</a>
                    @endif
                    <a class="collapse-item {{ Request::is('admin/prescriptions') ? 'active' : '' }}" href="{{ route('admin.list-prescriptions') }}">All Prescriptions</a>
                </div>
            </div>
        </li>
    @endif

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Settings
            </div>
            @if(auth()->user()->type == 'superAdmin')
            <li class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.settings') }}">
                    <i class="fas fa-fw fa-cogs"></i> <!-- Icon for settings (gears) -->
                    <span>General Settings</span>
                </a>
            </li>
        @endif

        <li class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.profile') }}">
                <i class="fas fa-fw fa-user"></i> <!-- Icon for profile -->
                <span>Profile</span>
            </a>
        </li>

</li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

          

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span id="notification-badge" class="badge badge-danger badge-counter"></span>
                        </a>
                        <!-- Dropdown - Alerts -->
                         @if(auth()->user()->type == 'doctor' || auth()->user()->type == 'superAdin' )
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <div class="notification-list mx-h-350 customscroll">
                                <ul id="notification-list" class="list-unstyled">
                                    <!-- Notifications will be dynamically loaded here -->
                                </ul>
                            </div>
                            <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.list-patients') }}">
                                Show All Alerts
                            </a>
                        </div>
                        @endif
                    </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
						 <!-- User Info -->
						 @livewire('admin.top-user-info')
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                  
				<div class="">
                    @yield("content")
                 </div>
                   
				 <div class="footer-wrap pd-20 mb-20 card-box">
					&copy copyright 2024 Hospital. All right reserved
					<a href="#" target="_blank"
						>jonascoder</a
					>
                </div>
                <!-- /.container-fluid -->

				 <!-- Footer -->
				 
            <!-- End of Footer -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

	<!-- Logout Modal -->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary" type="button" onclick="document.getElementById('logout-form').submit();">
						Logout
					</button>
				</div>
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('sb2/vendor/jquery/jquery.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('sb2/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('sb2/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('sb2/vendor/chart.js/Chart.min.js')}}"></script>
    

    <!-- Page level custom scripts -->
    <script src="{{ asset('back/vendors/scripts/core.js') }}"></script>

	
	<script src="{{asset('back/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<!-- buttons for Export datatable -->
	<script src="{{asset('back/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('back/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
    @stack('scripts')
	@kropifyScripts
	<script>

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    window.addEventListener('showToastr', function (event) {
        const notification = event.detail[0];
        if (notification && notification.type && notification.message) {
            const notif = document.createElement('div');
            notif.innerText = notification.message;
            notif.style.position = 'fixed';
            notif.style.top = '20px';
            notif.style.left = '50%';
            notif.style.transform = 'translateX(-50%)';
            notif.style.padding = '10px 20px';
            notif.style.backgroundColor = notification.type === 'success' ? 'green' : 'red';
            notif.style.color = 'white';
            notif.style.borderRadius = '5px';
            notif.style.zIndex = '1000';
            notif.style.fontFamily = 'Arial, sans-serif';
            notif.style.fontSize = '16px';
            notif.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';

            document.body.appendChild(notif);

            setTimeout(() => {
                document.body.removeChild(notif);
            }, 3000);
        } else {
            console.error("Invalid notification data:", notification);
        }
    });

    function fetchNotifications() {
    fetch('{{ route("admin.notifications.fetch") }}')
        .then(response => response.json())
        .then(data => {
            const notificationList = document.getElementById('notification-list');
            const notificationBadge = document.getElementById('notification-badge');

            // Clear previous notifications
            notificationList.innerHTML = '';

            if (data.length > 0) {
                // Update badge with the number of notifications
                notificationBadge.textContent = data.length;
                notificationBadge.style.display = 'inline-block';

                // Populate notifications in the dropdown
                data.forEach(notification => {
                    const listItem = document.createElement('li');
                    listItem.className = 'dropdown-item d-flex align-items-center';
                    listItem.innerHTML = `
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">
                                ${new Date(notification.created_at).toLocaleString()}
                            </div>
                            <a href="#" class="mark-as-read" data-id="${notification.id}">
                                ${notification.message}
                            </a>
                        </div>
                    `;
                    notificationList.appendChild(listItem);
                });

                // Add event listener for marking notifications as read
                document.querySelectorAll('.mark-as-read').forEach(item => {
                    item.addEventListener('click', function (e) {
                        e.preventDefault();
                        const notificationId = this.getAttribute('data-id');

                        fetch(`{{ url('/notifications/') }}/${notificationId}/mark-as-read`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.href = data.redirect_url;
                                }
                            })
                            .catch(error => console.error('Error marking notification as read:', error));
                    });
                });
            } else {
                // Hide badge and show "no notifications" message
                notificationBadge.style.display = 'none';
                notificationList.innerHTML = `
                    <li class="text-center small text-gray-500">
                        No new notifications
                    </li>
                `;
            }
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

// Initialize notifications on page load
document.addEventListener('DOMContentLoaded', fetchNotifications);
// Periodically fetch notifications every minute
setInterval(fetchNotifications, 60000);



   

</script>

</body>
</html>