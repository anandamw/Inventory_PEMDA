@extends('components.template')

@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #dc3545;
            /* Default merah */
            transition: .4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: var(--primary);
            /* Hijau saat running */
        }

        input:checked+.slider:before {
            transform: translateX(20px);
        }

        /* Warna saat pertama kali dimuat */
        .running {
            background-color: var(--primary) !important;
        }

        .pending {
            background-color: #dc3545 !important;
        }
    </style>

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="search-box">
                                <input type="text" id="tableSearch" class="form-control" placeholder="Search...">
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addAsetModal">
                                <span class="btn-icon-start text-info">
                                    <i class="fa fa-plus color-info"></i>
                                </span>
                                Add
                            </button>
                        </div>
                        <div class="card-body" style="padding: 0 20px">
                            <div class="table-responsive" style="max-height: 330px; overflow-y: auto;">
                                <table id="mytable" class="table table-responsive-md text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assets as $key => $asset)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><img src="{{ asset('uploads/aset/' . $asset->image) }}" style="border-radius:25% " width="50">
                                                </td>
                                                <td>{{ $asset->name }}</td>
                                                <td>{{ $asset->quantity }}</td>
                                                <td class="status-text">
                                                    <span
                                                        class="badge {{ ($asset->status ?? 'running') == 'running' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ ucfirst($asset->status ?? 'running') }}
                                                    </span>

                                                </td>
                                                <td>
                                                    <input type="text" class="form-control description-input"
                                                        data-id="{{ $asset->id }}"
                                                        value="{{ $asset->description ?? '-' }}"
                                                        {{ $asset->status == 'running' ? 'disabled' : '' }}>

                                                </td>
                                                <td class="text-end ps-0">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <!-- Toggle Switch -->
                                                        <label class="switch">
                                                            <input type="checkbox" class="status-toggle"
                                                                data-id="{{ $asset->id }}"
                                                                {{ $asset->status == 'running' ? 'checked' : '' }}>
                                                            <span
                                                                class="slider round {{ $asset->status == 'running' ? 'running' : 'stopped' }}"></span>
                                                        </label>

                                                        <!-- Dropdown Button -->
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);"
                                                                class="btn-link btn sharp tp-btn btn-primary pill"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 9c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-9 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm18 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"
                                                                        fill="#A098AE" />
                                                                </svg>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <!-- Edit Button -->
                                                                <a href="#" class="dropdown-item editAssetBtn"
                                                                    data-id="{{ $asset->id }}"
                                                                    data-name="{{ $asset->name }}"
                                                                    data-quantity="{{ $asset->quantity }}"
                                                                    data-image="{{ $asset->image ? asset('uploads/aset/' . $asset->image) : asset('assets/images/no-image.png') }}">
                                                                    Edit
                                                                </a>

                                                                <!-- Delete Button -->
                                                                <a href="{{ route('assets.destroy', $asset->id) }}"
                                                                    data-confirm-delete="true"
                                                                    class="dropdown-item text-danger">
                                                                    Delete
                                                                </a>

                                                            </div>
                                                        </div>
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


    <!-- Modal Add User -->
    <div class="modal fade" id="addAsetModal" tabindex="-1" aria-labelledby="addAsetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addAsetForm" action="/aset/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri: Input Data -->
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="item_name" class="form-label">Nama Aset</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukkan Nama Aset..." style="opacity: 0.6;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="Masukkan Quantity..." style="opacity: 0.6;" required>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Input Gambar dengan Drag & Drop -->
                            <div class="col-md-4 text-center">
                                <label class="form-label d-block">Item Picture</label>
                                <div class="card p-1 shadow-sm d-flex align-items-center">
                                    <div id="dropZone"
                                        class="border rounded d-flex flex-column align-items-center justify-content-center position-relative"
                                        style="width: 120px; height: 120px; border: 2px dashed #ccc; cursor: pointer; background-color: #f8f9fa; overflow: hidden;">
                                        <img id="previewImage" src="{{ asset('assets/images/no-image.png') }}"
                                            alt="Drag & Drop" class="img-thumbnail"
                                            style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 8px;">
                                        <input type="file" id="formFile" name="image" accept="image/*" hidden
                                            data-preview-target="previewImage" onchange="previewFile(event)">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="addAsetForm">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Aset -->
    <div class="modal fade" id="modalEditAsset" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editAssetForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editAssetId" name="id">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Asset Name</label>
                                    <input type="text" class="form-control" id="editAssetName" name="name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="editAssetQuantity" name="quantity"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <label class="form-label d-block">Asset Image</label>
                                <div class="card p-1 shadow-sm d-flex align-items-center">
                                    <div id="dropZoneEditAsset"
                                        class="border rounded d-flex flex-column align-items-center justify-content-center position-relative"
                                        style="width: 120px; height: 120px; border: 2px dashed #ccc; cursor: pointer; background-color: #f8f9fa; overflow: hidden;"
                                        onclick="document.getElementById('editAssetFile').click()">

                                        <img id="previewEditAssetImage" src="{{ asset('assets/images/no-image.png') }}"
                                            alt="Drag & Drop" class="img-thumbnail"
                                            style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 8px;">

                                        <input type="file" id="editAssetFile" name="image" accept="image/*" hidden
                                            onchange="previewEditAssetFile(event)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Edit Asset Modal Handling
            document.querySelectorAll(".editAssetBtn").forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id");
                    let name = this.getAttribute("data-name");
                    let quantity = this.getAttribute("data-quantity");
                    let image = this.getAttribute("data-image") ||
                        "{{ asset('assets/images/no-image.png') }}";

                    document.getElementById("editAssetId").value = id;
                    document.getElementById("editAssetName").value = name;
                    document.getElementById("editAssetQuantity").value = quantity;
                    document.getElementById("previewEditAssetImage").src = image;

                    var modal = new bootstrap.Modal(document.getElementById('modalEditAsset'));
                    modal.show();
                });
            });

            // ✅ Preview file untuk tambah aset (ini tetap benar)
            function previewFile(event) {
                const file = event.target.files[0];
                const previewImage = document.getElementById('previewImage');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }

            // ✅ Preview file untuk edit aset (dijamin kepanggil di input file edit modal)
            function previewEditAssetFile(event) {
                const file = event.target.files[0];
                const previewImage = document.getElementById('previewEditAssetImage');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }

            // ✅ Bind previewFile ke form tambah aset
            const formFileAddAset = document.getElementById('formFile');
            if (formFileAddAset) {
                formFileAddAset.addEventListener('change', previewFile);
            }

            // ✅ Bind previewEditAssetFile ke form edit aset (optional tambahan jaga-jaga)
            const editAssetFile = document.getElementById('editAssetFile');
            if (editAssetFile) {
                editAssetFile.addEventListener('change', previewEditAssetFile);
            }

            // ✅ Handle form submit edit aset (tetap dipertahankan)
            document.getElementById("editAssetForm").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = new FormData(this);
                let id = document.getElementById("editAssetId").value;

                formData.append("_method", "PUT");

                fetch(`/assets/${id}/update`, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "Accept": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert("Failed to update asset.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Update failed, try again.");
                    });
            });

            // ✅ Drag & Drop untuk tambah aset
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('formFile');
            const previewImage = document.getElementById('previewImage');

            if (dropZone) {
                dropZone.addEventListener('click', () => fileInput.click());

                dropZone.addEventListener('dragover', (event) => {
                    event.preventDefault();
                    dropZone.style.borderColor = "#007bff";
                });

                dropZone.addEventListener('dragleave', () => {
                    dropZone.style.borderColor = "#ccc";
                });

                dropZone.addEventListener('drop', (event) => {
                    event.preventDefault();
                    dropZone.style.borderColor = "#ccc";

                    if (event.dataTransfer.files.length > 0) {
                        fileInput.files = event.dataTransfer.files;
                        previewFile({
                            target: fileInput
                        });
                    }
                });
            }

            // ✅ Drag & Drop untuk edit aset (tambahan supaya konsisten)
            const dropZoneEdit = document.getElementById('dropZoneEditAsset');
            const fileInputEdit = document.getElementById('editAssetFile');

            if (dropZoneEdit) {
                dropZoneEdit.addEventListener('click', () => fileInputEdit.click());

                dropZoneEdit.addEventListener('dragover', (event) => {
                    event.preventDefault();
                    dropZoneEdit.style.borderColor = "#007bff";
                });

                dropZoneEdit.addEventListener('dragleave', () => {
                    dropZoneEdit.style.borderColor = "#ccc";
                });

                dropZoneEdit.addEventListener('drop', (event) => {
                    event.preventDefault();
                    dropZoneEdit.style.borderColor = "#ccc";

                    if (event.dataTransfer.files.length > 0) {
                        fileInputEdit.files = event.dataTransfer.files;
                        previewEditAssetFile({
                            target: fileInputEdit
                        });
                    }
                });
            }

            // Status Toggle Handling (tidak diubah, aman)
            document.querySelectorAll('.status-toggle').forEach(item => {
                item.addEventListener('change', function() {
                    let assetId = this.getAttribute('data-id');
                    let newStatus = this.checked ? 'running' : 'pending';
                    let parentRow = this.closest('tr');
                    let descriptionInput = parentRow.querySelector('.description-input');

                    let descriptionValue = newStatus === 'pending' ? prompt("Masukkan deskripsi:") :
                        "-";
                    if (newStatus === 'pending' && !descriptionValue) {
                        alert("Deskripsi tidak boleh kosong saat status pending!");
                        this.checked = false;
                        return;
                    }

                    fetch(`/assets/${assetId}/update-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: newStatus,
                                description: descriptionValue
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                let slider = this.nextElementSibling;
                                slider.classList.remove('running', 'pending');
                                slider.classList.add(newStatus);

                                let statusText = parentRow.querySelector('.status-text span');
                                statusText.innerText = newStatus.charAt(0).toUpperCase() +
                                    newStatus.slice(1);
                                statusText.classList.remove('bg-success', 'bg-danger');
                                statusText.classList.add(newStatus === 'running' ?
                                    'bg-success' : 'bg-danger');

                                descriptionInput.value = data.description;
                                descriptionInput.disabled = newStatus === 'running';
                            } else {
                                alert('Gagal memperbarui status.');
                            }
                        });
                });
            });
        });
    </script>
@endsection
