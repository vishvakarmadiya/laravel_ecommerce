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
      <div class="main-panel">
        <div class="content-wrapper bg-white">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  @if (session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <h2 class="text-primary">Add Brand</h2>
                  <p class="card-description">Enter Brand Details</p>

                  <!-- Form for Adding Brand -->
                  <form action="{{route("bradstore")}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif

                    <div class="form-group">
                      <label for="brandName">Brand Name</label>
                      <input type="text" class="form-control w-100" style="height: 50px; background:beige;" id="brandName" name="name" placeholder="Enter Brand Name" value="{{ old('name') }}" required>
                      @error('name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Brand Logo</label>
                      <input type="file" name="image" class="form-control dropify text-dark">
                      @error('logo')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100" style="height: 50px;">Add Brand</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
        <!-- Content Wrapper Ends -->

        <!-- Footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
              Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com
            </span>
          </div>
        </footer>
        <!-- Footer Ends -->
      </div>
      <!-- Main Content Ends -->
    </div>
    <!-- Page Body Wrapper Ends -->
  </div>
  <!-- Container Scroller -->
  @include('admin.footerlink')

</body>

</html>
