@extends('layout')

@section('title', 'GL Infotech')
@section('subTitle', 'Add Organisation')
@section('nav_organisation', 'active')

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
                                                  Add Organisation
                                             </h4>
                                        </div>
                                        <form  class="modal-form mt-10">
                                             <div class="row leads-form">
                                                  <div class="col-6 mb-20">
                                                       <label for="name">Name</label>
                                                       <input class="w-100" type="text" id="name" name="name" required="">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="Address">Address</label>
                                                       <input class="w-100" type="text" id="Address" name="Address" required="">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="Email"> Email</label>
                                                       <input class="w-100" type="tel" id="Email" name="Email" placeholder="test@gmail.com">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="phone">Phone Number</label>
                                                       <input class="w-100" type="tel" id="phone" name="phone" placeholder="+1 234 567 890">
                                                  </div>
                                                  
                                             
                                             </div>
                                             <button type="submit" class="save-btn mb-10">Save Changes</button>
                                        </form>
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
@endpush

