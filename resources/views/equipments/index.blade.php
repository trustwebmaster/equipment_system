@extends('layouts.master')
@section('title')
    Equipments
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
    Equipments
@endsection
@section('body')
@endsection
@section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Manage Equipments</h4>
                        <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2"
                                data-bs-toggle="modal" data-bs-target=".create-equipment">
                            <i class="mdi mdi-plus me-1"></i>Add Equipment
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="table-gridjs"></div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="modal fade create-equipment" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Record Equipment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('equipments.store') }}">
                            @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="equipment-name">Equipment Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Equipment Name" name="name"
                                           id="equipment-name" required>
                                </div>
                                @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="equipment-date">Date Of Acquisition</label>
                                    <input type="date" class="form-control" placeholder="Select Date" name="date"
                                           id="equipment-date" required>
                                </div>
                                @error('date')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="type">Equipment Condition</label>
                                    <select id="type" class="form-control form-select" name="type" required>
                                        <option value="old">Old</option>
                                        <option value="new">Brand New</option>
                                    </select>
                                </div>
                                @error('type')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>



                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1 align-middle"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#success-btn" id="btn-save-event"><i
                                        class="bx bx-check me-1 align-middle"></i> Confirm</button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

@endsection
@section('scripts')
        <!-- gridjs js -->
        <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/gridjs.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let today = new Date().toISOString().split('T')[0];
                document.getElementById('equipment-date').setAttribute('max', today);
            });
        </script>

        <script>
            const equipments = @json($equipments);

            const equipmentData = equipments.map(equipment => {
                const date = new Date(equipment.date_of_acquisition);
                const year = date.getFullYear();
                const month = date.toLocaleString('default', { month: 'long' });

                return [
                    equipment.name,
                    equipment.status,
                    year,
                    month,
                    `<a href="/equipments/${equipment.uid}/edit" class="me-2"><i class="bx bx-show"></i> Update</a>
                     <a href="#" class="text-danger" onclick="event.preventDefault(); if (confirm('Are you sure you want to remove this equipment?')) { document.getElementById('delete-form-${equipment.uid}').submit(); }"><i class="bx bx-trash"></i> Delete</a>
                     <form id="delete-form-${equipment.uid}" action="{{ route('equipments.destroy', '') }}/${equipment.uid}" method="POST" style="display: none;">
                         @csrf
                        @method('DELETE')
                    </form>`
                ];
            });

            new gridjs.Grid({
                columns: ["Equipment Name", "Status", "Year of Acquisition", "Month of Acquisition", "Action"],
                pagination: {
                    limit: 10
                },
                sort: true,
                search: true,
                data: equipmentData,
                style: {
                    table: {
                        'white-space': 'nowrap'
                    }
                },
                data: equipmentData.map(row => row.map(cell => gridjs.html(cell)))
            }).render(document.getElementById("table-gridjs"));

        </script>



@endsection
