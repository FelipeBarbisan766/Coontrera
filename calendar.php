<!-- Use API of Google Agenda -->
<!-- https://developers.google.com/calendar/api/guides/overview?hl=pt-br -->
<!DOCTYPE html>
<html lang="pt-BR">
<?php include('head.php');?>

<body class="g-sidenav-show  bg-gray-100">
  <?php include('sidebar.php'); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include('topbar.php'); ?>
    <!-- End Navbar -->
    <iframe src="https://calendar.google.com/calendar/embed?height=1000&wkst=1&ctz=America%2FSao_Paulo&src=Z2FtZXJmZWxpcGVzaTc2NkBnbWFpbC5jb20&src=cHQuYnJhemlsaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%230B8043" style="border:solid 1px #777" width="1500" height="800" frameborder="0" scrolling="no"></iframe>

</main>
</body>