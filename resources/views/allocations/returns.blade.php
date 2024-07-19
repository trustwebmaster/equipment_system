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
                    <h4 class="card-title mb-0">Manage Returns</h4>
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
        const allocations = @json($allocations);

        const equipmentData = allocations.map(allocation => {

            return [
                allocation.equipment.name,
                allocation.equipment.model,
                allocation.equipment.type,
                allocation.user.name,
                allocation.date_of_allocation,
                allocation.allocation_equipment_status,
                allocation.return_equipment_status,
                allocation.return_date

            ];
        });

        new gridjs.Grid({
            columns: ["Equipment", "Model","Type", "Previous User"  , "Allocation Date", "Allocation Status", "Return Status" ,"Return Date"],
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
