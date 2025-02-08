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
                                                                data-bs-target="#modalGrid{{ $item->id_orders }}">
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

    @foreach ($orders as $item)
        <!-- Modal -->
        <div class="modal fade" id="modalGrid{{ $item->id_orders }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pengambilan #{{ $item->id_orders }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <!-- Image Section (left) -->
                                <div class="col-md-4">
                                    <img src="{{ auth()->user()->profile ? asset(auth()->user()->profile) : asset('assets/images/no-profile.jpg') }}"
                                        alt="Image" class="img-fluid">
                                </div>

                                <!-- Description Section (right) -->
                                <div class="col-md-8">
                                    <h5>Nama: <span id="nama">{{ $item->name }}</span></h5>
                                    <p>NIP: <span id="nip">{{ $item->nip }}</span></p>

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
                                            @foreach ($orderItem->where('orders_id', $item->id_orders) as $data)
                                                <tr>
                                                    <td>{{ $data->item_name }}</td>
                                                    <td>{{ $data->quantity }}</td>

                                                    <td>
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

                                    <p>Total Barang: <span id="total">
                                            {{ $orderItem->where('orders_id', $item->id_orders)->sum('quantity') }}
                                        </span></p>
                                    <p>DateTime: <span id="datetime">{{ $item->created_at }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
