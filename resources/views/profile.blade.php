@extends('layout')

@section('title', 'GL Infotech')
@section('subTitle', 'Profile')

@section('content')
<!-- Start Container Fluid -->
               <div class="container-fluid">

                    <!-- Start here.... -->
                    <div class="row">
                         <div class="col">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <h4 class="card-title mb-20">
                                                  Profile Details
                                             </h4>
                                             <div class="add-btn-row">
                                                  <button
                                                       class="btn btn-sm btn-soft-primary orange-btn edit-btn custome-edit-btn"><i
                                                            class="bx bx-pen me-1"></i>Edit</button>
                                             </div>
                                        </div>

                                        <div class="custome-profile-container">
                                             <div class="custome-profile-header">
                                                  <div class="custome-user-info">
                                                       <img src="./assets/images/profile.png" alt="Profile"
                                                            class="custome-avatar">
                                                       <div class="custome-name-details">
                                                            <h2 class="custome-user-name">Alexa Rawles</h2>
                                                            <p class="custome-user-email">alexarawles@gmail.com</p>
                                                       </div>
                                                  </div>
                                             </div>

                                             <form class="custome-profile-form">
                                                  <div class="custome-form-grid mb-20">
                                                       <div class="custome-input-group">
                                                            <label>First Name</label>
                                                            <input type="text" placeholder="Your First Name">
                                                       </div>
                                                       <div class="custome-input-group">
                                                            <label>Last Name</label>
                                                            <input type="text" placeholder="Your First Name">
                                                       </div>
                                                       <div class="custome-input-group">
                                                            <label>Gender</label>
                                                            <select class="custome-select">
                                                                 <option value="male" selected>Male</option>
                                                                 <option value="female">Female</option>
                                                            </select>
                                                       </div>
                                                       <div class="custome-input-group">
                                                            <label>District </label>
                                                            <select class="custome-select">
                                                                 <option value="Thrissur" selected>Thrissur</option>
                                                                 <option value="Kochi">Kochi</option>
                                                            </select>
                                                       </div>
                                                       <div class="custome-input-group">
                                                            <label>Email</label>
                                                            <input type="email" placeholder="test@gmail.com">
                                                       </div>
                                                       <div class="custome-input-group">
                                                            <label>Phone Number</label>
                                                            <input type="email" placeholder="+91 9393019304">
                                                       </div>
                                                  </div>
                                                  <button type="submit"
                                                       class="save-btn mb-10 custome-hidden custome-save-btn">Save
                                                       Changes</button>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>
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
          document.addEventListener('DOMContentLoaded', () => {
               const editBtn = document.querySelector('.custome-edit-btn');
               const saveBtn = document.querySelector('.custome-save-btn');
               const inputs = document.querySelectorAll('.custome-profile-form input, .custome-select');

               editBtn.addEventListener('click', (e) => {
                    // 1. Prevent default behavior if it's inside a form
                    e.preventDefault();

                    // 2. Hide the Edit button
                    editBtn.classList.add('custome-hidden');

                    // 3. Show the Save button
                    saveBtn.classList.remove('custome-hidden');

                    // 4. Enable the input fields so the user can actually edit
                    inputs.forEach(input => {
                         input.disabled = false;

                    });
               });
          });
     </script>
@endpush

