<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cnh Fácil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

    </style>
</head>
<body>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-size: cover;
        background-image: url('https://images.unsplash.com/photo-1482029255085-35a4a48b7084?q=80&w=1631&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        width: 100%;
        height: 100vh;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 15px;
        border: none;
        padding: 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid #ddd;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: scale(1.05);
    }
</style>
@yield('content')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
