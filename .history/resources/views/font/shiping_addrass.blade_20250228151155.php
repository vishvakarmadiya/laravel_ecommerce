<!DOCTYPE html>
<html lang="en">

<head>
    @include ('font.hedderlink')
</head>

<body>
    <!-- Top Header Start -->
    @include ('font.tophedder')
    <!-- Top Header End -->

    <!-- Header Start -->
    @include ('font.navbar')
    <!-- Header End -->

    <!-- Main Content Start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Billing Address -->
                <div class="billing-address">
                    <h2>Billing Address</h2>
                    <form action="{{ route('orderAddress') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="billing_first_name"
                                    value="{{ old('billing_first_name', Auth::user()->name) }}" placeholder="First Name">
                                @error('billing_first_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="billing_last_name"
                                    value="{{ old('billing_last_name') }}" placeholder="Last Name">
                                @error('billing_last_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input class="form-control" type="email" name="billing_email"
                                    value="{{ old('billing_email', Auth::user()->email) }}" placeholder="E-mail">
                                @error('billing_email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" name="billing_mobile"
                                    value="{{ old('billing_mobile') }}" placeholder="Mobile No">
                                @error('billing_mobile')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label>Address</label>
                                <input class="form-control" type="text" name="billing_address"
                                    value="{{ old('billing_address') }}" placeholder="Address">
                                @error('billing_address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <select class="custom-select" name="billing_country">
                                    <option value="United States" selected>United States</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                </select>
                                @error('billing_country')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>City</label>
                                <input class="form-control" type="text" name="billing_city"
                                    value="{{ old('billing_city') }}" placeholder="City">
                                @error('billing_city')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>State</label>
                                <input class="form-control" type="text" name="billing_state"
                                    value="{{ old('billing_state') }}" placeholder="State">
                                @error('billing_state')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" name="billing_zip"
                                    value="{{ old('billing_zip') }}" placeholder="ZIP Code">
                                @error('billing_zip')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-dark w-100 pb-5">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content End -->

    @include ('font.footer')

    <!-- Back to Top -->
    @include ('font.footerlink')

</body>

</html>
