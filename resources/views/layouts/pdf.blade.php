<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak {{$title??'Dokument'}}</title>
    <?php
        echo '<style>';
        echo file_get_contents(base_path('public/argon/css/argon.min.css'));
        echo '</style>';
    ?>
    <style>
        body{
            background: #fff;
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
