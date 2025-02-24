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

    <div class="container-fluid page-body-wrapper">
      <!-- Top Bar -->
      @include('admin.topbar')

      <!-- Main Content -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-2 grid-margin stretch-card"></div>
            <div class="col-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                  @endif

                  @if (session('error'))
                  <div class="alert alert-danger">
                    {{ session('error') }}
                  </div>
                  @endif

                  <h2 class="text-primary ">Update Category</h2>
                  <p class="card-description">Enter Category Details</p>
                  <!-- Form for Adding Category -->
                  <form action="{{ route('updatecategory', $category->id ?? '') }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
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
                      <label for="categoryName">Category Name</label>
                      <input type="text" class="form-control w-100 text-dark" style="height: 50px; background:beige;" id="categoryName" name="name" placeholder="Enter Category Name" value="{{ old('name',$category->name) }}" required>
                      @error('name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="categoryDescription">Description</label>
                      <textarea class="form-control text-dark" style="background:beige;" id="categoryDescription" name="description" rows="6" placeholder="Enter Category Description">{{ old('description',$category->description) }}</textarea>
                      @error('description')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Category Image</label>
                      <input type="file" name="image" class="form-control dropify text-dark"
                        data-default-file="{{ asset('images/category/' . ($category->image ?? 'default.jpg')) }}">

                      @error('image')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100" style="height: 50px;">Update</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-2"></div>
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

  <!-- Initialize Dropify -->

</body>

</html>