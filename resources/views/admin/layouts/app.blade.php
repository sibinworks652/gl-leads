<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>GL Infotech</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="A fully responsive premium admin dashboard template" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <!-- App favicon -->
     <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

     <!-- Vendor css (Require in all Page) -->
     <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />


     <!-- Theme Config js (Require in all Page) -->
     <script src="{{ asset('assets/js/config.js') }}"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    *{
        font-family: 'Inter', sans-serif;
    }
    </style>
<body>

     <!-- START Wrapper -->
     <div class="wrapper">

          <header class="topbar">
               <div class="container-fluid">
                    <div class="navbar-header">
                         <div class="d-flex align-items-center">
                              <!-- Menu Toggle Button -->
                              <div class="topbar-item">
                                   <button type="button" class="button-toggle-menu me-2">
                                        <iconify-icon icon="solar:hamburger-menu-broken"
                                             class="fs-24 align-middle"></iconify-icon>
                                   </button>
                              </div>

                              <!-- Menu Toggle Button -->
                              <div class="topbar-item">
                                   <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">
                                        {{ $subTitle ?? '' }}
                                   </h4>
                              </div>
                         </div>

                         <div class="d-flex align-items-center gap-1">

                              <!-- Notification -->
                              <div class="dropdown topbar-item">
                                   <button type="button" class="topbar-button position-relative"
                                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <iconify-icon icon="solar:bell-bing-bold-duotone"
                                             class="fs-24 align-middle"></iconify-icon>
                                        <span
                                             class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">3<span
                                                  class="visually-hidden">unread messages</span></span>
                                   </button>
                                   <div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end"
                                        aria-labelledby="page-header-notifications-dropdown">
                                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                             <div class="row align-items-center">
                                                  <div class="col">
                                                       <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                                                  </div>
                                                  <div class="col-auto">
                                                       <a href="javascript: void(0);"
                                                            class="text-dark text-decoration-underline">
                                                            <small>Clear All</small>
                                                       </a>
                                                  </div>
                                             </div>
                                        </div>
                                        <div data-simplebar style="max-height: 280px;">
                                             <!-- Item -->
                                             <a href="javascript:void(0);"
                                                  class="dropdown-item py-3 border-bottom text-wrap">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                                 class="img-fluid me-2 avatar-sm rounded-circle"
                                                                 alt="avatar-1" />
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0"><span class="fw-medium">Josephine Thompson
                                                                 </span>commented on admin panel <span>" Wow 😍! this
                                                                      admin looks good and awesome design"</span></p>
                                                       </div>
                                                  </div>
                                             </a>
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <div class="avatar-sm me-2">
                                                                 <span
                                                                      class="avatar-title bg-soft-info text-info fs-20 rounded-circle">
                                                                      D
                                                                 </span>
                                                            </div>
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0 fw-semibold">Donoghue Susan</p>
                                                            <p class="mb-0 text-wrap">
                                                                 Hi, How are you? What about our next meeting
                                                            </p>
                                                       </div>
                                                  </div>
                                             </a>
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                                                 class="img-fluid me-2 avatar-sm rounded-circle"
                                                                 alt="avatar-3" />
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0 fw-semibold">Jacob Gines</p>
                                                            <p class="mb-0 text-wrap">Answered to your comment on the
                                                                 cash flow forecast's graph 🔔.</p>
                                                       </div>
                                                  </div>
                                             </a>
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <div class="avatar-sm me-2">
                                                                 <span
                                                                      class="avatar-title bg-soft-warning text-warning fs-20 rounded-circle">
                                                                      <iconify-icon
                                                                           icon="iconamoon:comment-dots-duotone"></iconify-icon>
                                                                 </span>
                                                            </div>
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0 fw-semibold text-wrap">You have received
                                                                 <b>20</b> new messages in the
                                                                 conversation</p>
                                                       </div>
                                                  </div>
                                             </a>
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <img src="{{ asset('assets/images/users/avatar-5.jpg') }}"
                                                                 class="img-fluid me-2 avatar-sm rounded-circle"
                                                                 alt="avatar-5" />
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0 fw-semibold">Shawn Bunch</p>
                                                            <p class="mb-0 text-wrap">
                                                                 Commented on Admin
                                                            </p>
                                                       </div>
                                                  </div>
                                             </a>
                                        </div>
                                        <div class="text-center py-3">
                                             <a href="{{ route('notification') }}" class="btn btn-primary btn-sm">View All
                                                  Notification <i class="bx bx-right-arrow-alt ms-1"></i></a>
                                        </div>
                                   </div>
                              </div>



                              <!-- Activity -->
                              <!-- <div class="topbar-item d-none d-md-flex">
                         <button type="button" class="topbar-button" id="theme-settings-btn" data-bs-toggle="offcanvas" data-bs-target="#theme-activity-offcanvas" aria-controls="theme-settings-offcanvas">
                              <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                         </button>
                    </div> -->

                              <!-- User -->
                              <div class="dropdown topbar-item">
                                   <a type="button" class="topbar-button" id="page-header-user-dropdown"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="d-flex align-items-center">
                                             <img class="rounded-circle" width="32"
                                                  src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="avatar-3">
                                        </span>
                                   </a>
                                   <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <h6 class="dropdown-header">Welcome {{ (auth('admin')->user() ?: auth('web')->user())?->name ?? 'User' }}!</h6>
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                             <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span
                                                  class="align-middle">Profile</span>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('settings') }}">
                                             <img src="{{ asset('assets/images/settings.svg') }}" class="me-1" alt="Settings" /><span
                                                  class="align-middle">Settings</span>
                                        </a>

                                        <div class="dropdown-divider my-1"></div>

                                         <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Logout</span>
                                            </button>
                                        </form>
                                   </div>
                              </div>

                              <!-- App Search-->
                              <form class="app-search d-none d-md-block ms-2">
                                   <div class="position-relative">
                                        <input type="search" class="form-control" placeholder="Search..."
                                             autocomplete="off" value="">
                                        <iconify-icon icon="solar:magnifer-linear"
                                             class="search-widget-icon"></iconify-icon>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </header>

          <!-- Activity Timeline -->
          <!-- <div>
     <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-activity-offcanvas" style="max-width: 450px; width: 100%;">
          <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
               <h5 class="text-white m-0 fw-semibold">Activity Stream</h5>
               <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body p-0">
               <div data-simplebar class="h-100 p-4">
                    <div class="position-relative ms-2">
                         <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                         <div class="position-relative ps-4">
                              <div class="mb-4">
                                   <span class="position-absolute start-0 avatar-sm translate-middle-x bg-danger d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon icon="iconamoon:folder-check-duotone"></iconify-icon></span>
                                   <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15 lh-base">Report-Fix / Update </h5>
                                        <p class="d-flex align-items-center">Add 3 files to <span class=" d-flex align-items-center text-primary ms-1"><iconify-icon icon="iconamoon:file-light"></iconify-icon> Tasks</span></p>
                                        <div class="bg-light bg-opacity-50 rounded-2 p-2">
                                             <div class="row">
                                                  <div class="col-lg-6 border-end border-light">
                                                       <div class="d-flex align-items-center gap-2">
                                                            <i class="bx bxl-figma fs-20 text-red"></i>
                                                            <a href="#!" class="text-dark fw-medium">Concept.fig</a>
                                                       </div>
                                                  </div>
                                                  <div class="col-lg-6">
                                                       <div class="d-flex align-items-center gap-2">
                                                            <i class="bx bxl-file-doc fs-20 text-success"></i>
                                                            <a href="#!" class="text-dark fw-medium">larkon.docs</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <h6 class="mt-2 text-muted">Monday , 4:24 PM</h6>
                                   </div>
                              </div>
                         </div>
                         <div class="position-relative ps-4">
                              <div class="mb-4">
                                   <span class="position-absolute start-0 avatar-sm translate-middle-x bg-success d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon icon="iconamoon:check-circle-1-duotone"></iconify-icon></span>
                                   <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15 lh-base">Project Status
                                        </h5>
                                        <p class="d-flex align-items-center mb-0">Marked<span class=" d-flex align-items-center text-primary mx-1"><iconify-icon icon="iconamoon:file-light"></iconify-icon> Design </span> as <span class="badge bg-success-subtle text-success px-2 py-1 ms-1"> Completed</span></p>
                                        <div class="d-flex align-items-center gap-3 mt-1 bg-light bg-opacity-50 p-2 rounded-2">
                                             <a href="#!" class="fw-medium text-dark">UI/UX Figma Design</a>
                                             <div class="ms-auto">
                                                  <a href="#!" class="fw-medium text-primary fs-18" data-bs-toggle="tooltip" data-bs-title="Download" data-bs-placement="bottom"><iconify-icon icon="iconamoon:cloud-download-duotone"></iconify-icon></a>
                                             </div>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday , 3:00 PM</h6>
                                   </div>
                              </div>
                         </div>
                         <div class="position-relative ps-4">
                              <div class="mb-4">
                                   <span class="position-absolute start-0 avatar-sm translate-middle-x bg-primary d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-16">UI</span>
                                   <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15">Larkon Application UI v2.0.0 <span class="badge bg-primary-subtle text-primary px-2 py-1 ms-1"> Latest</span>
                                        </h5>
                                        <p>Get access to over 20+ pages including a dashboard layout, charts, kanban board, calendar, and pre-order E-commerce & Marketing pages.</p>
                                        <div class="mt-2">
                                             <a href="#!" class="btn btn-light btn-sm">Download Zip</a>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday , 2:10 PM</h6>
                                   </div>
                              </div>
                         </div>
                         <div class="position-relative ps-4">
                              <div class="mb-4">
                                   <span class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><img src="{{ asset('assets/images/users/avatar-7.jpg') }}" alt="avatar-5" class="avatar-sm rounded-circle"></span>
                                   <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Alex Smith Attached Photos
                                        </h5>
                                        <div class="row g-2 mt-2">
                                             <div class="col-lg-4">
                                                  <a href="#!">
                                                       <img src="{{ asset('assets/images/small/img-6.jpg') }}" alt="" class="img-fluid rounded">
                                                  </a>
                                             </div>
                                             <div class="col-lg-4">
                                                  <a href="#!">
                                                       <img src="{{ asset('assets/images/small/img-3.jpg') }}" alt="" class="img-fluid rounded">
                                                  </a>
                                             </div>
                                             <div class="col-lg-4">
                                                  <a href="#!">
                                                       <img src="{{ asset('assets/images/small/img-4.jpg') }}" alt="" class="img-fluid rounded">
                                                  </a>
                                             </div>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday 1:00 PM</h6>
                                   </div>
                              </div>
                         </div>
                         <div class="position-relative ps-4">
                              <div class="mb-4">
                                   <span class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="avatar-5" class="avatar-sm rounded-circle"></span>
                                   <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Rebecca J. added a new team member
                                        </h5>
                                        <p class="d-flex align-items-center gap-1"><iconify-icon icon="iconamoon:check-circle-1-duotone" class="text-success"></iconify-icon> Added a new member to Front Dashboard</p>
                                        <h6 class="mt-3 text-muted">Monday 10:00 AM</h6>
                                   </div>
                              </div>
                         </div>
                         <div class="position-relative ps-4">
                              <div class="mb-4">
                                   <span class="position-absolute start-0 avatar-sm translate-middle-x bg-warning d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon icon="iconamoon:certificate-badge-duotone"></iconify-icon></span>
                                   <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Achievements
                                        </h5>
                                        <p class="d-flex align-items-center gap-1 mt-1">Earned a <iconify-icon icon="iconamoon:certificate-badge-duotone" class="text-danger fs-20"></iconify-icon>" Best Product Award"</p>
                                        <h6 class="mt-3 text-muted">Monday 9:30 AM</h6>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <a href="#!" class="btn btn-outline-dark w-100">View All</a>
               </div>
          </div>
     </div>
</div> -->


          <div class="main-nav">
               <!-- Sidebar Logo -->
               <div class="logo-box">
                    <a href="{{ route('index') }}" class="logo-dark">
                         <img src="{{ asset('assets/images/gl-logo.png') }}" class="logo-sm" alt="logo sm">
                         <img src="{{ asset('assets/images/gl-logo.png') }}" class="logo-lg" alt="logo dark">
                    </a>

                    <a href="{{ route('index') }}" class="logo-light">
                         <img src="{{ asset('assets/images/gl-logo.png') }}" class="logo-sm" alt="logo sm">
                         <img src="{{ asset('assets/images/gl-logo.png') }}" class="logo-lg" alt="logo light">
                    </a>
               </div>

               <!-- Menu Toggle Button (sm-hover) -->
               <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                    <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone"
                         class="button-sm-hover-icon"></iconify-icon>
               </button>

               <div class="scrollbar" data-simplebar>
                    <ul class="navbar-nav" id="navbar-nav">

                         @php
                              $adminUser = auth('admin')->user();
                              $panelUser = $adminUser ?: auth('web')->user();
                             $isOrganisationStaffOnly = $panelUser?->hasRole('organisation_staff') && ! $panelUser?->hasRole('organisation_admin');
                             $canAccessDashboard = (bool) $panelUser?->can('dashboard.view');
                             $canAccessStaffs = (bool) $panelUser?->can('staffs.view');
                             $canAccessLeads = (bool) $panelUser?->can('leads.view');
                             $canAccessOrganisations = (bool) $panelUser?->can('organisations.view');
                             $canAccessRoles = (bool) $panelUser?->can('roles.view');
                              $dashboardRoute = 'admin.dashboard';
                             $dashboardRouteParams = [];
                              $staffRoute = 'admin.staffs.index';
                             $staffRouteParams = [];
                              $leadRoute = 'admin.leads.index';
                             $leadRouteParams = [];

                             if ($panelUser?->hasRole('organisation_admin')) {
                                   $dashboardRoute = 'organisation.dashboard';
                                   $dashboardRouteParams = ['organisation' => $panelUser->organisation];
                                   $staffRoute = 'organisation.staffs.index';
                                   $staffRouteParams = ['organisation' => $panelUser->organisation];
                                   $leadRoute = 'organisation.leads.index';
                                   $leadRouteParams = ['organisation' => $panelUser->organisation];
                              } elseif ($isOrganisationStaffOnly) {
                                   $dashboardRoute = 'organisation.dashboard';
                                   $dashboardRouteParams = ['organisation' => $panelUser->organisation];
                                   $staffRoute = 'organisation.staffs.index';
                                   $staffRouteParams = ['organisation' => $panelUser->organisation];
                                   $leadRoute = 'organisation.leads.index';
                                   $leadRouteParams = ['organisation' => $panelUser->organisation];
                              } elseif ($panelUser?->hasRole('internal_staff')) {
                                   $dashboardRoute = 'staff.dashboard';
                                  $staffRoute = 'staff.staffs.index';
                                  $leadRoute = 'staff.leads.index';
                              }
                         @endphp
                         @if ($canAccessDashboard)
                             <li class="nav-item">
                                 <a class="nav-link {{ request()->routeIs('admin.dashboard', 'organisation.dashboard', 'staff.dashboard') ? 'active' : '' }}" href="{{ route($dashboardRoute, $dashboardRouteParams) }}">
                                       <span class="nav-icon">
                                            <img src="{{ asset('assets/images/dashboard.svg') }}" alt="Dashboard" />
                                       </span>
                                       <span class="nav-text"> Dashboard </span>
                                  </a>
                             </li>
                         @endif

                         <!-- <li class="nav-item">
                    <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOrders">
                         <span class="nav-icon">
                              <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                         </span>
                         <span class="nav-text"> Orders </span>
                    </a>
                    <div class="collapse" id="sidebarOrders">
                         <ul class="nav sub-navbar-nav">

                              <li class="sub-nav-item">
                                   <a class="sub-nav-link" href="orders-list.php">List</a>
                              </li>
                              <li class="sub-nav-item">
                                   <a class="sub-nav-link" href="order-detail.php">Details</a>
                              </li>
                              <li class="sub-nav-item">
                                   <a class="sub-nav-link" href="order-cart.php">Cart</a>
                              </li>
                              <li class="sub-nav-item">
                                   <a class="sub-nav-link" href="order-checkout.php">Check Out</a>
                              </li>
                         </ul>
                    </div>
               </li> -->
                         @if ($canAccessStaffs)
                         <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('admin.staffs.*', 'organisation.staffs.*', 'staff.staffs.*') ? 'active' : '' }}" href="{{ route($staffRoute, $staffRouteParams) }}">
                                   <span class="nav-icon">
                                        <img src="{{ asset('assets/images/staff.svg') }}" alt="Staffs" />
                                   </span>
                                   <span class="nav-text"> Staffs </span>
                              </a>
                         </li>
                         @endif
                         @if ($canAccessOrganisations)
                         <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('admin.organisations.*') ? 'active' : '' }}" href="{{ route('admin.organisations.index') }}">
                                   <span class="nav-icon">
                                        <img src="{{ asset('assets/images/organisation.svg') }}" alt="Leads" />
                                   </span>
                                   <span class="nav-text"> Organisation </span>
                              </a>
                         </li>
                         @endif
                         @if ($canAccessRoles)
                         <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                                   <span class="nav-icon">
                                        <img src="{{ asset('assets/images/settings.svg') }}" alt="Roles" />
                                   </span>
                                   <span class="nav-text"> Roles </span>
                              </a>
                         </li>
                         @endif

                         @if ($canAccessLeads)
                         <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('admin.leads.*', 'organisation.leads.*', 'staff.leads.*') ? 'active' : '' }}" href="{{ route($leadRoute, $leadRouteParams) }}">
                                   <span class="nav-icon">
                                        <img src="{{ asset('assets/images/leads.svg') }}" alt="Leads" />
                                   </span>
                                   <span class="nav-text">{{ $isOrganisationStaffOnly ? 'Assigned Leads' : 'Leads' }}</span>
                              </a>
                         </li>
                         @endif



                    </ul>
               </div>
          </div>

          <!-- ==================================================== -->
          <!-- Start right Content here -->
          <!-- ==================================================== -->
          <div class="page-content">

               @yield('content')

 <!-- ========== Footer Start ========== -->
               <footer class="footer">
                    <div class="container-fluid">
                         <div class="row">
                              <div class="col-12 text-center">
                                   <script>document.write(new Date().getFullYear())</script> &copy; Created by <a
                                        href="" class="fw-bold footer-text" target="_blank">GL Infotech</a>
                              </div>
                         </div>
                    </div>
               </footer>
               <!-- ========== Footer End ========== -->

          </div>
          <!-- ==================================================== -->
          <!-- End Page Content -->
          <!-- ==================================================== -->

     </div>
     <!-- END Wrapper -->

     <!-- Vendor Javascript (Require in all Page) -->
     <script src="{{ asset('assets/js/vendor.js') }}"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="{{ asset('assets/js/app.js') }}"></script>

     <!-- Vector Map Js -->
     <script src="{{ asset('assets/vendor/jsvectormap/jsvectormap.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/jsvectormap/maps/world-merc.js') }}"></script>
     <script src="{{ asset('assets/vendor/jsvectormap/maps/world.js') }}"></script>

     <!-- Dashboard Js -->
     <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>
          document.addEventListener('DOMContentLoaded', function () {
               const successMessage = @json(session('success'));
               const errorMessage = @json(session('error'));

               if (successMessage) {
                    Swal.fire({
                         icon: 'success',
                         title: 'Success',
                         text: successMessage,
                         confirmButtonColor: '#ff6c2f',
                    });
               }

               if (errorMessage) {
                    Swal.fire({
                         icon: 'error',
                         title: 'Something went wrong',
                         text: errorMessage,
                         confirmButtonColor: '#ff6c2f',
                    });
               }

               document.querySelectorAll('.delete-record-form').forEach((form) => {
                    form.addEventListener('submit', function (event) {
                         event.preventDefault();

                         const itemLabel = form.dataset.itemLabel || 'this record';

                         Swal.fire({
                              icon: 'error',
                              title: 'Delete record?',
                              text: `You are about to delete ${itemLabel}. This action cannot be undone.`,
                              showCancelButton: true,
                              confirmButtonText: 'Yes, delete it',
                              cancelButtonText: 'Cancel',
                              confirmButtonColor: '#ff0000',
                              cancelButtonColor: '#000000',
                              animation: false,
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   form.submit();
                              }
                         });
                    });
               });

               const getErrorContainer = (input) => {
                    const wrappers = [
                         '.input-margin',
                         '.col-md-6',
                         '.col-md-12',
                         '.col-lg-6',
                         '.col-lg-12',
                         '.col-12',
                         '.mb-3',
                         '.form-group',
                    ];

                    for (const wrapper of wrappers) {
                         const container = input.closest(wrapper)?.querySelector('.invalid-feedback');
                         if (container) {
                              return container;
                         }
                    }

                    const siblingContainer = input.parentElement?.querySelector('.invalid-feedback');
                    if (siblingContainer) {
                         return siblingContainer;
                    }

                    const generatedContainer = document.createElement('div');
                    generatedContainer.className = 'invalid-feedback d-block';
                    generatedContainer.dataset.generated = 'true';
                    input.insertAdjacentElement('afterend', generatedContainer);
                    return generatedContainer;
               };

               const findFieldInputs = (form, field) => {
                    const baseField = field.replace(/\.\*/g, '').replace(/\.\d+/g, '');
                    const elements = Array.from(form.elements || []);

                    return elements.filter((element) => {
                         if (!element.name) {
                              return false;
                         }

                         return element.name === field
                              || element.name === baseField
                              || element.name === `${baseField}[]`
                              || element.name.startsWith(`${baseField}[`);
                    });
               };

               const clearFormErrors = (form) => {
                    form.querySelectorAll('.error-input-bottom').forEach((element) => {
                         element.classList.remove('error-input-bottom');
                    });

                    form.querySelectorAll('.invalid-feedback').forEach((element) => {
                         element.textContent = '';
                         element.classList.remove('d-block');

                         if (element.dataset.generated === 'true') {
                              element.remove();
                         }
                    });
               };

               const setFieldError = (form, field, message) => {
                    const inputs = findFieldInputs(form, field);
                    if (!inputs.length) {
                         return;
                    }

                    inputs.forEach((input) => input.classList.add('error-input-bottom'));
                    const errorContainer = getErrorContainer(inputs[0]);
                    if (errorContainer) {
                         errorContainer.textContent = message;
                         errorContainer.classList.add('d-block');
                    }
               };

               document.querySelectorAll('.ajax-form').forEach((form) => {
                    form.querySelectorAll('input, select, textarea').forEach((field) => {
                         field.addEventListener('input', () => {
                              field.classList.remove('error-input-bottom');
                              const errorContainer = getErrorContainer(field);
                              if (errorContainer) {
                                   errorContainer.textContent = '';
                                   errorContainer.classList.remove('d-block');
                              }
                         });

                         field.addEventListener('change', () => {
                              field.classList.remove('error-input-bottom');
                              const errorContainer = getErrorContainer(field);
                              if (errorContainer) {
                                   errorContainer.textContent = '';
                                   errorContainer.classList.remove('d-block');
                              }
                         });
                    });

                    form.addEventListener('submit', async function (event) {
                         event.preventDefault();
                         clearFormErrors(form);

                         const submitButton = form.querySelector('[type="submit"]');
                         const originalLabel = submitButton ? submitButton.innerHTML : null;

                         if (submitButton) {
                              submitButton.disabled = true;
                              submitButton.innerHTML = 'Saving...';
                         }

                         try {
                              const response = await fetch(form.action, {
                                   method: form.method || 'POST',
                                   headers: {
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || form.querySelector('input[name="_token"]')?.value,
                                        'X-Requested-With': 'XMLHttpRequest',
                                   },
                                   body: new FormData(form),
                              });

                              const data = await response.json();

                              if (!response.ok) {
                                   if (response.status === 422 && data.errors) {
                                        Object.entries(data.errors).forEach(([field, messages]) => {
                                             setFieldError(form, field, messages[0]);
                                        });
                                   } else {
                                        Swal.fire({
                                             icon: 'error',
                                             title: 'Something went wrong',
                                             text: data.message || 'Unable to save the form right now.',
                                             confirmButtonColor: '#ff6c2f',
                                        });
                                   }

                                   return;
                              }

                              const modalElement = form.closest('.modal');
                              if (modalElement) {
                                   bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                              }

                              await Swal.fire({
                                   icon: 'success',
                                   title: 'Success',
                                   text: data.message || 'Saved successfully.',
                                   confirmButtonColor: '#ff6c2f',
                              });

                              if (data.redirect) {
                                   window.location.href = data.redirect;
                              } else {
                                   window.location.reload();
                              }
                         } catch (error) {
                              Swal.fire({
                                   icon: 'error',
                                   title: 'Something went wrong',
                                   text: 'Unable to process this form right now. Please try again.',
                                   confirmButtonColor: '#ff6c2f',
                              });
                         } finally {
                              if (submitButton) {
                                   submitButton.disabled = false;
                                   submitButton.innerHTML = originalLabel;
                              }
                         }
                    });
               });
          });
     </script>
     @stack('scripts')

</body>

</html>
