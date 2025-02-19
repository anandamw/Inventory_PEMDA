@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Card kiri atas: Detail User -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">History</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Events</th>
                                            <th>Phone</th>
                                            <th>Date Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->events }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td class="text-end ps-0">
                                                    <div class="dropdown d-flex justify-content-center">
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
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $item->id_orders }}">
                                                                Detail
                                                            </button>
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

    @foreach ($orders as $get)
        <div class="modal fade" id="exampleModal{{ $get->id_orders }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pengambilan #{{ $get->id_orders }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <!-- Image Section (left) -->
                                <div class="col-md-4">
                                    <img src="{{ $get->profile ? asset($get->profile) : asset('assets/images/no-profile.jpg') }}"
                                        alt="Image" class="img-fluid">
                                </div>

                                <!-- Description Section (right) -->
                                <div class="col-md-8">
                                    <h5>Nama: <span id="nama">{{ $get->name }}</span></h5>
                                    <p>NIP: <span id="nip">{{ $get->nip }}</span></p>

                                    <!-- Detail Barang (table) -->
                                    <h6>Detail Barang:</h6>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderItem->where('orders_id', $get->id_orders) as $data)
                                                <tr>
                                                    <td>{{ $data->item_name }}</td>

                                                    @if ($data->status !== 'success')
                                                        <td class="py-2 text-center">
                                                            <div class="input-group quantity-control">
                                                                <button
                                                                    class="btn btn-outline-primary btn-sm decrement">-</button>
                                                                <input type="number" name="quantity[]"
                                                                    class="form-control text-center quantity"
                                                                    value="{{ $data->quantity }}"
                                                                    data-id="{{ $data->id_order_items }}" min="1">
                                                                <button
                                                                    class="btn btn-outline-primary btn-sm increment">+</button>
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td>{{ $data->quantity }}</td>
                                                    @endif
                                                    <td class="text-center">
                                                        <div class="d-flex align-items-center">
                                                            @if ($data->status == 'success')
                                                                <i class="fa fa-circle text-success me-1"></i> Successful
                                                            @elseif($data->status == 'canceled')
                                                                <i class="fa fa-circle text-danger me-1"></i> Canceled
                                                            @elseif($data->status == 'pending')
                                                                <i class="fa fa-circle text-warning me-1"></i> Pending
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <p>Acara: <span id="datetime">{{ $get->events }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>

                        @php
                            // Mengecek apakah ada item yang belum success
                            $hasPendingItems =
                                $orderItem
                                    ->where('orders_id', $get->id_orders)
                                    ->where('status', '!=', 'success')
                                    ->count() > 0;
                        @endphp

                        @if ($hasPendingItems)
                            <button type="button" class="btn btn-warning light"
                                onclick="updateAllRecaps({{ $get->id_orders }})">
                                Simpan Perubahan
                            </button>

                            <button type="button" class="btn btn-primary light"
                                onclick="updateItemsStatus({{ $get->id_orders }}, 'success')">
                                Acara Selesai
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".quantity-control").forEach(function(control) {
                let decrementBtn = control.querySelector(".decrement");
                let incrementBtn = control.querySelector(".increment");
                let inputField = control.querySelector(".quantity");

                decrementBtn.addEventListener("click", function() {
                    let currentValue = parseInt(inputField.value) || 0;
                    if (currentValue > 0) {
                        inputField.value = currentValue - 1;
                    }
                });

                incrementBtn.addEventListener("click", function() {
                    let currentValue = parseInt(inputField.value) || 0;
                    inputField.value = currentValue + 1;
                });
            });
        });

        function updateAllRecaps(orderId) {
            let recaps = [];

            document.querySelectorAll(`#exampleModal${orderId} tbody tr`).forEach(row => {
                let id = row.querySelector("input[name='quantity[]']").getAttribute("data-id");
                let quantity = parseInt(row.querySelector("input[name='quantity[]']").value) || 0;


                recaps.push({
                    id: id,
                    quantity: quantity,

                });
            });

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            fetch("{{ route('history.dashboard.update') }}", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        recaps: recaps
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error("Error updating data:", error);
                });
        }
    </script>

    <script>
        function updateItemsStatus(orderId, status) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            fetch("{{ route('order-items.updateStatus') }}", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        orders_id: orderId,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error("Error updating status:", error);
                });
        }
    </script>
@endsection
