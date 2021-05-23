<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="destination">
        oke
    </div>
    <p>Siap</p>
    <p>Siap</p>
    <p>Siap</p>
    <p>Siap</p>
    <div id="source">
        iya
    </div>
    <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            console.log('oke');
            $('#source').append($('#destination'));
        })
    </script>
</body>
</html>
