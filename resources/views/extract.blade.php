<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        @foreach ($data as $key => $ligne)
            <tr>
                @if ($key == 0)
                    @foreach ($ligne as $item)
                        <th>{{ $item }}</th>
                    @endforeach
                @else
                    @foreach ($ligne as $item)
                        <td>{{ $item }}</td>
                    @endforeach
                @endif
            </tr>
        @endforeach
    </table>
</body>
</html>