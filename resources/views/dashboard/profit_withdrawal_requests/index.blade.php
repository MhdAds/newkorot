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
                        <h4 class="card-title">طلبات اضافة رصيد</h4>
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
                                @foreach ($ProfitWithdrawalRequests as $index => $ProfitWithdrawalRequest)
                                    <tr>
                                        
                                        <td>{{ $ProfitWithdrawalRequest->id }}</td>
                                        <td>
                                            {{-- @if(auth()->user()->canany(['super', 'representatives-show']))
                                                <a href="{{ route('dashboard.representatives.show', $ProfitWithdrawalRequest->representative->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    {{ $ProfitWithdrawalRequest->representative->name }}
                                                </a>
                                            @else
                                                {{ $ProfitWithdrawalRequest->representative->name }}
                                            @endif --}}
                                            {{ $ProfitWithdrawalRequest->user->name }}
                                        </td>
                                        <td>{{ $ProfitWithdrawalRequest->value }}</td>

                                        <td>
                                            @if ($ProfitWithdrawalRequest->status == 0)
                                                جديد
                                            @elseif ($ProfitWithdrawalRequest->status == 1)
                                                تم المشاهدة 
                                            @elseif ($ProfitWithdrawalRequest->status == 2)
                                                مقبول 
                                            @elseif ($ProfitWithdrawalRequest->status == 3)
                                                تم التحويل 
                                            @elseif ($ProfitWithdrawalRequest->status == 6)
                                                مرفوض 
                                            @endif
                                        </td>

                                       

                                        <td>{{ $ProfitWithdrawalRequest->created_at }}</td>
                                        <td>
                                            @if(auth()->user()->canany(['super', 'profit-withdrawal-requests-show']))
                                                <a href="{{ route('dashboard.profit-withdrawal-requests.show', $ProfitWithdrawalRequest->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
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
