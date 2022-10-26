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
                        <h4 class="card-title">الخدمات</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="dt-multilingual table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>الشعار</th>
                                    <th>الخدمة</th>
                                    <th>الحالة</th>
                                    <th>الخيارات</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $index => $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td>
                                            <img width="60" src="{{ image_or_placeholder($service->logo_full_path) }}" class="m--img-rounded m--marginless" alt="{{ $service->name }}">
                                        </td>
                                        <td>{{ $service->name }}</td>

                                        <td>
                                            
                                            @if(auth()->user()->canany(['super', 'cards-service-companies-update']))

                                                @if ($service->status)
                                                    <a onclick="event.preventDefault();" data-update="update-form-{{$index}}" href="{{ route('dashboard.cards-service-companies.update', $service->id) }}" 
                                                        class="btn btn-danger waves-effect waves-float waves-light but_update_action" title="تعطيل الخدمة">
                                                        تعطيل الخدمة
                                                    </a>
                                                @else 
                                                    <a onclick="event.preventDefault();" data-update="update-form-{{$index}}" href="{{ route('dashboard.cards-service-companies.update', $service->id) }}" 
                                                        class="btn btn-success waves-effect waves-float waves-light but_update_action" title="تفعيل الخدمة">
                                                        تفعيل الخدمة
                                                    </a>
                                                @endif
                                                
                         
                                                <form id="update-form-{{$index}}" action="{{ route('dashboard.service-status-update', $service->id) }}" method="POST" style="display: none;">
                                                    @method('PUT')

                                                    @if ($service->status)
                                                        <input type="hidden" name="status" value="0">
                                                    @else 
                                                        <input type="hidden" name="status" value="1">
                                                    @endif

                                                    @csrf
                                                </form>
                                            @endif
                                            
                                            
                                        </td>

                                        <td>
                                            @if(auth()->user()->canany(['super', 'services-show']))
                                                <a href="{{ route('dashboard.services.show', $service->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                                    <i data-feather='eye'></i>
                                                </a>
                                            @endif

                                            @if(auth()->user()->canany(['super', 'services-edit']))
                                                <a href="{{ route('dashboard.services.edit', $service->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Edit">
                                                    <i data-feather='edit'></i>
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
        {{ $services->links('vendor.pagination.bootstrap-4') }}
    </section>


@endsection

@push('page_scripts_vendors')

@endpush

@push('page_scripts')

@endpush
