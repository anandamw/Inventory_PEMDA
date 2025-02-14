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
                                            <th>Role</th>
                                            <th>Qrcode Download</th>
                                            <th>IsOnline</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ auth()->user()->profile ? asset(auth()->user()->profile) : asset('assets/images/no-profile.jpg') }}"
                                                        alt="" width="50"></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->role }}</td>
                                                <td>
                                                    <a href="{{ asset('Pictures/qrcode/' . $item->name) }}.png"
                                                        style="color: rgb(38, 38, 255)" download> >>
                                                        Qrcode
                                                        Download</a>
                                                </td>
                                                <td>haiiii</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="button"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i
                                                                class="fas fa-pencil-alt"></i></button>
                                                        <a href="/user/{{ $item->id_inventories }}/destroy" class="btn btn-danger shadow btn-xs sharp">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Kolom Kanan: Input Data -->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan nama....." style="opacity: 0.6;" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control" id="nip" name="nip"
                                            placeholder="Masukkan NIP....." style="opacity: 0.6;" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control" id="role" name="role" style="opacity: 0.6;"
                                            required>
                                            <option value="" disabled selected>Pilih Role...</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
