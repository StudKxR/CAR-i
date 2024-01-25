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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the current mileage value from the placeholder
            var currentMileage = parseInt(document.querySelector('[name="mileage"]').placeholder.split(': ')[1]);

            // Add an event listener to the form
            document.getElementById('myForm').addEventListener('submit', function (event) {
                // Get the entered mileage value
                var enteredMileage = parseInt(document.querySelector('[name="mileage"]').value);

                // Check if the entered mileage is less than or equal to the current mileage
                if (enteredMileage <= currentMileage) {
                    alert('Please enter a mileage greater than the current mileage.');
                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h3>CAR-i <br><br>Car Service Input Form</h3>
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form id="myForm" action="{{ route('service-center.submit') }}" method="post">
            @csrf
            <input type="hidden" name="maintenance_id" value="{{$maintenance_id}}">
            
            <label for="service_date">Next Mileage:</label>
            <input type="text" name="mileage" required  placeholder="Current mileage: {{$mileage}}">
            
            <button type="submit" >Submit</button>
        </form>
    </div>
</body>
</html>
