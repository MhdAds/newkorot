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
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.representatives.show', $CardMainCategory->user_id) }}">{{$CardMainCategory->representative->name}}</a>
                    </li>
                    <li class="breadcrumb-item active">CardMainCategory: #{{$CardMainCategory->id}} / Show
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
                    <h4 class="card-title">عرض الفئة الرئيسية</h4>
                    
                </div>
                <div class="card-body">
                   
                    <!-- Form -->
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <label for="name">الاسم</label>
                            <input type="text" name="name" value="{{ $CardMainCategory->name }}" class="form-control" id="name" disabled />
                        </div>
                        

                        <div class="col-md-6 col-12">
                            <label for="rank">الترتيب</label>
                            <input type="number" name="rank" value="{{ $CardMainCategory->rank }}" class="form-control" id="rank" disabled />
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label>الوصف</label>
                                <div id="blog-editor-wrapper">
                                    <div id="blog-editor-container">
                                        <textarea name="description" class="form-control" id="editor1" disabled>{{ $CardMainCategory->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                    <!--/ Form -->
                </div>
            </div>
        </div>
    </div>
</div>


<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">الكروت</h4>
                    <div class="form-modal-ex">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">
                            استيراد
                        </button>
                        <!-- Modal -->
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">نافذة الاستيراد</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('dashboard.cards-import') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="category_id" value="{{$CardMainCategory->id}}">
                                        <div class="modal-body">
                                            <label>File: </label>
                                            <div class="form-group">
                                                <input type="file" name="cards" class="form-control" />
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">استيراد</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">الغاء</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        
                        <a href="{{ route('dashboard.cards.create', $CardMainCategory) }}" class="btn btn-gradient-primary">اضافة كرت</a>

                    </div>
                   
                </div>
                <div class="card-datatable">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>تاريخ الصلاحية</th>
                                <th>توقيت الاضافة</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($CardMainCategory->cards as $index => $card)
                                <tr>
                                    <td>{{ $card->id }}</td>
                                    <td>{{ $card->expiry_date }}</td>
                                    <td>{{ $card->created_at }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.cards.show', $card->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                            <i data-feather='eye'></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('page_scripts_vendors')
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/editors/quill/katex.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/editors/quill/highlight.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
@endpush

@push('page_scripts')


   
@endpush
