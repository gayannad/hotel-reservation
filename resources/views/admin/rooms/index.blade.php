@extends('adminlte::page')

@section('title', 'Rooms')


@section('content')
    <div class="container">
        <x-adminlte-card title="Rooms" theme="dark" class="mt-4">
            <div class="row mb-3">
                <div class="col">
                    <a href="{{route('admin.rooms.create')}}" class="btn btn-success float-right">Add New</a>
                </div>
            </div>
            <table class="table table-bordered data-table" id="room_type_table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min')}}">
@stop

@section('js')
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2@10.js')}}"></script>


    <script>
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.rooms.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });

        function deleteRoomType(roomId){
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/admin/room-types/delete/' + roomId,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            Swal.fire('Deleted!', 'Room type has been deleted.', 'success');
                            $('#room_type_table').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        }
    </script>
@stop
