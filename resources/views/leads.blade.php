@extends('layout')

@section('title', 'GL Infotech')
@section('subTitle', 'Leads')
@section('nav_leads', 'active')

@section('content')
<!-- Start Container Fluid -->
               <div class="container-fluid">

                    <!-- Start here.... -->




                    <div class="row">
                         <div class="col">
                              <div class="btn-row">
                                   <button class="orange-btn tbl-action-btn import-btn" id="openImportBtn"><img
                                             src="./assets/images/arrow-down.svg" alt="Import" />Import</button>
                                   <button class="dark-btn tbl-action-btn export-btn"><img
                                             src="./assets/images/export.svg" alt="Export" />Export</button>
                              </div>
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
<script>
          const popup = document.getElementById('importPopup');
          const openBtn = document.getElementById('openImportBtn');
          const cancelBtn = document.getElementById('cancelBtn');

          // Updated variable and selector
          const importCloseBtn = document.getElementById('importCloseBtn');

          // Open logic
          openBtn.onclick = function () {
               popup.style.display = 'flex';
          }

          // Close logic
          const hidePopup = () => {
               popup.style.display = 'none';
          };

          importCloseBtn.onclick = hidePopup; // Using the new variable name
          cancelBtn.onclick = hidePopup;

          // Close if clicking outside the content box
          window.onclick = function (event) {
               if (event.target == popup) {
                    hidePopup();
               }
          }
     </script>
@endpush

