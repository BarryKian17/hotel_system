@extends('user.main')

@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Inner Banner -->
    <div class="inner-banner inner-bg6">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>User Dashboard </li>
                </ul>
                <h3>User Dashboard</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Service Details Area -->
    <div class="service-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('user.dashboard.user_sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="service-article">
                        <section class="checkout-area pb-70">
                            <div class="container">
                                <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-details">
                                                <h3 class="title">User Profile </h3>

                                                <div class="row">

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Name <span class="required">*</span></label>
                                                            <input type="text" name="name"
                                                                value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid  @enderror ">
                                                                @error('name')
                                                                    <p class="text-danger">*{{ $message }}*</p>
                                                                @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Email<span class="required">*</span></label>
                                                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                                                class="form-control @error('email') is-invalid  @enderror ">
                                                                @error('email')
                                                                    <p class="text-danger">*{{ $message }}*</p>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Address<span class="required">*</span></label>
                                                        <input type="text" name="address" value="{{ Auth::user()->address }}"
                                                            class="form-control @error('address') is-invalid  @enderror ">
                                                            @error('address')
                                                                <p class="text-danger">*{{ $message }}*</p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone <span class="required">*</span></label>
                                                            <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                                                class="form-control @error('phone') is-invalid  @enderror ">
                                                                @error('phone')
                                                                    <p class="text-danger">*{{ $message }}*</p>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-sm-9 text-secondary">
                                                            <img id="showImage"
                                                                src="{{ !empty(Auth::user()->photo) ? url('storage/profile/' . Auth::user()->photo) : url('storage/user.jpg') }}"
                                                                width="100px" alt="" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>User Profile <span class="required">*</span></label>
                                                        <input type="file" id="image" name="photo"
                                                            class="form-control @error('photo') is-invalid  @enderror ">
                                                            @error('photo')
                                                                <p class="text-danger">*{{ $message }}*</p>
                                                            @enderror
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-danger">Save Changes </button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Service Details Area End -->
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
