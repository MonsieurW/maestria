<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Maestria <?php echo (isset($title)) ? ' | '.$title : ''; ?></title>

    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/jumbotron.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">

    <?php
    $this->block('stylesheet');
    $this->endBlock();
    ?>

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><i class="fa fa-graduation-cap"></i> Maestria</a>
        </div>
        <?php if (isset($isConnect) === true) { ?>
          <div class="navbar-collapse collapse">
             <ul class="nav navbar-nav">
                <li><a href="/"></a></li>
              </ul>

              <?php if (isset($loginIsAdmin) && $loginIsAdmin === true) { ?>
              <ul class="nav navbar-nav">
                <li><a href="/theme/"><i class="fa fa-bookmark"></i></a></li>
                <li><a href="/classroom/"><i class="fa fa-desktop"></i></a></li>
                <li><a href="/domain/"><i class="fa fa-road"></i></a></li>
                <li><a href="/know/"><i class="fa fa-paw"></i></a></li>
              </ul>

              <?php } ?>
              <ul class="nav navbar-nav pull-right">
                <li class="active"><a href="/user/<?php echo $loginId; ?>"><i class="fa fa-user"></i> <?php echo $loginUser; ?></a></li>
                <li><a href="/user/"><i class="fa fa-users"></i></a></li>
                <?php if (isset($loginIsAdmin) && $loginIsAdmin === true) { ?>
                  <li><a href="/professor/<?php echo $loginId; ?>/evaluation/"><i class="fa fa-archive"></i></a></li>
                  <li><a href="/professor/<?php echo $loginId; ?>/evaluation/new"><i class="fa fa-plus-circle"></i></a></li>
                <?php } ?>
                <li><a href="/logout"><i class="fa fa-sign-out"></i></a></li>
              </ul>
          </div><!--/.navbar-collapse -->
        <?php } ?>
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <?php
    $this->block('container');
    $this->endBlock();
    ?>

      <footer>
        <p>&copy; Metaphysik.fr 2014 <!--button onclick="TogetherJS(this); return false;">Start TogetherJS</button--></p>
      </footer>
    </div> <!-- /container -->

    <?php
    $this->block('script:before');
    $this->endBlock();
    ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.js"></script>

    <?php
    $this->block('script');
    $this->endBlock();
    ?>
    <!--script src="https://togetherjs.com/togetherjs-min.js"></script-->
  </body>
</html>
