@extends('components.template')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="search-box">
                            <input type="text" id="tableSearch" class="form-control" placeholder="Search...">
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="shopping-cart">
                                <a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="downloadData()">
                                    <i class="fa fa-download me-2"></i>Download
                                </a>
                            </div>
                            <div class="dropdown bootstrap-select">
                                <select id="filterDate" class="image-select default-select dashboard-select width-130" onchange="filterData()">
                                    <option value="month">This Month</option>
                                    <option value="week">This Week</option>
                                    <option value="today">Today</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0 20px">
                        <div class="table-responsive" style="max-height: 330px; overflow-y: auto;">
                            <table id="mytable" class="table table-responsive-md text-center">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-center">Event</th>
                                        <th class="text-center">Profile</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Print</th>
                                        <th class="text-center">Detail</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($recaps as $recap)
                                    <tr>
                                        <td>{{ $recap->event }}</td>
                                        <td><img src="{{ asset($recap->profile ?? 'assets/images/no-image.png') }}" width="50"></td>
                                        <td>{{ $recap->name }}</td>
                                        <td>{{ $recap->date }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('rekapitulasi.download', $recap->id) }}">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="showDetail({{ $recap->id }})">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="pagination" class="mt-3 d-flex justify-content-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filterData() {
        let filter = document.getElementById('filterDate').value;
        fetch(`/rekapitulasi/filter/${filter}`)
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById('tableBody');
                tableBody.innerHTML = '';
                data.forEach(recap => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${recap.event}</td>
                            <td><img src="${recap.profile ? recap.profile : '/assets/images/no-image.png'}" width="50"></td>
                            <td>${recap.name}</td>
                            <td>${recap.date}</td>
                            <td class="text-center">
                                <a href="/rekapitulasi/download/${recap.id}">
                                    <i class="fa fa-download"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" onclick="showDetail(${recap.id})">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>`;
                });
            });
    }
</script>
@endsection