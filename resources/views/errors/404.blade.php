<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        body {
            background: #fff;
        }
        .page-wrap {
            min-height: 100vh;
        }

        .tamanio{
            width: 40%;
            heigth: 40%;
        }
    </style>

</head>
<body>
        
    <div class="page-wrap d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <span class="display-1 d-block">404</span>
                    <img src="{{ asset('images/error404.jpg') }}" alt="ERROR" class="img-fluid tamanio">
                    <div class="mb-4 ">La página que intenta solicitar no existe</div>
                    <a href="/" class="btn btn-link">Volver a la página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>