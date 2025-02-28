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
                                <th>users Name</th>
                                <th>Email</th>
                                <th>CreatedAt</th>

                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)
                            <!-- {{$i=0;}}  -->
                            @foreach ($users as $data)
                            <tr>

                                <td>{{ $i=$i+1 }}</td>

                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                               
                            
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