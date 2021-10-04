<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
<body>
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('search') }}" method="get">
        @csrf
        <input type="text" name="search" value="{{ old('search') }}">
        <button type="submit">Search</button>
    </form>
</div>
</body>
</html>
