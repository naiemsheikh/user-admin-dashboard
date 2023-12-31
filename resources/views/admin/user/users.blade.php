@extends('admin.layouts.master')
@section('main-content')

<!-- users filter start -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Filters</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                <li><a data-action=""><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
                <li><a data-action="close"><i class="feather icon-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show">
        <div class="card-body">
            <div class="users-list-filter">
                <form>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="users-list-role">Role</label>
                            <fieldset class="form-group">
                                <select class="form-control" id="users-list-role">
                                    <option value="">All</option>
                                    <option value="user">User</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="users-list-status">Status</label>
                            <fieldset class="form-group">
                                <select class="form-control" id="users-list-status">
                                    <option value="">All</option>
                                    <option value="Active">Active</option>
                                    <option value="Blocked">Blocked</option>
                                    <option value="deactivated">Deactivated</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="users-list-verified">Verified</label>
                            <fieldset class="form-group">
                                <select class="form-control" id="users-list-verified">
                                    <option value="">All</option>
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="users-list-department">Department</label>
                            <fieldset class="form-group">
                                <select class="form-control" id="users-list-department">
                                    <option value="">All</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Devlopment">Devlopment</option>
                                    <option value="Management">Management</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- users filter end -->
<!-- Ag Grid users list section start -->
<div id="basic-examples">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                            <div class="dropdown sort-dropdown mb-1 mb-sm-0">
                                <button class="btn btn-white filter-btn dropdown-toggle border text-dark" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    1 - 20 of 50
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">50</a>
                                </div>
                            </div>
                            <div class="ag-btns d-flex flex-wrap">
                                <input type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Search...." />
                                <div class="action-btns">
                                    <div class="btn-dropdown ">
                                        <div class="btn-group dropdown actions-dropodown">
                                            <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="feather icon-trash-2"></i> Delete</a>
                                                <a class="dropdown-item" href="#"><i class="feather icon-clipboard"></i> Archive</a>
                                                <a class="dropdown-item" href="#"><i class="feather icon-printer"></i> Print</a>
                                                <a class="dropdown-item" href="#"><i class="feather icon-download"></i> CSV</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="myGrid" class="aggrid ag-theme-material"></div>
            </div>
        </div>
    </div>
</div>
<!-- Ag Grid users list section end -->
@stop
@section('script')
<script type="text/javascript" charset="utf-8">
    // specify the columns
    var columnDefs = [
        {headerName: 'Name', field: 'name'},
        {headerName: 'Login ID', field: 'log_id'},
        {headerName: 'Section Name', field: 'section_name'},
        {headerName: 'Username', field: 'username'},
        {headerName: 'Role Name', field: 'role_name'},
        
        // Add more columns as needed
    ];

    // specify the data
    var rowData = @json($dataRows);

    // let the grid know which columns and what data to use
    var gridOptions = {
        columnDefs: columnDefs,
        rowData: rowData,
        enableRtl: isRtl,
    columnDefs: columnDefs,
    rowSelection: "multiple",
    floatingFilter: true,
    filter: true,
    pagination: true,
    paginationPageSize: 20,
    pivotPanelShow: "always",
    colResizeDefault: "shift",
    animateRows: true,
    resizable: true
    };

    // lookup the container we want the Grid to use
    var eGridDiv = document.querySelector('#myGrid');

    // create the grid passing in the div to use together with the columns & data we want to use
    new agGrid.Grid(eGridDiv, gridOptions);
</script>

@stop