@include('userpanel.includes.header')

<div class="container-fluid full_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7 white_bg rounded p-4 p-md-5 mb-4 mt-5 shadow">
                <div class="text-center mb-4">
                    <i class="fas fa-credit-card fa-3x green_text mb-3" data-aos="fade-up"></i>
                    <h2 class="text-dark fw-bold" data-aos="fade-up">Complete Your Payment</h2>
                    <p class="p text-muted" data-aos="fade-up" data-aos-delay="100">Securely finalize your TukTuk
                        reservation.</p>
                </div>

                <!-- Order Summary Snippet -->
                <div class="bg-light p-3 rounded mb-5 border" data-aos="fade-up" data-aos-delay="150">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="p mb-0"><strong>Order Total:</strong></p>
                        <p class="h5 text_dark mb-0"><strong>${{ session('trip_data.totle') }}</strong></p>
                        <small class="text-muted">Includes vehicle rental, services, extras, and refundable
                            deposit.</small>
                    </div>

                    <form id="paymentForm" >
                              @csrf
                        <h4 class="text_dark fw-bold mb-3 mt-5" data-aos="fade-up" data-aos-delay="200">Select
                            Payment Method</h4>

                        <div class="mb-3 payment-method-option" data-aos="fade-up" data-aos-delay="250"
                            onclick="selectPaymentMethod('card')">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input mt-0" type="radio" name="paymentMethod"
                                    id="paymentCard" value="card" checked>
                                <label class="form-check-label p fw-bold ms-2 flex-grow-1" for="paymentCard">
                                    Credit / Debit Card
                                </label>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1200px-Visa_Inc._logo.svg.png"
                                    alt="Visa">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Mastercard_2019_logo.svg/1200px-Mastercard_2019_logo.svg.png"
                                    alt="Mastercard">
                            </div>
                        </div>

                        <div id="cardPaymentFields" class="mb-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-none" id="cardHolderName"
                                    name="cardHolderName" placeholder="Card Holder Name" required>
                                <label for="cardHolderName">Card Holder Name*</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-none" id="cardNumber" name="cardNumber"
                                    placeholder="Card Number (e.g., 1234 5678 9012 3456)" required
                                    pattern="\d{4}[\s-]?\d{4}[\s-]?\d{4}[\s-]?\d{4}">
                                <label for="cardNumber">Card Number*</label>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control shadow-none" id="expiryDate"
                                            name="expiryDate" placeholder="MM / YY" required
                                            pattern="(0[1-9]|1[0-2])\s?\/\s?(2[4-9]|[3-9][0-9])">
                                        <label for="expiryDate">Expiry Date (MM / YY)*</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control shadow-none" id="cvc"
                                            name="cvc" placeholder="CVC" required pattern="\d{3,4}">
                                        <label for="cvc">CVC*</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mb-4 payment-method-option" data-aos="fade-up" data-aos-delay="350"
                            onclick="selectPaymentMethod('paypal')">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paymentPaypal"
                                    value="paypal">
                                <label class="form-check-label p fw-bold ms-2 flex-grow-1" for="paymentPaypal">
                                    PayPal
                                </label>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/1200px-PayPal.svg.png"
                                    alt="PayPal">
                            </div>
                        </div> --}}

                        <div class="form-check mb-4" data-aos="fade-up" data-aos-delay="400">
                            <input class="form-check-input shadow-none" type="checkbox" value=""
                                id="agreePaymentTerms" required>
                                <input type="hidden" name="id" value="{{ session('trip_data.id') }}">
                            <label class="form-check-label p" for="agreePaymentTerms d-flex">
                                I agree to the <span href="terms.html" class="red_link">Booking Terms &
                                    Conditions</span> and <span href="privacy.html" class="red_link">Payment
                                    Policy</span>.*
                            </label>
                        </div>

                        <div class="text-center" data-aos="fade-up" data-aos-delay="450">
                            <button type="submit" class="fill_btn btn login_btn py-2"
                                  id="paymentBtn">
                                <i class="fas fa-lock me-2"></i>CONFIRM & PAY ${{ session('trip_data.totle') }}
                            </button>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paymentSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="paymentSuccessModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0 justify-content-center">
                <div class="text-success fs-1">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <div class="modal-body">
                <h5 class="modal-title mb-3" id="paymentSuccessModalLabel">Payment Successful!</h5>
                <p>Your transaction has been completed successfully.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="redirectHome()">OK</button>
            </div>
        </div>
    </div>
</div>

@include('userpanel.includes.footer')
