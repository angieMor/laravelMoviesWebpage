<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    .container-fluid{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/netflix">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @auth
                @if(Auth::user()->role === 'ADMIN_ROLE')
                    <li class="nav-item">
                        <a class="nav-link" href="/admintool/save">Admin tool</a>
                    </li>
                @endif
            @endauth
            <li class="nav-item">
                <a class="nav-link" href="/reduce-string">Reduce string</a>
            </li>
        </ul>

        <div class="d-flex justify-content-between w-100">
            @php
                $currentRouteName = Route::currentRouteName();
            @endphp
            @if ($currentRouteName === 'movieslist')
            <form class="d-flex" action= "{{ route('movieslist.post') }}" method="POST">
                @csrf
                <select id="type" name="type">
                    <option value="noOption">Type</option>
                    <option value="Movie">Movies</option>
                    <option value="Serie">Series</option>
                </select> 
                <select id="order" name="order">
                    <option value="noOption">Order</option>
                    <option value="ascTitle">Asc by title</option>
                    <option value="descTitle">Desc by title</option>
                    <option value="ascRate">Asc by rate</option>
                    <option value="descRate">Desc by rate</option>
                </select>           
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            @endif
            <div class="d-flex">     
                <a href="/logout" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
    </div>
    </nav>

    @yield('content')
</body>