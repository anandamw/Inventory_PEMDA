@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Card kiri atas: Detail User -->
                <div class="col-12">
                    <div class="card">
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>NIP</th>
                                            <th>Prihal</th>
                                            <th>Instansi</th>
                                            <th>Start Repair</th>
                                            <th>Finish Repair</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($repairs as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <!-- Profile -->
                                                    <td><img src="{{ $item->profile ? asset($item->profile) : asset('assets/images/no-profile.jpg') }}"
                                                        width="50"></td>
                                                <td>{{ $item->user->name ?? '-' }}</td>
                                                <td>{{ $item->user->nip ?? '-' }}</td>
                                                <td>{{ $item->repair }}</td>
                                                <td>{{ $item->user->instansi->nama_instansi ?? '-' }}</td>
                                                <td>{{ $item->scheduled_date ?? '-' }}</td>
                                                <td>{{ $item->updated_at->format('Y-m-d H:i') }}</td>
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
@endsection
