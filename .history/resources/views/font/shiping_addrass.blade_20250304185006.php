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
        @php
            $userAddress = getUserOrdersAddress()->last(); // Get the latest address
        @endphp
        
        @if ($userAddress)
            <div class="col-md-6">
                <label>First Name</label>
                <input class="form-control" type="text" name="billing_first_name"
                    value="{{ old('billing_first_name', $userAddress->name) }}" placeholder="First Name" required>
                @error('billing_first_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label>E-mail</label>
                <input class="form-control" type="email" name="billing_email"
                    value="{{ old('billing_email', $userAddress->email) }}" placeholder="E-mail" required>
                @error('billing_email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label>Mobile No</label>
                <input class="form-control" type="text" name="billing_mobile"
                    value="{{ old('billing_mobile', $userAddress->mobile) }}" placeholder="Mobile No" pattern="^\d{10,15}$" required>
                @error('billing_mobile') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12">
                <label>Address</label>
                <input class="form-control" type="text" name="billing_address"
                    value="{{ old('billing_address', $userAddress->address) }}" placeholder="Address" required>
                @error('billing_address') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label>City</label>
                <input class="form-control" type="text" name="billing_city"
                    value="{{ old('billing_city', $userAddress->city) }}" placeholder="City" required>
                @error('billing_city') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label>State</label>
                <input class="form-control" type="text" name="billing_state"
                    value="{{ old('billing_state', $userAddress->state) }}" placeholder="State" required>
                @error('billing_state') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label>ZIP Code</label>
                <input class="form-control" type="text" name="billing_zip"
                    value="{{ old('billing_zip', $userAddress->pin_code) }}" placeholder="ZIP Code" pattern="^\d{5,10}$" required>
                @error('billing_zip') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label>Country</label>
                <select class="custom-select" name="billing_country" required>
                    <option value="United States" {{ old('billing_country', $userAddress->country) == 'United States' ? 'selected' : '' }}>United States</option>
                    <option value="Afghanistan" {{ old('billing_country', $userAddress->country) == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                    <option value="Albania" {{ old('billing_country', $userAddress->country) == 'Albania' ? 'selected' : '' }}>Albania</option>
                    <option value="Algeria" {{ old('billing_country', $userAddress->country) == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                </select>
                @error('billing_country') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @else
            <p class="text-warning">No saved addresses found. Please enter your details.</p>
        @endif
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-dark w-100 mb-2" style="border-radius: 4px;">Place Order</button>
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