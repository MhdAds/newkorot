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
            <h2 class="content-header-title float-left mb-0">الفئات</h2>
            <div class="breadcrumb-wrapper">
                {{-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.representatives.index') }}">Representatives</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.representatives.edit', $CardMainCategory->user_id) }}">{{$CardMainCategory->representative->name}}</a>
                    </li>
                    <li class="breadcrumb-item active">CardMainCategory: #{{$CardMainCategory->id}} / Edit
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
                    <h4 class="card-title">تعديل الفئة الرئيسية</h4>
                </div>
                <div class="card-body">
                   
                    <!-- Form -->
                    <form action="{{ route('dashboard.card-main-categories.update', $CardMainCategory->id) }}" method="post" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            

                            <div class="col-md-6 col-12">
                                <label for="name">الاسم</label>
                                <input type="text" name="name" value="{{ $CardMainCategory->name }}" class="form-control" id="name" required />
                            </div>
                            

                            <div class="col-md-6 col-12">
                                <label for="rank">الترتيب</label>
                                <input type="number" name="rank" value="{{ $CardMainCategory->rank }}" class="form-control" id="rank" required />
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label>الوصف</label>
                                    <div id="blog-editor-wrapper">
                                        <div id="blog-editor-container">
                                            <textarea name="description" class="form-control" id="editor1">{{ $CardMainCategory->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-50">
                                <button type="submit" class="btn btn-primary mr-1">حفظ التغيرات</button>
                                <button type="reset" class="btn btn-outline-secondary">الغاء</button>
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
