@extends('layout')

@section('title', 'GL Infotech')
@section('subTitle', 'Notification')

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
                                                  Notification List
                                             </h4>
                                        </div>
                                        <div class="notification-container mt-20 mb-10">
                                             <div class="notification-item notification-unread">
                                                  <img src="https://i.pravatar.cc/150?u=kate" alt="User"
                                                       class="notification-avatar">
                                                  <div class="notification-content">
                                                       <div class="notification-header">
                                                            <h4 class="notification-user-name">Kate Young</h4>
                                                            <span class="notification-time">5 mins ago</span>
                                                       </div>
                                                       <p class="notification-action">Commented on your photo</p>
                                                       <p class="notification-message">Great Shot Adam! Really enjoying
                                                            the composition on this piece.</p>
                                                  </div>
                                             </div>

                                             <div class="notification-item notification-unread">
                                                  <img src="https://i.pravatar.cc/150?u=brandon" alt="User"
                                                       class="notification-avatar">
                                                  <div class="notification-content">
                                                       <div class="notification-header">
                                                            <h4 class="notification-user-name">Brandon Newman</h4>
                                                            <span class="notification-time">21 mins ago</span>
                                                       </div>
                                                       <p class="notification-action">Liked your album: UI/UX Inspo</p>
                                                  </div>
                                             </div>

                                             <div class="notification-item notification-read">
                                                  <img src="https://i.pravatar.cc/150?u=dave" alt="User"
                                                       class="notification-avatar">
                                                  <div class="notification-content">
                                                       <div class="notification-header">
                                                            <h4 class="notification-user-name">Dave Wood</h4>
                                                            <span class="notification-time">2hrs ago</span>
                                                       </div>
                                                       <p class="notification-action">Liked your photo: Daily UI
                                                            Challenge 049</p>
                                                  </div>
                                             </div>

                                             <div class="notification-item notification-read">
                                                  <img src="https://i.pravatar.cc/150?u=anna" alt="User"
                                                       class="notification-avatar">
                                                  <div class="notification-content">
                                                       <div class="notification-header">
                                                            <h4 class="notification-user-name">Anna Lee</h4>
                                                            <span class="notification-time">1 day ago</span>
                                                       </div>
                                                       <p class="notification-action">Commented on your photo</p>
                                                       <p class="notification-message">Woah! Loving these colours! Keep
                                                            it up</p>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- End Container Fluid -->
@endsection

@push('scripts')
<script>document.write(new Date().getFullYear())</script>
<script src="{{ asset('assets/js/vendor.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endpush

