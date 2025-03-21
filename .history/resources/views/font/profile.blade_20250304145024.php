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


    <!-- main containt Start  -->

    <!-- Breadcrumb Start -->
    @include ('font.product_diatail_nav')
    <!-- Breadcrumb End -->


    <!-- Product List Start -->
    <!-- My Account Start -->
    <div class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab">Dashboard</a>
                        <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab">Orders</a>
                        <a class="nav-link" id="address-nav" data-toggle="pill" href="#address-tab" role="tab">address</a>
                        <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab">Account Details</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                            <h4>Dashboard</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Price</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>
                                        @if (getUserOrders()->isEmpty())
                                        <h1>No orders found</h1>
                                        @else
                                        <!-- {{ $id=0 }} -->
                                        @foreach (getUserOrders() as $order)
                                        <tr>
                                            <td>{{ $id=$id+1 }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->total }}</td>

                                            <td>
                                                @switch($order->status)
                                                @case(1)
                                                Placed
                                                @break
                                                @case(2)
                                                Processing
                                                @break
                                                @case(3)
                                                Shipped
                                                @break
                                                @case(4)
                                                Delivered
                                                @break
                                                @case(5)
                                                Cancelled
                                                @break
                                                @default
                                                Unknown
                                                @endswitch
                                            </td>



                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="address-tab" role="tabpanel" aria-labelledby="address-nav">
                            <h4>Address</h4>
                            <div class="row">
                                @if(getUserOrdersAddress()->isNotEmpty())
                                @php
                                $latestAddress = getUserOrdersAddress()->last(); // Latest Address Fetch Karna
                                @endphp

                                <!-- Payment Address -->
                                <div class="col-md-6">
                                    <h5>Payment Address</h5>
                                    <p>{{ $latestAddress->address }}, {{ $latestAddress->city }}, {{ $latestAddress->state }}, {{ $latestAddress->pin_code }}, {{ $latestAddress->country }}</p>
                                    <p>Mobile: {{ $latestAddress->mobile }}</p>
                                </div>

                                <!-- Shipping Address -->
                                <div class="col-md-6">
                                    <h5>Shipping Address</h5>
                                    <p>{{ $latestAddress->address }}, {{ $latestAddress->city }}, {{ $latestAddress->state }}, {{ $latestAddress->pin_code }}, {{ $latestAddress->country }}</p>
                                    <p>Mobile: {{ $latestAddress->mobile }}</p>
                                </div>
                                @else
                                <div class="col-md-12">
                                    <p>No saved address found.</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                            <h4>Account Details</h4>
                            <form action="{{-- route('account_update') --}}" method="POST">
                                <div class="row">

                                    @csrf
                                    @method('PUT') <!-- Agar update karna hai toh PUT method use karein -->

                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" placeholder="Name" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" disabled name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                                    </div>

                                    <div class="col-md-12">
                                        <h3>Address</h3> <!-- Address section ka heading -->
                                    </div>

                                    @if(getUserOrdersAddress()->isNotEmpty())
                                    @foreach(getUserOrdersAddress() as $latestAddress)
                                    <div class="col-md-6">
                                        <label for="full_name">Full Name</label>
                                        <input type="text" id="full_name" name="full_name" placeholder="Full Name" value="{{ $latestAddress->name }}">
                                        <input type="hidden" id="full_name" name="id" placeholder="Full Name" value="{{ $latestAddress->id }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="order_mobile">Mobile</label>
                                        <input type="text" id="order_mobile" name="order_mobile" placeholder="Mobile" value="{{ $latestAddress->mobile }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" placeholder="Address" value="{{ $latestAddress->address }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city">City</label>
                                        <input type="text" id="city" name="city" placeholder="City" value="{{ $latestAddress->city }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state">State</label>
                                        <input type="text" id="state" name="state" placeholder="State" value="{{ $latestAddress->state }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pin_code">Pin Code</label>
                                        <input type="text" id="pin_code" name="pin_code" placeholder="Pin Code" value="{{ $latestAddress->pin_code }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="country">Country</label>
                                        <input type="text" id="country" name="country" placeholder="Country" value="{{ $latestAddress->country }}">
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-md-12">
                                        <p>No saved address found.</p>
                                    </div>
                                    @endif

                                    <div class="col-md-12">
                                        <button type="submit">Update Account</button>
                                        <br><br>
                                    </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- My Account End -->


    <!-- Product List End -->


    <!-- main containt end -->

    @include ('font.footer')


    <!-- Back to Top -->
    @include ('font.footerlink')
</body>

</html>