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
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan Nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                placeholder="Masukkan NIP" required>

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
                                <option value="team">team</option>
                                <option value="opd">Opd</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addSaveButton" form="addUserForm">Save</button>
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
                    <form id="editUserForm" action="/user/{id}/update" method="POST">
                        @csrf
                        @method('PUT') <!-- Tambahkan ini agar Laravel mengenali metode PUT -->
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
                                <option value="team">Team</option>
                                <option value="opd">OPD</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="editSaveButton" form="editUserForm">Save
                                Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addForm = document.getElementById('addUserForm');
            const editForm = document.getElementById('editUserForm');

            const addSaveButton = document.getElementById('addSaveButton');
            const editSaveButton = document.getElementById('editSaveButton');

            const addNipInput = document.getElementById('nip');
            const editNipInput = document.getElementById('editNip');
            const editUserIdInput = document.getElementById('userId');

            const editButtons = document.querySelectorAll(".btn-edits");

            // Debugging sederhana: Pastikan tombol edit ada
            if (editButtons.length === 0) {
                console.warn("Tidak ditemukan tombol edit (btn-edits). Pastikan HTML-nya benar.");
            }

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    let userId = this.getAttribute("data-id");
                    document.getElementById("userId").value = userId;
                    document.getElementById("editName").value = this.getAttribute("data-name");
                    document.getElementById("editNip").value = this.getAttribute("data-nip");
                    document.getElementById("editRole").value = this.getAttribute("data-role");
                    document.getElementById("editInstansi").value = this.getAttribute(
                        "data-instansi");

                    // Pastikan action form update benar
                    editForm.action = `/user/${userId}/update`;

                    clearError(editNipInput);
                    checkDuplicateNip(editNipInput, editSaveButton, userId);

                    // Debug: pastikan element modal ditemukan
                    const modalElement = document.getElementById("editUserModal");
                    if (!modalElement) {
                        console.error("Modal editUserModal tidak ditemukan di DOM");
                        return;
                    }

                    let editModal = new bootstrap.Modal(modalElement);
                    editModal.show();
                });
            });

            // Event handler untuk validasi NIP (Tambah)
            addNipInput.addEventListener('input', () => checkDuplicateNip(addNipInput, addSaveButton));
            addNipInput.addEventListener('blur', () => checkDuplicateNip(addNipInput, addSaveButton));

            // Event handler untuk validasi NIP (Edit)
            editNipInput.addEventListener('input', () => checkDuplicateNip(editNipInput, editSaveButton,
                editUserIdInput.value));
            editNipInput.addEventListener('blur', () => checkDuplicateNip(editNipInput, editSaveButton,
                editUserIdInput.value));

            function checkDuplicateNip(inputElement, saveButton, excludeId = null) {
                const value = inputElement.value;
                if (!value) {
                    clearError(inputElement);
                    saveButton.disabled = false;
                    return;
                }

                const params = new URLSearchParams({
                    nip: value
                });
                if (excludeId) params.append('exclude_id', excludeId);

                fetch(`/user/check-duplicate?${params.toString()}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            showError(inputElement, 'NIP sudah digunakan.');
                            saveButton.disabled = true;
                        } else {
                            clearError(inputElement);
                            saveButton.disabled = false;
                        }
                    })
                    .catch(err => console.error('Error saat memeriksa duplikasi NIP:', err));
            }

            function showError(inputElement, message) {
                inputElement.classList.add('is-invalid');
                let feedback = inputElement.nextElementSibling;
                if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    inputElement.parentNode.appendChild(feedback);
                }
                feedback.innerText = message;
            }

            function clearError(inputElement) {
                inputElement.classList.remove('is-invalid');
                const feedback = inputElement.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            }

            // Cek duplikat di form tambah (NIP)
            addNipInput.addEventListener('blur', () => checkDuplicateNip(addNipInput, addSaveButton));
            addNipInput.addEventListener('input', () => checkDuplicateNip(addNipInput, addSaveButton));

            // Cek duplikat di form edit (NIP)
            editNipInput.addEventListener('blur', () => checkDuplicateNip(editNipInput, editSaveButton,
                editUserIdInput.value));
            editNipInput.addEventListener('input', () => checkDuplicateNip(editNipInput, editSaveButton,
                editUserIdInput.value));
        });
    </script>
@endsection
