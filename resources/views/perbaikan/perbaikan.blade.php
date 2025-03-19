@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button id="toggleTable" class="btn btn-primary btn-sm mb-3">
                                    Show Technician Recap
                                </button>
                            </div>

                            <div id="repairTable">
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
                                                <th class="text-center">Team</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($repairs as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img src="{{ $item->profile ? asset($item->profile) : asset('assets/images/no-profile.jpg') }}"
                                                            width="50"></td>
                                                    <td>{{ $item->user->name ?? '-' }}</td>
                                                    <td>{{ $item->user->nip ?? '-' }}</td>
                                                    <td>{{ $item->repair }}</td>
                                                    <td>{{ $item->user->instansi->nama_instansi ?? '-' }}</td>
                                                    <td>{{ $item->scheduled_date ?? '-' }}</td>
                                                    <td>{{ $item->updated_at->format('Y-m-d H:i') }}</td>
                                                    <td>
                                                        @if ($item->teams->isNotEmpty())
                                                            <ul class="list-unstyled">
                                                                @foreach ($item->teams as $teamMember)
                                                                    <li>- {{ $teamMember->name }} <br>
                                                                        ({{ $teamMember->nip }})
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <span class="text-muted">Belum ada teknisi</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="technicianTable" style="display: none;">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">NIP</th>
                                                <th class="text-center">Total Repairs</th>
                                                <th class="text-center">Completed Repairs</th>
                                                <th class="text-center">Failed Repairs</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rateUser as $index => $tech)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td class="text-center">{{ $tech->name }}</td>
                                                    <td class="text-center">{{ $tech->nip }}</td>
                                                    <td class="text-center">{{ $tech->total_repairs }}</td>
                                                    <td class="text-center text-success">{{ $tech->completed_repairs }}
                                                    </td>
                                                    <td class="text-center text-danger">{{ $tech->failed_repairs }}</td>
                                                     
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
    </div>

    <script>
        document.getElementById('toggleTable').addEventListener('click', function() {
            var repairTable = document.getElementById('repairTable');
            var technicianTable = document.getElementById('technicianTable');
            var button = document.getElementById('toggleTable');

            if (repairTable.style.display === "none") {
                repairTable.style.display = "block";
                technicianTable.style.display = "none";
                button.textContent = " Show Technician Recap";
            } else {
                repairTable.style.display = "none";
                technicianTable.style.display = "block";
                button.textContent = " Show Repairs Recap";
            }
        });
    </script>
@endsection
