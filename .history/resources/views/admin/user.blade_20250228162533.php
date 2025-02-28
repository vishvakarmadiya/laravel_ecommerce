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
                    <h3 class="card-title text-primary ">Manage users</h3>
                    <a href="{{ route('usersAdd') }}" class="btn btn-dark">
                        <i class="fas fa-plus"></i> Create users
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
                                <th>users title</th>
                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)
                            <!-- {{$i=0;}}  -->
                            @foreach ($users as $data)
                            <tr>

                                <td>{{ $i=$i+1 }}</td>

                                <td>{{ $data->title }}</td>
                                <td>
                                    @if ($data->image)
                                    <img src="{{ asset("images/userss/$data->image") }}" height="70px" width="170px" alt="">
                                    @endif
                                </td>
                                <td>{{ $data->description }}</td>
                                <td>
                               @if ($data->status==1)
                               Active
                               
                               @endif
                               @if ($data->status!=1)
                               Inactive
                               @endif
                               
                            </td>
                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
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
        <!-- Page-body-wrapper Ends -->
    </div>

    <!-- container-scroller -->
    @include('admin.footerlink')
    @include('admin.datatables')

    <script>

    </script>
</body>

</html>