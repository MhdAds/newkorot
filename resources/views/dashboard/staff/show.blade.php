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
                        <i data-feather="user"></i><span class="d-none d-sm-block">Account</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab"
                        href="#information" aria-controls="information" role="tab" aria-selected="false">
                        <i data-feather="info"></i><span class="d-none d-sm-block">Information</span>
                    </a>
                </li>
               
            </ul>
            <div class="tab-content">
                <!-- Account Tab starts -->
                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                    
                    <!-- users edit account form start -->
                    <form class="mt-2">
                        <div class="row">

                            <div class="col-md-12">
                                <!-- users edit media object start -->
                                <div class="media mb-2">
                                    <img src="{{ image_or_placeholder($Staff->avatar_full_path, 'profile') }}" alt="users avatar"
                                        class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                        height="90" width="90" />
                                    <div class="media-body mt-50">
                                        {{-- <h4>Eleanor Aguilar</h4> --}}
                                        <div class="col-12 d-flex mt-1 px-0">
                                            {{-- <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                                <span class="d-none d-sm-block">Change</span>
                                                <input class="form-control" type="file" name="avatar" id="change-picture" hidden accept="image/png, image/jpeg, image/jpg" />
                                                <span class="d-block d-sm-none">
                                                    <i class="mr-0" data-feather="edit"></i>
                                                </span>
                                            </label> --}}
                                            @if ($Staff->avatar() != null)
                                                <a href="{{ route('dashboard.common.image-delete', $Staff->avatar()->id) }}" class="btn btn-outline-secondary d-none d-sm-block">Remove</a>
                                            @endif
                                            <button class="btn btn-outline-secondary d-block d-sm-none">
                                                <i class="mr-0" data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- users edit media object ends -->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" value="{{ $Staff->name }}" name="name" id="name" disabled/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" placeholder="Email" value="{{ $Staff->email }}" name="email" id="email" disabled/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" placeholder="Phone" value="{{ $Staff->phone }}" name="phone" id="phone" disabled/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">status</label>
                                    <select class="form-control" name="status" id="status" disabled>
                                        <option value="1" @if ($Staff->status == 1) selected @endif>Active</option>
                                        <option value="0" @if ($Staff->status == 0) selected @endif>Deactivated</option>
                                        <option value="6" @if ($Staff->status == 6) selected @endif>Blocked</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role" id="role" disabled>
                                        <option value="">Select role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if ($Staff->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                           
                            {{-- <div class="col-12">
                                <div class="table-responsive border rounded mt-1">
                                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                        <span class="align-middle">Permission</span>
                                    </h6>
                                    <table class="table table-striped table-borderless">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Module</th>
                                                <th>Read</th>
                                                <th>Write</th>
                                                <th>Create</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Admin</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input" id="admin-read"
                                                            checked />
                                                        <label class="custom-control-label"
                                                            for="admin-read"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="admin-write" />
                                                        <label class="custom-control-label"
                                                            for="admin-write"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="admin-create" />
                                                        <label class="custom-control-label"
                                                            for="admin-create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="admin-delete" />
                                                        <label class="custom-control-label"
                                                            for="admin-delete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Staff</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="staff-read" />
                                                        <label class="custom-control-label"
                                                            for="staff-read"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="staff-write" checked />
                                                        <label class="custom-control-label"
                                                            for="staff-write"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="staff-create" />
                                                        <label class="custom-control-label"
                                                            for="staff-create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="staff-delete" />
                                                        <label class="custom-control-label"
                                                            for="staff-delete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Author</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="author-read" checked />
                                                        <label class="custom-control-label"
                                                            for="author-read"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="author-write" />
                                                        <label class="custom-control-label"
                                                            for="author-write"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="author-create" checked />
                                                        <label class="custom-control-label"
                                                            for="author-create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="author-delete" />
                                                        <label class="custom-control-label"
                                                            for="author-delete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contributor</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="contributor-read" />
                                                        <label class="custom-control-label"
                                                            for="contributor-read"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="contributor-write" />
                                                        <label class="custom-control-label"
                                                            for="contributor-write"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="contributor-create" />
                                                        <label class="custom-control-label"
                                                            for="contributor-create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="contributor-delete" />
                                                        <label class="custom-control-label"
                                                            for="contributor-delete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>User</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="user-read" />
                                                        <label class="custom-control-label"
                                                            for="user-read"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="user-create" />
                                                        <label class="custom-control-label"
                                                            for="user-create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="user-write" />
                                                        <label class="custom-control-label"
                                                            for="user-write"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="user-delete" checked />
                                                        <label class="custom-control-label"
                                                            for="user-delete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                </div>
                <!-- Account Tab ends -->

                <!-- Information Tab starts -->
                <div class="tab-pane" id="information" aria-labelledby="information-tab"
                    role="tabpanel">
                    <!-- users edit Info form start -->
                    <form class="mt-2">
                       
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
                                    <input type="date" class="form-control birthdate-picker" name="birth_date" value="{{$Staff->birth_date}}" id="birth" placeholder="YYYY-MM-DD" disabled/>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="d-block mb-1">Gender</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" name="gender" value="1" @if ($Staff->gender == 1) checked @endif class="custom-control-input" disabled/>
                                        <label class="custom-control-label" for="male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" name="gender" value="0" @if ($Staff->gender == 0) checked @endif class="custom-control-input" disabled/>
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
                                <select class="form-control" name="governorate_id" disabled>
                                    <option value="">Select governorate</option>
                                    @foreach ($governorates as $governorate)
                                        <option value="{{$governorate->id}}" @if ( $Staff->governorate_id == $governorate->id) selected @endif>{{$governorate->name}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please select your country</div>
                            </div>

                            <div class="col-md-4 col-6">
                                <label for="select-city">City</label>
                                <select class="form-control" name="city_id" disabled>
                                    <option value="">Select city</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}" @if ($Staff->city_id == $city->id) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please select your country</div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="address-1">Address Line</label>
                                    <input type="text" name="address_line_1" value="{{ $Staff->address_line_1 }}" class="form-control" id="address-1" disabled/>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="address-2">Address Line 2</label>
                                    <input type="text" name="address_line_2" value="{{ $Staff->address_line_2 }}" class="form-control" id="address-2" disabled/>
                                </div>
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
