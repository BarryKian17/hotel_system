@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Room</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('room.type.list') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Room</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-primary" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                                        aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Home</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Room Number</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-3">
                                <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <h5 class="mb-4">Update Room</h5>
                                            <form class="row g-3" action="{{ route('room.update', $room[0]['id']) }}"
                                                enctype="multipart/form-data" method="POST">
                                                @csrf
                                                <div class="col-md-4">
                                                    <label for="input1" class="form-label">Room Type Name</label>
                                                    <input type="text" disabled name="room_type_id" class="form-control"
                                                        value="{{ $type[0]['name'] }}" id="input1"
                                                        placeholder="First Name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="input2" class="form-label">Total Adult</label>
                                                    <input type="text" name="total_adult" class="form-control"
                                                        value="{{ $room[0]['total_adult'] }}" id="input2">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="input2" class="form-label">Total Child</label>
                                                    <input type="text" name="total_child" class="form-control"
                                                        value="{{ $room[0]['total_child'] }}" id="input2">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="input3" class="form-label">Main Image</label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="image">
                                                    <img id="showImage" class="mt-1"
                                                        src="{{ !empty($room[0]['image']) ? asset('upload/room/' . $room[0]['image']) : url('storage/none.jpg') }}"
                                                        width="100px" alt="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="input4" class="form-label">Gallary</label>
                                                    <input type="file" name="multi_image[]" class="form-control" multiple
                                                        id="multiImg"
                                                        accept="image/jpeg , image/jpg , image/png , image/avif , image/gif">
                                                    @foreach ($multiImg as $m)
                                                        <img class="mt-1"
                                                            src="{{ !empty($m['multi_image']) ? url('upload/room/multiImg/' . $m['multi_image']) : url('storage/none.jpg') }}"
                                                            width="100px" height="100px" alt="">
                                                        <a href="{{ route('room.delete.multiImg', $m['id']) }}" id="delete"><i
                                                                class="lni lni-close me-3"></i></a>
                                                    @endforeach
                                                    <div class="row" id="preview_img"></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="input2" class="form-label">Room Price ($)</label>
                                                    <input type="text" name="price" class="form-control"
                                                        value="{{ $room[0]['price'] }}" id="input2">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="input2" class="form-label">Size</label>
                                                    <input type="text" name="size" class="form-control"
                                                        value="{{ $room[0]['size'] }}" id="input2">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="input2" class="form-label">Discount (%)</label>
                                                    <input type="text" name="discount" class="form-control"
                                                        value="{{ $room[0]['discount'] }}" id="input2">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="input2" class="form-label">Room Capacity</label>
                                                    <input type="text" name="room_capacity" class="form-control"
                                                        value="{{ $room[0]['room_capacity'] }}" id="input2">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="input7" class="form-label">Room View</label>
                                                    <select name="view" id="input7" class="form-select">
                                                        <option selected="">Choose...</option>
                                                        <option value="Sea View"
                                                            {{ $room[0]['view'] == 'Sea View' ? 'selected' : '' }}>Sea View
                                                        </option>
                                                        <option value="Hill View"
                                                            {{ $room[0]['view'] == 'Hill View' ? 'selected' : '' }}>Hill
                                                            View</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="input7" class="form-label">Bed Style</label>
                                                    <select name="bed_style" id="input7" class="form-select">
                                                        <option selected="">Choose...</option>
                                                        <option value="Queen Bed"
                                                            {{ $room[0]['bed_style'] == 'Queen Bed' ? 'selected' : '' }}>
                                                            Queen Bed</option>
                                                        <option value="Twin Bed"
                                                            {{ $room[0]['bed_style'] == 'Twin Bed' ? 'selected' : '' }}>
                                                            Twin Bed</option>
                                                        <option value="King Bed"
                                                            {{ $room[0]['bed_style'] == 'King Bed' ? 'selected' : '' }}>
                                                            King Bed</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="input11" class="form-label">Short Description</label>
                                                    <textarea class="form-control" name="short_desc" id="input11" placeholder="short description ..." rows="3">{{ $room[0]['short_desc'] }}</textarea>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="input11" class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" id="myeditorinstance" rows="3">{!! $room[0]['description'] !!}</textarea>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-md-12 mb-3">
                                                        @forelse ($basic_facility as $item)
                                                            <div class="basic_facility_section_remove"
                                                                id="basic_facility_section_remove">
                                                                <div class="row add_item">
                                                                    <div class="col-md-8">
                                                                        <label for="facility_name" class="form-label">
                                                                            Room Facilities </label>
                                                                        <select name="facility_name[]" id="facility_name"
                                                                            class="form-control">
                                                                            <option value="">Select Facility</option>
                                                                            <option value="Complimentary Breakfast"
                                                                                {{ $item->facility_name == 'Complimentary Breakfast' ? 'selected' : '' }}>
                                                                                Complimentary Breakfast</option>
                                                                            <option value="32/42 inch LED TV"
                                                                                {{ $item->facility_name == '32/42 inch LED TV' ? 'selected' : '' }}>
                                                                                32/42 inch LED TV</option>

                                                                            <option value="Smoke alarms"
                                                                                {{ $item->facility_name == 'Smoke alarms' ? 'selected' : '' }}>
                                                                                Smoke alarms</option>

                                                                                <option value="Mini Bar"
                                                                                {{ $item->facility_name == 'Mini Bar' ? 'selected' : '' }}>
                                                                                Mini Bar</option>

                                                                            <option value="Work Desk"
                                                                                {{ $item->facility_name == 'Work Desk' ? 'selected' : '' }}>
                                                                                Work Desk</option>

                                                                            <option value="Free Wi-Fi"
                                                                                {{ $item->facility_name == 'Free Wi-Fi' ? 'selected' : '' }}>
                                                                                Free Wi-Fi</option>

                                                                            <option value="Safety box"
                                                                                {{ $item->facility_name == 'Safety box' ? 'selected' : '' }}>
                                                                                Safety box</option>

                                                                            <option value="Rain Shower"
                                                                                {{ $item->facility_name == 'Rain Shower' ? 'selected' : '' }}>
                                                                                Rain Shower</option>

                                                                            <option value="Slippers"
                                                                                {{ $item->facility_name == 'Slippers' ? 'selected' : '' }}>
                                                                                Slippers</option>

                                                                            <option value="Hair dryer"
                                                                                {{ $item->facility_name == 'Hair dryer' ? 'selected' : '' }}>
                                                                                Hair dryer</option>

                                                                            <option value="Wake-up service"
                                                                                {{ $item->facility_name == 'Wake-up service' ? 'selected' : '' }}>
                                                                                Wake-up service</option>

                                                                            <option value="Laundry & Dry Cleaning"
                                                                                {{ $item->facility_name == 'Laundry & Dry Cleaning' ? 'selected' : '' }}>
                                                                                Laundry & Dry Cleaning</option>

                                                                            <option value="Electronic door lock"
                                                                                {{ $item->facility_name == 'Electronic door lock' ? 'selected' : '' }}>
                                                                                Electronic door lock</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group"
                                                                            style="padding-top: 30px;">
                                                                            <a class="btn btn-success addeventmore"><i
                                                                                    class="lni lni-circle-plus"></i></a>
                                                                            <span
                                                                                class="btn btn-danger p-2 btn-sm removeeventmore"><i
                                                                                    class="lni lni-circle-minus"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @empty

                                                            <div class="basic_facility_section_remove"
                                                                id="basic_facility_section_remove">
                                                                <div class="row add_item">
                                                                    <div class="col-md-6">
                                                                        <label for="basic_facility_name"
                                                                            class="form-label">Room Facilities </label>
                                                                        <select name="facility_name[]" id="facility_name"
                                                                            class="form-control">
                                                                            <option value="">Select Facility</option>
                                                                            <option value="Complimentary Breakfast">
                                                                                Complimentary Breakfast</option>
                                                                            <option value="32/42 inch LED TV"> 32/42 inch
                                                                                LED TV</option>
                                                                            <option value="Smoke alarms">Smoke alarms
                                                                            </option>
                                                                            <option value="Mini Bar">Mini Bar</option>
                                                                            <option value="Work Desk">Work Desk</option>
                                                                            <option value="Free Wi-Fi">Free Wi-Fi</option>
                                                                            <option value="Safety box">Safety box</option>
                                                                            <option value="Rain Shower">Rain Shower
                                                                            </option>
                                                                            <option value="Slippers">Slippers</option>
                                                                            <option value="Hair dryer">Hair dryer</option>
                                                                            <option value="Wake-up service">Wake-up service
                                                                            </option>
                                                                            <option value="Laundry & Dry Cleaning">Laundry
                                                                                & Dry Cleaning</option>
                                                                            <option value="Electronic door lock">Electronic
                                                                                door lock</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"
                                                                            style="padding-top: 30px;">
                                                                            <a class="btn btn-success addeventmore"><i
                                                                                    class="lni lni-circle-plus"></i></a>

                                                                            <span class="btn btn-danger removeeventmore"><i
                                                                                    class="lni lni-circle-minus"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforelse



                                                    </div>
                                                </div>
                                                <br>

                                                <div class="col-md-12">
                                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                                        <button type="submit" class="btn btn-primary px-4">Save
                                                            Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- ======================================= Room Number section =========================== --}}
                                <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <a class="card-title btn btn-primary float-right" onclick="addRoomNo()" id="addRoomNo">
                                                <i class="lni lni-plus">Add New</i>
                                            </a>
                                            <div class="roomHide" id="roomHide">
                                                <form action="{{ route('room.number.create') }}" method="POST">
                                                    @csrf
                                                    <input type="text" value="{{ $room[0]['id'] }}" hidden name="rooms_id">
                                                    <input type="text" value="{{ $room[0]['room_type_id'] }}" hidden name="room_type_id">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="input2" class="form-label">Room Number</label>
                                                            <input type="text" name="room_no" required class="form-control"
                                                                id="input2">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="input7" class="form-label">Room Status</label>
                                                            <select name="status" id="input7" class="form-select">
                                                                <option selected value="Active">Active
                                                                </option>
                                                                <option value="Inactive">Inactive</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="d-md-flex d-grid align-items-center gap-3 mt-4">
                                                                <button type="submit" class="btn btn-success px-2">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="card-body" id="roomView">
                                                <h4>Room List</h4>
                                                <table class="table mb-0 table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Room Number</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($roomNo as $r)
                                                        <tr>
                                                            <td>{{ $r->room_no }}</td>
                                                            <td>{{ $r->status }}</td>
                                                            <td>
                                                                <a href="{{ route('room.number.edit',$r->id) }}"><button class="btn btn-success">Edit</button></a>
                                                                <a href="{{ route('room.number.delete',$r->id) }}" id="delete" ><button class="btn btn-danger">Delete</button></a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ======================================= Room Number section End ===========================    --}}
                            </div>
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

    <!--------===Show MultiImage ========------->
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|avif)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <!--========== Start of add Basic Plan Facilities ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                <div class="container mt-2">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="basic_facility_name">Room Facilities</label>
                            <select name="facility_name[]" id="basic_facility_name" class="form-control">
                                <option value="">Select Facility</option>
                                <option value="Complimentary Breakfast">Complimentary Breakfast</option>
                                <option value="32/42 inch LED TV"> 32/42 inch LED TV</option>
                                <option value="Smoke alarms">Smoke alarms</option>
                                <option value="Mini Bar">Mini Bar</option>
                                <option value="Work Desk">Work Desk</option>
                                <option value="Free Wi-Fi">Free Wi-Fi</option>
                                <option value="Safety box">Safety box</option>
                                <option value="Rain Shower">Rain Shower</option>
                                <option value="Slippers">Slippers</option>
                                <option value="Hair dryer">Hair dryer</option>
                                <option value="Wake-up service">Wake-up service</option>
                                <option value="Laundry & Dry Cleaning">Laundry & Dry Cleaning</option>
                                <option value="Electronic door lock">Electronic door lock</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></span>
                            <span class="btn btn-danger removeeventmore"><i class="lni lni-circle-minus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#basic_facility_section_remove").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of Basic Plan Facilities ==============-->

    <!--========== Room Number section ==============-->
    <script>
        $('#roomHide').hide();
        $('$#roomView').show();
        function addRoomNo(){
            $('#roomHide').show();
            $('#roomView').hide();
            $('#addRoomNo').hide();
        }
    </script>
@endsection
