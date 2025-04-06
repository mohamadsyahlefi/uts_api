<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: rgb(185, 230, 201);
        }
        .header {
            background-color: #28a745;
            color: white;
            padding: 10px 20px; /* Kurangi padding vertikal */
            display: flex; /* Menggunakan flexbox */
            align-items: center; /* Memusatkan item secara vertikal */
        }
        .header img.icon {
            width: 40px; /* Sesuaikan ukuran ikon */
            height: auto;
            margin-right: 10px; /* Beri ruang antara ikon dan teks */
        }
        .header h1 {
            margin: 0; /* Hilangkan margin default h1 */
            font-size: 1.5rem; /* Sesuaikan ukuran font */
        }
        .task-item {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            transition: box-shadow 0.3s;
        }
        .task-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .badge {
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .select-status {
            width: 95%;
            max-width: 200px;
            overflow: hidden;
        }
        @media (max-width: 768px) {
            .task-item {
                padding: 10px;
            }
            .btn {
                width: 100%;
                margin-bottom: 5px;
            }
            .status-badge {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/icon.png') }}" alt="icon Image" class="icon">
        <h1>To-Do List</h1>
    </div>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>