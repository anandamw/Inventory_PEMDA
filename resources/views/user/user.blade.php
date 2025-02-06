@extends('components.template')

@section('content')
    <!--**********************************
                Content body start
            ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Card kiri atas: Detail User -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data User</h4>
                            <a href="/user/create"
                                class="btn btn-primary btn-info d-flex align-items-center justify-content-center">
                                <span class="btn-icon-start text-info">
                                    <i class="fa fa-plus color-info"></i>
                                </span>
                                Add
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Profile</th>
                                      <th>Name</th>
                                      <th>NIP</th>
                                      <th>Start date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1</td>
                                      <td>Gambar</td>
                                      <td>ajon kdo</td>
                                      <td>1256721</td>
                                      <td>Admin</td>
                                      <td>
                                        <div class="d-flex justify-content-center">
                                          <a href="#" class="btn btn-primary shadow btn-xs sharp me-1">
                                            <i class="fas fa-pencil-alt"></i>
                                          </a>
                                          <a href="#" class="btn btn-danger shadow btn-xs sharp">
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>2</td>
                                      <td>Gambar</td>
                                      <td>Garrett Winters</td>
                                      <td>1256722</td>
                                      <td>Accountant</td>
                                      <td>
                                        <div class="d-flex justify-content-center">
                                          <a href="#" class="btn btn-primary shadow btn-xs sharp me-1">
                                            <i class="fas fa-pencil-alt"></i>
                                          </a>
                                          <a href="#" class="btn btn-danger shadow btn-xs sharp">
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>3</td>
                                      <td>Gambar</td>
                                      <td>Ashton Cox</td>
                                      <td>1256723</td>
                                      <td>Junior Technical Author</td>
                                      <td>
                                        <div class="d-flex justify-content-center">
                                          <a href="#" class="btn btn-primary shadow btn-xs sharp me-1">
                                            <i class="fas fa-pencil-alt"></i>
                                          </a>
                                          <a href="#" class="btn btn-danger shadow btn-xs sharp">
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>4</td>
                                      <td>Gambar</td>
                                      <td>Airi Satou</td>
                                      <td>1256725</td>
                                      <td>Accountant</td>
                                      <td>
                                        <div class="d-flex justify-content-center">
                                          <a href="#" class="btn btn-primary shadow btn-xs sharp me-1">
                                            <i class="fas fa-pencil-alt"></i>
                                          </a>
                                          <a href="#" class="btn btn-danger shadow btn-xs sharp">
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>5</td>
                                      <td>Gambar</td>
                                      <td>Brielle Williamson</td>
                                      <td>1256726</td>
                                      <td>Integration Specialist</td>
                                      <td>
                                        <div class="d-flex justify-content-center">
                                          <a href="#" class="btn btn-primary shadow btn-xs sharp me-1">
                                            <i class="fas fa-pencil-alt"></i>
                                          </a>
                                          <a href="#" class="btn btn-danger shadow btn-xs sharp">
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </div>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
