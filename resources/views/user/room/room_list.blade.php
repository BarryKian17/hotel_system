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
                @foreach ($room as $r)
                    <div class="col-lg-3 col-md-6">
                        <div class="room-card">
                            <a href="{{ route('user.room.detail',$r->id) }}">
                                <img src="{{ asset('upload/room/' . $r->image) }}" alt="Images" width="420px" height="220px">
                            </a>
                            <div class="content">
                                <h5><a href="{{ route('user.room.detail',$r->id) }}" class="text-dark">{{ $r->room_name }}</a></h5>
                                <ul>
                                    <li class="text-color">{{ $r->price }}$</li>
                                    <li class="text-color">Per Night</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-12 col-md-12">
                    <div class="pagination-area">
                        <a href="#" class="prev page-numbers">
                            <i class='bx bx-chevrons-left'></i>
                        </a>

                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="#" class="page-numbers">2</a>
                        <a href="#" class="page-numbers">3</a>

                        <a href="#" class="next page-numbers">
                            <i class='bx bx-chevrons-right'></i>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Room Area End -->
@endsection
