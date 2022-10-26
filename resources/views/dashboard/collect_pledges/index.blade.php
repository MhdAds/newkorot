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
                    <div class="card-header bpledge-bottom">
                        <h4 class="card-title">العهود</h4>
                        {{-- <div>
                            <div class="form-modal-ex">
                                <a href="{{ route('dashboard.collect-pledges.create') }}" class="btn btn-gradient-primary">New</a>

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
                                            <form action="{{ route('dashboard.collect-pledges-import') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <label>File: </label>
                                                    <div class="form-group">
                                                        <input type="file" name="collect-pledges" class="form-control" />
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
                            <a href="{{ route('dashboard.collect-pledges.create') }}" class="btn btn-gradient-primary">اضافة</a>
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
                                @foreach ($collect_pledges as $index => $pledge)
                                    <tr>
                                        <td>{{ $pledge->id }}</td>
                                        <td>{{ optional($pledge->user)->name }}</td>
                                        <td>{{ $pledge->value }}</td>
                                        <td>{{ $pledge->created_at }}</td>
                                        <td>
                                            @if(auth()->user()->canany(['super', 'collect-pledges-show']))
                                                <a href="{{ route('dashboard.collect-pledges.show', $pledge->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'collect-pledges-edit']))
                                                <a href="{{ route('dashboard.collect-pledges.edit', $pledge->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Edit">
                                                    <i data-feather='edit'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'collect-pledges-destroy']))
                                                <a onclick="event.preventDefault();" data-delete="delete-form-{{$index}}" href="{{ route('dashboard.collect-pledges.destroy', $pledge->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill but_delete_action" style="padding: 6px;" title="Delete">
                                                    <i data-feather='trash'></i>
                                                </a>
                                                <form id="delete-form-{{$index}}" action="{{ route('dashboard.collect-pledges.destroy', $pledge->id) }}" method="POST" style="display: none;">
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

        {{ $collect_pledges->links('vendor.pagination.bootstrap-4') }}
    </section>

    
@endsection

@push('page_scripts_vendors')
<script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
@endpush

@push('page_scripts')
<script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/forms/form-select2.js"></script>
@endpush
