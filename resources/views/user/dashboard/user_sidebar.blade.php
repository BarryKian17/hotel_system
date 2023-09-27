        <div class="service-side-bar">


            <div class="services-bar-widget">
                <h3 class="title">User Side bar</h3>
                <div class="side-bar-categories">
                    <img src="{{ !empty(Auth::user()->photo) ? url('storage/user_profile/' . Auth::user()->photo) : url('storage/user.jpg') }}"
                        class="rounded mx-auto d-block" alt="Image" style="width:150px; height:150px;">
                    <div class="text-center">
                        <b>{{ Auth::user()->name }}</b><br>
                        <b>{{ Auth::user()->email }}</b><br>
                    </div>
                    <br>
                    <ul>
                        <a class="w-100" href="{{ route('dashboard') }}">
                            <li class="text-dark p-2">
                                User Dashboard
                            </li>
                        </a>
                        <a class="w-100" href="{{ route('user.profile') }}">
                            <li class="text-dark p-2">
                                User Profile
                            </li>
                        </a>
                        <a class="w-100" href="{{ route('user.password.change') }}">
                            <li class="text-dark p-2">
                                Change Password
                            </li>
                        </a>
                        <a class="w-100" href="#">
                            <li class="text-dark p-2">
                                Booking Details
                            </li>
                        </a>
                        <a class="w-100" href="{{ route('user.logout') }}">
                            <li class="text-dark p-2">
                                Logout
                            </li>
                        </a>
                    </ul>
                </div>
            </div>


        </div>
