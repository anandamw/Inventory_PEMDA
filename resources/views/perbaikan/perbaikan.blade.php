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
                                                <th class="text-center">Total Rating</th>
                                                <th class="text-center">Average Rating</th>

                                                <th class="text-center">Details</th>
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
                                                    <td class="text-center">{{ number_format($tech->total_rating, 2) }}
                                                    </td>
                                                    <td class="text-center">{{ number_format($tech->avg_rating, 2) }}</td>
                                                    <td class="text-center text-danger">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModaltech{{ $tech->id }}">
                                                            <i class="fas fa-info-circle"></i>
                                                        </button>
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
    </div>
    @foreach ($rateUser as $index => $tech)
        <!-- Modal -->
        <style>
            .star-rating {
                direction: rtl;
                display: inline-flex;
            }

            .star-rating input {
                display: none;
            }

            .star-rating label {
                font-size: 1.5rem;
                color: gray;
                cursor: default;
                transition: color 0.3s ease-in-out;
            }

            .star-rating input:checked~label,
            .star-rating label:hover,
            .star-rating label:hover~label {
                color: gold;
            }
        </style>
        <div class="modal fade" id="exampleModaltech{{ $tech->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Modal Rating</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Repair</th>
                                    <th>Scheduled Date</th>
                                    <th>Comment</th>
                                    <th>Rating</th>
                                    <th>Date Completed</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $userRatings = $rateUserTeam->where('id', $tech->id);
                                @endphp
                                @foreach ($userRatings as $index => $rate)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $rate->repair }}</td>
                                        <td>{{ $rate->scheduled_date }}</td>
                                        <td>{{ $rate->comment ?? 'No comment' }}</td>
                                        <td>
                                            <div class="star-rating">
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <input type="radio" name="rating_{{ $index }}"
                                                        id="star{{ $i }}_{{ $index }}"
                                                        value="{{ $i }}"
                                                        {{ $rate->rating == $i ? 'checked' : '' }} disabled>
                                                    <label
                                                        for="star{{ $i }}_{{ $index }}">&#9733;</label>
                                                @endfor
                                            </div>
                                        </td>
                                        <td>{{ $rate->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach




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
