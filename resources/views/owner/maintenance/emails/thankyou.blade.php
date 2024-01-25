<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Car Maintenance Service</title>
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
            color: #4CAF50;
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
        <h3>Thank You for Your Car Maintenance Service!</h3>
        <p>We appreciate your prompt attention and service for our car maintenance needs.</p>
        <p><strong>Car Details:</strong></p>
        <ul>
            <li><strong>Car Name:</strong> {{$car_name}}</li>
            <li><strong>Car plate:</strong> {{$car_plate}}</li>
        </ul>
        <p><strong>Description:</strong><br>{{$description}}</p>

        <p>Please provide recommended mileage for next service by filling out the form <a href="{{ route('mileage.form', ['maintenance_id' => $maintenance_id]) }}">here</a>.</p>

        <p>If you have any further inquiries, feel free to contact us. We look forward to serving you again in the future.</p>

        <p>Regards,<br>{{$name}}</p>
    </div>

    <div class="footer">
        <p>This email was sent from your Car Service Center. If you have any questions, please contact us.</p>
    </div>
</body>
</html>
