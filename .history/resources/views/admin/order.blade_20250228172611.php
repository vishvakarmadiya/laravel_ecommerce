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
    
      <!-- Main Content Ends -->
    </div>
    <!-- Page Body Wrapper Ends -->
  </div>
  <!-- Container Scroller -->
  @include('admin.footerlink')

</body>

</html>
