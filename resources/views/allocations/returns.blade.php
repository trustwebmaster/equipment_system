@extends('layouts.master')
@section('title')
    Manage Returns
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
    Manage Returns
@endsection
@section('body')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Manage Returns</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Equipment</th>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Previous User</th>
                                <th>Allocation Date</th>
                                <th>Allocation Status</th>
                                <th>Return Status</th>
                                <th>Return Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allocations as $allocation)
                                <tr>
                                    <td>{{ $allocation->equipment->name }}</td>
                                    <td>{{ $allocation->equipment->model }}</td>
                                    <td>{{ $allocation->equipment->type }}</td>
                                    <td>{{ $allocation->user->name }}</td>
                                    <td>{{ $allocation->date_of_allocation }}</td>
                                    <td>{{ $allocation->allocation_equipment_status }}</td>
                                    <td>{{ $allocation->return_equipment_status }}</td>
                                    <td>{{ $allocation->return_date }}</td>
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

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let today = new Date().toISOString().split('T')[0];
            document.getElementById('equipment-date').setAttribute('max', today);
        });
    </script>
@endsection
