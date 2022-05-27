@extends('layouts.default')
@section('title')
    Users
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <div class="card border-radius-coust">
        <div class="card-body">
            @can('write-users')
                <a href="{{ route('users.create') }}">
                    <button type="button" class="btn btn-primary ml-3 all-buttons-coust  border-radius-coust col-1 table-coust waves-effect waves-light float-right"><i class="ti-plus"> </i> Add</button></a>
                    @endcan
                    <input  type="submit" value="Delete " class="btn btn-danger float-right col-1" id="checkerButton"/>
            <table id="datatable-buttons" class="table table-striped mt-3 text-center bitable-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th></th>
                        <th  class="th-table-coust">ID <i class="fas fa-sort-alpha-down float-right mt-1"></i></th>
                        <th  class="th-table-coust">Avatar<i class="fas fa-sort-alpha-down float-right mt-1"></i></th>
                        <th  class="th-table-coust">Name<i class="fas fa-sort-alpha-down float-right mt-1"></i></th>
                        <th  class="th-table-coust">Job Title<i class="fas fa-sort-alpha-down float-right mt-1"></i></th>
                        <th  class="th-table-coust">Phone<i class="fas fa-sort-alpha-down float-right mt-1"></i></th>
                        <th  class="th-table-coust">Email<i class="fas fa-sort-alpha-down ml-2 mt-1"></i></th>
                        <th  class="th-table-coust">Modified<i class="fas fa-sort-alpha-down float-right mt-1"></i></th>
                        <th  class="th-table-coust">Actions</th>
                    </tr>
                </thead>


                <tbody>
                    @php
                        $i = 0;
                    @endphp
                 
                    @foreach ($users as $user)
                        <tr class="userRow{{ $user->id }}">
                            <td>
                                <div class="form-check  ">
                                    <input type="checkbox" class="form-check-input checkbox-coust table-checkbox" name="" id="" value="checkedValue">
                                </div>
                            </td>
                            <td>{{ ++$i }}</td>
                            <td> <img src="{{ asset('images/avatars/' . $user->avatar) }}" alt="user"
                                    class="rounded-circle img-fluid avater-table-coust" >
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->job_title }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->updated_at }}</td>
                        <td>
                            <div class="d-flex"   <div class="d-inline">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <a href="{{ route('users.show', $user) }}"> <button type="button"
                                                class="btn btn-primary mr-2 border-radius-coust"><i class="eva eva-eye-outline"></i></button></a></div>
                                    <div class="d-inline">  @can('write-users')
                                            <button class="btn btn-danger delete_btn border-radius-coust" data-id="{{ $user->id }}"
                                                data-route="user-delete/"><i class="eva eva-trash"></i></button>
                                        @endcan
                                    </div>
                            </div>
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('jquery')
    <script>
        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var route = $(this).data("route");

            $.ajax({
                type: "POST",
                url: route,
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE",

                },
                success: function(data) {

                    $('.userRow' + id).remove();
                }

            });
        });
     </script>
@endsection

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
    <script src="{{asset('plugins/datatables/selected_delete.js')}}"></script><!--new file -->
    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('pages/datatables.init.js') }}"></script>
@endsection
