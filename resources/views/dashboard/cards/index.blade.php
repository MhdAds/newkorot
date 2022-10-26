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
                <div class="card-header">
                    <h4 class="card-title">الكروت</h4>
                    <div class="form-modal-ex">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">
                            استيراد
                        </button>
                        <!-- Modal -->
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">نافذة الاستيراد</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('dashboard.cards-import') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="category_id" value="{{$CardCategory->id}}">
                                        <div class="modal-body">
                                            <label>File: </label>
                                            <div class="form-group">
                                                <input type="file" name="cards" class="form-control" />
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">استيراد</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">الغاء</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        
                        <a href="{{ route('dashboard.cards.create', $CardCategory) }}" class="btn btn-gradient-primary">اضافة كرت</a>

                    </div>
                   
                </div>
                <div class="card-datatable">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>تاريخ الصلاحية</th>
                                <th>توقيت الاضافة</th>
                                <th>الخيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($CardCategory->cards as $index => $card)
                                <tr>
                                    <td>{{ $card->id }}</td>
                                    <td>{{ $card->expiry_date }}</td>
                                    <td>{{ $card->created_at }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.cards.show', $card->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                            <i data-feather='eye'></i>
                                        </a>
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
