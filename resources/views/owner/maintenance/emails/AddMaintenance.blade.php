<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Service Required</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h3 {
            color: #FE0000;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #005791;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Hello!</h3>
        <p>You are receiving this email because we require car maintenance service from you.</p>
        <p><strong>Car Details:</strong></p>
        <ul>
            <li><strong>Car Name:</strong> {{$car_name}}</li>
            <li><strong>Car Mode:</strong> {{$car_mode}}</li>
            <li><strong>Mileage:</strong> {{$mileage}}</li>
            <li><strong>Last Service:</strong> {{$last_date}}</li>
        </ul>
        <p><strong>Description:</strong><br>{{$description}}</p>

        <p><strong>Service requested by:</strong> {{ $name }}</p>

        <p>Please provide maintenance date and description by filling out the form <a href="{{ route('service-center.form', ['maintenance_id' => $maintenance_id]) }}">here</a>.</p>

        <p>Regards,<br>{{$name}}</p>
    </div>

    <div class="footer">
        <p>This email was sent from your Car Service Center. If you have any questions, please contact us.</p>
    </div>
</body>
</html>
