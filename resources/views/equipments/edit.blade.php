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
                    <h4 class="card-title mb-0">Edit Equipment : {{ $equipment->name }}</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('equipments.update' , $equipment->uid) }}">
                        @method('PATCH')
                        @csrf

                        <div class="row">

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="equipment-name">Equipment  Name</label>
                                    <input type="text" class="form-control" placeholder="Enter  Name" name="name"
                                          value="{{$equipment->name}}" id="equipment-name" required>
                                </div>
                                @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="equipment-date">Date Of Acquisition</label>
                                    <input type="date" class="form-control" placeholder="Select Date" name="date"
                                           value="{{ old('date', $equipment->date_of_acquisition ) }}" id="equipment-date" required>
                                </div>
                                @error('date')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="type">Equipment Condition</label>
                                    <select id="type" class="form-control form-select" name="type" required>
                                        <option value="new" {{ $equipment->status == 'new' ? 'selected' : '' }}>Brand New</option>
                                        <option value="old" {{ $equipment->status == 'old' ? 'selected' : '' }}>Old</option>
                                    </select>
                                </div>
                                @error('type')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="row mt-6">
                                <div class="col-12 text-end">
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
