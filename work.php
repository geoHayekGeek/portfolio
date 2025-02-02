<?php
include_once "./layout/header.php";
?>

<section class="container-fluid about-section" id="work_section">
    <div class="site-map">
        <div class="sitemap-page">
            <img src="assets\img\work\sitemap_single.png" loading="lazy" alt="page-icon" class="sitemap-image">
            <h4 class="sitemap-title">My Work</h4>
        </div>
        <div class="sitemap-info">
            <div class="sitemap-text">Inspiring Selection</div>
        </div>
    </div>  

    <div class="work-wrapper">
        <div class="work-list-wrapper w-dyn-list">
            <div role="list" class="work-list w-dyn-items w-row">
                <!-- Projects will be dynamically inserted here by JS -->
            </div>
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
