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
                                    <th>id</th>
                                    <th>اسم العميل</th>
                                    <th>الرسالة</th>
                                    <th>الحالة</th>
                                    <th>توقيت الطلب</th>
                                    <th>الخيارات</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Helps as $index => $help)
                                    <tr>
                                        
                                        <td>{{ $help->id }}</td>
                                        <td>
                                            {{-- @if(auth()->user()->canany(['super', 'representatives-show']))
                                                <a href="{{ route('dashboard.representatives.show', $help->representative->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    {{ $help->representative->name }}
                                                </a>
                                            @else
                                                {{ $help->representative->name }}
                                            @endif --}}
                                            {{ $help->user->name }}
                                        </td>
                                        <td>{{ $help->message }}</td>

                                        <td>
                                            @if ($help->status == 0)
                                                جديد
                                            @elseif ($help->status == 1)
                                                تم المشاهدة 
                                            @elseif ($help->status == 2)
                                                مقبول 
                                            @elseif ($help->status == 3)
                                                تم التحويل 
                                            @elseif ($help->status == 6)
                                                مرفوض 
                                            @endif
                                        </td>

                                       

                                        <td>{{ $help->created_at }}</td>
                                        <td>
                                            @if(auth()->user()->canany(['super', 'help-show']))
                                                <a href="{{ route('dashboard.help.show', $help->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
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
