@extends('dashboard.layouts.app')
@push('page_vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">


@endpush
@push('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/pages/app-user.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/pages/app-invoice-list.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/pages/app-user.css">
@endpush
@section('content')

<section class="app-user-view">
    <!-- User Card & Plan Starts -->
    <div class="row">
        <!-- User Card starts-->
        <div class="col-xl-10 col-lg-8 col-md-7">
            <div class="card user-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-8 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                            <div class="user-avatar-section">
                                <div class="d-flex justify-content-start">
                                    <img class="img-fluid rounded" src="{{ image_or_placeholder($Merchant->avatar_full_path, 'profile') }}" height="104" width="104" alt="User avatar">
                                    <div class="d-flex flex-column ml-1">
                                        <div class="user-info mb-1">
                                            <h4 class="mb-0">{{$Merchant->name}}</h4>
                                            <span class="card-text">{{$Merchant->email}}</span>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <a href="./app-user-edit.html" class="btn btn-primary waves-effect waves-float waves-light">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center user-total-numbers">
                                <div class="d-flex align-items-center mr-2">
                                    <div class="color-box bg-light-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-primary"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Merchant->total_profits}}</h5>
                                        <small>اجمالي الارباح</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mr-2">
                                    <div class="color-box bg-light-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up text-success"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Merchant->balance}}</h5>
                                        <small>الرصيد الحالي</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mr-2">
                                    <div class="color-box bg-light-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-primary"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Merchant->pledges}}</h5>
                                        <small>العهد</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mr-2">
                                    <div class="color-box bg-light-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up text-success"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Merchant->debts}}</h5>
                                        <small>المديونيات</small>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-xl-4 col-lg-12 mt-2 mt-xl-0">
                            <div class="user-info-wrapper">
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-1"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        <span class="card-text user-info-title font-weight-bold mb-0">حالة الحساب</span>
                                    </div>
                                    <p class="card-text mb-0">
                                        @if ($Merchant->status)
                                            نشط
                                        @else
                                            معطل
                                        @endif
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star mr-1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        <span class="card-text user-info-title font-weight-bold mb-0">نوع الحساب</span>
                                    </div>
                                    <p class="card-text mb-0">موزع</p>
                                </div>
              
                                <div class="d-flex flex-wrap">
                                    <div class="user-info-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone mr-1"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                        <span class="card-text user-info-title font-weight-bold mb-0">رقم الهاتف</span>
                                    </div>
                                    <p class="card-text mb-0">{{$Merchant->phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Card Ends-->

        <!-- Plan Card starts-->
        <div class="col-xl-2 col-lg-4 col-md-5">
            <div class="card plan-card border-primary">
                <div class="card-header d-flex justify-content-between align-items-center pt-75 pb-1">
                    <h5 class="mb-0">الخطة الحاية</h5>
                    <div class="badge badge-light-primary">الذهبية</div>
                </div>
                <div class="card-body">
                    
                    <button class="btn btn-primary text-center btn-block waves-effect waves-float waves-light">تغير الخطة</button>
                </div>
            </div>
        </div>
        <!-- /Plan CardEnds -->
    </div>
    <!-- User Card & Plan Ends -->

    <!-- User Timeline & Permissions Starts -->
    <div class="row">
        <!-- information starts -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">User Timeline</h4>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>12 Invoices have been paid</h6>
                                    <span class="timeline-event-time">12 min ago</span>
                                </div>
                                <p>Invoices have been paid to the company.</p>
                                <div class="media align-items-center">
                                    <img class="mr-1" src="../../../app-assets/images/icons/file-icons/pdf.png" alt="invoice" height="23">
                                    <div class="media-body">invoice.pdf</div>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>Client Meeting</h6>
                                    <span class="timeline-event-time">45 min ago</span>
                                </div>
                                <p>Project meeting with john @10:15am.</p>
                                <div class="media align-items-center">
                                    <div class="avatar">
                                        <img src="../../../app-assets/images/avatars/12-small.png" alt="avatar" height="38" width="38">
                                    </div>
                                    <div class="media-body ml-50">
                                        <h6 class="mb-0">John Doe (Client)</h6>
                                        <span>CEO of Infibeam</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>Create a new project for client</h6>
                                    <span class="timeline-event-time">2 days ago</span>
                                </div>
                                <p class="mb-0">Add files to new design folder</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- information Ends -->

        <!-- User Permissions Starts -->
        <div class="col-md-6">
            <!-- User Permissions -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions</h4>
                </div>
                <p class="card-text ml-2">Permission according to roles</p>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead class="thead-light">
                            <tr>
                                <th>Module</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Create</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Admin</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="admin-read" checked="" disabled="">
                                        <label class="custom-control-label" for="admin-read"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="admin-write" disabled="">
                                        <label class="custom-control-label" for="admin-write"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="admin-create" disabled="">
                                        <label class="custom-control-label" for="admin-create"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="admin-delete" disabled="">
                                        <label class="custom-control-label" for="admin-delete"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Staff</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="staff-read" disabled="">
                                        <label class="custom-control-label" for="staff-read"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="staff-write" checked="" disabled="">
                                        <label class="custom-control-label" for="staff-write"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="staff-create" disabled="">
                                        <label class="custom-control-label" for="staff-create"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="staff-delete" disabled="">
                                        <label class="custom-control-label" for="staff-delete"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Author</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="author-read" checked="" disabled="">
                                        <label class="custom-control-label" for="author-read"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="author-write" disabled="">
                                        <label class="custom-control-label" for="author-write"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="author-create" checked="" disabled="">
                                        <label class="custom-control-label" for="author-create"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="author-delete" disabled="">
                                        <label class="custom-control-label" for="author-delete"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Contributor</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="contributor-read" disabled="">
                                        <label class="custom-control-label" for="contributor-read"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="contributor-write" disabled="">
                                        <label class="custom-control-label" for="contributor-write"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="contributor-create" disabled="">
                                        <label class="custom-control-label" for="contributor-create"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="contributor-delete" disabled="">
                                        <label class="custom-control-label" for="contributor-delete"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="user-read" disabled="">
                                        <label class="custom-control-label" for="user-read"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="user-create" disabled="">
                                        <label class="custom-control-label" for="user-create"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="user-write" disabled="">
                                        <label class="custom-control-label" for="user-write"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="user-delete" checked="" disabled="">
                                        <label class="custom-control-label" for="user-delete"></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /User Permissions -->
        </div>
        <!-- User Permissions Ends -->
    </div>
    <!-- User Timeline & Permissions Ends -->

    <!-- User Invoice Starts-->
    <div class="row invoice-list-wrapper">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row d-flex justify-content-between align-items-center m-1"><div class="col-lg-6 d-flex align-items-center"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="custom-select form-control"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div><div class="dt-action-buttons text-xl-right text-lg-left text-md-right text-left "><div class="dt-buttons btn-group flex-wrap"><button class="btn btn-primary btn-add-record ml-2" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span>Add Record</span></button> </div></div></div><div class="col-lg-6 d-flex align-items-center justify-content-lg-end flex-wrap pr-lg-1 p-0"><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search<input type="search" class="form-control" placeholder="Search Invoice" aria-controls="DataTables_Table_0"></label></div><div class="invoice_status ml-2"></div></div></div><table class="invoice-list-table table dataTable no-footer dtr-column" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr role="row"><th class="control sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="display: none;"></th><th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 46px;" aria-sort="descending" aria-label="#: activate to sort column ascending">#</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 42px;" aria-label=": activate to sort column ascending"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 270px;" aria-label="Client: activate to sort column ascending">Client</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 73px;" aria-label="Total: activate to sort column ascending">Total</th><th class="text-truncate sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 130px;" aria-label="Issued Date: activate to sort column ascending">Issued Date</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 98px;" aria-label="Balance: activate to sort column ascending">Balance</th><th class="cell-fit sorting_disabled" rowspan="1" colspan="1" style="width: 80px;" aria-label="Actions">Actions</th></tr>
                        </thead><tbody><tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">Loading...</td></tr></tbody>
                    </table><div class="d-flex justify-content-between mx-2 row"><div class="col-sm-12 col-md-6"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">&nbsp;</a></li><li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">&nbsp;</a></li></ul></div></div></div></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /User Invoice Ends-->
</section>  
<!-- users edit start -->
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" id="account-tab"
                        data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                        <i data-feather="user"></i><span class="d-none d-sm-block">الحساب</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab"
                        href="#information" aria-controls="information" role="tab" aria-selected="false">
                        <i data-feather="info"></i><span class="d-none d-sm-block">البيانات الاضافية</span>
                    </a>
                </li>
               
            </ul>
            <div class="tab-content">
                <!-- Account Tab starts -->
                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                    
                    <!-- users edit account form start -->
                    <form action="{{ route('dashboard.merchants.update', $Merchant->id) }}" method="post" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-12">
                                <!-- users edit media object start -->
                                <div class="media mb-2">
                                    <img src="{{ image_or_placeholder($Merchant->avatar_full_path, 'profile') }}" alt="users avatar"
                                        class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                        height="90" width="90" />
                                    <div class="media-body mt-50">
                                        {{-- <h4>Eleanor Aguilar</h4> --}}
                                        <div class="col-12 d-flex mt-1 px-0">
                                            <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                                <span class="d-none d-sm-block">Change</span>
                                                <input class="form-control" type="file" name="avatar" id="change-picture" hidden accept="image/png, image/jpeg, image/jpg" />
                                                <span class="d-block d-sm-none">
                                                    <i class="mr-0" data-feather="edit"></i>
                                                </span>
                                            </label>
                                            @if ($Merchant->avatar() != null)
                                                <a href="{{ route('dashboard.common.image-delete', $Merchant->avatar()->id) }}" class="btn btn-outline-secondary d-none d-sm-block">Remove</a>
                                            @endif
                                            <button class="btn btn-outline-secondary d-block d-sm-none">
                                                <i class="mr-0" data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- users edit media object ends -->
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="supervisor-id">المسؤول</label>
                                <select class="form-control" name="supervisor_id" id="supervisor-id" required>
                                    <option value="">Select a supervisor</option>
                                    @foreach ($all_staff as $staff)
                                        <option value="{{$staff->id}}" @if($staff->id == $Merchant->supervisor_id) selected @endif>{{$staff->name}}</option>
                                    @endforeach                                 
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">الاسم بالكامل</label>
                                    <input type="text" class="form-control" placeholder="Name" value="{{ $Merchant->name }}" name="name" id="name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">البريد الالكتروني</label>
                                    <input type="email" class="form-control" placeholder="Email" value="{{ $Merchant->email }}" name="email" id="email" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="tel" class="form-control" placeholder="Phone" value="{{ $Merchant->phone }}" name="phone" id="phone" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">كلمة السر</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                                </div>
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password_confirmation">تأكيد كلمة السر</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" id="password_confirmation" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">حالة الحساب</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" @if ($Merchant->status == 1) selected @endif>Active</option>
                                        <option value="0" @if ($Merchant->status == 0) selected @endif>Deactivated</option>
                                        <option value="6" @if ($Merchant->status == 6) selected @endif>Blocked</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                <button type="submit"
                                    class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ التغيرات</button>
                                <button type="reset" class="btn btn-outline-secondary">الغاء</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                </div>
                <!-- Account Tab ends -->

                <!-- Information Tab starts -->
                <div class="tab-pane" id="information" aria-labelledby="information-tab"
                    role="tabpanel">
                    <!-- users edit Info form start -->
                    <form action="#" method="post" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        @method('PUT')
                        <div class="row mt-1">
                            <div class="col-12">
                                <h4 class="mb-1">
                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Personal Information</span>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="birth">Birth date</label>
                                    <input type="date" class="form-control birthdate-picker" name="birth_date" value="{{$Merchant->birth_date}}" id="birth" placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="d-block mb-1">Gender</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" name="gender" value="1" @if ($Merchant->gender == 1) checked @endif class="custom-control-input" />
                                        <label class="custom-control-label" for="male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" name="gender" value="0" @if ($Merchant->gender == 0) checked @endif class="custom-control-input"/>
                                        <label class="custom-control-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4 class="mb-1 mt-2">
                                    <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Address</span>
                                </h4>
                            </div>

                           

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="address-1">Address Line</label>
                                    <input type="text" name="address_line_1" value="{{ $Merchant->address_line_1 }}" class="form-control" id="address-1" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="address-2">Address Line 2</label>
                                    <input type="text" name="address_line_2" value="{{ $Merchant->address_line_2 }}" class="form-control" id="address-2" />
                                </div>
                            </div>
                            
                            

                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ التغيرات</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit Info form ends -->
                </div>
                <!-- Information Tab ends -->

              
            </div>
        </div>
    </div>
</section>
<!-- users edit ends -->    



@endsection

@push('page_scripts_vendors')
<script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endpush

@push('page_scripts')
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/pages/app-user-edit.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/components/components-navs.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/pages/app-user-view.js"></script>
@endpush
