<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .error-container {
            text-align: center;
            padding: 20px;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: #343a40;
        }
        .error-message {
            font-size: 1.5rem;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .home-button {
            padding: 10px 20px;
            font-size: 1.2rem;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Remove underline */
        }
        .home-button:hover {
            background-color: #0056b3;

        }
        .illustration img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="illustration">
            <img src="https://via.placeholder.com/400x300.png?text=404+Illustration" alt="404 Illustration">
        </div>
        <div class="error-code">404</div>
        <div class="error-message">Oops! The page you're looking for doesn't exist.</div>
        <a href="<?=$_ENV['ROOT']?>/admin" class="home-button">Go Admin Home</a>
    </div>

</body>
</html>
