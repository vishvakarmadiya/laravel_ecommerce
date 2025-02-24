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

        <div class="container-fluid page-body-wrapper bg-white">
            <!-- Top Bar -->
            @include('admin.topbar')

            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper bg-white">
                    <div class="row">
                        <div class="col-2 grid-margin stretch-card bg-white"></div>
                        <div class="col-8 grid-margin stretch-card bg-white">
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
                                    {{$subcategory}}
                                    <h2 class="text-primary">Add Subcategory</h2>
                                    <p class="card-description">Enter Subcategory Details</p>

                                    <!-- Form for Adding Subcategory -->
                                    <!-- route('subcategoryStore')  -->
                              
                                    <form action="{{ route('SubCategoryUpdate',$subcategory->id ) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')


                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)

                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <!-- Select Category -->
                                        <div class="form-group">
                                            <label for="category">Select Category</label>
                                            <select class="form-control bg-white text-dark" style="height: 50px;" name="category_id" required>
                                                <option value="">Choose Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if($subcategory->category_id == $category->id) selected @endif>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Subcategory Name -->
                                        <div class="form-group">
                                            <label for="subcategoryName">Subcategory Name</label>
                                            <input style="height: 50px;" type="text" class="form-control  bg-white text-dark  w-100" id="subcategoryName" name="name" placeholder="Enter Subcategory Name" value="{{ old('name',$subcategory->name) }}" required>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Subcategory Description -->
                                        <div class="form-group">
                                            <label for="subcategoryDescription">Description</label>
                                            <textarea class="form-control  bg-white text-dark" id="subcategoryDescription" name="description" rows="6" placeholder="Enter Subcategory Description">{{ old('description',$subcategory->description) }}</textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Subcategory Image -->
                                        <div class="form-group">
                                            <label>Subcategory Image</label>
                                            <input type="file" name="image" class="form-control dropify text-dark  bg-white text-dark" data-default-file="{{ asset('images/subcategory/' . ($subcategory->image ?? 'default.jpg')) }}">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100" style="height: 50px;">Add Subcategory</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="col-2 bg-whhit"></div>
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