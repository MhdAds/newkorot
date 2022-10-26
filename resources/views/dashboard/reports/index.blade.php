@extends('dashboard.layouts.app')
@push('page_vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
@endpush
@push('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/pickers/form-pickadate.css">
@endpush
@section('content')


<div class="row">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-info p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-medium-5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">36.9k</h2>
                <p class="card-text">التجار</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-warning p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square font-medium-5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">12k</h2>
                <p class="card-text">الموزعين</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag font-medium-5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">97.8k</h2>
                <p class="card-text">المستخدمين العادين</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-primary p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart font-medium-5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">26.8</h2>
                <p class="card-text">المولات</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-success p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award font-medium-5"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">689</h2>
                <p class="card-text">الشركات</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck font-medium-5"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">2.1k</h2>
                <p class="card-text">المشرفين</p>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-info p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-medium-5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">36.9k</h2>
                <p class="card-text">قيمة المديونيات</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-warning p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square font-medium-5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">12k</h2>
                <p class="card-text">اجمالي القيمة المحصلة</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag font-medium-5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">97.8k</h2>
                <p class="card-text">عدد المدينين</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-primary p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart font-medium-5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">26.8</h2>
                <p class="card-text">قيمة العهد</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-success p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award font-medium-5"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">689</h2>
                <p class="card-text">عدد التعويضات</p>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="avatar bg-light-danger p-50 mb-1">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck font-medium-5"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                </div>
                <h2 class="font-weight-bolder">2.1k</h2>
                <p class="card-text">قيمة التعويضات</p>
            </div>
        </div>
    </div>

</div>




<div class="row">
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">500</h2>
                    <p class="card-text">طلبات اضافة رصيد</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu font-medium-5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">1523262</h2>
                    <p class="card-text">طلبات اضافة رصيد جديدة</p>
                </div>
                <div class="avatar bg-light-success p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server font-medium-5"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">2663</h2>
                    <p class="card-text">قيمة طلبات اضافة الرصيد الجديدة</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">2663</h2>
                    <p class="card-text">الارباح</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">2663</h2>
                    <p class="card-text">الارباح</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">2663</h2>
                    <p class="card-text">الارباح</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">13</h2>
                    <p class="card-text">Issues Found</p>
                </div>
                <div class="avatar bg-light-warning p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon font-medium-5"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>






<div class="row">
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">500</h2>
                    <p class="card-text">طلبات سحب الارباح</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu font-medium-5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">1523262</h2>
                    <p class="card-text">طلبات صحب الاراح الجديدة</p>
                </div>
                <div class="avatar bg-light-success p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server font-medium-5"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">2663</h2>
                    <p class="card-text">طلبات التعويضات</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">2663</h2>
                    <p class="card-text">قيمة طلبات التعويضات</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">2663</h2>
                    <p class="card-text">طلبات التعويضات الجديدة</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">2663</h2>
                    <p class="card-text">طلبات التعويضات الجديدةقيمة </p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection

@push('page_scripts_vendors')
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endpush

@push('page_scripts')
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
@endpush
