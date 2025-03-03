<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.hedderlink')
</head>

<body>
    <div class="container-scroller">
        <!-- Sidebar Start -->
        @include('admin.sidebar')
        <!-- Sidebar End -->

        <div class="container-fluid page-body-wrapper bg-white ">
            <!-- Top Bar -->
            @include('admin.topbar')

            <!-- Main Content -->
            <div class="card-body" style="margin-top:20px;">


                <div class="d-flex justify-content-between align-items-center mt-5">
                    <h3 class="card-title text-primary ">Manage orders</h3>
                    <a href="{{-- route('ordersAdd') --}}" class="btn btn-dark">
                        <i class="fas fa-plus"></i> Create orders
                    </a>
                </div>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}

                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}

                </div>
                @endif
                <div class="table-responsive text-dark">
                    <table id="category" class="display">
                        <thead>
                            <tr style="background-color: black;" class="bg-dark text-white">
                                <th>Sr</th>
                                <th>User Name</th>
                                <th>SubTotal Price</th>
                                <th>Shipping Charge Price</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Created Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->count() > 0)
                            <!-- {{$i=0;}}  -->
                            @foreach ($orders as $data)
                            <tr class="text-dark">

                                <td>{{ $i=$i+1 }}</td>

                                <td>{{ $data->user_name }}</td>
                                <td>{{ $data->sub_total }}</td>
                                <td>{{ $data->shipping_charge }}</td>
                                <td>{{ $data->total }}</td>
                                <td>
                                    <form action="{{ route('order_status_update', ['orderid' => $data->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" style="background-color: ;" onchange="this.form.submit()">
                                            <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Placed</option>
                                            <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Processing</option>
                                            <option value="3" {{ $data->status == 3 ? 'selected' : '' }}>Shipped</option>
                                            <option value="4" {{ $data->status == 4 ? 'selected' : '' }}>Delivered</option>
                                            <option value="5" {{ $data->status == 5 ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>

                                </td>




                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:m:s') }}</td>
                                <td>
                                    <a href="{{ route('categoryEdit', $data->id) }}" class="btn btn-primary bg-primary">Edit</a>
                                    <a href="#" onclick="catetegery_delete({{$data->id}})" class="btn btn-danger bg-danger">Delete</a>
                                    <form id="delete-category-{{$data->id}}" action="{{route('destroy',$data->id)}}" method="post" style="display: none;">
                                        @csrf
                                        @method("delete")
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Main Content Ends -->
        </div>
        <!-- Page Body Wrapper Ends -->
    </div>
    <!-- Container Scroller -->
    @include('admin.footerlink')

</body>

</html>