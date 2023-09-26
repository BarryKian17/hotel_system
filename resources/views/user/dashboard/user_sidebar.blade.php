        <div class="service-side-bar">


            <div class="services-bar-widget">
                <h3 class="title">User Side bar</h3>
                <div class="side-bar-categories">
                    <img src="{{ (!empty(Auth::user()->photo)) ? url('storage/user_profile/'.Auth::user()->photo) : url('storage/user.jpg') }}" class="rounded mx-auto d-block"
                        alt="Image" style="width:150px; height:150px;">
                    <div class="text-center">
                        <b>{{Auth::user()->name}}</b><br>
                        <b>{{ Auth::user()->email }}</b><br>
                    </div>
                    <br>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard') }}">User Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('user.profile') }}">User Profile </a>
                        </li>
                        <li>
                            <a href="#">Change Password</a>
                        </li>
                        <li>
                            <a href="#">Booking Details </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">Logout </a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
