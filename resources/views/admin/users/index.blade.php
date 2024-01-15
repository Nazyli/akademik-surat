@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ url('/admin/home') }}"><span class="text-muted fw-light">Home /</span></a>
            Master User
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Status Pengajuan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 alert alert-info">
                            <label class="col-sm-2 col-form-label text-info" for="basic-default-department"
                                style="font-weight: bold;">Pilih Departemen</label>
                            <div class="col-sm-10">
                                <select id="departmentSelect" class="form-select">
                                    <option value="">Semua Departemen</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered user_datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NPM</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Departemen</th>
                                            <th>Program Studi</th>
                                            <th>Role</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
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
        $(function() {
            var table;

            function initDataTable(departmentId) {
                table = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('masteruser.getByDepartementId', ':departmentId') }}"
                            .replace(':departmentId', departmentId),
                        data: function(d) {
                            d.searchInput = $('#searchInput').val();
                        }
                    },
                    "order": [],
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    oLanguage: {
                        "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                        "sProcessing": "Sedang memproses...",
                        "sLengthMenu": "Tampilkan _MENU_ entri",
                        "sZeroRecords": "Tidak ditemukan data yang sesuai",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                        "sInfoPostFix": "",
                        "sSearch": "Cari:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "<i class='tf-icon bx bx-chevrons-left'></i>",
                            "sPrevious": "<i class='tf-icon bx bx-chevron-left'></i>",
                            "sNext": "<i class='tf-icon bx bx-chevron-right'></i>",
                            "sLast": "<i class='tf-icon bx bx-chevrons-right'></i>"
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },

                        {
                            data: 'avatar',
                            name: 'avatar'
                        },
                        {
                            data: 'npm',
                            name: 'npm'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'department_name',
                            name: 'department_name'
                        },
                        {
                            data: 'study_program_name',
                            name: 'study_program_name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
            }

            // Initial load with departmentId = 0
            initDataTable(0);

            // Handle change event on departmentSelect dropdown
            $('#departmentSelect').on('change', function() {
                var departmentId = $(this).val() || 0; // If no value selected, default to 0
                table.destroy(); // Destroy existing DataTable
                initDataTable(departmentId); // Initialize DataTable with new departmentId
            });
        });
    </script>
@endsection
