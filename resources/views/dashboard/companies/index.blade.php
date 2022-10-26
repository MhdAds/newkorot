@extends('dashboard.layouts.app')
@push('page_vendor_css')

@endpush
@push('page_styles')

@endpush
@section('content')

    <section id="multilingual-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">قائمة الشركات</h4>
                        <div>
                            <a href="{{ route('dashboard.companies.create') }}" class="btn btn-gradient-primary">اضافة</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-multilingual table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>الشعار</th>
                                    <th>الاسم</th>
                                    {{-- <th>الفئات</th> --}}
                                    {{-- <th>توقيت الاضافة</th> --}}
                                    <th>الخيارات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $index => $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>
                                            <img width="60" src="{{ image_or_placeholder($company->logo_full_path) }}" class="m--img-rounded m--marginless" alt="{{ $company->name }}">
                                        </td>
                                        <td>{{ $company->name }}</td>
                                        {{-- <td>
                                            
                                        </td> --}}

                                        {{-- <td>{{ $company->created_at }}</td> --}}
                                        <td>

                                            @if(auth()->user()->canany(['super', 'companies-show']))
                                                <a href="{{ route('dashboard.companies.show', $company->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'companies-edit']))
                                                <a href="{{ route('dashboard.companies.edit', $company->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Edit">
                                                    <i data-feather='edit'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'companies-destroy']))
                                                <a onclick="event.preventDefault();" data-delete="delete-form-{{$index}}" href="{{ route('dashboard.companies.destroy', $company->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill but_delete_action" style="padding: 6px;" title="Delete">
                                                    <i data-feather='trash'></i>
                                                </a>
                                                <form id="delete-form-{{$index}}" action="{{ route('dashboard.companies.destroy', $company->id) }}" method="POST" style="display: none;">
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
        {{ $companies->links('vendor.pagination.bootstrap-4') }}
    </section>

@endsection

@push('page_scripts_vendors')

@endpush

@push('page_scripts')

@endpush
