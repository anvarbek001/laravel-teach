<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ob-havo Ma'lumotlari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">Ob-havo ma'lumotlarini ko'rish</h2>

        <div class="mb-3">
            <input type="text" id="city" class="form-control" placeholder="Shahar nomini kiriting">
        </div>

        <button class="btn btn-primary" onclick="fetchWeather()">Ob-havo ma'lumotini olish</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="weatherModal" tabindex="-1" aria-labelledby="weatherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="weatherModalLabel">Ob-havo ma'lumotlari</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Shahar:</strong> <span id="cityName"></span></p>
                    <p><strong>Harorat:</strong> <span id="temperature"></span> °C</p>
                    <p><strong>Namlik:</strong> <span id="humidity"></span>%</p>
                    <p><strong>Shamol tezligi:</strong> <span id="windSpeed"></span> m/s</p>
                    <p><strong>Ob-havo:</strong> <span id="weatherDesc"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function fetchWeather() {
            let modal = new bootstrap.Modal(document.getElementById('weatherModal'));
            modal.show();
            let city = document.getElementById('city').value;
            if (!city) {
                alert("Iltimos, shahar nomini kiriting!");
                return;
            }

            fetch(`/weather/${city}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert("Xatolik: " + data.error);
                        return;
                    }

                    document.getElementById('cityName').textContent = data.name;
                    document.getElementById('temperature').textContent = data.main.temp;
                    document.getElementById('humidity').textContent = data.main.humidity;
                    document.getElementById('windSpeed').textContent = data.wind.speed;
                    document.getElementById('weatherDesc').textContent = data.weather[0].description;

                    let modal = new bootstrap.Modal(document.getElementById('weatherModal'));
                    modal.show();
                })
                .catch(error => console.error("Xatolik:", error));
        }
    </script>

</body>

</html>
