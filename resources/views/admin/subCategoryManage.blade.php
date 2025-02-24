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
                    <a href="{{ route('subCategoryAdd') }}" class="btn btn-dark">
                        <i class="fas fa-plus"></i> Add Sub Category
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
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Created Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($subcategories->count() > 0)
                            <!-- {{$i=0;}}  -->
                            @foreach ($subcategories as $data)
                            <tr>
                               
                                <td>{{ $i=$i+1 }}</td>

                                <td>{{ $data->category_name }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @if ($data->image)
                                    <img src="{{ asset("images/subcategory/$data->image") }}" height="70px" width="70px" style="border-radius: 50%;" alt="">
                                    @endif
                                </td>
                                <td>{{ $data->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('subcategoryEdit', $data->id) }}" class="btn btn-primary bg-primary">Edit</a>
                                    <a href="#" onclick="return confirmDelete({{ $data->id }});" class="btn btn-danger">Delete</a>
                                    <form id="delete-form-{{ $data->id }}" action="{{ route('sub_category_destroy', $data->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
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