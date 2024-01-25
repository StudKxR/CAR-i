<!DOCTYPE html>
<html>
<head>
    <title>Service Center Input Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #FE0000;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #ff9c9c;
        }

        p.success {
            color: #4caf50;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Car Service Input Form</h3>
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form id="myForm" action="{{ route('service-center.submit') }}" method="post">
            @csrf
            <input type="hidden" name="maintenance_id" value="{{$maintenance_id}}">
            
            <label for="service_date">Service Date:</label>
            <input type="date" name="service_date" required>
            
            <label for="service_description">Service Description:</label>
            <textarea name="service_description" required></textarea>
            
            <button type="submit" >Submit</button>
        </form>
    </div>
</body>
</html>
