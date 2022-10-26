@extends('dashboard.layouts.app')
@push('page_vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
@endpush
@push('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/app-assets/css/pages/app-user.css">
@endpush
@section('content')

<!-- users edit start -->
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                        <i data-feather="user"></i><span class="d-none d-sm-block">Account</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" id="change_password-tab" data-toggle="tab" href="#change_password" aria-controls="change_password" role="tab" aria-selected="false">
                        <i data-feather='key'></i></i><span class="d-none d-sm-block">Change Password</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab"
                        href="#information" aria-controls="information" role="tab" aria-selected="false">
                        <i data-feather="info"></i><span class="d-none d-sm-block">Information</span>
                    </a>
                </li> --}}
                
        
            </ul>
            <div class="tab-content">
                <!-- Account Tab starts -->
                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                    <!-- users edit media object start -->
                    
                    <!-- users edit media object ends -->
                    <!-- users edit account form start -->
                    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data" class="form-validate">
                        @method('PUT')
                        @csrf
                        <div class="media mb-2">
                            <img src="{{ image_or_placeholder(auth()->guard('web')->user()->avatar_full_path, 'profile') }}" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90" />
                            <div class="media-body mt-50">
                                <h4>{{ auth()->guard('web')->user()->name }}</h4>
                                <div class="col-12 d-flex mt-1 px-0">
                                    <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                        <span class="d-none d-sm-block">Change</span>
                                        <input type="file" name="avatar" id="change-picture" hidden accept="image/png, image/jpeg, image/jpg" class="form-control" />
                                        <span class="d-block d-sm-none">
                                            <i class="mr-0" data-feather="edit"></i>
                                        </span>
                                    </label>
                                    <a href="#" class="btn btn-outline-secondary d-none d-sm-block">Remove</a>
                                    <button class="btn btn-outline-secondary d-block d-sm-none">
                                        <i class="mr-0" data-feather="trash-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" placeholder="Name" value="{{ auth()->guard('web')->user()->name }}" class="form-control" id="name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" placeholder="Email" value="{{ auth()->guard('web')->user()->email }}" class="form-control"  id="email" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">current password</label>
                                    <input type="password" name="current_password" class="form-control" placeholder="Enter your current password to حفظ التغيرات" id="company" />
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ التغيرات</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                </div>
                <!-- Account Tab ends -->

                <!-- change_password Tab starts -->
                <div class="tab-pane" id="change_password" aria-labelledby="change_password-tab" role="tabpanel">
                    <!-- users edit Info form start -->
                    <form class="form-validate">
                        <div class="row mt-1">
                            <div class="col-12">
                                <h4 class="mb-1">
                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Change password</span>
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">New password</label>
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter your new password to حفظ التغيرات" id="company" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">New password confirmation</label>
                                    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Enter your new password confirmation to حفظ التغيرات" id="company" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">current password</label>
                                    <input type="password" name="current_password" class="form-control" placeholder="Enter your current password to حفظ التغيرات" id="company" />
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
                <!-- change_password Tab ends -->


                <!-- Information Tab starts -->
                {{-- <div class="tab-pane" id="information" aria-labelledby="information-tab"
                    role="tabpanel">
                    <!-- users edit Info form start -->
                    <form action="{{ route('dashboard.profile.info-update', $user->id) }}" method="post" enctype="multipart/form-data" class="mt-2">
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
                                    <input type="date" class="form-control birthdate-picker" name="birth_date" value="{{$user->birth_date}}" id="birth" placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="d-block mb-1">Gender</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" name="gender" value="1" @if ($user->gender == 1) checked @endif class="custom-control-input" />
                                        <label class="custom-control-label" for="male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" name="gender" value="0" @if ($user->gender == 0) checked @endif class="custom-control-input"/>
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
                                        <option value="{{$governorate->id}}" @if ($user->governorate_id == $governorate->id) selected @endif>{{$governorate->name}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please select your country</div>
                            </div>

                            <div class="col-md-4 col-6">
                                <label for="select-city">City</label>
                                <select class="form-control" name="city_id" required>
                                    <option value="">Select city</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}" @if ($user->city_id == $city->id) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please select your country</div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="address-1">Address Line</label>
                                    <input type="text" name="address_line_1" value="{{ $user->address_line_1 }}" class="form-control" id="address-1" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="address-2">Address Line 2</label>
                                    <input type="text" name="address_line_2" value="{{ $user->address_line_2 }}" class="form-control" id="address-2" />
                                </div>
                            </div>
                            
                            

                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ التغيرات</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit Info form ends -->
                </div> --}}
                <!-- Information Tab ends -->
            </div>
        </div>
    </div>
</section>
<!-- users edit ends -->


@endsection

@push('page_scripts_vendors')

@endpush

@push('page_scripts')
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/pages/app-user-edit.js"></script>
    <script src="{{ asset('assets/dashboard') }}/app-assets/js/scripts/components/components-navs.js"></script>
@endpush
