<div class="room-area pt-100 pb-70 section-bg" style="background-color:#ffffff">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">ROOMS</span>
            <h2>Our Rooms & Rates</h2>
        </div>
        <div class="row pt-45">
            @foreach ($room as $r)
            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="{{ route('user.room.detail',$r->id) }}">
                                    <img src="{{ asset('upload/room/'.$r->image) }}" alt="Images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                 <h4 >
                                     <a href="{{ route('user.room.detail',$r->id) }}" class="text-dark">{{ $r->room_name }}</a>
                                </h4>
                                <span>{{ $r->price }}$ / Per Night </span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <p>{{ $r->short_desc }}</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> {{ $r->room_capacity }} Person</li>
                                    <li><i class='bx bx-expand'></i> {{ $r->size }}</li>
                                </ul>

                                <ul>
                                    <li><i class='bx bx-show-alt'></i> {{ $r->view }}</li>
                                    <li><i class='bx bxs-hotel'></i>{{ $r->bed_style }}</li>
                                </ul>

                                <a href="{{ route('user.room.detail',$r->id) }}" class="book-more-btn">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
</div>
    </div>
</div>
