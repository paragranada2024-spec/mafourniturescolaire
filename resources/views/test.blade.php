<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    @if ($name != 'youssef')
<p style="color: red;">Error: name is not youssef</p>
        
   
 @else
    <h1>hellow {{$name}}</h1>
 @endif

</body>
</html>
