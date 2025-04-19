@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Card Kiri: Profile -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow-lg profile-card author-profile mb-4">
                        <div
                            class="card-body d-flex flex-column justify-content-center align-items-center text-center py-5 h-100">
                            <div class="author-profile">
                                <!-- Gambar Profil (Klik untuk ganti gambar) -->
                                <div class="author-media mb-3" style="cursor: pointer;"
                                    onclick="document.getElementById('profile-input').click();">
                                    <img id="profile-preview"
                                        src="{{ auth()->user()->profile ? asset(auth()->user()->profile) : asset('assets/images/no-profile.jpg') }}"
                                        class="img-fluid rounded-circle border shadow-sm" alt="Profile Image"
                                        width="120">
                                </div>

                                <!-- Input File (Hidden) -->
                                <input type="file" id="profile-input" name="profile" class="d-none" accept="image/*"
                                    onchange="previewAndCrop(event)">

                                <div class="author-info">
                                    <h6 class="title mb-1">{{ Auth::user()->name }}</h6>
                                    <span class="text-muted">{{ Auth::user()->role }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Kanan: Name, NIP, & Barcode Password -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow-lg profile-card mb-4" style="min-height: 400px;">
                        <div class="card-header bg-primary text-white">
                            <h4 class="title mb-0" style="color: azure">User Information</h4>
                        </div>


                        <div class="card-body p-5 d-flex flex-column justify-content-center" style="min-height: 350px;">
                            <div class="row align-items-center">
                                <!-- Data User (Kiri) -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" class="form-control border rounded"
                                            value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">NIP</label>
                                        <input type="text" class="form-control border rounded"
                                            value="{{ Auth::user()->nip }}" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Instansi</label>
                                        <textarea class="form-control border rounded" rows="3" readonly>{{ Auth::user()->instansi->nama_instansi }}</textarea>
                                    </div>
                                </div>

                                <!-- Barcode Password + Download (Kanan) -->
                                <div class="col-md-6 text-center">
                                    <label class="form-label fw-bold">Password Barcode</label>
                                    <div class="d-flex flex-column align-items-center">
                                        <a id="download-barcode"
                                            href="{{ asset('Pictures/qrcode/' . Auth::user()->name . '.png') }}"
                                            download="QR_{{ Auth::user()->name }}.png">
                                            <img src="{{ asset('Pictures/qrcode/' . Auth::user()->name . '.png') }}"
                                                class="img-fluid border shadow-sm rounded" alt="QR Code" width="150"
                                                style="cursor: pointer;">
                                        </a>
                                        <a href="{{ asset('Pictures/qrcode/' . Auth::user()->name . '.png') }}"
                                            download="QR_{{ Auth::user()->name }}.png" class="btn btn-primary mt-4">
                                            Download QR Code
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Card Kanan -->
            </div> <!-- End Row -->
        </div> <!-- End Container -->
    </div>

    <!-- Modal Crop (Awalnya disembunyikan) -->
    <div id="crop-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center;">

        <div
            style="background: white; padding: 20px; border-radius: 8px; text-align: center; width: 700px; height: 500px; max-width: 90%; box-shadow: 0px 4px 10px rgba(0,0,0,0.2); overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <h5 style="margin-bottom: 10px; font-size: 16px;">CROP IMAGES</h5>

            <!-- Container untuk memastikan gambar tetap dalam batas -->
            <div
                style="display: flex; justify-content: center; align-items: center; width: 600px; height: 600px; overflow: hidden;">
                <img id="crop-preview"
                    style="width: 100%; height: 100%; max-width: 600px; max-height: 600px; object-fit: contain; border-radius: 5px; border: 1px solid #ddd;">
            </div>

            <br>
            <!-- Container tombol dengan flex -->
            <div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
                <button onclick="cropAndUpload()"
                    style="padding: 8px 12px; font-size: 14px; background-color: #008B8B; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Save
                </button>

                <button onclick="closeCropModal()"
                    style="padding: 8px 12px; font-size: 14px; background-color: #a44646; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Cancel
                </button>
            </div>
        </div>
    </div>


    <script>
        function previewImage(event) {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('profile-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- Cropper.js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script>
        let cropper;
        let croppedBlob;

        function previewAndCrop(event) {
            let file = event.target.files[0];
            if (!file) return;

            let reader = new FileReader();
            reader.onload = function(e) {
                let cropPreview = document.getElementById('crop-preview');
                cropPreview.src = e.target.result;
                document.getElementById('crop-modal').style.display = 'flex';

                // Hapus instance cropper sebelumnya jika ada
                if (cropper) cropper.destroy();

                // Inisialisasi Cropper.js dengan rasio 1:1
                cropper = new Cropper(cropPreview, {
                    aspectRatio: 1,
                    viewMode: 1
                });
            };
            reader.readAsDataURL(file);
        }

        function cropAndUpload() {
            if (!cropper) return;

            // Dapatkan hasil crop sebagai Blob
            cropper.getCroppedCanvas().toBlob(blob => {
                croppedBlob = blob;
                uploadProfile();
            }, 'image/jpeg');

            closeCropModal();
        }

        function uploadProfile() {
            if (!croppedBlob) {
                alert('Crop gambar terlebih dahulu!');
                return;
            }

            let formData = new FormData();
            formData.append('profile', croppedBlob, 'cropped.jpg');
            formData.append('_token', '{{ csrf_token() }}');

            fetch("{{ route('upload.image') }}", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Profile updated successfully!');
                        document.getElementById('profile-preview').src = URL.createObjectURL(croppedBlob);

                        // 🔄 Auto reload setelah sukses upload
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        alert('Gagal mengupload gambar!');
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert('Gagal mengupload gambar!');
                });
        }

        function closeCropModal() {
            document.getElementById('crop-modal').style.display = 'none';
        }
    </script>
@endsection
