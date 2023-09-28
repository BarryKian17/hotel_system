@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <a href="{{ route('team.add.page') }}"><button class="btn btn-outline-primary">Add Member</button></a>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Team Member List</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Facebook</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($team as $t)
                            <tr>
                                <td>{{ $t->id }}</td>
                                <td><img src="{{ asset($t->image) }}" alt="" style="width: 50px; height: 70px"></td>
                                <td>{{$t->name}}</td>
                                <td>{{ $t->position }}</td>
                                <td>{{ $t->facebook }}</td>
                                <td>
                                    <a href="{{ route('team.edit',$t->id) }}"><button class="btn btn-success">Edit</button></a>
                                    <a href="{{ route('team.delete',$t->id) }}"><button class="btn btn-danger">Delete</button></a>
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
