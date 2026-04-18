@extends('layout')

@section('title', 'GL Infotech')
@section('subTitle', 'Dashboard')
@section('nav_dashboard', 'active')

@section('content')
<!-- Start Container Fluid -->
               <div class="container-fluid">

                    <!-- Start here.... -->
                    <div class="row">

                         <div class="col-xxl-12 welcom-title"> Welcome, Admin</div>

                         <div class="col-xxl-5">
                              <div class="row">
                                   <div class="col-12">
                                        <div class="alert alert-primary text-truncate mb-3" role="alert">
                                             We regret to inform you that our server is currently experiencing technical
                                             difficulties.
                                        </div>
                                   </div>

                                   <div class="col-md-6">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-6">
                                                            <div class="avatar-md bg-soft-primary rounded card-icons">
                                                                 <img src="./assets/images/new-leads.svg"
                                                                      alt="New Leads" />
                                                            </div>
                                                       </div> <!-- end col -->
                                                       <div class="col-6 text-end">
                                                            <p class="text-muted mb-0 text-truncate card-title">New
                                                                 Leads</p>
                                                            <h3 class="text-dark mt-1 mb-0 count-detail">50 Today</h3>
                                                       </div> <!-- end col -->
                                                  </div> <!-- end row-->
                                             </div> <!-- end card body -->
                                             <!-- <div class="card-footer py-2 bg-light bg-opacity-50">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                            <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> 2.3%</span>
                                                            <span class="text-muted ms-1 fs-12">Last Week</span>
                                                       </div>
                                                       <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                                                  </div>
                                             </div>  -->
                                        </div> <!-- end card -->
                                   </div> <!-- end col -->
                                   <div class="col-md-6">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-6">
                                                            <div class="avatar-md bg-soft-primary rounded card-icons">
                                                                 <img src="./assets/images/followups.svg"
                                                                      alt="New Leads" />
                                                            </div>
                                                       </div> <!-- end col -->
                                                       <div class="col-6 text-end">
                                                            <p class="text-muted mb-0 text-truncate card-title">
                                                                 Follow-Ups</p>
                                                            <h3 class="text-dark mt-1 mb-0 count-detail">8 Due Today
                                                            </h3>
                                                       </div> <!-- end col -->
                                                  </div> <!-- end row-->
                                             </div> <!-- end card body -->
                                             <!-- <div class="card-footer py-2 bg-light bg-opacity-50">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                            <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> 8.1%</span>
                                                            <span class="text-muted ms-1 fs-12">Last Month</span>
                                                       </div>
                                                       <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                                                  </div>
                                             </div>  -->
                                        </div> <!-- end card -->
                                   </div> <!-- end col -->
                                   <div class="col-md-6">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-6">
                                                            <div class="avatar-md bg-soft-primary rounded card-icons">
                                                                 <img src="./assets/images/convereted.svg"
                                                                      alt="New Leads" />
                                                            </div>
                                                       </div> <!-- end col -->
                                                       <div class="col-6 text-end">
                                                            <p class="text-muted mb-0 text-truncate card-title">
                                                                 Converred</p>
                                                            <h3 class="text-dark mt-1 mb-0 count-detail">5 This Week
                                                            </h3>
                                                       </div> <!-- end col -->
                                                  </div> <!-- end row-->
                                             </div> <!-- end card body -->
                                             <!-- <div class="card-footer py-2 bg-light bg-opacity-50">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                            <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> 0.3%</span>
                                                            <span class="text-muted ms-1 fs-12">Last Month</span>
                                                       </div>
                                                       <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                                                  </div>
                                             </div>  -->
                                        </div> <!-- end card -->
                                   </div> <!-- end col -->
                                   <div class="col-md-6">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-6">
                                                            <div class="avatar-md bg-soft-primary rounded card-icons">
                                                                 <img src="./assets/images/total-leads.svg"
                                                                      alt="Total Leads" />
                                                            </div>
                                                       </div> <!-- end col -->
                                                       <div class="col-6 text-end">
                                                            <p class="text-muted mb-0 text-truncate card-title">Total
                                                                 Leads</p>
                                                            <h3 class="text-dark mt-1 mb-0 count-detail">230 All Time
                                                            </h3>
                                                       </div> <!-- end col -->
                                                  </div> <!-- end row-->
                                             </div> <!-- end card body -->
                                             <!-- <div class="card-footer py-2 bg-light bg-opacity-50">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                            <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> 10.6%</span>
                                                            <span class="text-muted ms-1 fs-12">Last Month</span>
                                                       </div>
                                                       <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                                                  </div>
                                             </div>  -->
                                        </div> <!-- end card -->
                                   </div> <!-- end col -->
                              </div> <!-- end row -->
                         </div> <!-- end col -->

                         <div class="col-xxl-7">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                             <h4 class="card-title">Leads</h4>
                                             <div>
                                                  <button type="button"
                                                       class="btn btn-sm btn-outline-light">ALL</button>
                                                  <button type="button"
                                                       class="btn btn-sm btn-outline-light">Follow-Ups</button>
                                                  <button type="button"
                                                       class="btn btn-sm btn-outline-light">Converred</button>
                                             </div>
                                        </div> <!-- end card-title-->

                                        <div dir="ltr">
                                             <div id="dash-performance-chart" class="apex-charts"></div>
                                        </div>
                                   </div> <!-- end card body -->
                              </div> <!-- end card -->
                         </div> <!-- end col -->
                    </div> <!-- end row -->



                    <div class="row">
                         <div class="col">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <h4 class="card-title">
                                                  Recent Leads
                                             </h4>

                                             <a href="./add-leads.html" class="btn btn-sm btn-soft-primary"><i
                                                       class="bx bx-plus me-1"></i>Add New Lead
                                             </a>
                                        </div>
                                   </div>
                                   <!-- end card body -->
                                   <div class="table-responsive table-centered">
                                        <table class="table mb-0 lead-table">
                                             <thead class="bg-light bg-opacity-50">
                                                  <tr>
                                                       <th class="ps-3">
                                                            Name
                                                       </th>
                                                       <th>
                                                            Phone
                                                       </th>
                                                       <th>
                                                            Source
                                                       </th>
                                                       <th>
                                                            Status
                                                       </th>
                                                       <th>
                                                            Assigned To
                                                       </th>
                                                       <th>
                                                            Date
                                                       </th>
                                                       <th>
                                                            Action
                                                       </th>

                                                  </tr>
                                             </thead>
                                             <!-- end thead-->
                                             <tbody>
                                                  <tr>
                                                       <td class="ps-3">
                                                            <a>John Doe</a>
                                                       </td>
                                                       <td><a href="tel:+919256934026">+91 9256934026</a></td>
                                                       <td>
                                                            Facebook
                                                       </td>
                                                       <td>
                                                            <div class="status-new status-btn">New</div>
                                                       </td>
                                                       <td>Agent A</td>
                                                       <td>Jan 26 2026</td>
                                                       <td class="action-btn">
                                                            <button class="openEditModal">
                                                                 <img src="./assets/images/edit.svg" alt="Edit" />
                                                            </button>
                                                            <button>
                                                                 <img src="./assets/images/delete.svg" alt="Delete" />
                                                            </button>
                                                       </td>
                                                  </tr>

                                                  <tr>
                                                       <td class="ps-3">
                                                            <a>John Doe</a>
                                                       </td>
                                                       <td><a href="tel:+919256934026">+91 9256934026</a></td>
                                                       <td>
                                                            Google
                                                       </td>
                                                       <td>
                                                            <div class="status-contacted status-btn">Contacted</div>
                                                       </td>
                                                       <td>Agent A</td>
                                                       <td>Jan 26 2026</td>
                                                       <td class="action-btn">
                                                            <button class="openEditModal">
                                                                 <img src="./assets/images/edit.svg" alt="Edit" />
                                                            </button>
                                                            <button>
                                                                 <img src="./assets/images/delete.svg" alt="Delete" />
                                                            </button>
                                                       </td>
                                                  </tr>

                                                  <tr>
                                                       <td class="ps-3">
                                                            <a>John Doe</a>
                                                       </td>
                                                       <td><a href="tel:+919256934026">+91 9256934026</a></td>
                                                       <td>
                                                            Facebook
                                                       </td>
                                                       <td>
                                                            <div class="status-new status-btn">New</div>
                                                       </td>
                                                       <td>Agent A</td>
                                                       <td>Jan 26 2026</td>
                                                       <td class="action-btn">
                                                            <button class="openEditModal">
                                                                 <img src="./assets/images/edit.svg" alt="Edit" />
                                                            </button>
                                                            <button>
                                                                 <img src="./assets/images/delete.svg" alt="Delete" />
                                                            </button>
                                                       </td>
                                                  </tr>

                                                  <tr>
                                                       <td class="ps-3">
                                                            <a>John Doe</a>
                                                       </td>
                                                       <td><a href="tel:+919256934026">+91 9256934026</a></td>
                                                       <td>
                                                            Google
                                                       </td>
                                                       <td>
                                                            <div class="status-contacted status-btn">Contacted</div>
                                                       </td>
                                                       <td>Agent A</td>
                                                       <td>Jan 26 2026</td>
                                                       <td class="action-btn">
                                                            <button class="openEditModal">
                                                                 <img src="./assets/images/edit.svg" alt="Edit" />
                                                            </button>
                                                            <button>
                                                                 <img src="./assets/images/delete.svg" alt="Delete" />
                                                            </button>
                                                       </td>
                                                  </tr>


                                             </tbody>
                                             <!-- end tbody -->
                                        </table>
                                        <!-- end table -->
                                   </div>
                                   <!-- table responsive -->

                                   <div class="card-footer border-top">
                                        <div class="row g-3">
                                             <div class="col-sm">
                                                  <div class="text-muted">
                                                       Showing
                                                       <span class="fw-semibold">5</span>
                                                       of
                                                       <span class="fw-semibold">90,521</span>
                                                       orders
                                                  </div>
                                             </div>

                                             <div class="col-sm-auto">
                                                  <ul class="pagination m-0">
                                                       <li class="page-item">
                                                            <a href="#" class="page-link"><i
                                                                      class="bx bx-left-arrow-alt"></i></a>
                                                       </li>
                                                       <li class="page-item active">
                                                            <a href="#" class="page-link">1</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link">2</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link">3</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link"><i
                                                                      class="bx bx-right-arrow-alt"></i></a>
                                                       </li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <!-- end card -->
                         </div>
                         <!-- end col -->
                    </div> <!-- end row -->

               </div>
               <!-- End Container Fluid -->
@endsection

@push('scripts')
<script>document.write(new Date().getFullYear())</script>
<script src="{{ asset('assets/js/vendor.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
<script>
          const modal = document.getElementById("Editform");
          const openBtn = document.getElementById("openEditModal");
          const closeBtn = document.querySelector(".close-btn");

          // Open modal
          openBtn.onclick = function() {
          modal.style.display = "block";
          document.body.classList.add("modal-open"); // Lock background
          }

          // Close modal via (X) button
          closeBtn.onclick = function() {
          modal.style.display = "none";
          document.body.classList.remove("modal-open"); // Unlock background
          }

          closeBtn.onclick = closeModal;
          // Close modal if user clicks anywhere outside the box
          window.onclick = function(event) {
               if (event.target == modal) {
                    closeModal();
               }
          }
     </script>
<script>
          // 1. Select the modal and close elements
          const modal = document.getElementById("Editform");
          const closeBtn = document.querySelector(".close-btn");

          // 2. Select ALL buttons with the class "openEditModal"
          const openBtns = document.querySelectorAll(".openEditModal");

          // 3. Loop through each button and add the click event
          openBtns.forEach(btn => {
               btn.addEventListener("click", () => {
                    modal.style.display = "block";
                    document.body.classList.add("modal-open");
               });
          });

          // 4. Function to close the modal
          const closeModal = () => {
               modal.style.display = "none";
               document.body.classList.remove("modal-open");
          };

          closeBtn.onclick = closeModal;

          // 5. Improved Click-Outside Logic
          window.onclick = function (event) {
               // If the click happened on the background (the 'modal' div), close it
               if (event.target === modal) {
                    closeModal();
               }
          }
     </script>
@endpush

