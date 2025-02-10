<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column">
    <div class="container mt-5">
        <h2 class="text-center">Selamat Datang di Dashboard</h2>
        <div class="card mt-4">
            <div class="card-body text-center">
                <p>Halo, {{ auth()->user()->name }}! Anda berhasil login.</p>
                <a href="{{ url('/categories') }}" class="btn btn-primary">Buat Category</a>
                <a href="{{ url('/blog') }}" class="btn btn-success">Buat Postingan Blog</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>
