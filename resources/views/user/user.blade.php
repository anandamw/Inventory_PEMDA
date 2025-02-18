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
                                        @foreach ($users as $us)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ $us->profile ? asset($us->profile) : asset('assets/images/no-profile.jpg') }}"
                                                        alt="Profile Image" width="50">
                                                </td>

                                                <td>{{ $us->name }}</td>
                                                <td>{{ $us->nip }}</td>
                                                <td>{{ $us->role }}</td>
                                                <td>
                                                    <a href="{{ asset('Pictures/qrcode/' . $us->name) }}.png"
                                                        style="color: rgb(38, 38, 255)" download> >>
                                                        Qrcode
                                                        Download</a>
                                                </td>
                                                <td>haiiii</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <!-- Tombol Edit -->
                                                        <button type="button"
                                                            class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                                                            data-id="{{ $us->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>

                                                        <!-- Tombol Hapus -->
                                                        <button type="button"
                                                            class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                            data-id="{{ $us->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
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

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        @csrf
                        <input type="hidden" id="userId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // --- FUNGSI EDIT USER ---
            $('.btn-edit').click(function() {
                var id = $(this).data('id'); // Ambil ID user
                $.ajax({
                    url: '/user/' + id + '/edit', // Panggil API Laravel
                    type: 'GET',
                    success: function(data) {
                        // Isi modal dengan data user yang didapat dari server
                        $('#editUserModal #userId').val(data.id);
                        $('#editUserModal #name').val(data.name);
                        $('#editUserModal #nip').val(data.nip);
                        $('#editUserModal #role').val(data.role);

                        // Tampilkan modal
                        $('#editUserModal').modal('show');
                    },
                    error: function() {
                        alert('Gagal mengambil data user.');
                    }
                });
            });

            // --- FUNGSI UPDATE USER ---
            $('#saveChanges').click(function() {
                var id = $('#editUserModal #userId').val();
                var name = $('#editUserModal #name').val();
                var nip = $('#editUserModal #nip').val();
                var role = $('#editUserModal #role').val();

                $.ajax({
                    url: '/user/' + id + '/update',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        nip: nip,
                        role: role
                    },
                    success: function() {
                        alert('Data berhasil diperbarui');
                        $('#editUserModal').modal('hide');
                        location.reload(); // Refresh halaman setelah update
                    },
                    error: function() {
                        alert('Gagal memperbarui data.');
                    }
                });
            });

            // --- FUNGSI HAPUS USER ---
            $('.btn-delete').click(function() {
                var id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: '/user/' + id + '/destroy',
                        type: 'GET',
                        success: function() {
                            alert('Data berhasil dihapus');
                            location.reload();
                        },
                        error: function() {
                            alert('Gagal menghapus data.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
