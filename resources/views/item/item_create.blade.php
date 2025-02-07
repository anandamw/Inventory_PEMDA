@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Card kiri atas: Detail User -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Item</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Kolom Kiri: Input Data -->
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Item</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Item....." style="opacity: 0.6;" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="stock" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan Quantity....." style="opacity: 0.6;" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Kolom Kanan: Input Gambar dengan Drag & Drop -->
                                    <div class="col-md-4 text-center">
                                        <label class="form-label d-block">Item Picture</label>
                                        <div class="card p-1 shadow-sm d-flex align-items-center"> 
                                            <div id="dropZone" class="border rounded d-flex flex-column align-items-center justify-content-center position-relative"
                                                style="width: 120px; height: 120px; border: 2px dashed #ccc; cursor: pointer; background-color: #f8f9fa; overflow: hidden;">
                                                <img id="previewImage" src="https://via.placeholder.com/100" alt="Drag & Drop" class="img-thumbnail"
                                                    style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 8px;">
                                                <input type="file" id="formFile" name="profile_picture" accept="image/*" hidden onchange="previewFile(event)">
                                            </div>
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

    <!-- Script untuk Drag & Drop Pratinjau Gambar -->
<script>
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('formFile');
    const previewImage = document.getElementById('previewImage');

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
            previewFile({ target: fileInput });
        }
    });

    function previewFile(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function(){
            previewImage.src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>   
@endsection
