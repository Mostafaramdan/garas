<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>testSocket</h1>
    <script src="{{asset('js/app.js') }}"></script>
    <script>

    Echo.channel(`orders`)
    .listen('ordersEvent', (e) => {
        console.log(e.order);
        alert(e.id)
    });
    </script>
</body>
</html>