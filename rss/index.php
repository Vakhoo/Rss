<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>News Rss</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="container border border- mt-4 align-items-center">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="row p-3" method="post">
    <input type="text" name="fileLink" class="primary m-2 col-8" placeholder="Input site link">
    <input type="submit" class="btn-primary m-2 btn col-3">
</form>

<?php
$link = "https://makitweb.com/feed";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['fileLink'];
    if (!empty($name)) {
        $link = $name;
    }
}
$feeds = simplexml_load_file($link);
if ($feeds) {
    $site_name = $feeds->channel->title;
    foreach ($feeds->channel->item as $content) {
        ?>
        <hr>
        <div class="mt-2">
            <h4><a href="<?= $content->link ?>"><?= $content->title ?></a></h4>
            <p class="fs-6 fst-italic fw-lighter"><?= $content->pubDate ?></p>
            <p class="fs-5"><?= $content->description ?></p>
        </div>
        <?php
    }
}else{
    echo "<h1 class='col-xs-1 text-center m-4 text-muted'>No data</h1>";
}

?>
</body>
</html>