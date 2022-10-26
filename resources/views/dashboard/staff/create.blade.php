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

            <!-- Account Tab starts -->
            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                    
                <!-- users edit account form start -->
                <form method="POST" action="{{ route('dashboard.staff.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <!-- users edit media object start -->
                            <div class="media mb-2">
                                <img src="{{ image_or_placeholder('', 'profile') }}" alt="users avatar"
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
                                <input type="text" class="form-control" placeholder="Name" value="{{ old('name') }}" name="name" id="name" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" id="email" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" placeholder="Phone" value="{{ old('phone') }}" name="phone" id="phone" required />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Password" value="{{ old('password') }}" name="password" id="password" required />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" class="form-control" placeholder="Password Confirmation" value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirmation" required />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" id="role" required>
                                    <option value="">Select role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
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
                        
                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">حفظ التغيرات</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </form>
                <!-- users edit account form ends -->
            </div>
            <!-- Account Tab ends -->
              
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
