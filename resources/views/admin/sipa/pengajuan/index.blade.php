@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Application History') }}
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Application Status Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row alert alert-info">
                            <div class="col-md-6 mb-2">
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-info">{{ __('Department') }}</label>
                                    <div class="col-md-9">
                                        <select id="departmentName" class="form-select">
                                            <option value="0">{{ __('All Departments') }}</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->department_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-info">{{ __('Study Program') }}</label>
                                    <div class="col-md-9">
                                        <select class="form-select program-studi-select" id="programStudi"
                                            aria-label="Default select example" name="study_program_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-info">{{ __('Date of Application') }}</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date" value="" id="startDate" />
                                    </div>
                                    <div class="col-sm-1"> s/d </div>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date" value="" id="endDate" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-info">{{ __('Status') }}</label>
                                    <div class="col-md-9">
                                        <select class="form-select" id="status" name="status">
                                            <option value="all"></option>
                                            <option value="Sent">{{ __('Not Processed') }}</option>
                                            <option value="Reviewed">{{ __('Reviewed') }}</option>
                                            <option value="Revisi">{{ __('Revisi') }}</option>
                                            <option value="Reject">{{ __('Reject') }}</option>
                                            <option value="Finished">{{ __('Finished') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered user_datatable table-sm" style="font-size: 90%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Department') }}</th>
                                            <th>{{ __('Study Program') }}</th>
                                            <th>{{ __('Form Type') }}</th>
                                            <th>{{ __('App. Date') }}</th>
                                            <th>{{ __('Proc. Date') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
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
            var programStudiSelect = document.querySelector('.program-studi-select');
            var departmentId = 0;
            var programStudi = 0;
            var startDate = 0;
            var endDate = 0;
            var status = "all";

            function initDataTable(departmentId, studyProgramId, startDate, endDate, status) {
                if (table) {
                    table.destroy();
                }
                table = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    // ajax: {
                    //     url: "{{ route('getPengajuanByDepartmentId', ['departmentId' => ':departmentId', 'status' => ':status']) }}"
                    //         .replace(':departmentId', departmentId)
                    //         .replace(':status', 'all'),
                    //     data: function(d) {
                    //         d.searchInput = $('#searchInput').val();
                    //     }
                    // },
                    ajax: {
                        url: "{{ route('getPengajuanByDepartmentId') }}",
                        data: function(d) {
                            d.departmentId = departmentId;
                            d.studyProgramId = studyProgramId;
                            d.submissionStartDate = startDate;
                            d.submissionEndDate = endDate;
                            d.status = status;
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
                        "sEmptyTable": "{{ __('No data available in table') }}",
                        "sProcessing": "{{ __('Processing') }}...",
                        "sLengthMenu": "{{ __('Show _MENU_ entries') }}",
                        "sZeroRecords": "{{ __('No matching records found') }}",
                        "sInfo": "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                        "sInfoEmpty": "{{ __('Showing 0 to 0 of 0 entries') }}",
                        "sInfoFiltered": "{{ __('(filtered from _MAX_ total entries)') }}",
                        "sInfoPostFix": "",
                        "sSearch": "{{ __('Search') }}:",
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
                            data: 'full_name',
                            name: 'full_name'
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
                            data: 'template_name',
                            name: 'template_name'
                        },
                        {
                            data: 'submission_date',
                            name: 'submission_date'
                        },
                        {
                            data: 'processed_date',
                            name: 'processed_date'
                        },

                        {
                            data: 'status',
                            name: 'status',
                            orderable: true,
                            searchable: false,
                            orderData: [
                                9
                            ]
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'form_status', // Kolom tersembunyi
                            name: 'form_status',
                            visible: false, // Menyembunyikan kolom ini
                            orderable: true, // Kolom ini dapat diurutkan
                        },
                        {
                            data: 'updated_by', // Kolom tersembunyi
                            name: 'updated_by',
                            visible: false, // Menyembunyikan kolom ini
                            orderable: false, // Kolom ini dapat diurutkan
                        }
                    ]
                });
            }

            function fillProgramStudi(departmentId) {
                programStudiSelect.innerHTML = '<option value="0"></option>';

                var link = "{{ route('openGetProgramStudi', ':departmentId') }}";
                link = link.replace(':departmentId', departmentId);

                fetch(link)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(program => {
                            var option = document.createElement('option');
                            option.value = program.id;
                            option.text = program.study_program_name;

                            programStudiSelect.appendChild(option);
                        });
                    });
            }

            initDataTable(departmentId, programStudi, startDate, endDate, status);
            $('#departmentName').on('change', function() {
                departmentId = $(this).val();
                initDataTable(departmentId, programStudi, startDate, endDate, status);
                if (departmentId) {
                    fillProgramStudi(departmentId);
                }
            });

            $('#programStudi').on('change', function() {
                programStudi = $(this).val();
                if (programStudi) {
                    initDataTable(departmentId, programStudi, startDate, endDate, status);

                }
            });

            $('#startDate').on('change', function() {
                startDate = $(this).val();
                if (startDate) {
                    initDataTable(departmentId, programStudi, startDate, endDate, status);
                } else {
                    initDataTable(departmentId, programStudi, 0, endDate, status);
                }
            });

            $('#endDate').on('change', function() {
                endDate = $(this).val();
                if (endDate) {
                    initDataTable(departmentId, programStudi, startDate, endDate, status);
                } else {
                    initDataTable(departmentId, programStudi, startDate, 0, status);
                }
            });

            $('#status').on('change', function() {
                status = $(this).val();
                if (status) {
                    initDataTable(departmentId, programStudi, startDate, endDate, status);
                }
            });


        });
    </script>
@endsection
