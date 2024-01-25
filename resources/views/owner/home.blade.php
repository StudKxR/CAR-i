@extends('owner.layout.layout')
@section('content')


<!-- <div class="bg-gradient-to-r from-red-500 to-yellow-300 rounded-lg text-white p-2 text-center h-24 break-words">
        <script type="text/javascript" src="https://www.brainyquote.com/link/quotebr.js"></script>
</div> -->
<div class="pb-6">	
	<span class="text-lg font-bold text-black">My Dashboard</span>
</div>


<div class="flex gap-4 justify-center">
    <div class="p-4 bg-white rounded-lg w-2/3">
        <h5 class="text-xl font-medium mb-2">Bookings Per Month</h5>
        <!-- Add a canvas element for the chart -->
        <canvas id="bookingsPerMonthChart"></canvas>
    </div>


    <div class="p-4 bg-white rounded-lg w-1/3">
        <h5 class="text-xl font-medium mb-2">Bookings Per Car</h5>
        <!-- Add a canvas element for the chart with responsive styles -->
        <canvas id="bookingsChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var cars = <?php echo json_encode($cars); ?>;
        var bookingsCountByCar = <?php echo json_encode($bookingsCountByCar); ?>;

        // Get the canvas element
        var canvas = document.getElementById("bookingsChart");

        // Create an array to store bookings count for each car
        var bookingsData = [];

        // Iterate through the cars and get the bookings count for each
        cars.forEach(function (car) {
            // Use the bookingsCountByCar array to fetch the count of bookings for each car
            var count = bookingsCountByCar[car.id];
            
            // Default to 0 if count is undefined
            bookingsData.push(count !== undefined ? count : 0);
        });

        // Create a pie chart
        var ctx = canvas.getContext("2d");
        var bookingsChart = new Chart(ctx, {
            type: "pie", // Change the chart type to "pie"
            data: {
                labels: cars.map(function (car) {
                    return car.name; // Assuming you have a 'name' attribute for each car
                }),
                datasets: [{
                    data: bookingsData,
                    backgroundColor: ["#36A2EB", "#FF6384", "#FFCE56", "#4BC0C0", "#9966FF"], // Customize colors as needed
                    borderColor: "#FFFFFF",
                    borderWidth: 1,
                }],
            },
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        var months = <?php echo json_encode($months); ?>;
        var counts = <?php echo json_encode($counts); ?>;

        // Create an array to store counts for each month (initialize with zeros)
        var monthlyCounts = Array.from({ length: 12 }, (_, i) => counts[months.indexOf(i + 1)] || 0);

        // Get the canvas element
        var canvas = document.getElementById("bookingsPerMonthChart");

        // Define an array of different colors for each month
        var monthColors = [
            "#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF",
            "#FF8C00", "#33CC33", "#FF4500", "#9370DB", "#20B2AA", "#FFD700", "#8A2BE2"
        ];

        // Map each month to a color
        var backgroundColors = monthlyCounts.map((count, index) => monthColors[index]);

        // Create a bar chart
        var ctx = canvas.getContext("2d");
        var bookingsChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    data: monthlyCounts,
                    backgroundColor: backgroundColors,
                    borderColor: "#FFFFFF",
                    borderWidth: 1,
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                    },
                },
            },
        });
    });
</script>
    
@endsection