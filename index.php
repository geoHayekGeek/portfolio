<?php
include_once "./layout/header.php";
include_once "./partials/promotion_popup.php";
?>

<section class="row m-0 home-section" id="home_section">
    <div class="col-md-4 p-0 m-0 about-container d-flex align-items-end justify-content-start clickable" onclick="window.open('./about', '_blank');">
        <img src="assets\img\home\lea.webp" alt="" class="about-img" loading="lazy">

        <div class="about-text ms-5 mb-5">
            <h2 class="about-title">about</h2>
            <div class="subtitle-block">
                <div class="about-subtitle">biography &amp; abilities</div>
            </div>
        </div>
    </div>
    <div class="col-md-8 rest-container">
        <div class="services-container clickable" onclick="window.open('./services', '_blank');">
            <div class="text-with-dot">
                <div class="dot-text">elite solutions</div>
            </div>
            <div class="service-circles">
                <div class="service-box">
                    <img decoding="async" src="assets\img\home\service1.png"
                        loading="lazy" alt="services1" class="service-icon">
                </div>
                <div class="service-box">
                    <img decoding="async" src="assets\img\home\service2.png"
                        loading="lazy" alt="services2" class="service-icon">
                </div>
                <div class="service-box">
                    <img decoding="async" src="assets\img\home\service3.png"
                        loading="lazy" alt="services3" class="service-icon">
                </div>
            </div>
            <h3 class="main-title">services</h3>
        </div>
        <div class="row m-0 work-contact-wrapper">
            <div class="col-12 col-md-7 work-container clickable" onclick="window.open('./work', '_blank');">
                <div class="text-with-dot">
                    <div class="dot-text">inspiring selection</div>
                </div>
                <div class="circle-ball">
                    <img decoding="async" src="assets\img\home\portfolio1.jpg"
                        loading="lazy" alt="work" class="ball-image">
                </div>
                <h3 class="main-title">work</h3>
            </div>
            <div class="col-12 col-md-5 contact-container clickable" onclick="window.open('./contact', '_blank');">
                <div class="text-with-dot">
                    <div class="dot-text">let's talk</div>
                </div>
                <img decoding="async" src="assets\img\home\contact2.png"
                    loading="lazy" alt="contact" class="contact-img">
                <h3 class="main-title">contact</h3>
            </div>
        </div>
    </div>
</section>

<?php
include_once "./layout/footer.php";
?>