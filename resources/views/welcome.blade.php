<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

 
    </head>
<body>
    <h1>Some video </h1>

    <p>
    This video has been downloaded {{ $downloads ?? 'no' }} times. 
    </p>
</body>

</html>
