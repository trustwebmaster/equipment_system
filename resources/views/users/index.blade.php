@extends('layouts.master')
@section('title')
    Users
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
    Users
@endsection
@section('body')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Manage System Users</h4>
                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2"
                            data-bs-toggle="modal" data-bs-target=".create-user">
                        <i class="mdi mdi-plus me-1"></i>Add User
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['role_name'] }}</td>
                                    <td>
                                        <a href="/users/{{ $user['uid'] }}/edit" class="btn btn-sm btn-warning me-2"><i class="bx bx-show"></i> Update</a>
                                        <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $user['uid'] }}').submit(); }"><i class="bx bx-trash"></i> Delete</a>
                                        <form id="delete-form-{{ $user['uid'] }}" action="{{ route('users.destroy', $user['uid']) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="modal fade create-user" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Create System User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="user-name">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Full Name" name="name" id="user-name" required>
                                </div>
                                @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="user-email">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter Valid Email" name="email" id="user-email" required>
                                </div>
                                @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="role">Role</label>
                                    <select id="type" class="form-control form-select" name="role" required>

                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('role')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password</label>
                                    <input type="password" class="form-control auth-pass-inputgroup input-custom-icon" placeholder="Please Enter Password with at least 8 characters" name="password" id="password-input">
                                    <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                        <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                    </button>
                                </div>
                                @error('password')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i class="bx bx-x me-1 align-middle"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success-btn" id="btn-save-event"><i class="bx bx-check me-1 align-middle"></i> Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('build/js/pages/pass-addon.init.js') }}"></script>
@endsection
