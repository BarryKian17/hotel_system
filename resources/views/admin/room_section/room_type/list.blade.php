@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <a href="{{ route('room.type.add.page') }}"><button class="btn btn-outline-primary">Add Room Type</button></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Room Type List</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $t)
                            @php
                                $room = App\Models\Room::where('room_type_id',$t->id)->get();
                            @endphp
                            <tr>
                                <td>{{ $t->id }}</td>
                                <td><img src="{{ !empty($room[0]['image']) ? asset('upload/room/'.$room[0]['image']) : url('storage/none.jpg') }}" style="width: 100px" alt=""></td>
                                <td>{{$t->name}}</td>
                                <td>
                                    <a href="{{ route('room.edit',$t->id) }}"><button class="btn btn-success">Edit</button></a>
                                    <a href="" id="delete" ><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
