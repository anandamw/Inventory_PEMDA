@extends('components.template')

@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
              <!-- row -->
    
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Profile Datatable</h4>
                      <a href="" class="btn btn-success">Create Data</a>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table
                          id="example3"
                          class="display"
                          style="min-width: 845px"
                        >
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Pict</th>
                              <th>Item</th>
                              <th>kode</th>
                              <th>Gender</th>
                              <th>Bidang</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>QR</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>
                                <img
                                  class="rounded-circle"
                                  width="35"
                                  src="images/profile/small/pic10.jpg"
                                  alt=""
                                />
                              </td>
                              <td>Shou Itou</td>
                              <td>20001876151912</td>
                              <td>Female</td>
                              <td>Kominfo</td>
                              <td>
                                <a href="javascript:void(0);"
                                  ><strong>123 456 7890</strong></a
                                >
                              </td>
                              <td>
                                <a href="javascript:void(0);"
                                  ><strong>info@example.com</strong></a
                                >
                              </td>
                              <td>img_QR</td>
                              <td>
                                <div class="d-flex">
                                  <a
                                    href="#"
                                    class="btn btn-primary shadow btn-xs sharp me-1"
                                    ><i class="fas fa-pencil-alt"></i
                                  ></a>
                                  <a
                                    href="#"
                                    class="btn btn-danger shadow btn-xs sharp"
                                    ><i class="fa fa-trash"></i
                                  ></a>
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
          <!--**********************************
                Content body end
            ***********************************-->
@endsection
