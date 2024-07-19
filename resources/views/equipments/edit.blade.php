@extends('layouts.master')
@section('title')
    Edit User
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    Edit User
@endsection

@section('body')

<body>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit User : {{ $user->name }}</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update' , $user->uid) }}">
                        @method('PATCH')
                        @csrf

                        <div class="row">

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="user-name">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Full Name" name="name"
                                          value="{{$user->name}}" id="user-name" required>
                                </div>
                                @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="user-email">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter Valid Email" name="email"
                                          value="{{ $user->email  }}" id="user-email" required>
                                </div>
                                @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="user-password">Enter New Password</label>
                                    <input type="password" class="form-control" placeholder="Please Enter Password with at least 6 characters"
                                           name="password" id="user-password">
                                </div>
                                @error('password')<span class="text-danger small">{{ $message }}</span>@enderror

                            </div>

                            <div class="row mt-2">
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#success-btn" id="btn-save-event"><i
                                            class="me-1 align-middle"></i> Update </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
