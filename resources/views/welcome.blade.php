<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Browser</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app" class="m-8">
        <h1 class="text-center text-4xl mb-8 font-bold">Profile Browser</h1>
        <profiles-list />
    </div>
</body>
</html>