<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
<body>
<div class="container">
    <form action="{{ route('search') }}" method="get">
        @csrf
        <input type="text" name="search" required>
        <button type="submit">Search</button>
    </form>
</div>
</body>
</html>
