@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ url('/admin/home') }}"><span class="text-muted fw-light">Home /</span></a>
            Riwayat Pengajuan
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Status Pengajuan</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <select id="departmentSelect" class="form-select">
                                <option value="">Pilih Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->department_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" id="searchInput" class="form-control mt-3" placeholder="Search">

                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Department</th>
                                    <th>Program Studi</th>
                                    <th>Tipe Borang</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Download File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="departmentData">
                            </tbody>
                        </table>
                        <div class="pagination">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departmentSelect = document.getElementById('departmentSelect');
            const departmentData = document.getElementById('departmentData');
            const pagination = document.querySelector('.pagination');
            const searchInput = document.getElementById('searchInput');

            function fetchData(departmentId, search = '') {
                const link = `{{ route('getPengajuanByDepartmentId', ':departmentId') }}`;
                const departmentLink = link.replace(':departmentId', departmentId);

                fetch(`${departmentLink}?search=${search}`)
                    .then(response => response.json())
                    .then(data => {
                        departmentData.innerHTML = '';

                        data.data.forEach(function(submission, index) {
                            const row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${submission.keterangan}</td>
                                    <td>${submission.keterangan}</td>
                                    <td>${submission.keterangan}</td>
                                    <td>${submission.keterangan}</td>
                                    <td>${submission.submission_date}</td>
                                </tr>
                            `;
                            departmentData.innerHTML += row;
                        });

                        pagination.innerHTML = data.links;
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
            }

            departmentSelect.addEventListener('change', function() {
                const departmentId = this.value;
                const search = searchInput.value.trim();
                fetchData(departmentId, search);
            });

            // searchInput.addEventListener('input', function() {
            //     const departmentId = departmentSelect.value;
            //     const search = this.value.trim();
            //     fetchData(departmentId, search);
            // });
        });
    </script>
@endsection
