<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cherkkoffie</title>

    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <script src="/node_modules/vue/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="/assets/js/machines.js"></script>


    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico" />
</head>
<body>
  <div class="container-fluid">
  <nav id="app" class="container-fluid" class="navlinks">
            <h2>
                <div><?=$brand;?></div>
            </h2>
            <button class="btn btn-primary" type="button"><a href="index.html">cherkkoffie</a></button>

        </nav>

      <header>
          <h1><?="$brand $desc";?></h1>
    <h1>
<?="$greeting $lan";?>
<br>
<?="$greeting $name";?>
    </h1>
    </header>
    <h2>Colors:</h2>
    <ul>
      <?php foreach ($colors as $color): ?>
          <li><?=$color;?></li>
      <?php endforeach;?>
    </ul>
    <hr>
    <h2>Coffee</h2>
    <ul>
       <?php foreach ($coffees as $feature => $featureVal): ?>
            <li><strong><?="$feature:";?></strong> <?=$featureVal;?></li>
        <?php endforeach?>
    </ul>

    </div>
</body>
<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" id="footer">
    <p class="col-md-4 mb-0 text-muted">&copy; 2021 Cherkkoffie</p>
    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
        <li><a href="https://www.facebook.com/" class="fa fa-facebook"></a>
        </li>
        <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a>
        </li>
        <li><a href="https://www.instagram.com/" class=" fa fa-instagram"></a>
        </li>
    </ul>
</footer>

</html>

