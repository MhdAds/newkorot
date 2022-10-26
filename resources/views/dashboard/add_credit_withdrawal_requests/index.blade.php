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
                        <h4 class="card-title">طلبات سحب الارباح</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-multilingual table">
                            <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>اسم العميل</th>
                                    <th>القيمة</th>
                                    <th>الحالة</th>
                                    <th>توقيت الطلب</th>
                                    <th>الخيارات</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AddCreditRequests as $index => $AddCreditRequest)
                                    <tr>
                                        
                                        <td>{{ $AddCreditRequest->id }}</td>
                                        <td>
                                            {{-- @if(auth()->user()->canany(['super', 'representatives-show']))
                                                <a href="{{ route('dashboard.representatives.show', $AddCreditRequest->representative->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    {{ $AddCreditRequest->representative->name }}
                                                </a>
                                            @else
                                                {{ $AddCreditRequest->representative->name }}
                                            @endif --}}
                                            {{ $AddCreditRequest->user->name }}
                                        </td>
                                        <td>{{ $AddCreditRequest->value }}</td>

                                        <td>
                                            @if ($AddCreditRequest->status == 0)
                                                جديد
                                            @elseif ($AddCreditRequest->status == 1)
                                                تم المشاهدة 
                                            @elseif ($AddCreditRequest->status == 2)
                                                مقبول 
                                            @elseif ($AddCreditRequest->status == 3)
                                                تم التحويل 
                                            @elseif ($AddCreditRequest->status == 6)
                                                مرفوض 
                                            @endif
                                        </td>

                                       

                                        <td>{{ $AddCreditRequest->created_at }}</td>
                                        <td>
                                            @if(auth()->user()->canany(['super', 'add-credit-withdrawal-requests-show']))
                                                <a href="{{ route('dashboard.add-credit-withdrawal-requests.show', $AddCreditRequest->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
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
