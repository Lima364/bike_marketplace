<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketPlace L6</title>
    <!-- <link rel="stylesheet" href="style.css"></link>  -->
    <!-- para chamada de um css externo -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"></link> 

</head>

<body>
    <div class="container">
        @include('flash::message')
        @yield('content')

    </div>
</body>

</html>