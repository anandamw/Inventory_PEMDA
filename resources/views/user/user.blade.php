@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"></h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addUserModal">
                                <span class="btn-icon-start text-info">
                                    <i class="fa fa-plus color-info"></i>
                                </span>
                                Add
                            </button>
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
                                            <th>Instansi</th>
                                            <th>Role</th>
                                            <th>QR Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $us)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $us->profile ? asset($us->profile) : asset('assets/images/no-profile.jpg') }}"
                                                        width="50"></td>
                                                <td>{{ $us->name }}</td>
                                                <td>{{ $us->nip }}</td>
                                                <td>{{ $us->instansi->nama_instansi ?? '-' }}</td>
                                                <td>{{ $us->role }}</td>
                                                <td><a href="{{ asset('Pictures/qrcode/' . $us->name) }}.png"
                                                        style="color:var(--primary)" download>QR
                                                        Download</a></td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <button type="button"
                                                        class="btn btn-primary shadow btn-xs sharp me-1 btn-edits"
                                                        data-id="{{ $us->id }}" data-name="{{ $us->name }}"
                                                        data-nip="{{ $us->nip }}" data-role="{{ $us->role }}"
                                                        data-instansi="{{ $us->instansi->id_instansi ?? '' }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>

                                                    <a href="{{ route('users.destroy', $us->id) }}"
                                                        data-confirm-delete="true"><button type="button"
                                                            class="btn btn-danger shadow btn-xs sharp btn-delete">
                                                            <i class="fa fa-trash" style="color: aliceblue"></i>
                                                        </button></a>
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

    <!-- Modal Add User -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" action="/user/store" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" style="opacity: 0.6;"
                                placeholder="Masukkan Nama......" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" style="opacity: 0.6;"
                                placeholder="Masukkan NIP......" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_instansi" class="form-label">Instansi</label>
                            <select class="form-control" id="id_instansi" name="id_instansi" required style="opacity: 0.6;">
                                <option value="" disabled selected>Pilih Instansi...</option>
                                @foreach ($instansis as $instansi)
                                    <option value="{{ $instansi->id_instansi }}">{{ $instansi->nama_instansi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" style="opacity: 0.6;" required>
                                <option value="" disabled selected>Pilih Role...</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="addUserForm">Save</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')  <!-- Tambahkan ini agar Laravel mengenali metode PUT -->
                    <input type="hidden" id="userId" name="userId">                              

                    <div class="mb-3">
                        <label for="editName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="editNip" name="nip" required>
                    </div>
                    <div class="mb-3">
                        <label for="editInstansi" class="form-label">Instansi</label>
                        <select class="form-control" id="editInstansi" name="instansi" required>
                            <option value="" disabled selected>Pilih Instansi...</option>
                            @foreach ($instansis as $instansi)
                                <option value="{{ $instansi->id_instansi }}">{{ $instansi->nama_instansi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-control" id="editRole" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll(".btn-edits");
    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            let userId = this.getAttribute("data-id");
            let userName = this.getAttribute("data-name");
            let userNip = this.getAttribute("data-nip");
            let userRole = this.getAttribute("data-role");
            let userInstansi = this.getAttribute("data-instansi");

            document.getElementById("userId").value = userId;
            document.getElementById("editName").value = userName;
            document.getElementById("editNip").value = userNip;
            document.getElementById("editRole").value = userRole;
            document.getElementById("editInstansi").value = userInstansi;

            // Update form action dynamically
            let form = document.getElementById("editUserForm");
            form.action = `/user/${userId}/update`; // Set action dengan ID user

            let editModal = new bootstrap.Modal(document.getElementById("editUserModal"));
            editModal.show();
        });
    });
});
</script>
@endsection
