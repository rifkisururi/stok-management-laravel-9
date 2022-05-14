@extends('template/sbadmin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered tblBarang" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                        <tr class="tr_{{$dt->id}}">
                            <td class="kode">{{$dt->kode}}</td>
                            <td class="nama">{{$dt->nama}}</td>
                            <td>0</td>
                            <td>
                                <button class="btn btn-warning btn-sm btnEdit" id="brg_{{$dt->id}}">Edit</button>
                                <button class="btn btn-danger btn-sm btnHapus" id="brg_{{$dt->id}}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="js/barang.js"></script>
@endsection