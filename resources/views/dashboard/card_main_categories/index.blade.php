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
                        <h4 class="card-title">عرض الفئات الرئيسية</h4>
                        <div class="form-modal-ex">
                            <a href="{{ route('dashboard.card-main-categories.create', $company_id) }}" class="btn btn-gradient-primary">اضافة</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-multilingual table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>اسم الفئة</th>
                                    <th>توقيت الاضافة</th>
                                    <th>الفئات الفرعية</th>
                                    <th>الخيارات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index => $category)
                                    <tr>
                                        
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            @if(auth()->user()->canany(['super', 'card-categories-index']))

                                                {{ $category->card_categories->count() }}
                                                <a href="{{ route('dashboard.card-categories.index', $category->id) }}" class="btn btn-outline-primary waves-effect" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                    <span>عرض</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(auth()->user()->canany(['super', 'categories-show']))
                                                <a href="{{ route('dashboard.card-main-categories.show', $category->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'categories-edit']))
                                                <a href="{{ route('dashboard.card-main-categories.edit', $category->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Edit">
                                                    <i data-feather='edit'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'categories-destroy']))
                                                <a onclick="event.preventDefault();" data-delete="delete-form-{{$index}}" href="{{ route('dashboard.card-main-categories.destroy', $category->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill but_delete_action" style="padding: 6px;" title="Delete">
                                                    <i data-feather='trash'></i>
                                                </a>
                                                <form id="delete-form-{{$index}}" action="{{ route('dashboard.card-main-categories.destroy', $category->id) }}" method="POST" style="display: none;">
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
        {{ $categories->links('vendor.pagination.bootstrap-4') }}
    </section>


@endsection

@push('page_scripts_vendors')

@endpush

@push('page_scripts')

@endpush
