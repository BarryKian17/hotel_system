@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Manage Booking Area</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Area</li>
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
                            <form action="{{ route('book.area.update') }}" id="myForm" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                            <input type="text" name="id" value="{{ $data->id }}" hidden>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Short_title</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input type="text" name="short_title" class="form-control " value="{{ $data->short_title }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Main_title</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input type="text" name="main_title" class="form-control" value="{{ $data->main_title }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Description</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input type="text" name="description" class="form-control " value="{{ $data->short_description }}" />

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Link_url</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input type="text" name="link_url" class="form-control " value="{{ $data->link_url }}" />

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror" id="image"
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
                                            <img id="showImage" src="{{ asset($data->image) }}" width="100px"
                                                alt="">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    short_title: {
                        required: true,
                    },
                    main_title: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    link_url: {
                        required: true,
                    },

                },
                messages: {
                    short_title: {
                        required: 'Please Enter short_title',
                    },
                    main_title: {
                        required: 'Please Enter main_title',
                    },
                    description: {
                        required: 'Please Enter description',
                    },
                    link_url: {
                        required: 'Please Enter link_url',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
