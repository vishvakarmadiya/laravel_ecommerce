 <!-- plugins:js -->
 <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
 <!-- endinject -->
 <!-- Plugin js for this page -->
 <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
 <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
 <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
 <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
 <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
 <!-- End plugin js for this page -->
 <!-- inject:js -->
 <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
 <script src="admin/assets/js/hoverable-collapse.js"></script>
 <script src="admin/assets/js/misc.js"></script>
 <script src="admin/assets/js/settings.js"></script>
 <script src="admin/assets/js/todolist.js"></script>
 <!-- endinject -->
 <!-- Custom js for this page -->
 <script src="admin/assets/js/dashboard.js"></script>

 <!-- jquesy drofpify img-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <!-- summer note :text area-->
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
 <!-- parsleyjs  validation -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <!-- sweet_alert -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.all.min.js"></script>
 <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>


 <script>
     $(document).ready(function() {
         // Initialize Dropify
         $('.dropify').dropify();

         // Initialize DataTables with buttons
         $('#category').DataTable({
             layout: {
                 topStart: {
                     buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                 }
             }
         });

         // Initialize Summernote
         $('#summernote').summernote({
             height: 200,
             placeholder: 'Enter text here...',
             toolbar: [
                 ['style', ['bold', 'italic', 'underline', 'clear']],
                 ['font', ['strikethrough', 'superscript', 'subscript']],
                 ['para', ['ul', 'ol', 'paragraph']],
                 ['insert', ['link', 'picture', 'video']],
                 ['view', ['fullscreen', 'codeview', 'help']]
             ]
         });
     });
     $(document).ready(function() {
         if (!$.fn.DataTable.isDataTable('#category')) {
             $('#category').DataTable({
                 dom: 'Bfrtip',
                 buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
             });
         }
     });


     function catetegery_delete(id) {
         if (confirm('are you sure want to delete.')) {
             document.getElementById('delete-category-' + id).submit()
         }

     }

     function confirmDelete(id) {
         if (confirm('Are you sure you want to delete this item?')) {
             document.getElementById('delete-form-' + id).submit();
         }
         return false;
     }

     function brand_delete(id) {
         if (confirm('Are you sure you want to delete this item?')) {
             document.getElementById('delete-brand-' + id).submit();
         }
         return false;
     }
     function product_delete(id) {
         if (confirm('Are you sure you want to delete this item?')) {
             document.getElementById('delete-products-' + id).submit();
         }
         return false;
     }

     // Auto-hide alerts after 5 seconds
     setTimeout(() => {
         let alertElements = document.querySelectorAll('.alert');
         alertElements.forEach(alert => {
             let bsAlert = new bootstrap.Alert(alert);
             bsAlert.close();
         });
     }, 5000);
 </script>