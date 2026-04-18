@extends('layout')

@section('title', 'GL Infotech')
@section('subTitle', 'Settings')

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
                                                  Settings
                                             </h4>
                                        </div>
                                        <form class="modal-form mt-10">
                                             <div class="row leads-form">
                                                  <div class="col-6 mb-20">
                                                       <label for="Test">Test1</label>
                                                       <input class="w-100" type="text" id="Test" name="Test"
                                                            required="">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="Test">Test2</label>
                                                       <input class="w-100" type="text" id="Test" name="Test"
                                                            required="">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="Test">Test3</label>
                                                       <input class="w-100" type="text" id="Test" name="Test"
                                                            required="">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="Test">Test4</label>
                                                       <input class="w-100" type="text" id="Test" name="Test"
                                                            required="">
                                                  </div>
                                                  <div class="col-6 mb-20">
                                                       <label for="Test">Test5</label>
                                                       <input class="w-100" type="text" id="Test" name="Test"
                                                            required="">
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

