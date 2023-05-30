  <footer class="main-footer">
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="{{url('')}}" target="_blank">The Primal Cuts</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)

</script>
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('assets/dist/js/main.js')}}"></script>
<script src="{{asset('assets/dist/js/datatable.js')}}"></script>
<script src="{{asset('assets/dist/js/demo.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script type="text/javascript">
    $('[data-mask]').inputmask();
  $(".12h").inputmask("hh:mm t", {
  alias: "datetime",
  hourFormat: 12
 }
);
     window.addEventListener('Swal',function(e){
        Swal.fire(e.detail);
      });

</script>
@stack('js')
@livewireScripts