@extends('admin.base')

@section('title', 'Barang')

@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Jenis & Satuan</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <div class="row">
            <div class="col">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="d-flex justify-content-between card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary align-self-center">Tabel Data Jenis</h6>
                        <!-- Button trigger modal -->
                        <button type="button float-right" class="btn btn-success" data-toggle="modal"
                            data-target="#createType">
                            Buat
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <td>{{ $type->name }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning btn-circle btn-sm"
                                                    data-toggle="modal" data-target="#updateType{{ $type->id }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                |
                                                <button type="button" class="btn btn-danger btn-circle btn-sm"
                                                    data-toggle="modal" data-target="#deleteType{{ $type->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Type Update Modal -->
                                        <div class="modal fade" id="updateType{{ $type->id }}" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="updateTypeLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateTypeLabel">Ubah Jenis</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.tynun.update', $type->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="mode" value="type">
                                                            <div class="form-group">
                                                                <label for="name">Nama Jenis</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" value="{{ $type->name }}">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Type Delete Modal -->
                                        <div class="modal fade" id="deleteType{{ $type->id }}" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="deleteTypeLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteTypeLabel">Hapus Jenis</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.tynun.delete', $type->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="mode" value="type">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="d-flex justify-content-between card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary align-self-center">Tabel Data Satuan</h6>
                        <!-- Button trigger modal -->
                        <button type="button float-right" class="btn btn-success" data-toggle="modal"
                            data-target="#createUnit">
                            Buat
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($units as $unit)
                                        <tr>
                                            <td>{{ $unit->name }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning btn-circle btn-sm"
                                                    data-toggle="modal" data-target="#updateUnit{{ $unit->id }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                |
                                                <button type="button" class="btn btn-danger btn-circle btn-sm"
                                                    data-toggle="modal" data-target="#deleteUnit{{ $unit->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Unit Update Modal -->
                                        <div class="modal fade" id="updateUnit{{ $unit->id }}"
                                            data-backdrop="static" data-keyboard="false" tabindex="-1"
                                            aria-labelledby="updateUnitLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateUnitLabel">Ubah Jenis</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.tynun.update', $unit->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="mode" value="unit">
                                                            <div class="form-group">
                                                                <label for="name">Nama Jenis</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" value="{{ $unit->name }}">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Unit Delete Modal -->
                                        <div class="modal fade" id="deleteUnit{{ $unit->id }}"
                                            data-backdrop="static" data-keyboard="false" tabindex="-1"
                                            aria-labelledby="deleteUnitLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteUnitLabel">Hapus Satuan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.tynun.delete', $unit->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="mode" value="unit">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Type Create Modal -->
    <div class="modal fade" id="createType" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="createTypeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTypeLabel">Tambah Jenis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.tynun.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="mode" value="type">
                        <div class="form-group">
                            <label for="name">Nama Jenis</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Buat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Unit Create Modal -->
    <div class="modal fade" id="createUnit" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="createUnitLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUnitLabel">Tambah Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.tynun.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="mode" value="unit">
                        <div class="form-group">
                            <label for="name">Nama Satuan</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Buat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
