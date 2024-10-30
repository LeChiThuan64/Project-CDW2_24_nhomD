@extends('viewUser.navigation')
@section('title', 'contact')
@section('content')

<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
</head>
<main>
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
        <div class="mw-930">
            <h2 class="page-title">CONTACT US</h2>
        </div>
    </section>

    <!-- Thông báo flash thành công -->
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="main-container">
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7839.023987265331!2d106.6869756632963!3d10.772043177154966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3c691d16d7%3A0x2e1df14948ef55aa!2sC%C3%B4ng%20Ty%20TNHH%20J97%20Entertainment!5e0!3m2!1svi!2s!4v1730304529224!5m2!1svi!2s"
                width="300"
                height="200"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <div class="contact-info-container">

            <div class="contact-info-item">
                <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="contact-details">
                    <div class="contact-title">ĐỊA CHỈ </div>
                    <div>81 Đ. Cách Mạng Tháng 8, Phường 7,<br> Quận 1, Hồ Chí Minh 700000, Việt Nam</div>
                </div>
            </div>
            <div class="contact-info-item">
                <div class="contact-icon"><i class="fas fa-clock"></i></div>
                <div class="contact-details">
                    <div class="contact-title">Giờ mở cửa</div>
                    <div>Cả Ngày</div>
                </div>
            </div>
            <div class="contact-info-item">
                <div class="contact-icon"><i class="fas fa-phone"></i></div>
                <div class="contact-details">
                    <div class="contact-title">Điện Thoại</div>
                    <div> 0917256539 </div>
                </div>
            </div>
        </div>
    </div>

    <section class="contact-us container">
        <div class="contact-us__form">
            <form action="{{ route('contact.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <h3 class="mb-5" style="padding-top: 28px;">Get In Touch</h3>

                @auth
                <div class="my-4">
                    <textarea class="form-control form-control_gray" name="message" placeholder="Your Message" cols="30" rows="8" required></textarea>
                </div>
                @else
                <div class="form-floating my-4">
                    <input type="text" class="form-control" id="contact_us_name" name="name" placeholder="Name *" required>
                    <label for="contact_us_name">Name *</label>
                </div>
                <div class="form-floating my-4">
                    <input type="email" class="form-control" id="contact_us_email" name="email" placeholder="Email address *" required>
                    <label for="contact_us_email">Email address *</label>
                </div>
                <div class="my-4">
                    <textarea class="form-control form-control_gray" name="message" placeholder="Your Message" cols="30" rows="8" required></textarea>
                </div>
                @endauth

                <div class="my-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
</main>

<!-- JavaScript để ẩn thông báo sau 3 giây -->
<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000); // 3000 milliseconds = 3 giây
</script>

<div class="mb-5 pb-xl-5"></div>
@endsection
