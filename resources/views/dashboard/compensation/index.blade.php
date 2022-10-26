@extends('dashboard.layouts.app')
@push('page_vendor_css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/forms/select/select2.min.css">
@endpush
@push('page_styles')

@endpush
@section('content')

  
    <!-- Select2 End -->
    <section id="multilingual-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bcompensation-bottom">
                        <h4 class="card-title">التعويضات</h4>
                        {{-- <div>
                            <div class="form-modal-ex">
                                <a href="{{ route('dashboard.compensations.create') }}" class="btn btn-gradient-primary">New</a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-gradient-warning" data-toggle="modal" data-target="#inlineForm">
                                    Import
                                </button>
                                <!-- Modal -->
                                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                    
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Import Form</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('dashboard.compensations-import') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <label>File: </label>
                                                    <div class="form-group">
                                                        <input type="file" name="compensations" class="form-control" />
                                                    </div>
    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">import</button>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button>
    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-modal-ex">
                            <a href="{{ route('dashboard.compensation.create') }}" class="btn btn-gradient-primary">اضافة</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-multilingual table ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>اسم المستخدم</th>
                                    <th>المبلغ</th>
                                    <th>توقيت الاضافة</th>
                                    <th>الخيارات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compensations as $index => $compensation)
                                    <tr>
                                        <td>{{ $compensation->id }}</td>
                                        <td>{{ optional($compensation->user)->name }}</td>
                                        <td>{{ $compensation->value }}</td>
                                        <td>{{ $compensation->created_at }}</td>
                                        <td>
                                            @if(auth()->user()->canany(['super', 'compensation-show']))
                                                <a href="{{ route('dashboard.compensation.show', $compensation->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'compensation-edit']))
                                                <a href="{{ route('dashboard.compensation.edit', $compensation->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Edit">
                                                    <i data-feather='edit'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'compensation-destroy']))
                                                <a onclick="event.preventDefault();" data-delete="delete-form-{{$index}}" href="{{ route('dashboard.compensation.destroy', $compensation->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill but_delete_action" style="padding: 6px;" title="Delete">
                                                    <i data-feather='trash'></i>
                                                </a>
                                                <form id="delete-form-{{$index}}" action="{{ route('dashboard.compensation.destroy', $compensation->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                       

                    </div>
                   
                </div>
                
            </div>
        </div>

        {{ $compensations->links('vendor.pagination.bootstrap-4') }}
    </section>

    
@endsection

@push('page_scripts_vendors')
<script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
@endpush

@push('page_scripts')
<script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/forms/form-select2.js"></script>
@endpush
