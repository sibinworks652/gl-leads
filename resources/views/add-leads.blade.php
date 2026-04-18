@extends('layout')

@section('title', 'GL Infotech')
@section('subTitle', 'Add New Lead')
@section('nav_leads', 'active')

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
                                                  Add New Leads
                                             </h4>
                                        </div>
                                        <form class="modal-form mt-10">
                                             <div class="row leads-form">
                                                  <div class="col-6 mb-20">
                                                       <label for="name">Name</label>
                                                       <input class="w-100" type="text" id="name" name="name"
                                                            required="">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="phone">Phone Number</label>
                                                       <input class="w-100" type="tel" id="phone" name="phone"
                                                            placeholder="+1 234 567 890">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="Source">Source</label>
                                                       <select class="w-100 custome-select" id="Source" name="Source">
                                                            <option value="Facebook">Facebook</option>
                                                            <option value="Google">Google</option>
                                                       </select>
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="status">Status</label>
                                                       <select class="w-100 custome-select" id="status" name="status">
                                                            <option value="new">New</option>
                                                            <option value="contacted">Contacted</option>
                                                            <option value="completed">Completed</option>
                                                       </select>
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="Assignedto">Assigned To</label>
                                                       <select class="w-100 custome-select" id="Assignedto"
                                                            name="Assignedto">
                                                            <option value="low">Low</option>
                                                            <option value="medium">Medium</option>
                                                            <option value="high">High</option>
                                                       </select>
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="editDate">Select Date</label>
                                                       <input class="w-100" type="date" id="editDate" name="editDate"
                                                            onclick="this.showPicker()">
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

