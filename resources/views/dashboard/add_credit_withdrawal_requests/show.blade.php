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
                    <h4 class="card-title">عرض طلب سحب الرصيد</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.add-credit-withdrawal-requests.update', $AddCreditRequest->id) }}" method="post" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="created-at">توقيت الطلب</label>
                                    <input type="text" class="form-control" value="{{ $AddCreditRequest->created_at }}" id="created-at" disabled />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="status">الحالة</label>
                                    <input type="text" class="form-control" value="@if ($AddCreditRequest->status == 0) جديد @elseif ($AddCreditRequest->status == 1) تم المشاهدة  @elseif ($AddCreditRequest->status == 2) مقبول  @elseif ($AddCreditRequest->status == 3) تم التحويل @elseif ($AddCreditRequest->status == 6) مرفوض  @endif" id="status" disabled />
                                </div>
                            </div>
                            
                            @if ($AddCreditRequest->status == 1 || $AddCreditRequest->status == 2)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">تحديث حالة الطلب</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1" @if ($AddCreditRequest->status == 1) selected @endif readonly>تم المشاهدة</option>
                                            <option value="2" @if ($AddCreditRequest->status == 2) selected @endif>الطلب مقبول</option>
                                            <option value="3" @if ($AddCreditRequest->status == 3) selected @endif>تم التحويل</option>
                                            <option value="6" @if ($AddCreditRequest->status == 6) selected @endif>مرفوض</option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="created-at">قيمة الطلب</label>
                                    <input type="text" class="form-control" value="{{ $AddCreditRequest->value }}" id="created-at" disabled />
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="d-block" for="staff-notes">Notes</label>
                                    <textarea class="form-control" id="staff-notes" name="staff_notes" rows="3" @if ($AddCreditRequest->status == 3 || $AddCreditRequest->status == 6) disabled @endif>{{ $AddCreditRequest->staff_notes }}</textarea>
                                </div>
                            </div>

                            
                            @if ($AddCreditRequest->status == 1 || $AddCreditRequest->status == 2)
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit"
                                        class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ التغيرات</button>
                                    <button type="reset" class="btn btn-outline-secondary">الغاء</button>
                                </div>
                            @endif

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
