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
                                <div class="col-md-6">
                                    <h5>Payment Address</h5>
                                    <p>123 Payment Street, Los Angeles, CA</p>
                                    <p>Mobile: 012-345-6789</p>
                                    <button>Edit Address</button>
                                </div>
                                <div class="col-md-6">
                                    <h5>Shipping Address</h5>
                                    <p>123 Shipping Street, Los Angeles, CA</p>
                                    <p>Mobile: 012-345-6789</p>
                                    <button>Edit Address</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                            <h4>Account Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Name" value="{{ Auth::user()->name }}">
                                </div>

                                <div class="col-md-6">
                                    <input type="text" placeholder="Mobile" value="{{ Auth::user()->mobile ?? '' }}">
                                </div>

                                <div class="col-md-6">
                                    <input type="text" placeholder="Email" value="{{ Auth::user()->email }}">
                                </div>

                                @if(getUserOrdersAddress()->isNotEmpty())
                                @foreach(getUserOrdersAddress() as $address)
                                <div class="col-md-6">
                                    <input type="text" placeholder="Order ID" value="{{ $address->id }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Full Name" value="{{ $address->name }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Email" value="{{ $address->email }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Mobile" value="{{ $address->mobile }}">
                                </div>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Address" value="{{ $address->address }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="City" value="{{ $address->city }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="State" value="{{ $address->state }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Pin Code" value="{{ $address->pin_code }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Country" value="{{ $address->country }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Order Date" value="{{ $address->order_date }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Created At" value="{{ $address->created_at }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Updated At" value="{{ $address->updated_at }}">
                                </div>
                                @endforeach
                                @else
                                <div class="col-md-12">
                                    <p>No saved addresses found.</p>
                                </div>
                                @endif

                                <div class="col-md-12">
                                    <button>Update Account</button>
                                    <br><br>
                                </div>
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