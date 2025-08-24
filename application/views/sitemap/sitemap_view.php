<?php header("Content-Type: application/xml; charset=utf-8"); ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap-image/1.1">

    <!-- home page 1.0 -->
    <url>
        <loc><?php echo base_url(); ?></loc>
        <lastmod><?php echo date('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?php echo base_url('Properti/dijual'); ?></loc>
        <lastmod><?php echo date('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?php echo base_url('Properti/disewa'); ?></loc>
        <lastmod><?php echo date('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?php echo base_url('Simulasi_KPR'); ?></loc>
        <lastmod><?php echo date('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <?= $url_properti_rumah; ?>
    <?= $url_properti_perumahan; ?>
    <?= $url_properti_proyek_baru; ?>
    <?= $url_detail_properti; ?>
     <?= $url_short_video; ?> 
    <?= $url_artikel; ?>
    <?= $url_properti_ruko; ?>

    

    <!-- tag artikel 0.5 -->
    <?= $url_tag_artikel; ?>

    <!-- detail artikel 0.5 -->
    <?= $url_detail_artikel; ?>
</urlset>