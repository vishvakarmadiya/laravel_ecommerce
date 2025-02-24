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

        <div class="container-fluid  bg-white text-dark text-dark page-body-wrapper ">
            <!-- Top Bar -->
            @include('admin.topbar')
            <!-- Main Content -->
            <div class="card-body" style="margin-top:20px;">


                <div class="d-flex justify-content-between align-items-center mt-5">
                    <h3 class="card-title text-primary ">Manage Sub Category</h3>
                    <a href="{{route('productAdd')}}" class="btn btn-dark">
                        <i class="fas fa-plus"></i> Create Prodcut
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
                <div class="table-responsive">
                    <table id="category" class="display">
                        <thead>
                            <tr style="background-color: black;" class="bg-dark text-white">
                                <th>Sr</th>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Sub-Category Name</th>
                                <th>Mrp</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Created Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count() > 0)

                            <!-- {{$i=0}} -->
                            @foreach ($products as $data)
                            <tr>

                                <td>{{$i=$i+1}}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->category_name }}</td>
                                <td>{{ $data->subcategory_name }}</td>
                                <td>{{ $data->mrp }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->description }}</td>
                                <td>
                                    @if($data->status == 1)
                                    In Stock
                                    @else
                                    Out of Stock
                                    @endif

                                </td>
                                <td>
                                    @if ($data->image)
                                    <img src="{{ asset("images/products/$data->image") }}" height="70px" width="170px" alt="">
                                    @endif
                                </td>

                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
                                <td class="d-flex gap-3">
                                    <a href="{{ route('productEdit', $data->id) }}" class="btn btn-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <a href="#" onclick="product_delete({{ $data->id }})" class="btn btn-danger">
                                        <i class="fa-regular fa-trash"></i>
                                    </a>

                                    <form id="delete-products-{{ $data->id }}" action="{{ route('product_delete', $data->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method("DELETE")
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
        <!-- Page-body-wrapper Ends -->
    </div>

    <!-- container-scroller -->
    @include('admin.footerlink')
    @include('admin.datatables')

    <script>

    </script>
</body>

</html>