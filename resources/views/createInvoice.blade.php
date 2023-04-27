<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link " aria-current="page" href="/">View</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="/create-barang">Create</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/create-invoice">Invoice</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/create-category">Create Category</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
        </nav>

        <div class="m-5">
            <h1 class="text-center">Faktur Barang</h1>
            <form method="POST" action="{{ route('store') }}">
                @csrf
    
                <div class="mb-3">
                    <label for="exampleInputKategori" class="form-label">Kategori Barang</label>
                    <select class="form-select" aria-label="Default select example" name="CategoryName">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->CategoryName}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mb-3">
                    <label for="exampleInputNama" class="form-label">Nama Barang</label>
                    <input type="text" value="{{old('nama_barang')}}" class="form-control @error('nama_barang') is-invalid @enderror" id="exampleInputNama" name="nama_barang">
                </div>
    
                @error('nama_barang')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror

                <div class="mb-3">
                    <label for="exampleInputHarga" class="form-label">Harga Barang</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" value="{{ old('harga_barang') }}" class="form-control @error('harga_barang') is-invalid @enderror" id="exampleInputHarga" name="harga_barang" aria-label="Harga Barang" aria-describedby="basic-addon2">
                    </div>
                </div>
    
                @error('harga_barang')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
    
                <div class="mb-3">
                    <label for="exampleInputKuantitas" class="form-label">Kuantitas</label>
                    <input type="number" value="{{old('kuantitas')}}" class="form-control @error('kuantitas') is-invalid @enderror" id="exampleInputKuantitas" name="kuantitas">
                </div>
    
                @error('kuantitas')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror
    
                <div class="mb-3">
                    <label for="exampleInputAlamat" class="form-label">Alamat Pengiriman</label>
                    <input type="text" value="{{old('alamat_pengiriman')}}" class="form-control @error('alamat_pengiriman') is-invalid @enderror" id="exampleInputAlamat" name="alamat_pengiriman">
                </div>
    
                @error('alamat_pengiriman')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror

                <div class="mb-3">
                    <label for="exampleInputKode" class="form-label">Kode Pos</label>
                    <input type="text" value="{{old('kode_pos')}}" class="form-control @error('kode_pos') is-invalid @enderror" id="exampleInputKode" name="kode_pos">
                </div>
    
                @error('kode_pos')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                @enderror            
    
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>    