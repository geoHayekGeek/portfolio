<?php
include_once "./layout/header.php";
?>

<section class="container-fluid about-section" id="single_work_section">
    <div class="site-map">
        <div class="sitemap-page">
            <img src="assets\img\work\sitemap_single.png" loading="lazy" alt="page-icon" class="sitemap-image">
            <h4 class="sitemap-title">My Work</h4>
        </div>
        <div class="sitemap-info">
            <div class="sitemap-text">inspiring selection</div>
        </div>
    </div>

    <div class="single-wrapper">
        <img alt="Essence" loading="lazy"
            src="https://themeguri.com/gridos/wp-content/uploads/sites/2/2024/01/work1.jpg" class="single-work-image">
        <h2 class="single-work-title mb-1">Elixir</h2>
        <div class="single-text-style">
        </div>

    </div>

    <div class="space-line"></div>

    <?php
    include_once "./partials/tiktok_section.php";
    ?>
</section>

<?php
include_once "./layout/footer.php";
?>