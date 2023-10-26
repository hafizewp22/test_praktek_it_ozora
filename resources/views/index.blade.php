@extends('layouts.main')


@section('content')
    <style>
        .custom-button {
            text-decoration: none;
            /* Menghapus garis bawah */
            color: rgb(255, 255, 255);
            /* Mengubah teks menjadi warna lain, misalnya hitam */
        }
    </style>

    <div class="p-5">
        <div class="mt-5">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto Barang</th>
                    <th scope="col">Nama Barang </th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Stok Barang</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="images/upload/{{ $data->photo }}" width="60" height="60" draggable="false">
                        </td>
                        <td class="align-middle">{{ $data->nama_barang }}</td>
                        <td class="align-middle">Rp. {{ number_format($data->harga_beli, 0, ',', '.') }}</td>
                        <td class="align-middle">Rp. {{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                        <td class="align-middle">{{ $data->stok }}</td>
                        <td class="align-middle">
                            <a class="cursor-pointer" href="#" data-bs-toggle="modal"
                                data-bs-target="#updateModal-{{ $data->id }}">Edit</a>
                            <a class="cursor-pointer" href="#" data-bs-toggle="modal"
                                data-bs-target="#deleteModal-{{ $data->id }}">Delete</a>
                        </td>
                    </tr>

                    <!-- Modal Update -->
                    <div class="modal fade" id="updateModal-{{ $data->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('update.data') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_barang" class="form-label">Nama Barang</label>
                                            <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                                value="{{ $data->nama_barang }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga_beli" class="form-label">Harga Beli</label>
                                            <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                                value="{{ $data->harga_beli }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga_jual" class="form-label">Harga Jual</label>
                                            <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                                value="{{ $data->harga_jual }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="stok" class="form-label">Stok</label>
                                            <input type="number" class="form-control" id="stok" name="stok"
                                                value="{{ $data->stok }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Foto Brang</label>
                                            <input class="form-control" type="file" id="photo" name="photo">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal-{{ $data->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-25 w-25 text-warning"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>

                                    <div>
                                        Apakah yakin mau dihapus?
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-danger">
                                        <a href="/delete-data/{{ $data->id }}" class="custom-button">Delete</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
