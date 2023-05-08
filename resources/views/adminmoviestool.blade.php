@extends('navbar')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Netflix</title>
</head>
<body>
    <div class = "container w-25 border p-4 mt-4">
        <form action="{{ route('admintool.post') }}" method="POST">
        @csrf
        <!-- Display a pop up success message -->
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

        @error('title')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror       
        <div class="mb-3">
            <label for="inputMovieTitle" class="form-label">Title</label>
            <input type="title" class="form-control" id="inputMovieTitle" name="title">
        </div>
        @error('year')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        <div class="mb-3">
            <label for="inputMovieYear" class="form-label">Release year</label>
            <input type="number" maxlength="4" class="form-control" id="inputMovieYear" name="year">
        </div>
        @error('image')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        <div class="mb-3">
            <label for="inputMoviePosterUrl" class="form-label">Poster image url</label>
            <input type="url" class="form-control" id="inputMoviePosterUrl" name="image">
        </div>
        <div class="mb-3">
            <label for="inputMovieType" class="form-label">Select the type</label>
            <select class="form-control" id="inputMovieType" name="type">
                <option value="Movie">Movie</option>
                <option value="Serie">Series</option>
            </select>
        </div>
        <a href="/admintool/update" class="btn btn-primary">Edit section</a>
        <button type="submit" class="btn btn-primary">Save item</button>
        </form>
    </div>
</body>
</html>
@endsection