<?php
use yii\helpers\Url;
?>

<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($events as $event): ?>
        <url>
            <loc><?=Url::to($event->url, true);?></loc>
            <lastmod><?php echo date(DATE_W3C, $event->updated_at);?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    <?php endforeach; ?>
</urlset>