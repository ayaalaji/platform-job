<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>
<body>
    {{$cv->name}}
    {{$cv->email}}

    <iframe height="700" width="100%" src="/assets/{{$cv->file_path}}" ></iframe>
    
</body>
</html>