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
                    <h4 class="card-title">التعويضات / تعديل</h4>
                    
                </div>
                <div class="card-body">
                    <form class="mt-2">
                        <div class="row">

                            
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="user-id">المستخدم</label>
                                    <select class="form-control" name="user_id" id="user-id" disabled>
                                        <option value="">اختر مستخدم</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" @if ($Compensation->user->user_id == $user->id) selected @endif>{{$user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                          

                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="edit-total-payments">المبلغ</label>
                                    <input type="number" name="value" value="{{ $Compensation->value }}" id="edit-total-payments" class="form-control" disabled>
                                </div>
                            </div>
                            
                            {{-- <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label>تاريخ الدفع</label>
                                    <input type="text" name="payment_date" value="{{$Compensation->payment_date}}" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                                </div>
                            </div> --}}

                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="notes">الملاحظات</label>
                                    <textarea class="form-control" name="notes" id="notes" rows="4" disabled>{{$Compensation->notes}}</textarea>
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
