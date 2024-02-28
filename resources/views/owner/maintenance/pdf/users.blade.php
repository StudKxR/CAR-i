<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Maintenance Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Car Maintenance Record</h1>
        <table>
            <tr>
                <th>Car Name - Plate</th>
                <th>Seats</th>
                <th>Model</th>
                <th>Category</th>
                <th>Mileage</th>
                <th>Last Maintenance</th>
            </tr>
            <tr>
                <td>{{ $maintenance->cars->name }} - {{ $maintenance->cars->plate }}</td>
                <td>{{ $maintenance->cars->seats }}</td>
                <td>{{ $maintenance->cars->mode }}</td>
                <td>{{ $maintenance->cars->category }}</td>
                <td>{{ $maintenance->cars->mileage }}</td>
                <td>{{ $maintenance->cars->last_maintenance }}</td>
            </tr>
        </table>
        <h2>Overview:</h2>
        <table>
            <tr>
                <th>Service Provider</th>
                <th>Maintenance Recommended</th>
                <th>Maintenance Date</th>
                <th>Maintenance Status</th>
            </tr>
            <tr>
                <td>{{ $maintenance->serviceProvider->name }}</td>
                <td>{!! $maintenance->maintenance_needed ?? '<span class="text-yellow-400">Reply Pending</span>' !!}</td>
                <td>{!! $maintenance->service_date ?? '<span class="text-yellow-400">Reply Pending</span>' !!}</td>
                <td>
                    @if ($maintenance->status == 'Progressing')
                        <span class="font-bold text-yellow-400 rounded-lg">{{ $maintenance->status }}</span>
                    @elseif ($maintenance->status == 'Done')
                        <span class="font-bold text-green-600 rounded-lg">{{ $maintenance->status }}</span>
                    @else
                        <span class="font-bold rounded-lg">{{ $maintenance->status }}</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
