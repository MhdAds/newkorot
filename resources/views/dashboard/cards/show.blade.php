@extends('dashboard.layouts.app')
@push('page_vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/editors/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/editors/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/editors/quill/quill.snow.css">

@endpush
@push('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/form-quill-editor.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/pages/page-blog.css">
@endpush

@section('route')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">الكروت</h2>
            <div class="breadcrumb-wrapper">
                {{-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.representatives.index') }}">Representatives</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.representatives.show', $PlanVisit->plan->user_id) }}">{{$PlanVisit->plan->representative->name}}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.plans.show', $PlanVisit->plan->id) }}">Plan: #{{$PlanVisit->plan->id}}</a>
                    </li>

                    <li class="breadcrumb-item active">الكروت / Show
                    </li>
                </ol> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="blog-edit-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">الكروت / عرض</h4>
                </div>
                <div class="card-body">
                   
                    <!-- Form -->
                    <form class="mt-2">
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="code">الكود</label>
                                    <input type="text" name="code" value="{{ $Card->code }}" class="form-control" id="code" disabled />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="expiry-date">تاريخ انتهاء الصلاحية</label>
                                    <input type="date" name="expiry_date" value="{{ $Card->expiry_date }}" class="form-control" id="expiry-date" disabled />
                                </div>
                            </div>

                        </div>
                    </form>
                    <!--/ Form -->
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('page_scripts_vendors')
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/editors/quill/katex.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/editors/quill/highlight.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
@endpush

@push('page_scripts')

   
@endpush
