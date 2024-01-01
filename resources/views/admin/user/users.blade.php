@extends('admin.layouts.master')

@section('header-content')
    <div class="content-header row">
        <div class="content-header-left col-lg-12">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ $title }}</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Data List</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('main-content')

    {{-- DataTable --}}
    <section id="data-list-view" class="data-list-view-header">
        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">
                <div class="btn-group dropdown actions-dropodown">
                    <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable starts -->
        <div class="table-responsive">
            <table class="table data-list-view">
                <thead>
                    <tr>
                        <th></th>
                        <th>NAME</th>
                        <th>Username</th>
                        <th>Login ID</th>
                        {{-- <th>Section </th> --}}
                        <th>Role</th>
                        {{-- <th>Designation</th> --}}
                        <th>Status</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>






                    @foreach ($dataRows as $item)
                        <tr>
                            <td></td>
                            <td class="user-name">{{ $item->name }}</td>
                            <td class="user-username">{{ $item->username }}</td>
                            <td class="user-log_id">{{ $item->log_id }}</td>
                            {{-- <td class="user-designation_name">{{ $item->designation_name }}</td>
                            <td class="user-section_name">{{ $item->section_name }}</td> --}}
                            <td class="user-role_name">{{ $item->role_name }}</td>

                            <td>
                                @if ($item->status == 1)
                                    <div class="chip chip-success">
                                        <div class="chip-body">
                                            <div class="chip-text">
                                                Enabled
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="chip chip-danger">
                                        <div class="chip-body">
                                            <div class="chip-text">
                                                Disabled
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>

                            <td class="product-action">
                                <span class="primary action-edit"><i class="feather icon-edit"></i></span>
                                <span class="danger action-delete"><i class="feather icon-trash"></i></span>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- DataTable ends -->

        <!-- add new sidebar starts -->
        <div class="add-new-data-sidebar">
            <div class="overlay-bg"></div>
            <div class="add-new-data">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">List View Data</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2 mt-3">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Name</label>
                                <input type="text" class="form-control" id="data-name">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-category"> Category </label>
                                <select class="form-control" id="data-category">
                                    <option>Audio</option>
                                    <option>Computers</option>
                                    <option>Fitness</option>
                                    <option>Appliance</option>
                                </select>
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-status">Order Status</label>
                                <select class="form-control" id="data-status">
                                    <option>Pending</option>
                                    <option>Canceled</option>
                                    <option>Delivered</option>
                                    <option>On Hold</option>
                                </select>
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-price">Price</label>
                                <input type="text" class="form-control" id="data-price">
                            </div>
                            <div class="col-sm-12 data-field-col data-list-upload">
                                <form action="#" class="dropzone dropzone-area" id="dataListUpload">
                                    <div class="dz-message">Upload Image</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-primary">Add Data</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button class="btn btn-outline-danger">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add new sidebar ends -->
    </section>
    {{-- DataTable --}}

@stop
@section('script')
    {{-- <script type="text/javascript" charset="utf-8">
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
    //    enableRtl: isRtl,
    // columnDefs: columnDefs,
    rowSelection: "multiple",
    floatingFilter: true,
    filter: true,
    pagination: true,
    paginationPageSize: 20,
    // pivotPanelShow: "always",
    colResizeDefault: "shift",
    animateRows: true,
    resizable: true
    };

    // lookup the container we want the Grid to use
    var eGridDiv = document.querySelector('#myGrid');

    // create the grid passing in the div to use together with the columns & data we want to use
    new agGrid.Grid(eGridDiv, gridOptions);
</script> --}}

@stop
