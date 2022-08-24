@extends('admin.base')

@section('title', 'Barang')
@section('item', 'active')

@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="d-flex justify-content-between card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary align-self-center">Tabel Data Barang</h6>
                <!-- Button trigger modal -->
                <button type="button float-right" class="btn btn-success" data-toggle="modal" data-target="#createItem">
                    Buat
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Harga Pokok</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Harga Pokok</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type->name }}</td>
                                    <td>{{ $item->base_price }}</td>
                                    <td>{{ $item->sell_price }}</td>
                                    <td>{{ $item->stock . '' . strtolower($item->unit->name) }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning btn-circle btn-sm" data-toggle="modal"
                                            data-target="#updateItem{{ $item->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        |
                                        <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#deleteItem{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Item Update Modal -->
                                <div class="modal fade" id="updateItem{{ $item->id }}" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="updateItemLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateItemLabel">Ubah Barang</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.item.update', $item->id) }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name">Nama Barang</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" value="{{ $item->name }}">
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="type">Jenis</label>
                                                            <select id="type" name="type" class="form-control">
                                                                <option>Choose...</option>
                                                                @foreach ($types as $type)
                                                                    <option value="{{ $type->id }}"
                                                                        {{ $type->id == $item->type_id ? 'selected' : '' }}>
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="unit">Satuan</label>
                                                            <select id="unit" name="unit" class="form-control">
                                                                <option>Choose...</option>
                                                                @foreach ($units as $unit)
                                                                    <option value="{{ $unit->id }}"
                                                                        {{ $unit->id == $item->unit_id ? 'selected' : '' }}>
                                                                        {{ $unit->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="base_price">Harga Pokok</label>
                                                            <input type="number" class="form-control" name="base_price"
                                                                id="base_price" value="{{ $item->base_price }}">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="sell_price">Harga Jual</label>
                                                            <input type="number" class="form-control" name="sell_price"
                                                                id="sell_price" value="{{ $item->sell_price }}">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="stock">Stok</label>
                                                            <input type="text" class="form-control" name="stock"
                                                                id="stock" value="{{ $item->stock }}">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning">Buat</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item Delete Modal -->
                                <div class="modal fade" id="deleteItem{{ $item->id }}" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="deleteItemLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteItemLabel">Hapus Barang</h5>
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
                                                <form action="{{ route('admin.item.delete', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
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
    <!-- /.container-fluid -->

    <!-- Item Create Modal -->
    <div class="modal fade" id="createItem" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="createItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createItemLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.item.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="type">Jenis</label>
                                <select id="type" name="type" class="form-control">
                                    <option>Choose...</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="unit">Satuan</label>
                                <select id="unit" name="unit" class="form-control">
                                    <option>Choose...</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="base_price">Harga Pokok</label>
                                <input type="number" class="form-control" name="base_price" id="base_price">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sell_price">Harga Jual</label>
                                <input type="number" class="form-control" name="sell_price" id="sell_price">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="stock">Stok</label>
                                <input type="text" class="form-control" name="stock" id="stock">
                            </div>
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
