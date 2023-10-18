@extends('user.main')

@section('main')









        <!-- Inner Banner -->
        <div class="inner-banner inner-bg7">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li> Check Out</li>
                    </ul>
                    <h3> Check Out</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Checkout Area -->
		<section class="checkout-area pt-100 pb-70">
			<div class="container">
				<form action="{{ route('user.booking.checkout') }}" method="POST" role="form">
                    @csrf
					<div class="row">
                        <div class="col-lg-8">
							<div class="billing-details">
								<h3 class="title">Billing Details</h3>

								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Country <span class="required">*</span></label>
											<div class="select-box">
												<select class="form-control"  name="country">
													<option value="Myanmar">Myanmar</option>
													<option value="Thailand">Thailand</option>
													<option value="Singapore">Singapore</option>
													<option value="India">India</option>
													<option value="United State">United State</option>
													<option value="China">China</option>
													<option value="United Kingdom">United Kingdom</option>
													<option value="Germany">Germany</option>
													<option value="France">France</option>
													<option value="Japan">Japan</option>
													<option value="Canada">Canada</option>
													<option value="South-Korea">South-Korea</option>
													<option value="Any Other">Any Other</option>

												</select>
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Name <span class="required">*</span></label>
											<input required name="name" value="{{ Auth::user()->name }}" type="text" class="form-control fw-bold">
										</div>
									</div>
                                    <input name="user_id" value="{{ Auth::user()->id }}" type="hidden">

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Email<span class="required">*</span></label>
											<input required type="email" class="form-control fw-bold" name="email" value="{{ Auth::user()->email }}">
										</div>
									</div>

									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Phone</label>
											<input required name="phone" value="{{ Auth::user()->phone }}" type="text" class="form-control fw-bold">
										</div>
									</div>

									<div class="col-lg-12 col-md-6">
										<div class="form-group">
											<label>Address <span class="required">*</span></label>
											<input required name="address" value="{{ Auth::user()->address }}" type="text" class="form-control fw-bold">
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>State<span class="required">*</span></label>
											<input required type="text" name="state" class="form-control">
										</div>
									</div>

									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Zip_Code <span class="required">*</span></label>
											<input required type="text" name="zip_code" class="form-control">
										</div>
									</div>
								</div>
							</div>
						</div>


                        <div class="col-lg-4">
                            <section class="checkout-area pb-70">
                                <div class="card-body">
                                      <div class="billing-details">
                                            <h3 class="title">Booking Summary</h3>
                                            <hr>

                                            <div style="display: flex">
                                                  <img style="height:100px; width:120px;object-fit: cover" src="{{ !empty($room->image)? url('upload/room/'.$room->image) : asset('storage/none.jpg') }}" alt="Images" alt="Images">
                                                  <div style="padding-left: 10px;">
                                                        <a href=" " style="font-size: 17px; color: #595959;font-weight: bold">{{ $room_name[0]['name'] }}</a>
                                                        <p><b>{{$room->price}}$ / Night</b></p>
                                                  </div>

                                            </div>

                                            <br>

                                            <table class="table" style="width: 100%">
                                                @php
                                                    $subTotal = $room->price * $nights * $booking_data['number_of_rooms'] ;
                                                    if ($room->discount > 0) {
                                                        $d = $room->discount * 0.01;
                                                        $discount = $subTotal * $d;
                                                    } else {
                                                        $discount = 0;
                                                    }
                                                    $total = $subTotal - $discount
                                                @endphp
                                                  <tr>
                                                        <td><p><b>{{ $booking_data['check_in']}} - {{$booking_data['check_out'] }}</b></p></td>
                                                        <td style="text-align: right"><p>Total - <b>{{ $nights }} day(s)</b></p></td>
                                                  </tr>
                                                  <tr>
                                                        <td><p>Total Room</p></td>
                                                        <td style="text-align: right"><p><b>{{ $booking_data['number_of_rooms']}}</b></p></td>
                                                  </tr>
                                                  <tr>
                                                        <td><p>Subtotal</p></td>
                                                        <td style="text-align: right"><p>{{$subTotal}}$</p></td>
                                                  </tr>
                                                  <tr>
                                                        <td><p>Discount</p></td>
                                                        <td style="text-align:right"> <p>{{$discount}}$</p></td>
                                                  </tr>
                                                  <tr>
                                                        <td><p>Total</p></td>
                                                        <td style="text-align:right"> <p>{{$total}}$</p></td>
                                                  </tr>
                                            </table>

                                      </div>
                                </div>
                          </section>
                          <input type="hidden" name="subTotal" value="{{ $subTotal }}">
                          <input type="hidden" name="discount" value="{{ $discount }}">

                          <input type="hidden" name="total" value="{{ $total }}">
                          <input type="hidden" name="person" value="{{ $booking_data['person'] }}">

                          <input type="hidden" name="number_of_rooms" value="{{ $booking_data['number_of_rooms'] }}">

						</div>


						<div class="col-lg-8 col-md-8">
							<div class="payment-box">
                                <div class="payment-method">
                                    <p>
                                        <label class="fw-bold" for="direct-bank-transfer">Payment Method</label></p>
                                        <p>
                                            <input type="radio" id="cash-on-arrival" value="COD" name="payment_method">
                                            <label for="cash-on-arrival">Cash On Arrival</label>
                                        </p>
                                    <p>
                                        <input type="radio" id="stripe" name="radio-group">
                                        <label for="stripe">Stripe</label>
                                    </p>

                                </div>

                                <button href="#" class="order-btn three">
                                    Place to Order
                                </button>
                            </div>
						</div>
					</div>
				</form>
			</div>
		</section>
		<!-- Checkout Area End -->








@endsection
