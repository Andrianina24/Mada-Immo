<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title','Home admin')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/admin/asset/img/favicon.png" rel="icon">
  <link href="/admin/asset/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/admin/asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/admin/asset/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/admin/asset/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/admin/asset/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/admin/asset/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/admin/asset/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/admin/asset/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/admin/asset/css/style.css" rel="stylesheet">
  <!-- Inclure jQuery avant votre script JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Inclure le jeton CSRF dans les métadonnées de la page -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/admin/index" class="logo d-flex align-items-center">
        <img src="/admin/asset/img/logo.png" alt="">
        <span class="d-none d-lg-block">Mada - Immo</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/index">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/insert">
          <i class="bi bi-grid"></i>
          <span>Ajouter location</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/import">
          <i class="bi bi-grid"></i>
          <span>Importer des fichiers</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/liste">
          <i class="bi bi-grid"></i>
          <span>Liste de locations</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('logout.admin') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
          <i class="bi bi-grid"></i>
          <span>Se deconnecter</span>
        </a>
        <form id="logout-form" action="{{ route('logout.admin') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/admin/asset/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/admin/asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/admin/asset/vendor/chart.js/chart.umd.js"></script>
  <script src="/admin/asset/vendor/echarts/echarts.min.js"></script>
  <script src="/admin/asset/vendor/quill/quill.js"></script>
  <script src="/admin/asset/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/admin/asset/vendor/tinymce/tinymce.min.js"></script>
  <script src="/admin/asset/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/admin/asset/js/main.js"></script>

</body>

</html>