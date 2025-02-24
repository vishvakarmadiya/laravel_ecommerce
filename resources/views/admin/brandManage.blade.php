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
                    <a href="{{ route('brandAdd') }}" class="btn btn-dark">
                        <i class="fas fa-plus"></i> Create barand
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
                                <th> Brand</th>
                                <th>Image</th>
                                <th>Created Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($brands->count() > 0)
                            <!-- {{$i=0;}}  -->
                            @foreach ($brands as $data)
                            <tr>

                                <td>{{ $i=$i+1 }}</td>

                                <td>{{ $data->name }}</td>
                                <td>
                                    @if ($data->image)
                                    <img src="{{ asset("images/brands/$data->image") }}" height="70px" width="170px" alt="">
                                    @endif
                                </td>
                                
                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('brandEdit', $data->id) }}" class="btn btn-primary bg-primary">Edit</a>
                                    <a href="#" onclick="brand_delete({{$data->id}})" class="btn btn-danger bg-danger">Delete</a>
                                    <form id="delete-brand-{{$data->id}}" action="{{route('brand_delete',$data->id)}}" method="post" style="display: none;">
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
        <!-- Page-body-wrapper Ends -->
    </div>

    <!-- container-scroller -->
    @include('admin.footerlink')
    @include('admin.datatables')

    <script>

    </script>
</body>

</html>