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
                        <h4 class="card-title">الموزعين</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-multilingual table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>الصورة</th>
                                    <th>الاسم</th>
                                    <th>الرصيد</th>
                                    <th>وقت الضافة</th>
                                    <th>حركات الحساب</th>
                                    <th>الخيارات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($distributors as $index => $distributor)
                                    <tr>
                                        <td>{{ $distributor->id }}</td>
                                        <td>
                                            <img width="60" src="{{ image_or_placeholder($distributor->avatar_full_path) }}" class="m--img-rounded m--marginless" alt="{{ $distributor->name }}">
                                        </td>
                                        <td>{{ $distributor->name }}</td>
                                        <td>{{ $distributor->balance }}</td>

                                        <td>{{ $distributor->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary waves-effect waves-float waves-light">حركات الحساب</button>
                                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split waves-effect waves-float waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only"> Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton902" style="">
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-transactions', $distributor->id) }}">جميع الحركات</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-pledges', $distributor->id) }}">العهد</a>
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-pledges', $distributor->id) }}">عمليات تسديد العهد</a>
                                                    <div class="dropdown-divider"></div>
                                                    {{-- <h6 class="dropdown-header">Group 3</h6> --}}
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-indebtedness', $distributor->id) }}">المديونيات</a>
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-indebtedness', $distributor->id) }}">عمليات تسديد المديونيات</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-profit-withdrawal-requests', $distributor->id) }}">طلبات سحب الارباح</a>
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-add-credit-withdrawal-requests', $distributor->id) }}">طلبات اضافة الرصيد</a>
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-add-credit-withdrawal-requests', $distributor->id) }}">عمليات تحويل الارباح لرصيد</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('dashboard.user-transactions.all-compensation', $distributor->id) }}">التعويضات</a>
                    
                                                </div>
                                        </td>
                                        <td>

                                            @if(auth()->user()->canany(['super', 'distributors-show']))
                                                <a href="{{ route('dashboard.distributors.show', $distributor->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'distributors-edit']))
                                                <a href="{{ route('dashboard.distributors.edit', $distributor->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Edit">
                                                    <i data-feather='edit'></i>
                                                </a>
                                            @endif

                                            {{-- @if(auth()->user()->canany(['super', 'distributors-destroy']))
                                                <a onclick="event.preventDefault();" data-delete="delete-form-{{$index}}" href="{{ route('dashboard.distributors.destroy', $distributor->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill but_delete_action" style="padding: 6px;" title="Delete">
                                                    <i data-feather='trash'></i>
                                                </a>
                                                <form id="delete-form-{{$index}}" action="{{ route('dashboard.distributors.destroy', $distributor->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            @endif
                                             --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        {{ $distributors->links('vendor.pagination.bootstrap-4') }}
    </section>


@endsection

@push('page_scripts_vendors')

@endpush

@push('page_scripts')

@endpush
