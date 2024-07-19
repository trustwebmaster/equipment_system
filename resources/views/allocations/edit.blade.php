@extends('layouts.master')
@section('title')
    Return Equipment
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    Return Equipment
@endsection

@section('body')

    <body>
    @endsection

    @section('content')

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Return Equipment : {{ $allocation->equipment->name }}</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('returns.update' , $allocation->uid) }}">
                            @method('PATCH')
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="equipment-name">Equipment  Name</label>
                                        <input type="text" class="form-control"
                                               value="{{$allocation->equipment->name}}" id="equipment-name" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="equipment-name">Equipment  Condition When Allocated</label>
                                        <input type="text" class="form-control"
                                               value="{{$allocation->allocation_equipment_status}}" id="equipment-name" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="equipment-name">Allocated User</label>
                                        <input type="text" class="form-control"
                                               value="{{$allocation->user->name}}" id="equipment-name" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="allocation_date">Date Of Allocation</label>
                                        <input type="date" class="form-control" placeholder="Select Date"
                                               value="{{ old('date', $allocation->date_of_allocation ) }}" id="allocation_date" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="type">Equipment Condition On Return </label>
                                        <select id="type" class="form-control form-select" name="condition" required>
                                            <option value="new">Brand New</option>
                                            <option value="old">Old</option>
                                        </select>
                                    </div>
                                    @error('condition')<span class="text-danger small">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="equipment-date">Date Of Return</label>
                                        <input type="date" class="form-control" placeholder="Select Date" name="date"
                                               id="equipment-date" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="equipment-name">Additional Notes</label>
                                        <input type="text" class="form-control" name="notes" id="equipment-name" required>
                                    </div>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let today = new Date().toISOString().split('T')[0];
                document.getElementById('equipment-date').setAttribute('max', today);
            });
        </script>

        <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
