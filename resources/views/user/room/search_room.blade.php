@extends('user.main')

@section('main')
    <!-- Inner Banner -->
    <div class="inner-banner inner-bg9">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="{{ route('user.index') }}">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>Rooms</li>
                </ul>
                <h3>Rooms</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Room Area -->
    <div class="room-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color">ROOMS</span>
                <h2>Our Rooms & Rates</h2>
            </div>
            <div class="row pt-45">
                <?php $empty_array = []; ?>
                @foreach ($room as $r)
                    @php
                        $booking = App\Models\Booking::withCount('assign_rooms')
                            ->whereIn('id', $check_date_booking_ids)
                            ->where('rooms_id', $r->id)
                            ->get()
                            ->toArray();

                        $total_book_room = array_sum(array_column($booking, 'assign_rooms_count'));
                        $av_room = @$r->room_numbers_count - $total_book_room;
                    @endphp

                    @if ($av_room > 0 && old('person') <= $r->total_adult)


                    <div class="col-lg-3 col-md-6">
                        <div class="room-card">
                            <a href="{{ route('user.room.detail', $r->id) }}">
                                <img src="{{ asset('upload/room/' . $r->image) }}" alt="Images" width="420px"
                                    height="220px">
                            </a>
                            <div class="content">
                                <h5><a href="{{ route('user.room.detail', $r->id) }}"
                                        class="text-dark">{{ $r->room_name }}</a></h5>
                                <ul>
                                    <li class="text-color">{{ $r->price }}$</li>
                                    <li class="text-color">Per Night</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @else
                    <?php array_push($empty_array,$r->id) ?>
                    @endif
                @endforeach

                @if (count($room) == count($empty_array))
                    <h4 class="text-danger text-center fw-bold">Sorry. There is no Room</h4>
                @endif
            </div>
        </div>
    </div>
    <!-- Room Area End -->
@endsection
