<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Algolia</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h1 class="page-header">Search Results</h1>
<ul class="list-group">
    @foreach ( $results as $user)
        <li class="list-group-item">{{ $user['name'] }}</li>
    @endforeach
</ul>
</div>
</body>
</html>