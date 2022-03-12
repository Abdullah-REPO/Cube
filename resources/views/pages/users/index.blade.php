@extends('layouts.default')
@section('title')
    Users
@endsection
@section('content')
    <a href="{{ route('users.create') }}"> <button type="button" class="btn btn-primary waves-effect waves-light float-right">Add</button></a>
    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Job Title</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Modified</th>
            </tr>
        </thead>


        <tbody>
            @for ($i = 0; $i < 100; $i++)
                @foreach ($users as $user)
                @endforeach
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->job_title }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endfor
        </tbody>
    </table>

@section('plugins')
    <script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('pages/datatables.init.js') }}"></script>
@endsection
@endsection
