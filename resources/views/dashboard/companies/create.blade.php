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
@section('content')

<div class="blog-edit-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">الشركات / اضافة</h4>
                </div>
                <div class="card-body">
                   
                    <!-- Form -->
                    <form action="{{ route('dashboard.companies.store') }}" method="post" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        <div class="row">
                            
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="edit-name">الاسم</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required id="edit-name" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="rank">الترتيب</label>
                                    <input type="number" name="rank" value="{{ old('rank') }}" id="rank" class="form-control">
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="border rounded p-2">
                                    <h4 class="mb-1">شعار الشركة</h4>
                                    <div class="media flex-column flex-md-row">
                                        <img src="{{asset('assets/dashboard') . '/' . 'placeholder_image.jpg'}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image" />
                                        <div class="media-body">
                                            <small class="text-muted">Required image resolution 800x400, image size 10mb.</small>
                                            <p class="my-50">
                                                <a href="javascript:void(0);" id="blog-image-text"></a>
                                            </p>
                                            <div class="d-inline-block">
                                                <div class="form-group mb-0">
                                                    <div class="custom-file">
                                                        <input type="file" name="logo" class="custom-file-input" id="blogCustomFile" accept="image/*" />
                                                        <label class="custom-file-label" for="blogCustomFile">اختر ملف</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/editors/quill/quill.min.js"></script>
@endpush

@push('page_scripts')
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/pages/page-blog-edit.js"></script>
    <script>
        CKEDITOR.replace('editor1', {
            language: 'en'
        });

    </script>
@endpush
