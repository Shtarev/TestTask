<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{meta_token}">
  <title>Admin</title>
  <!-- Bootstrap -->
  <link href="/css/bootstrap.css" rel="stylesheet">
</head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/" target="_blank">Site</a>
      <a class="navbar-brand" href="/admin/">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <form id="aus" method="post" action="">
              <input type="hidden" name="sessionstop">
              <input type="submit" class="btn btn-danger" href="" value="Выход">
            </form>
          </li>
        </ul>
      </div>
    </nav>
    <section>
      <h3 class="text-center mt-3 text-uppercase">Admin</h3>
    </section>
    <hr>
    <!-- Content -->
    <div class="container">
    {view}
    </div>
    <!-- Footer -->
    <hr>
    <footer class="text-center">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <p>Copyright © MyWebsite. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap-4.0.0.js"></script>
    <!-- Мои скрипты -->
    <script src="/js/script.js"></script>
  </body>
</html>