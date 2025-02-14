@extends('components.template')
@section('content')
    <!--**********************************
                                            Content body start
                                        ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="search-box">
                                <input type="text" id="tableSearch" class="form-control" placeholder="Search...">
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="shopping-cart">
                                    <a class="btn btn-primary btn-sm" href="javascript:void(0);">
                                        <i class="fa fa-download me-2"></i>Download
                                    </a>
                                </div>
                                <div class="dropdown bootstrap-select">
                                    <select class="image-select default-select dashboard-select width-130"
                                        aria-label="Default" tabindex="0">
                                        <option selected="">This Month</option>
                                        <option value="1">Weeks</option>
                                        <option value="2">Today</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0 20px">
                            <div class="table-responsive" style="max-height: 330px; overflow-y: auto;">
                                <table id="mytable" class="table table-responsive-md text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">Event</th>
                                            <th class="text-center">Profile</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Print</th>
                                            <th class="text-center">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Perbaikan Jalan</td>
                                            <td><img src="http://127.0.0.1:8000/assets/images/no-image.png" alt="Item Image"
                                                    width="50"></td>
                                            <td>Heru</td>
                                            <td>2025-02-12 01:03:12</td>
                                            <td class="text-center d-flex justify-content-center align-items-center">
                                                <a href="javascript:void(0)" onclick="downloadData()"
                                                    class="d-flex justify-content-center align-items-center"
                                                    style="width: 53px; height: 53px;">
                                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 9V2H18V9H6ZM8 4V7H16V4H8Z" fill="#A098AE" />
                                                        <path
                                                            d="M4 8H20C21.1 8 22 8.9 22 10V18H18V22H6V18H2V10C2 8.9 2.9 8 4 8ZM16 20V16H8V20H16ZM20 10H4V16H6V14H18V16H20V10ZM18 12H6V10H18V12Z"
                                                            fill="#A098AE" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="javascript:void(0)"
                                                        class="icon-box bg-primary d-flex justify-content-center align-items-center"
                                                        style="width: 28px; height: 28px; border-radius: 50%;">
                                                        <svg width="20" height="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z"
                                                                fill="white" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="pagination" class="mt-3 d-flex justify-content-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                                            Content body end
                                        ***********************************-->

                                        
@endsection
