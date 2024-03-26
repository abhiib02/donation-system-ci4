<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=env('appName')?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        :root{
            --theme-color : <?=env('appThemeHex')?>;
            --theme-color-hover : <?=env('appThemeHex').'55'?>
        }
    </style>
    <link rel="stylesheet" href="<?=env('app.baseURL')?>css/style.css">
    
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark sticky-top" no-print data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="<?=env('appLogoPath')?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      <?=env('appName')?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end"  id="navbarSupportedContent">
      <ul class="navbar-nav  mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact-us">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
