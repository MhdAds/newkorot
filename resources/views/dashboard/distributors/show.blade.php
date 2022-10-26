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
            <div class="card plan-card border-primary">
                
                <div class="card-body">
                    <div class="btn-group show">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary waves-effect waves-float waves-light">حركات الحساب</button>
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split waves-effect waves-float waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only"> Dropdown</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton902" style="">
                                <a class="dropdown-item" href="javascript:void(0);">جميع الحركات</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);">العهد</a>
                                <a class="dropdown-item" href="javascript:void(0);">عمليات تسديد العهد</a>
                                <div class="dropdown-divider"></div>
                                {{-- <h6 class="dropdown-header">Group 3</h6> --}}
                                <a class="dropdown-item" href="javascript:void(0);">المديونيات</a>
                                <a class="dropdown-item" href="javascript:void(0);">عمليات تسديد المديونيات</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);">طلبات سحب الارباح</a>
                                <a class="dropdown-item" href="javascript:void(0);">طلبات اضافة الرصيد</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);">التعويضات</a>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /Plan CardEnds -->

        <!-- User Card starts-->
        <div class="col-xl-10 col-lg-8 col-md-7">
            <div class="card user-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-8 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                            <div class="user-avatar-section">
                                <div class="d-flex justify-content-start">
                                    <img class="img-fluid rounded" src="{{ image_or_placeholder($Distributor->avatar_full_path, 'profile') }}" height="104" width="104" alt="User avatar">
                                    <div class="d-flex flex-column ml-1">
                                        <div class="user-info mb-1">
                                            <h4 class="mb-0">{{$Distributor->name}}</h4>
                                            <span class="card-text">{{$Distributor->email}}</span>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <a href="{{ route('dashboard.distributors.edit', $Distributor->id) }}" class="btn btn-primary waves-effect waves-float waves-light">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center user-total-numbers">
                                <div class="d-flex align-items-center mr-1">
                                    <div class="color-box bg-light-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-success"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Distributor->total_profits}}</h5>
                                        <small>اجمالي الارباح</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mr-1">
                                    <div class="color-box bg-light-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-primary"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Distributor->balance}}</h5>
                                        <small>الرصيد الحالي</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mr-1">
                                    <div class="color-box bg-light-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-danger"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Distributor->pledges}}</h5>
                                        <small>العهد</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mr-1">
                                    <div class="color-box bg-light-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-danger"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Distributor->debts}}</h5>
                                        <small>المديونيات</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mr-1">
                                    <div class="color-box bg-light-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-success"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$Distributor->debts}}</h5>
                                        <small>الرصيد المجمع</small>
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
                                        @if ($Distributor->status)
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
                                    <p class="card-text mb-0">{{$Distributor->phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Card Ends-->

        
    </div>
    <!-- User Card & Plan Ends -->
</section>  

<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">التجار</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>

<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">حركة الرصيد</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>

<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">عمليات ارسال الرصيد للتجار</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>

<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">عمليات تسديد التجار</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>


<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">العهد</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>


<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">عمليات تسديد العهد</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>


<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">المديونيات</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>


<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">عمليات تسديد المديونيات</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>


<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">طلبات سحب الارباح</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>


<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">طلبات اضافة الرصيد</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>

<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">التعويضات</h4>
                </div>
                <div class="table-responsive">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($merchants as $index => $merchant)
                                <tr>
                                    <td>{{ $merchant->id }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>

                                        @if(auth()->user()->canany(['super', 'merchants-show']))
                                            <a href="{{ route('dashboard.merchants.show', $merchant->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                <i data-feather='eye'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- {{ $merchants->links('vendor.pagination.bootstrap-4') }} --}}
</section>
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
