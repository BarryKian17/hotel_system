@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Team</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('team.list') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Members</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <form action="{{ route('team.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="id" hidden value="{{ $member->id }}">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                value="{{ $member->name }}" />
                                                @error('name')
                                                    <span class="text-danger">*{{ $message }}*</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Position</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                                                value="{{ $member->position }}" />
                                                @error('position')
                                                    <span class="text-danger">*{{ $message }}*</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Facebook</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror"
                                                value="{{ $member->facebook }}" />
                                                @error('facebook')
                                                    <span class="text-danger">*{{ $message }}*</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="image" class="form-control @error('image')
                                         is-invalid @enderror " id="image"
                                                value="" />
                                                @error('image')
                                                    <span class="text-danger">*{{ $message }}*</span>
                                                @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage"
                                                src="{{asset($member->image)}}"
                                                width="100px" alt="">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Update Changes" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(() => {
            $('#image').change(function() {
                const file = this.files[0];
                console.log(file);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $('#showImage').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
