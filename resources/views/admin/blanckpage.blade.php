<!DOCTYPE html>
<html lang="en">
  <head>
   @include ('admin.hedderlink');
  </head>
  <body>
    <div class="container-scroller">
      <!-- sidebaar star -->
      @include ('admin.sidebar');
      <!-- sidebaar End -->
  
      <div class="container-fluid page-body-wrapper">
        <!-- top baar -->
        @include ("admin.topbar")
        <!-- main containt -->
       
        <!-- main containt ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
   @include ('admin.footerlink');
  </body>
</html>