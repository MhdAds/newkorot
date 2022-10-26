@extends('dashboard.layouts.app')
@push('page_vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/editors/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/editors/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/editors/quill/quill.snow.css">
    <script src="{{ asset('ckeditor') }}/ckeditor.js"></script>

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
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.representatives.index') }}">Representatives</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.representatives.edit', $plan->user_id) }}">{{$plan->representative->name}}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.plans.edit', $plan->id) }}">Plan: #{{$plan->id}} / Edit</a>
                    </li>
                    <li class="breadcrumb-item active">الكروت / تعديل
                    </li> --}}
                </ol>
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
                    <h4 class="card-title">الكروت / اضافة كرت</h4>
                </div>
                <div class="card-body">
                   
                    <!-- Form -->
                    <form action="{{ route('dashboard.cards.store') }}" method="post" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        <div class="row">

                            <input type="hidden" name="category_id" value="{{ $category_id }}">

                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="code">الكود</label>
                                    <input type="text" name="code" class="form-control" id="code" required />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="expiry-date">تاريخ انتهاء الصلاحية</label>
                                    <input type="date" name="expiry_date" class="form-control" id="expiry-date" required />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buy_price">تكلفة الشراء</label>
                                    <input type="text" name="buy_price" class="form-control" id="buy_price" required />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buy_price">تكلفة البيع للعملاء</label>
                                    <input type="text" name="buy_price" class="form-control" id="buy_price" required />
                                </div>
                            </div>

                            <div class="col-12 mt-50">
                                <button type="submit" class="btn btn-primary mr-1">اضافة</button>
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

@endpush

@push('page_scripts')



@endpush
