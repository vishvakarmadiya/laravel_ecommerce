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

                  <h2 class="text-primary">Update Product</h2>
                  <p class="card-description">Enter Product Details</p>

                  <!-- Form for Updateing Product -->
                  <form action="{{route('productupdate',$products->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                    <!-- Product Name -->
                    <div class="form-group">
                      <label for="productName">Product Name</label>
                      <input type="text" class="form-control bg-white text-dark w-100" value="{{$products->name}}" style="height: 50px;" id="productName" name="name" placeholder="Enter Product Name" value="{{ old('name') }}" required>
                      @error('name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <!-- Select Category -->
                    <div class="form-group">
                      <label for="category">Select Category</label>
                      <select class="form-control bg-white text-dark" style="height: 50px;" name="category_id" id="category" required>
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                        @if ($products->category_id==$category->id)
                        selected
                        @endif
                        >{{ $category->name }}</option>
                        @endforeach

                      </select>
                      @error('category_id')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <!-- Select Subcategory -->
                    <div class="form-group">
                      <label for="subcategory">Select Subcategory</label>
                      <select class="form-control bg-white text-dark" style="height: 50px;" name="subcategory_id" id="subcategory" required>
                        <option value="">Choose Subcategory</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}"
                        @if ($products->subcategory_id==$subcategory->id)
                        selected
                        @endif
                        >{{ $subcategory->name }}</option>
                        @endforeach
                      </select>
                      @error('subcategory_id')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>



                    <!-- Product Description -->
                    <div class="form-group">
                      <label for="productDescription">Description</label>
                      <textarea class="form-control bg-white text-dark" id="productDescription" name="description" rows="6" placeholder="Enter Product Description">{{ old('description',$products->description) }}</textarea>
                      @error('description')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="mrp">MRP (₹)</label>
                      <input type="number" class="form-control bg-white text-dark w-100" style="height: 50px;" id="mrp" name="mrp" placeholder="Enter Maximum Retail Price" value="{{ old('mrp',$products->mrp) }}" required>
                      @error('mrp')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="productPrice">Selling Price (₹)</label>
                      <input type="number" class="form-control bg-white text-dark w-100" style="height: 50px;" id="productPrice" name="price" placeholder="Enter Product Price" value="{{ old('price',$products->price) }}" required>
                      @error('price')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>


                    <!-- Product Stock Status -->
                    <div class="form-group">
                      <label for="stockStatus">Stock Status</label>
                      <select class="form-control bg-white text-dark" style="height: 50px;" name="status" id="stockStatus" required>
                        <option value="1" 
                        @if ($products->status==1)
                        selected
                        
                        @endif
                        >In Stock</option>
                        <option value="2">Out of Stock</option>
                        @if ($products->status==2)
                        selected
                        
                        @endif
                      </select>
                      @error('stock_status')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <!-- Product Image -->
                    <div class="form-group">
                      <label>Product Image</label>
                      <input type="file" name="image"  data-default-file="{{ asset('images/products/' . $products->image) }}" class="form-control dropify text-dark bg-white text-dark">
                      @error('image')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100" style="height: 50px;">Update Product</button>
                  </form>

                </div>
              </div>
            </div>
            <div class="col-2 bg-white"></div>
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