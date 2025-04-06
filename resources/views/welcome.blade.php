<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column; /* Mengatur flex direction menjadi column */
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .welcome-container {
            background-color: #28a745;
            color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Menambahkan margin top untuk memberi ruang antara ikon dan container */
        }
        .btn-start {
            background-color: #ffffff;
            color: #28a745;
            border: 2px solid #28a745;
            margin-top: 20px;
        }
        .btn-start:hover {
            background-color: #28a745;
            color: white;
        }
        .icon {
            width: 280px; /* Ukuran ikon sedang */
            height: auto; /* Menjaga aspek rasio */
            margin-bottom: 20px; /* Memberi ruang antara ikon dan container */
        }
    </style>
</head>
<body>
    <img src="{{ asset('images/icon.png') }}" alt="Welcome Image" class="icon">
    <div class="welcome-container">
        <h1>Selamat Datang di Aplikasi To-Do List</h1>
        <p>Membantu manajemen waktu Anda</p>
        <a href="{{ url('/tasks') }}" class="btn btn-start btn-lg">Mulai</a>
    </div>
</body>
</html>