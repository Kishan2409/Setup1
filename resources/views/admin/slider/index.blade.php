@extends('admin.files.layouts')

@section('title', 'Dashboard')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $module_name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                            <a class="btn btn-primary float-right" href="{{ route('slider.create') }}"><i
                                    class="fa-solid fa-plus"></i> Create New</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info card-outline">
                            <div class="card-header d-flex align-items-center">
                                <div class="Status">
                                    <lable for="status" class="m-1">Select Status</lable>
                                    <select class="select2 w-100" name="status" id="status">
                                        <option value=""></option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="ml-3 mt-4 Filter">
                                    <button class="btn border border-danger " id="clearfilter"><i
                                            class="fa-solid fa-filter-circle-xmark"></i> Clear
                                        Filter</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>
                                                Description
                                            </th>
                                            <th>
                                                Image
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    {{-- success message --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ Session::get('success') }}",
                icon: 'success',
                showCloseButton: true,
                confirmButtonText: 'Ok  <i class="fa-regular fa-thumbs-up"></i>',
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // datatable
            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('slider') }}",
                    data: function(d) {
                        d.status = $('#status').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        searchable: true,
                    },
                    {
                        data: 'description',
                        searchable: true,
                    },
                    {
                        data: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        searchable: true,
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
            // Inactive to active btn
            $("#example").on('click', '.activate', function(e) {
                e.preventDefault();
                var input = $(this);
                var Id = input.data("id");
                Swal.fire({
                    title: "Are you sure want to Active?",
                    icon: "warning",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('slider.status') }}",
                            data: {
                                'id': Id,
                            },
                            success: function(Id) {
                                table.ajax.reload();
                            }
                        });
                    }
                });
            });

            // active to inactive btn
            $("#example").on('click', '.deactivate', function(e) {
                e.preventDefault();
                var input = $(this);
                var Id = input.data("id");
                Swal.fire({
                    title: "Are you sure want to Inactive?",
                    icon: "warning",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('slider.status') }}",
                            data: {
                                'id': Id,
                            },
                            success: function(Id) {
                                table.ajax.reload();
                            }
                        });
                    }
                });
            });

            // delete btn
            $("#example").on('click', '.delete', function(e) {
                e.preventDefault();
                var input = $(this);
                var Id = input.data("id")

                Swal.fire({
                    title: "Are you sure ?",
                    text: "Are you sure you want to delete this slider.",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('slider.destroy') }}",
                            data: {
                                'id': Id,
                            },
                            success: function(Id) {
                                table.ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        });
                    }
                })
            });

            // status filter
            $('#status').change(function() {
                table.draw();
            });

            // clearfilter
            $("#clearfilter").click(function() {
                $('#status').val(null).trigger('change');
            });

            // select2 dropdown
            $('.select2').select2({
                placeholder: "--- Select Status ---",
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection
