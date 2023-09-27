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
                <h3>User Change Password</h3>
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
                                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('put')
                                    <h3 class="text-center">Change Password</h3>
                                    @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-success fw-bold"
                                    >{{ __('Password changed Successfully') }}</p>
                                @endif
                                    <div>
                                        <x-input-label for="current_password" :value="__('Current Password')" class="form-label mx-4 mt-2 fw-bold" />
                                        <x-text-input id="current_password" name="current_password" type="password" class="block mx-4 w-75 form-control " autocomplete="current-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="password" :value="__('New Password')" class="form-label mx-4 mt-2 fw-bold" />
                                        <x-text-input id="password" name="password" type="password" class="block mx-4 w-75 form-control " autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label mx-4 mt-2 fw-bold" />
                                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block mx-4 w-75 form-control " autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <x-primary-button class="btn btn-primary text-center px-2 my-3 mx-4">{{ __('Save') }}</x-primary-button>

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
@endsection
