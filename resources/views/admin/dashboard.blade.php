@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-xl-3">
             <div class="card">
                  <div class="card-body">
                       <div class="row">
                            <div class="col-6">
                                 <div class="avatar-md bg-soft-primary rounded">
                                      <i class="bx bx-layer avatar-title fs-24 text-primary"></i>
                                 </div>
                            </div> <!-- end col -->
                            <div class="col-6 text-end">
                                 <p class="text-muted mb-0 text-truncate">Campaign Sent</p>
                                 <h3 class="text-dark mt-1 mb-0">13, 647</h3>
                            </div> <!-- end col -->
                       </div> <!-- end row-->
                  </div> <!-- end card body -->
                  <div class="card-footer py-2 bg-light bg-opacity-50">
                       <div class="d-flex align-items-center justify-content-between">
                            <div>
                                 <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> 2.3%</span>
                                 <span class="text-muted ms-1 fs-12">Last Month</span>
                            </div>
                            <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                       </div>
                  </div> <!-- end card body -->
             </div> <!-- end card -->
        </div> <!-- end col -->
        <div class="col-md-6 col-xl-3">
             <div class="card">
                  <div class="card-body">
                       <div class="row">
                            <div class="col-6">
                                 <div class="avatar-md bg-soft-success rounded">
                                      <i class="bx bx-award avatar-title fs-24 text-success"></i>
                                 </div>
                            </div> <!-- end col -->
                            <div class="col-6 text-end">
                                 <p class="text-muted mb-0 text-truncate">New Leads</p>
                                 <h3 class="text-dark mt-1 mb-0">9, 526</h3>
                            </div> <!-- end col -->
                       </div> <!-- end row-->
                  </div> <!-- end card body -->
                  <div class="card-footer py-2 bg-light bg-opacity-50">
                       <div class="d-flex align-items-center justify-content-between">
                            <div>
                                 <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> 8.1%</span>
                                 <span class="text-muted ms-1 fs-12">Last Month</span>
                            </div>
                            <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                       </div>
                  </div> <!-- end card body -->
             </div> <!-- end card -->
        </div> <!-- end col -->
        <div class="col-md-6 col-xl-3">
             <div class="card">
                  <div class="card-body">
                       <div class="row">
                            <div class="col-6">
                                 <div class="avatar-md bg-soft-danger rounded">
                                      <i class="bx bxs-backpack avatar-title fs-24 text-danger"></i>
                                 </div>
                            </div> <!-- end col -->
                            <div class="col-6 text-end">
                                 <p class="text-muted mb-0 text-truncate">Deals</p>
                                 <h3 class="text-dark mt-1 mb-0">976</h3>
                            </div> <!-- end col -->
                       </div> <!-- end row-->
                  </div> <!-- end card body -->
                  <div class="card-footer py-2 bg-light bg-opacity-50">
                       <div class="d-flex align-items-center justify-content-between">
                            <div>
                                 <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> 0.3%</span>
                                 <span class="text-muted ms-1 fs-12">Last Month</span>
                            </div>
                            <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                       </div>
                  </div> <!-- end card body -->
             </div> <!-- end card -->
        </div> <!-- end col -->
        <div class="col-md-6 col-xl-3">
             <div class="card">
                  <div class="card-body">
                       <div class="row">
                            <div class="col-6">
                                 <div class="avatar-md bg-soft-warning rounded">
                                      <i class="bx bx-dollar-circle avatar-title text-warning fs-24"></i>
                                 </div>
                            </div> <!-- end col -->
                            <div class="col-6 text-end">
                                 <p class="text-muted mb-0 text-truncate">Booked Revenue</p>
                                 <h3 class="text-dark mt-1 mb-0">$123.6k</h3>
                            </div> <!-- end col -->
                       </div> <!-- end row-->
                  </div> <!-- end card body -->
                  <div class="card-footer py-2 bg-light bg-opacity-50">
                       <div class="d-flex align-items-center justify-content-between">
                            <div>
                                 <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> 10.6%</span>
                                 <span class="text-muted ms-1 fs-12">Last Month</span>
                            </div>
                            <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                       </div>
                  </div> <!-- end card body -->
             </div> <!-- end card -->
        </div> <!-- end col -->
   </div>
    <div class="row g-3">
        <div class="col-md-6 col-xl-3">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">New Leads</p><h3 class="mb-0">{{ $stats['new'] ?? 0 }}</h3></div></div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Contacted</p><h3 class="mb-0">{{ $stats['contacted'] ?? 0 }}</h3></div></div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Completed</p><h3 class="mb-0">{{ $stats['completed'] ?? 0 }}</h3></div></div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Total Leads</p><h3 class="mb-0">{{ $stats['total'] ?? 0 }}</h3></div></div>
        </div>
    </div>
</div>
@endsection
