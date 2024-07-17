@extends('layouts.master')
@section('title')
    Advance Tables
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
    Advance Tables
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">GridJs Table</h4>
                    </div><!-- end card header -->
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

            const users =  @json($users);

            const userData = users.map(user => [
                user.name,
                user.email,
                user.name,
                user.name
            ]);

            new gridjs.Grid({
                columns: ["Name", "Email", "Position", "Department"],
                pagination: {
                    limit: 10
                },
                sort: true,
                search: true,
                data: userData
            }).render(document.getElementById("table-gridjs"));

        </script>
@endsection
