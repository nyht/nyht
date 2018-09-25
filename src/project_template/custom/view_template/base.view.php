<?php use Nyht\Generator\TranslationGenerator; ?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/bootstrap.css">
    <link rel="stylesheet" href="/css.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 nyht-nav-panel">
            <h1 class="display-4 application-title"><?= '<?=__(\''.TranslationGenerator::APPLICATION_TITLE.'\')?>' ?></h1>
            <?php include 'base_nav.view.php' ?>
        </div>
        <div class="col-md-10 nyht-content-panel">
            <?= $content ?>
        
        </div>
    </div>
</div>
</body>
</html>