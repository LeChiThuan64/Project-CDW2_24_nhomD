
    // Ẩn thông báo thành công sau 3 giây
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);

    // Kiểm tra độ dài của tin nhắn và không cho phép chỉ nhập khoảng trắng
    document.getElementById('message').addEventListener('input', function() {
        const message = document.getElementById('message');
        const submitBtn = document.getElementById('submitBtn');
        const feedback = document.querySelector('.invalid-feedback');

        // Kiểm tra xem tin nhắn có chứa ít nhất một ký tự không phải khoảng trắng và không vượt quá 500 ký tự
        if (message.value.trim().length === 0 || message.value.length > 500) {
            feedback.style.display = 'block';
            submitBtn.disabled = true; // Vô hiệu hóa nút submit
        } else {
            feedback.style.display = 'none';
            submitBtn.disabled = false; // Bật lại nút submit
        }
    });



    // Mảng chứa tên tỉnh/thành phố và tọa độ
    const cities = [{
            name: "Vĩnh Long",
            lat: 10.256,
            lon: 105.965
        },
        {
            name: "Hà Nội",
            lat: 21.0285,
            lon: 105.8542
        },
        {
            name: "Hồ Chí Minh",
            lat: 10.8231,
            lon: 106.6297
        },
        {
            name: "Đà Nẵng",
            lat: 16.0471,
            lon: 108.2068
        },
        {
            name: "Hải Phòng",
            lat: 20.8449,
            lon: 106.6881
        },
        {
            name: "Cần Thơ",
            lat: 10.0327,
            lon: 105.7836
        },
        {
            name: "Nha Trang",
            lat: 12.2388,
            lon: 109.1967
        },
        {
            name: "Đà Lạt",
            lat: 11.9416,
            lon: 108.4384
        },
        {
            name: "Vũng Tàu",
            lat: 10.3525,
            lon: 107.0843
        },
        {
            name: "Vinh",
            lat: 18.6796,
            lon: 105.6813
        },
        {
            name: "Bình Dương",
            lat: 10.6789,
            lon: 106.8166
        },
        {
            name: "Long Xuyên",
            lat: 9.9575,
            lon: 105.0851
        },
        {
            name: "Quy Nhơn",
            lat: 13.0827,
            lon: 109.2801
        },
        {
            name: "Yên Bái",
            lat: 21.5876,
            lon: 104.1118
        },
        {
            name: "Bảo Lộc",
            lat: 11.9341,
            lon: 108.4587
        },
        {
            name: "Lào Cai",
            lat: 21.4022,
            lon: 103.0166
        },
        {
            name: "Bến Tre",
            lat: 9.937,
            lon: 106.3347
        },
        {
            name: "Ninh Bình",
            lat: 20.25,
            lon: 105.974
        },
        {
            name: "Quảng Nam",
            lat: 15.8794,
            lon: 108.335
        },
        {
            name: "Tây Ninh",
            lat: 11.0522,
            lon: 106.3487
        },
        {
            name: "Phủ Lý",
            lat: 20.9387,
            lon: 105.8
        },
        {
            name: "Gia Lai",
            lat: 14.3763,
            lon: 108.0076
        },
        {
            name: "Tuy Hòa",
            lat: 13.7784,
            lon: 109.2237
        },
        {
            name: "Quảng Bình",
            lat: 17.4676,
            lon: 106.6237
        },
        {
            name: "Đắk Nông",
            lat: 11.5686,
            lon: 107.9087
        },
        {
            name: "Tân An",
            lat: 10.9802,
            lon: 106.6519
        },
        {
            name: "Sơn La",
            lat: 21.3857,
            lon: 105.8962
        },
        {
            name: "Điện Biên",
            lat: 21.5236,
            lon: 103.8858
        },
        {
            name: "Sóc Trăng",
            lat: 9.8242,
            lon: 105.5845
        }
    ];

    // Thêm các <option> vào dropdown dựa trên mảng
    const citySelect = document.getElementById('city-select');
    cities.forEach(city => {
        const option = document.createElement('option');
        option.value = `${city.lat},${city.lon}`;
        option.textContent = city.name;
        citySelect.appendChild(option);
    });

    // Hàm gọi API thời tiết (như trước đây)
    async function getWeather() {
        try {
            const [latitude, longitude] = citySelect.value.split(',');
            const response = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current_weather=true`);
            const data = await response.json();

            if (data && data.current_weather) {
                document.querySelector('.current-temp').textContent = `${data.current_weather.temperature}°C`;
                document.querySelector('.weather-desc').textContent = `Gió: ${data.current_weather.windspeed} km/h`;
                document.getElementById('weather-icon').className = 'fas';
                document.getElementById('weather-icon').classList.add(getWeatherIcon(data.current_weather.weathercode));
            } else {
                console.error("Dữ liệu thời tiết không hợp lệ:", data);
            }
        } catch (error) {
            console.error("Lỗi khi lấy dữ liệu thời tiết:", error);
        }
    }

    function getWeatherIcon(weatherCode) {
        switch (weatherCode) {
            case 0:
                return 'fa-sun';
            case 1:
                return 'fa-cloud';
            case 2:
                return 'fa-cloud-rain';
            default:
                return 'fa-question';
        }
    }

    document.addEventListener('DOMContentLoaded', getWeather);
