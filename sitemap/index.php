<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
    // include class
    include 'SitemapGenerator.php';
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
    $site_url = $protocol . $_SERVER["SERVER_NAME"];
    // create object
    $sitemap = new SitemapGenerator($site_url);

    // add urls
    $sitemap->addUrl($site_url,                date('c'),  'daily',    '1');
    $sitemap->addUrl("$site_url/index.php",          date('c'),  'daily',    '0.5');
    $sitemap->addUrl("$site_url/login.php",          date('c'),  'daily');
    $sitemap->addUrl("$site_url/signup.php",          date('c'));
    $sitemap->addUrl("$site_url/about");
    $sitemap->addUrl("$site_url/terms",  date('c'),  'daily',    '0.4');
    $sitemap->addUrl("$site_url/privacy",  date('c'),  'daily');

    // create sitemap
    $sitemap->createSitemap();

    // write sitemap as file
    $sitemap->writeSitemap();

    // update robots.txt file
    $sitemap->updateRobots();

    // submit sitemaps to search engines
    $sitemap->submitSitemap();
    header("location: ../sitemap.xml");
    ?>
</body>

</html>