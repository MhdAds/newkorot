@extends('dashboard.layouts.app')
@push('page_vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
@endpush
@push('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/pages/app-user.min.css">
@endpush
@section('content')

<!-- users edit start -->
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" id="account-tab"
                        data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                        <i data-feather="user"></i><span class="d-none d-sm-block">الحساب</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab"
                        href="#information" aria-controls="information" role="tab" aria-selected="false">
                        <i data-feather="info"></i><span class="d-none d-sm-block">البيانات الاضافية</span>
                    </a>
                </li>
               
            </ul>
            <div class="tab-content">
                <!-- Account Tab starts -->
                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                    
                    <!-- users edit account form start -->
                    <form action="{{ route('dashboard.merchants.update', $Merchant->id) }}" method="post" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-12">
                                <!-- users edit media object start -->
                                <div class="media mb-2">
                                    <img src="{{ image_or_placeholder($Merchant->avatar_full_path, 'profile') }}" alt="users avatar"
                                        class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                        height="90" width="90" />
                                    <div class="media-body mt-50">
                                        {{-- <h4>Eleanor Aguilar</h4> --}}
                                        <div class="col-12 d-flex mt-1 px-0">
                                            <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                                <span class="d-none d-sm-block">Change</span>
                                                <input class="form-control" type="file" name="avatar" id="change-picture" hidden accept="image/png, image/jpeg, image/jpg" />
                                                <span class="d-block d-sm-none">
                                                    <i class="mr-0" data-feather="edit"></i>
                                                </span>
                                            </label>
                                            @if ($Merchant->avatar() != null)
                                                <a href="{{ route('dashboard.common.image-delete', $Merchant->avatar()->id) }}" class="btn btn-outline-secondary d-none d-sm-block">Remove</a>
                                            @endif
                                            <button class="btn btn-outline-secondary d-block d-sm-none">
                                                <i class="mr-0" data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- users edit media object ends -->
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="supervisor-id">المسؤول</label>
                                <select class="form-control" name="supervisor_id" id="supervisor-id" required>
                                    <option value="">Select a supervisor</option>
                                    @foreach ($all_staff as $staff)
                                        <option value="{{$staff->id}}" @if($staff->id == $Merchant->supervisor_id) selected @endif>{{$staff->name}}</option>
                                    @endforeach                                 
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">الاسم بالكامل</label>
                                    <input type="text" class="form-control" placeholder="Name" value="{{ $Merchant->name }}" name="name" id="name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">البريد الالكتروني</label>
                                    <input type="email" class="form-control" placeholder="Email" value="{{ $Merchant->email }}" name="email" id="email" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="tel" class="form-control" placeholder="Phone" value="{{ $Merchant->phone }}" name="phone" id="phone" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">كلمة السر</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                                </div>
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password_confirmation">تأكيد كلمة السر</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" id="password_confirmation" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">حالة الحساب</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" @if ($Merchant->status == 1) selected @endif>Active</option>
                                        <option value="0" @if ($Merchant->status == 0) selected @endif>Deactivated</option>
                                        <option value="6" @if ($Merchant->status == 6) selected @endif>Blocked</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                <button type="submit"
                                    class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ التغيرات</button>
                                <button type="reset" class="btn btn-outline-secondary">الغاء</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                </div>
                <!-- Account Tab ends -->

                <!-- Information Tab starts -->
                <div class="tab-pane" id="information" aria-labelledby="information-tab"
                    role="tabpanel">
                    <!-- users edit Info form start -->
                    <form action="{{ route('dashboard.representative.update-info', $Merchant->id) }}" method="post" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        @method('PUT')
                        <div class="row mt-1">
                            <div class="col-12">
                                <h4 class="mb-1">
                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Personal Information</span>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="birth">Birth date</label>
                                    <input type="date" class="form-control birthdate-picker" name="birth_date" value="{{$Merchant->birth_date}}" id="birth" placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="d-block mb-1">Gender</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" name="gender" value="1" @if ($Merchant->gender == 1) checked @endif class="custom-control-input" />
                                        <label class="custom-control-label" for="male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" name="gender" value="0" @if ($Merchant->gender == 0) checked @endif class="custom-control-input"/>
                                        <label class="custom-control-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4 class="mb-1 mt-2">
                                    <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Address</span>
                                </h4>
                            </div>

                            <div class="col-md-4 col-6">
                                <label for="select-governorate">Governorate</label>
                                <select class="form-control" name="governorate_id" required>
                                    <option value="">Select governorate</option>
                                    @foreach ($governorates as $governorate)
                                        <option value="{{$governorate->id}}" @if (isset($Merchant->governorate) && $Merchant->governorate->id == $governorate->id) selected @endif>{{$governorate->name}}</option>
                                    @endforeach
                                </select>
                                {{-- <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please select your country</div> --}}
                            </div>

                            <div class="col-md-4 col-6">
                                <label for="select-city">City</label>
                                <select class="form-control" name="city_id" required>
                                    <option value="">Select city</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}" @if (isset($Merchant->city) && $Merchant->city->id == $city->id) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                </select>
                                {{-- <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please select your country</div> --}}
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="address-1">Address Line</label>
                                    <input type="text" name="address_line_1" value="{{ $Merchant->address_line_1 }}" class="form-control" id="address-1" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="address-2">Address Line 2</label>
                                    <input type="text" name="address_line_2" value="{{ $Merchant->address_line_2 }}" class="form-control" id="address-2" />
                                </div>
                            </div>
                            
                            

                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ التغيرات</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit Info form ends -->
                </div>
                <!-- Information Tab ends -->

              
            </div>
        </div>
    </div>
</section>
<!-- users edit ends -->    


<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Plans</h4>
                    <div class="form-modal-ex">
                        {{-- <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">
                            Copy Plans
                        </button> --}}
                        <!-- Modal -->
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Copy Plans Form</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('dashboard.plans.copy-plans') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="representative_id" value="{{$Merchant->id}}">
                                        <div class="modal-body">
                                            <label>Merchant ID: </label>
                                            <div class="form-group">
                                                <input type="text" name="copy_representative_id" placeholder="Enter plan id" class="form-control" required>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Copy</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.plans.create', $Merchant->id) }}" class="btn btn-gradient-success">Add New</a>
                    </div>
                </div>
                <div class="card-datatable">
                    <table class="dt-multilingual table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Month</th>
                                <th>Visits</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Merchant->plans()->orderBy('month', 'desc')->take(12)->get(); as $index => $plan)
                                <tr>
                                    <td>{{ $plan->id }}</td>
                                    <td>{{ $plan->month }}</td>
                                    <td>{{ $plan->visits->sum('visits') }}</td>
                                    <td>{{ $plan->created_at }}</td>
                                    <td>{{ $plan->updated_at }}</td>

                                    <td>
                                        <a href="{{ route('dashboard.plans.show', $plan->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Show">
                                            <i data-feather='eye'></i>
                                        </a>
                                        <a href="{{ route('dashboard.plans.edit', $plan->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill" style="padding: 6px;" title="Edit">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <a onclick="event.preventDefault();" data-delete="delete-form-{{$index}}" href="{{ route('dashboard.plans.destroy', $plan->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-blog m-btn--icon m-btn--icon-only m-btn--pill but_delete_action" style="padding: 6px;" title="Delete">
                                            <i data-feather='trash'></i>
                                        </a>
                                        <form id="delete-form-{{$index}}" action="{{ route('dashboard.plans.destroy', $plan->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
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
<script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endpush

@push('page_scripts')
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/pages/app-user-edit.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/components/components-navs.min.js"></script>
@endpush
