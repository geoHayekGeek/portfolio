<?php
include_once "./layout/header.php";
?>

<section class="container-fluid about-section" id="single_work_section">
    <div class="site-map">
        <div class="sitemap-page">
            <img src="assets\img\work\sitemap_single.png" loading="lazy" alt="page-icon" class="sitemap-image">
            <h4 class="sitemap-title"></h4>
        </div>
        <div class="sitemap-info">
            <div class="sitemap-text"></div>
        </div>
    </div>

    <div class="single-wrapper">
        <img alt="Essence" loading="lazy"
            src="" class="single-work-image">
        <h2 class="single-work-title mb-1"></h2>
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