<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../assets/image/light.png');
            background-size: cover;
            background-position: center;
        }

        .font-heading {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        elegant: {
                            100: '#f5f5f5',
                            200: '#e0e0e0',
                            300: '#9e9e9e',
                            400: '#707070',
                            500: '#424242',
                            600: '#303030',
                            700: '#212121',
                            800: '#121212',
                            900: '#090909',
                            accent: '#c9a96e'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body>
    @yield('content')
</body>

</html>
