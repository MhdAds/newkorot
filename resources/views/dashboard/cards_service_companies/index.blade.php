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
                        <h4 class="card-title">التحكم في البطاقات</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-multilingual table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>اسم الشركة</th>
                                    <th>الشعار</th>
                                    <th>الحالة</th>
                                    <th>الفئات الرئيسية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_companies as $index => $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>
                                            <img width="60" src="{{ image_or_placeholder($company->logo_full_path) }}" class="m--img-rounded m--marginless" alt="{{ $company->name }}">
                                        </td>
                                        <td>{{ $company->name }}</td>

                                        <td>
                                            
                                            @if(auth()->user()->canany(['super', 'cards-service-companies-update']))

                                                @if (in_array($company->id, $cards_service_companies))
                                                    <a onclick="event.preventDefault();" data-update="update-form-{{$index}}" href="{{ route('dashboard.cards-service-companies.update', $company->id) }}" 
                                                        class="btn btn-danger waves-effect waves-float waves-light but_update_action" title="تعطيل الخدمة">
                                                        تعطيل الخدمة
                                                    </a>
                                                @else 
                                                    <a onclick="event.preventDefault();" data-update="update-form-{{$index}}" href="{{ route('dashboard.cards-service-companies.update', $company->id) }}" 
                                                        class="btn btn-success waves-effect waves-float waves-light but_update_action" title="تفعيل الخدمة">
                                                        تفعيل الخدمة
                                                    </a>
                                                @endif
                                                
                                                {{-- <button type="button" class="btn btn-success waves-effect waves-float waves-light">Success</button> --}}
                                                {{-- <button type="button" class="btn btn-danger waves-effect waves-float waves-light">Danger</button> --}}
                                                <form id="update-form-{{$index}}" action="{{ route('dashboard.cards-service-companies.update', $company->id) }}" method="POST" style="display: none;">
                                                    @method('PUT')

                                                    @if (in_array($company->id, $cards_service_companies))
                                                        <input type="hidden" name="status" value="0">
                                                        <input type="hidden" name="service_id" value="1">

                                                    @else 
                                                        <input type="hidden" name="status" value="1">
                                                        <input type="hidden" name="service_id" value="1">

                                                    @endif

                                                    @csrf
                                                </form>
                                            @endif
                                           
                                            
                                        </td>

                                        <td>
                                            @if(auth()->user()->canany(['super', 'card-main-categories-index']))
                                                <span>{{ $company->card_main_categories->count() }}</span>
                                                <a href="{{ route('dashboard.card-main-categories.index', $company->id) }}" class="btn btn-outline-primary waves-effect" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                    <span>عرض</span>
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
        {{ $all_companies->links('vendor.pagination.bootstrap-4') }}
    </section>


@endsection

@push('page_scripts_vendors')

@endpush

@push('page_scripts')

@endpush
