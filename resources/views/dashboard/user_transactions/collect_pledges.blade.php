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
                        <h4 class="card-title">العمليات</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-multilingual table">
                            <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>اسم العميل</th>
                                    <th>القيمة</th>
                                    <th>توقيت العملية</th>
                                    <th>الخيارات</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Transactions as $index => $Transaction)
                                    <tr>
                                        
                                        <td>{{ $Transaction->id }}</td>
                                        <td>
                                            {{-- @if(auth()->user()->canany(['super', 'representatives-show']))
                                                <a href="{{ route('dashboard.representatives.show', $Transaction->representative->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    {{ $Transaction->representative->name }}
                                                </a>
                                            @else
                                                {{ $Transaction->representative->name }}
                                            @endif --}}
                                            {{ $Transaction->user->name }}
                                        </td>
                                        <td>{{ $Transaction->value }}</td>


                                       

                                        <td>{{ $Transaction->created_at }}</td>
                                        <td>
                                            @if(auth()->user()->canany(['super', 'user-transactions-show']))
                                                <a href="{{ route('dashboard.user-transactions.show', $Transaction->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                </a>
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
    </section>


@endsection

@push('page_scripts_vendors')

@endpush

@push('page_scripts')

@endpush
