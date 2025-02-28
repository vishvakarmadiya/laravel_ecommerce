<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="../../index.html"><img src="{{ asset('admin/assets/images/logo.svg') }}" alt="logo" />
    </a>
    <a class="sidebar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
          <img class="img-xs rounded-circle" src="{{ asset('admin/assets/images/faces/face15.jpg') }}" alt="User Image">

            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">Aditya Vishvakarma</h5>
            <span>Admin</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{route("index")}}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
   <!-- Product Section -->


<!-- Category Section -->
<li class="nav-item menu-items">
      <a class="nav-link"  href="{{route('productManage')}}">
      <span class="menu-icon">
      <i class="mdi mdi-cart"></i> <!-- Product Icon -->
    </span>
    <span class="menu-title">Product</span>
      </a>
    </li>

<!-- Sub Category Section -->

<li class="nav-item menu-items">
      <a class="nav-link"  href="{{route('categoryManage')}}">
      <span class="menu-icon">
      <i class="mdi mdi-view-list"></i> <!-- Category Icon -->
    </span>
        <span class="menu-title">Category</span>
      </a>
    </li>
<li class="nav-item menu-items">
      <a class="nav-link"  href="{{route('subCategoryManage')}}">
      <span class="menu-icon">
      <i class="mdi mdi-view-list"></i> <!-- Category Icon -->
    </span>
        <span class="menu-title">Sub Category</span>
      </a>
    </li>

<!-- Slider Section -->
<li class="nav-item menu-items">
  <a class="nav-link" href="{{ route('sliderManage') }}">
    <span class="menu-icon">
      <i class="mdi mdi-image"></i>
    </span>
    <span class="menu-title">Slider</span>
  </a>
</li>

<!-- Brand Section -->
<li class="nav-item menu-items">
  <a class="nav-link" href="{{ route('brandManage') }}">
    <span class="menu-icon">
      <i class="mdi mdi-tag"></i> 
    </span>
    <span class="menu-title">Brand</span>
  </a>
</li>
<li class="nav-item menu-items">
  <a class="nav-link" href="{{-- route('orders') --}}">
    <span class="menu-icon">
      <i class="mdi mdi-cart"></i>  <!-- Icon for orders -->
    </span>
    <span class="menu-title">Orders</span>
  </a>
</li>



<!-- User Details Section (Fixed Route) -->
<li class="nav-item menu-items">
  <a class="nav-link" href="{{route('userDiatils')}}">
    <span class="menu-icon">
      <i class="mdi mdi-account"></i>
    </span>
    <span class="menu-title">User Details</span>
  </a>
</li>


  </ul>
</nav>