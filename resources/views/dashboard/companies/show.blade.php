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
                    <h4 class="card-title">الشركات / تعديل</h4>
                    <div>
                        <div class="form-modal-ex">
                            <a href="{{ route('dashboard.companies.create') }}" class="btn btn-gradient-primary">اضافة</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="mt-2">
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="edit-country">الدولة</label>
                                    <input type="text" name="country" value="{{ $Company->country }}" id="edit-country" class="form-control" disabled>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="edit-name">الاسم</label>
                                    <input type="text" name="name" class="form-control" value="{{ $Company->name }}" disabled/>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="edit-email">البريد الاالكتروني</label>
                                    <input type="email" name="email" value="{{ $Company->email }}" id="edit-email" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="edit-phone">رقم الهاتف</label>
                                    <input type="tel" name="phone" value="{{ $Company->phone }}" id="edit-phone" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="edit-phone-2">رقم الهاتف الاخر</label>
                                    <input type="tel" name="another_phone" value="{{ $Company->another_phone }}" id="edit-phone-2" class="form-control" disabled>
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
