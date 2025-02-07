@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Card kiri atas: Detail User -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add User</h5>
                        </div>
                        <div class="card-body">
                            <form action="/user/store" method="POST">
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
                        <div class="card-footer d-sm-flex justify-content-between align-items-center">
                            <div class="ms-auto">
                                <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
