@extends('navbar')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    
    <div class = "container w-25 border p-4 mt-4">
    <h2>Reduce a string</h2>
        <form action="{{ route('string') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">String to reduce</label>
            <input type="text" class="form-control" name="string">
        </div>       
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @if (isset($string))
            <p> Resultado es: {{ $string }}
        @endif
    </div>
</body>
@endsection
</html>