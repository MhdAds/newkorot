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

<div class="row">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ $all_visits_count }}</h2>
                    <p class="card-text">All visits</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <i data-feather="truck" class="font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ $main_visits_count }}</h2>
                    <p class="card-text">As Main</p>
                </div>
                <div class="avatar bg-light-success p-50 m-0">
                    <div class="avatar-content">
                        <i data-feather="truck" class="font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="font-weight-bolder mb-0">{{ $secondary_visits_count }}</h2>
                    <p class="card-text">As Secondary</p>
                </div>
                <div class="avatar bg-light-danger p-50 m-0">
                    <div class="avatar-content">
                        <i data-feather="truck" class="font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="blog-edit-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Products / Show</h4>
                </div>
                <div class="card-body">
                    <form class="mt-2">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="product-manager-id">Product manager</label>
                                <select class="form-control" name="product_manager_id" id="product-manager-id" disabled>
                                    @foreach ($all_staff as $staff)
                                        <option value="{{$staff->id}}" @if($staff->id == $product->product_manager_id) selected @endif>{{$staff->name}}</option>
                                    @endforeach                                 
                                </select>
                            </div> 

                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" disabled/>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label>Description</label>
                                    <div id="blog-editor-wrapper">
                                        <div id="blog-editor-container">
                                            <textarea name="description" id="editor1" disabled> {!! $product->description !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                               <div class="border rounded p-2">
                                   <h4 class="mb-1">Featured Image</h4>
                                   <div class="media flex-column flex-md-row">
                                       <img src="{{ $product->main_image_full_path }}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image" />
                                       <div class="media-body">
                                           <small class="text-muted">Required image resolution 800x400, image size 10mb.</small>
                                           <p class="my-50">
                                               <a href="javascript:void(0);" id="blog-image-text">{{ $product->main_image_full_path }}</a>
                                           </p>
                                       </div>
                                   </div>
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
