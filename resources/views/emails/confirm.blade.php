<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Xin chào {{ $user->name }},</h2>
    <p>Ma don hang {{$order->id}}</p>
    <ul>
        @foreach($cart as $item)
        <li>{{$item['title']}} Quantity: {{$item['quantity'] }} Price: {{ $item['price'] }}$</li>
        @endforeach
    </ul>
    <p>Tổng tiền: {{$order->total}}$</p>
</body>

</html>