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
                    <h4 class="card-title">Visits / Show</h4>
                </div>
                <div class="card-body">
                    <form class="mt-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="visit-time">Visit time</label>
                                    <input type="text" class="form-control" value="{{ $UserVisit->visit_time }}" id="visit-time" disabled />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="created-at">Created at</label>
                                    <input type="text" class="form-control" value="{{ $UserVisit->created_at }}" id="created-at" disabled />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" value="@if ($UserVisit->status == \App\Models\UserVisit::STATUS_CANCELLED) cancelled @else completed @endif" id="status" disabled />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" value="@if ($UserVisit->type == \App\Models\UserVisit::TYPE_INDIVIDUAL) individual @else with the supervisor @endif" id="type" disabled />
                                </div>
                            </div>

                            @if ($UserVisit->status == \App\Models\UserVisit::STATUS_CANCELLED)
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="reason">Cancel reason</label>
                                        <input type="text" class="form-control" value="{{ $UserVisit->cancel_reason->reason }}" id="reason" disabled />
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="d-block" for="main-products">Main products</label>
                                        <textarea class="form-control" id="main-products" name="main_products" rows="3" disabled>@foreach ($UserVisit->main_products as $main_product){{ $main_product->name }} @endforeach
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="d-block" for="secondary-products">Secondary products</label>
                                        <textarea class="form-control" id="secondary-products" name="secondary_products" rows="3" disabled>@foreach ($UserVisit->secondary_products as $secondary_product){{ $secondary_product->name }} @endforeach
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="d-block" for="items">Items</label>
                                        <textarea class="form-control" id="items" name="items" rows="3" disabled>@foreach ($UserVisit->items as $item){{ $item->name  . ' ( ' . $item->pivot->quantity .' )'}} @endforeach
                                        </textarea>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="d-block" for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3" disabled>{{ $UserVisit->notes }}</textarea>
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
