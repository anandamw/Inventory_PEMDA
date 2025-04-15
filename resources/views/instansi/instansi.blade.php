@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Instansi</h4>
                            <button type="button"
                                class="btn btn-primary btn-info d-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#addInstansiModal">
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
                                            <th>Nama Instansi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($instansis as $ins)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ins->nama_instansi }}</td>
                                                <td>
                                                    <div class="d-flex ">

                                                        <button type="button"
                                                            class="btn btn-primary shadow btn-xs sharp me-1 btn-edits"
                                                            data-id="{{ $ins->id_instansi }}"
                                                            data-nama="{{ $ins->nama_instansi }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <a href="{{ route('instansi.destroy', $ins->id_instansi) }}"
                                                            data-confirm-delete="true">
                                                            <button type="button"
                                                                class="btn btn-danger shadow btn-xs sharp btn-delete">
                                                                <i class="fa fa-trash" style="color: aliceblue"></i>
                                                            </button></a>
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


    <!-- Modal Add Instansi -->
    <div class="modal fade" id="addInstansiModal" tabindex="-1" aria-labelledby="addInstansiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInstansiModalLabel">Tambah Instansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addInstansiForm" action="{{ route('instansi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="add_nama_instansi" class="form-label">Nama Instansi</label>
                            <input type="text" class="form-control" id="add_nama_instansi" name="nama_instansi"
                                placeholder="Masukkan Nama Instansi....." required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="addInstansiForm">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Instansi -->
    <div class="modal fade" id="editInstansiModal" tabindex="-1" aria-labelledby="editInstansiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInstansiModalLabel">Edit Instansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editInstansiForm" method="POST">
                        @csrf
                        @method('PUT') <!-- Laravel butuh ini untuk mengenali metode PUT -->
                        <input type="hidden" id="instansiId" name="id_instansi">
                        <div class="mb-3">
                            <label for="edit_nama_instansi" class="form-label">Nama Instansi</label>
                            <input type="text" class="form-control" id="edit_nama_instansi" name="nama_instansi"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges" form="editInstansiForm">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edits");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    let instansiId = this.getAttribute("data-id");
                    let namaInstansi = this.getAttribute("data-nama");

                    document.getElementById("instansiId").value = instansiId;
                    document.getElementById("edit_nama_instansi").value = namaInstansi;

                    // Sesuaikan dengan format route yang baru
                    document.getElementById("editInstansiForm").setAttribute("action",
                        `/instansi/${instansiId}/update`);

                    let editModal = new bootstrap.Modal(document.getElementById(
                        "editInstansiModal"));
                    editModal.show();
                });
            });
        });
    </script>
@endsection
