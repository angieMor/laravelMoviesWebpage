@extends('navbar')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .movie-image {
            max-width: 100%;
            max-height: 350px;
            object-fit: cover;
        }
    </style>
    <title>Netflix</title>
</head>
<div class="container">
    <div class="row">
        @foreach ($movies as $movie)
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="{{ $movie->image_url }}" class="card-img-top movie-image" alt="{{ $movie->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <p class="card-text"> {{ $movie->type }}</p>
                        <p class="card-text">Release year: {{ $movie->year }}</p>
                        @if ($movie->total_rates == 0)
                            <p class="card-text">Users rate: 0</p>
                        @else
                            <p class="card-text">Users rate: {{ $movie->sum_rates / $movie->total_rates }}</p>
                        @endif
                        @auth
                            @if(Auth::user()->role === 'USER_ROLE')
                                <form action = "{{ route('movieslist.post.rate', ['title' => $movie->title]) }}" method="POST">
                                @csrf
                                    <p class="card-text">Rate:</p>
                                    <input type="number" min=1 max=5 name="rate"></input>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @endif
                        @endauth

                        @auth
                        
                            @if(Auth::user()->role === 'ADMIN_ROLE')
                            <form action = "{{ route('movieslist.delete', ['id' => $movie->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                                <div class="d-flex">     
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                            @endif
                        @endauth
                        
                    </div>
                </div>
            </div>

            @if ($loop->iteration % 3 == 0)
                </div><div class="row">
            @endif
        @endforeach
    </div>
</div>
@endsection