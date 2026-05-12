 <div class="clearfix"></div>

 <!-- ========================================== -->
 <!-- ========================================== -->
 <!-- =================footer=================== -->

 <div class="container-fluid py-4" style="background-color: #003525;">
     <div class="container">
         <div class="row align-items-center justify-content-center">
             <div class="col-10">
                 <div class="row">
                     <div class="col-4 footer_col">
                         <div class="footer_logo mb-3">
                             <img src="{{ asset('public/frontend/images/logo.png') }}" alt="" class="w-100">
                         </div>
                         <p class="text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus
                             quo quas quaerat fuga in ut ullam quidem accusantium saepe dolores!</p>
                     </div>

                     <div class="col-4 footer_col d-flex flex-column justify-content-center ps-5">
                         <p class="fw-bold text-light">
                             Navigation
                         </p>

                         <div class="row">
                             <div class="col-6">
                                 <a href="" class="footer_link">
                                     <i class="fa-solid fa-arrow-right me-1"></i>
                                     Home
                                 </a>
                                 <a href="" class="footer_link">
                                     <i class="fa-solid fa-arrow-right me-1"></i>
                                     About Us
                                 </a>
                                 <a href="" class="footer_link">
                                     <i class="fa-solid fa-arrow-right me-1"></i>
                                     How It Work
                                 </a>
                             </div>

                             <div class="col-6">
                                 <a href="" class="footer_link">
                                     <i class="fa-solid fa-arrow-right me-1"></i>
                                     Pricing
                                 </a>
                                 <a href="" class="footer_link">
                                     <i class="fa-solid fa-arrow-right me-1"></i>
                                     FAQ
                                 </a>
                                 <a href="" class="footer_link">
                                     <i class="fa-solid fa-arrow-right me-1"></i>
                                     Contact Us
                                 </a>
                             </div>
                         </div>
                     </div>

                     <div class="col-4 d-flex flex-column justify-content-center ps-5">
                         <p class="fw-bold mb-1 text-light">Hotline</p>
                         <h2 class="footer_num"><a href="">
                                 +94 11 256 256
                             </a></h2>

                         <a href="" class="footer_link mb-3">
                             <i class="fa-regular fa-envelope"></i>
                             info@tuktuk.com
                         </a>

                         <div class="d-flex social_flex">
                             <a href="" class="footer_social_icon me">
                                 <i class="fa-brands fa-facebook-f"></i>
                             </a>
                             <a href="" class="footer_social_icon">
                                 <i class="fa-brands fa-instagram"></i>
                             </a>
                             <a href="" class="footer_social_icon">
                                 <i class="fa-brands fa-x-twitter"></i>
                             </a>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- ================================= -->
 <!-- ================================= -->
 <!-- ================================= -->


 <!-- Option 1: Bootstrap Bundle with Popper -->
 <script src="{{ asset('public/frontend/js/jquery-3.2.1.min.js') }}"></script>
 <script src="{{ asset('public/frontend/js/popper.min.js') }}"></script>
 <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>

 <!-- owl carousel -->
 <script src="{{ asset('public/frontend/owl/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('public/frontend/owl/owl_js.js') }}"></script>
 <!-- owl carousel -->

 <!-- Swiper JS -->
 <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>

 <!-- loading effect -->
 <script src="{{ asset('public/frontend/js/aos.js') }}"></script>

 <!-- date picker -->
 <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>
 <script src="{{ asset('public/frontend/date_picker/date_picker.js') }}"></script>
 <!-- date picker -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
 <script>
     AOS.init({
         easing: 'ease-out-back',
         duration: 1000
     });
 </script>
 <!-- loading effect -->

 <!-- Initialize Swiper -->
 <script>
     var swiper = new Swiper('.blog-slider', {
         spaceBetween: 30,
         effect: 'fade',
         loop: true,
         mousewheel: {
             invert: false,
         },
         // autoHeight: true,
         pagination: {
             el: '.blog-slider__pagination',
             clickable: true,
         }
     });
 </script>


 <!-- scroll top -->
 <script type="module">
     import ScrollTop from 'https://cdn.skypack.dev/smooth-scroll-top';
     const scrollTop = new ScrollTop();
     scrollTop.init();
 </script>
 <!-- scroll top -->

 <!-- owl carousel -->
 <script>
     $('.blog_slider').owlCarousel({
         loop: true,
         margin: 10,
         nav: false,
         dots: true,
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 3
             },
             1000: {
                 items: 4
             }
         }
     })
 </script>

 <script>
     $('.testi_slider').owlCarousel({
         loop: true,
         margin: 10,
         responsiveClass: true,
         responsive: {
             0: {
                 items: 1,
                 nav: false
             },
             600: {
                 items: 1,
                 nav: false
             },
             1000: {
                 items: 1,
                 nav: false,
                 loop: true
             }
         }
     })
 </script>
 <!-- owl carousel -->

 <!-- gallery -->
 <script src="{{ asset('public/frontend/gallery/fancybox.min.js') }}"></script>
 <!-- gallery -->

 <script>
     $(document).ready(function() {

         const inquiryForm = document.getElementById('booking_search_form');
         if (inquiryForm) {
             inquiryForm.addEventListener('submit', function(event) {
                 if (!inquiryForm.checkValidity()) {
                     event.preventDefault();
                     event.stopPropagation();
                 }
                 inquiryForm.classList.add('was-validated');

             }, false);
         }

     });


     // Centralized toast handling
     const showToast = (elementId, message) => {
         const toastElement = document.getElementById(elementId);
         const messageElement = document.getElementById(
             `${elementId.replace('_toast', '')}_message`);

         if (!toastElement || !messageElement) {
             console.error(`Toast element (${elementId}) or message element not found`);
             return;
         }

         messageElement.textContent = message;
         const toast = new bootstrap.Toast(toastElement);
         toast.show();
     };

     const registerForm = document.getElementById('register_form');
     const registerSubmit = document.getElementById('register_submit');


     if (registerSubmit) {
         registerSubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission


             // Bootstrap validation
             if (!registerForm.checkValidity()) {

                 registerForm.classList.add('was-validated');
                 return;
             }

             registerSubmit.disabled = true;
             try {
                 const formData = new FormData(registerForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('passenger-register') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {
                     const userId = response.userId;
                     window.location.href = '{{ route('email-verification', ['id' => 'userId']) }}'.replace(
                         "userId", userId);

                     registerForm.reset();
                     registerForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message || 'Registration failed');
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 registerSubmit.disabled = false;
             }


         });
     }

     const emailVerificationForm = document.getElementById('emailVerificationForm');
     const verifySubmit = document.getElementById('verifyAccountBtn');



     if (verifySubmit) {
         verifySubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission


             // Bootstrap validation
             if (!emailVerificationForm.checkValidity()) {

                 emailVerificationForm.classList.add('was-validated');
                 return;
             }

             verifySubmit.disabled = true;
             try {
                 const formData = new FormData(emailVerificationForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('verfy-email') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {

                     showToast('success_toast', response.message);

                     //dellay for the toast to show before redirecting
                     await new Promise(resolve => setTimeout(resolve, 2000));

                     window.location.href =
                         '{{ route('login') }}'; // Redirect to login page after successful verification

                     emailVerificationForm.reset();
                     emailVerificationForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message || 'Verification failed');
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 verifySubmit.disabled = false;
             }


         });
     }

     const resendCodeForm = document.getElementById('resendCodeForm');
     const resendSubmit = document.getElementById('resendCodeBtn');

     if (resendSubmit) {
         resendSubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission

             resendSubmit.disabled = true;
             try {
                 const formData = new FormData(resendCodeForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('resend-verification-code') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {
                     showToast('success_toast', response.message);
                     resendCodeForm.reset();
                     resendCodeForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message || 'Verification failed');
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 resendSubmit.disabled = false;
             }


         });
     }

     const loginForm = document.getElementById('login_form');
     const loginSubmit = document.getElementById('login_submit');

     if (loginSubmit) {
         loginSubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission


             // Bootstrap validation
             if (!loginForm.checkValidity()) {

                 loginForm.classList.add('was-validated');
                 return;
             }

             loginSubmit.disabled = true;
             try {
                 const formData = new FormData(loginForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('passenger-login') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {
                     window.location.href = '{{ route('passenger-dashboard') }}';

                     loginForm.reset();
                     loginForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message);
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 loginSubmit.disabled = false;
             }


         });
     }

     const resetForm = document.getElementById('passwordResetRequestForm');
     const resetSubmit = document.getElementById('resetPasswordBtn');

     if (resetSubmit) {
         resetSubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission


             // Bootstrap validation
             if (!resetForm.checkValidity()) {

                 resetForm.classList.add('was-validated');
                 return;
             }

             resetSubmit.disabled = true;
             try {
                 const formData = new FormData(resetForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('send-reset-link') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {
                     showToast('success_toast', response.message);

                     resetForm.reset();
                     resetForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message);
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 resetSubmit.disabled = false;
             }


         });
     }

     const setNewPasswordForm = document.getElementById('setNewPasswordForm');
     const setNewSubmit = document.getElementById('setNewPasswordBtn');

     if (setNewSubmit) {
         setNewSubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission


             // Bootstrap validation
             if (!setNewPasswordForm.checkValidity()) {

                 setNewPasswordForm.classList.add('was-validated');
                 return;
             }

             setNewSubmit.disabled = true;
             try {
                 const formData = new FormData(setNewPasswordForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('save-new-password') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {
                     showToast('success_toast', response.message);
                     await new Promise(resolve => setTimeout(resolve, 2000));

                     window.location.href = '{{ route('login') }}';
                     setNewPasswordForm.reset();
                     setNewPasswordForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message);
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 setNewSubmit.disabled = false;
             }


         });
     }


     const profileForm = document.getElementById('profileForm');
     const profileSubmit = document.getElementById('saveProfileBtn');

     if (profileSubmit) {
         profileSubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission


             // Bootstrap validation
             if (!profileForm.checkValidity()) {

                 profileForm.classList.add('was-validated');
                 return;
             }

             profileSubmit.disabled = true;
             try {
                 const formData = new FormData(profileForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('update-user-profile') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {
                     showToast('success_toast', response.message);

                     await new Promise(resolve => setTimeout(resolve, 2000));
                     window.location.reload();

                     profileForm.reset();
                     profileForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message);
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 profileSubmit.disabled = false;
             }


         });
     }


     const emailVerifyForm = document.getElementById('emailVerifyForm');
     const verifyEmailSubmit = document.getElementById('verifyEmailBtn');



     if (verifyEmailSubmit) {
         verifyEmailSubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission


             // Bootstrap validation
             if (!emailVerifyForm.checkValidity()) {

                 emailVerifyForm.classList.add('was-validated');
                 return;
             }

             verifyEmailSubmit.disabled = true;
             try {
                 const formData = new FormData(emailVerifyForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('booking-email-verfy') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {

                     showToast('success_toast', response.message);

                     //dellay for the toast to show before redirecting
                     await new Promise(resolve => setTimeout(resolve, 2000));

                     window.location.href =
                         '{{ route('go-payment') }}'; // Redirect to login page after successful verification

                     emailVerifyForm.reset();
                     emailVerifyForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message || 'Verification failed');
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 verifyEmailSubmit.disabled = false;
             }


         });
     }

     const paymentForm = document.getElementById('paymentForm');
     const paymentSubmit = document.getElementById('paymentBtn');



     if (paymentSubmit) {
         paymentSubmit.addEventListener('click', async (event) => {
             event.preventDefault(); // Prevent default form submission


             // Bootstrap validation
             if (!paymentForm.checkValidity()) {

                 paymentForm.classList.add('was-validated');
                 return;
             }

             paymentSubmit.disabled = true;
             try {
                 const formData = new FormData(paymentForm);

                 const response = await $.ajax({
                     type: 'POST',
                     url: '{{ route('confirm-payment') }}', // Replace with actual URL if needed
                     data: formData,
                     processData: false,
                     contentType: false
                 });


                 if (response.status === 'success') {

                     var paymentSuccessModal = new bootstrap.Modal(document.getElementById(
                         'paymentSuccessModal'));
                     paymentSuccessModal.show();
                     paymentForm.reset();
                     paymentForm.classList.remove('was-validated');
                 } else {
                     showToast('error_toast', response.message);
                 }
             } catch (error) {

                 const message = error.responseJSON?.message ||
                     'An unexpected error occurred. Please try again.';
                 showToast('error_toast', message);
             } finally {
                 paymentSubmit.disabled = false;
             }


         });
     }

     function redirectHome() {
         window.location.href = '{{ route('login') }}';
     }


     $(document).ready(function() {

         $('#driver_form').parsley();
     });

     $(document).ready(function() {

         $('#instructorForm').parsley();
     });

     $(document).ready(function() {

         $('#mechanicForm').parsley();
     });




     $('#appLanguages').select2({
         placeholder: 'Languages Spoken',
         allowClear: true,
         closeOnSelect: false
     });
 </script>

 <script>
     let initialProfileValues = {};
     const profileFormFields = ['firstName', 'lastName', 'mobile', 'birthDate', 'countryResidence',
         'passportNumber', 'emergencyContact'
     ];

     function storeInitialValues() {
         profileFormFields.forEach(id => {
             const element = document.getElementById(id);
             if (element) { // Check if element exists
                 initialProfileValues[id] = element.value;
             }
         });
         const profileImageElement = document.getElementById('profileImage');
         if (profileImageElement) { // Check if element exists
             initialProfileValues.profileImageSrc = profileImageElement.src;
         }
     }

     function resetToInitialValues() {
         profileFormFields.forEach(id => {
             const element = document.getElementById(id);
             if (element) { // Check if element exists
                 if (element.tagName === 'SELECT') {
                     element.value = initialProfileValues[id] || ''; // Set to empty string if undefined
                     // Also, update the selected option
                     const selectedOption = element.querySelector(`option[value="${element.value}"]`);
                     if (selectedOption) {
                         selectedOption.selected = true;
                     }
                 } else if (element.tagName === 'INPUT') {
                     element.value = initialProfileValues[id] || ''; // Set to empty string if undefined
                 }
             }
         });
         const profileImageElement = document.getElementById('profileImage');
         if (profileImageElement && initialProfileValues.profileImageSrc) { // Check if element and stored src exist
             profileImageElement.src = initialProfileValues.profileImageSrc;
         }
         const passwordElement = document.getElementById('password');
         if (passwordElement) passwordElement.value = '';
         const confirmPasswordElement = document.getElementById('confirmPassword');
         if (confirmPasswordElement) confirmPasswordElement.value = '';
     }

     function toggleEditProfile(isEditing) {
         profileFormFields.forEach(id => {
             const element = document.getElementById(id);
             if (element) { // Check if element exists
                 if (element.tagName === 'SELECT') {
                     element.disabled = !isEditing;
                 } else if (element.tagName === 'INPUT') {
                     element.readOnly = !isEditing;
                 }
             }
         });

         document.getElementById('passwordSection').style.display = isEditing ? 'block' : 'none';
         document.getElementById('confirmPasswordSection').style.display = isEditing ? 'block' : 'none';
         document.getElementById('editPicButton').style.display = isEditing ? 'flex' : 'none';

         document.getElementById('editProfileBtn').style.display = isEditing ? 'none' : 'inline-block';
         document.getElementById('saveProfileBtn').style.display = isEditing ? 'inline-block' : 'none';
         document.getElementById('cancelEditBtn').style.display = isEditing ? 'inline-block' : 'none';

         const formMessageElement = document.getElementById('formMessage');
         if (formMessageElement) formMessageElement.innerHTML = '';

         if (isEditing) {
             storeInitialValues();
         } else {
             resetToInitialValues();
         }
     }

     function previewProfileImage(event) {
         const reader = new FileReader();
         reader.onload = function() {
             const output = document.getElementById('profileImage');
             if (output) { // Check if element exists
                 output.src = reader.result;
             }
         };
         if (event.target.files[0]) {
             reader.readAsDataURL(event.target.files[0]);
         }
     }

     //  window.onload = () => {
     //      storeInitialValues(); // Store initial values FIRST
     //      toggleEditProfile(false); // Then set the initial state
     //      // Initialize datepicker if your date_picker.js requires it
     //      // Example: if (typeof datepicker === 'function') { datepicker('.datepicker_input', { /* options */ }); }
     //  }




     $(document).ready(function() {
         function updateVehicleCalculations() {
             // Get the trip duration
             const tripDuration = parseInt($('#trip_duration_input').val()) || 1;

             // Get all vehicle radio cards
             $('.radio-card').each(function() {
                 const $card = $(this);
                 const ratePerDay = parseFloat($card.find('.price_tag p').text().match(/[\d.]+/)[0]);
                 const deposit = parseFloat($card.find('.tuk_card p:contains("Deposit")').next().text()
                     .match(/[\d.]+/)[0]);

                 // Calculate fee (rate per day * duration)
                 const fee = ratePerDay * tripDuration;

                 // Update fee display
                 $card.find('.tuk_card p:contains("Fee")').next().text(`$${fee.toFixed(2)}`);

                 // Calculate and update total (fee + deposit)
                 const total = fee + deposit;
                 $card.find('.tuk_card p:contains("Total")').next().text(`$${total.toFixed(2)}`);
             });
         }

         function updateSelectedVehicle() {
             // Get the selected vehicle card
             const $selectedCard = $('.radio-card input[name="vehicle"]:checked').closest('.radio-card');
             if ($selectedCard.length) {
                 const ratePerDay = parseFloat($selectedCard.find('.price_tag p').text().match(/[\d.]+/)[0]);
                 const deposit = parseFloat($selectedCard.find('.tuk_card p:contains("Deposit")').next().text()
                     .match(/[\d.]+/)[0]);
                 const tripDuration = parseInt($('#trip_duration_input').val()) || 1;

                 // Calculate fee and total for selected vehicle
                 const fee = ratePerDay * tripDuration;
                 const total = fee + deposit;

                 // Update hidden inputs
                 $('#vehicle_fee_input').val(fee.toFixed(2));
                 $('#vehicle_totle_input').val(total.toFixed(2));
             }
         }

         function calculateDuration() {
             // Get the check-in and check-out date inputs
             const checkInInput = document.querySelector('input[name="check_in"]');
             const checkOutInput = document.querySelector('input[name="check_out"]');
             const durationSpan = document.querySelector('.green_text');

             if (checkInInput && checkOutInput && durationSpan) {
                 const checkInDate = new Date(checkInInput.value.split('/').reverse().join('-'));
                 const checkOutDate = new Date(checkOutInput.value.split('/').reverse().join('-'));

                 // Check if dates are valid
                 if (!isNaN(checkInDate) && !isNaN(checkOutDate)) {
                     // Calculate the difference in milliseconds
                     const timeDifference = checkOutDate - checkInDate;
                     // Calculate the difference in days
                     const durationInDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

                     // Update duration and trigger vehicle calculations
                     if (durationInDays == 0) {
                         durationSpan.textContent = '1 Day';
                         $('#trip_duration_input').val(1);
                     }

                     //  else if (durationInDays < 0) {
                     //      showToast('error_toast', 'check-out date must be greater than check-in date');
                     //      return;
                     //  }
                     else {
                         $('#trip_duration_input').val(durationInDays);
                         durationSpan.textContent = durationInDays + ' Days';
                     }

                     // Update all vehicle displays and selected vehicle inputs
                     updateVehicleCalculations();
                     updateSelectedVehicle();
                 } else {
                     showToast('error_toast', 'Invalid dates');
                 }
             }
         }

         // Initial calculation on page load
         calculateDuration();

         // Add event listeners for date changes
         const inputs = document.querySelectorAll('.datepicker_input');
         inputs.forEach(input => {
             input.addEventListener('blur', function() {
                 calculateDuration();
             });
         });

         // Add event listener for vehicle selection
         $('input[name="vehicle"]').on('change', function() {
             updateSelectedVehicle();
         });
     });

     $(document).ready(function() {

         $('#rent_step_1_form').parsley();
     });

     $(document).ready(function() {

         $('#bookingDetailsForm').parsley();

         // Assume you have an input field with id "email-input"

     });

     $('#email-input').on('input', function() {
         var email = $(this).val();

         $.ajax({
             type: 'GET',
             url: '{{ route('check-email') }}',
             data: {
                 email: email,
                 _token: $('meta[name="csrf-token"]').attr('content')
             },
             success: function(response) {
                 if (response.exists) {
                     // Email exists, autofill other input fields with retrieved data
                     $('#firstName').val(response.data.first_name);
                     $('#lastName').val(response.data.last_name);
                     $('#mobileNumber').val(response.data.phone_number);
                     $('#birthDay').val(response.data.date_of_birth);
                     $('#country').val(response.data.contry_of_residence);


                 } else {
                     $('#firstName').val('');
                     $('#lastName').val('');
                     $('#mobileNumber').val('');
                     $('#birthDay').val('');

                 }
             }
         });
     });
 </script>


 </body>

 </html>
