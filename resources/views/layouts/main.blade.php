<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
        <a class="navbar-brand text-white" href="/">Data Toko Barang</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#uploadModal">Add Data</button>
                </li>
            </ul>
            <form method="GET" action="{{ route('search.data') }}" class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="SearchData" name="SearchData">
              <button class="btn btn-secondary" type="submit">Search</button>
            </form>
          </div>
        </div>
    </nav>

    <div class="p-2">
        @yield('content')
    </div>

    <!-- Modal Upload -->
    <div class="modal fade" id="uploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Add Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                <form method="POST" action="{{ route('input.data') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                        </div>
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli">
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual">
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok">
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto Brang</label>
                            <input class="form-control" type="file" id="photo" name="photo">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src={{ asset('js/bootstrap.bundle.min.js') }} crossorigin="anonymous"></script>
</body>

</html>
