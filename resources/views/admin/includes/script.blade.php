<!-- BEGIN: Vendor JS-->
<script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('admin/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/tether.min.js') }}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/dataTables.select.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
{{-- <script src="{{ asset('admin/app-assets/vendors/js/extensions/shepherd.min.js') }}"></script> --}}
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('admin/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/core/app.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/scripts/components.js') }}"></script>
<!-- END: Theme JS-->
  {{-- BEGIN: Page JS --}}
  <script src="{{asset('admin/app-assets/vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')}}"></script>
  <script src="{{asset('admin/app-assets/js/scripts/pages/app-user.js')}}"></script>
<script src="{{asset('admin/app-assets/js/scripts/ui/data-list-view.js')}}"></script>
  {{-- END: Page JS --}}

<!-- BEGIN: Page JS-->
<script src="{{ asset('admin/app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
<!-- END: Page JS-->
@yield('script')