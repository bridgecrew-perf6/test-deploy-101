<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test quantity</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form action="{{ route('test_post') }}" method="post">
                    @csrf
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>name</th>
                            <th>quantity</th>
                            <th>price</th>
                            <th>Sales_price</th>
                            <th>total</th>
                        </tr>
                        <tbody>
                            @foreach ($cart as $c)
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>
                                        <input type="number" name="quantity[]" value="{{ $c->quantity }}" min="1">
                                    </td>
                                    <td>
                                        @if ($c->sales_price > 0)
                                            <del>{{ $c->price }}</del>
                                        @else
                                            {{ $c->price }}
                                        @endif
                                    </td>
                                    <td>{{ $c->sales_price }}</td>
                                    <td>
                                        @if ($c->sales_price > 0)
                                            {{ $c->sales_price * $c->quantity }}
                                        @else
                                            {{ $c->price * $c->quantity }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-sm btn-danger">update cart</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
