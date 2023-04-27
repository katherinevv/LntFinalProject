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
                <a class="nav-link active" aria-current="page" href="/">View</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="/create-barang">Create</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/create-invoice">Invoice</a>
                </li>

                {{-- yang bisa lihat admin doang --}}
                @if(auth()->user()->isAdmin)
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
                @endif

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

    @foreach ($barangs as $barang)
    <div class=" m-5">
        <div class="card" style="width: 18rem;">
            <img src="{{asset('/storage/image/'.$barang->foto_barang)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h2 class="card-title">{{$barang->nama_barang}}</h2>
                <h3 class="card-title">{{$barang->harga_barang}}</h3>
                <h4 class="card-title">{{$barang->jumlah_barang}}</h4>
                <p class="card-text">{{$barang->category->CategoryName}}</p>

                <a href="{{route('edit', $barang->id)}}" class="btn btn-success">Edit</a>
                <form action="{{route('delete', $barang->id)}}" method="POST">
                @csrf
                @method('delete')
                {{-- kalo put patch delete hrs tambahain kek atas --}}
                <button class="btn btn-danger">Delete</button>
                </form>
            </div>
            </div>
    </div>
    @endforeach

    <form action="/send-mail" method="POST">
        @csrf
        <label for="">Message</label>
        <input type="text" name="message">
        <button>Click Me</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
