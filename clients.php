<!DOCTYPE html>
<html lang="pt-BR">
<?php include('head.php');
include('conexao.php');

if (isset($_POST['name']) && isset($_POST['cpf']) && isset($_POST['phone']) && isset($_POST['address'])) {
  $name = $_POST['name'];
  $cpf = $_POST['cpf'];
  $phone = $_POST['phone'];
  // $address = $_POST['address'];
  $address = null;
  $dateInit = date('Y-m-d');
  $isActive = 1;
  $plan = $_POST['plan'];

  $sql = "INSERT INTO client (cl_name, cl_cpf, cl_phone, cl_addres, cl_dateInit, cl_isActive, planID) VALUES ('$name', '$cpf', '$phone', '$address', '$dateInit', '$isActive','$plan')";
  $result = mysqli_query($conexao, $sql);
  if ($result) {

  } else {
    echo '<script>alert("Erro ao cadastrar cliente!");</script>';
  }
}
?>
<style>
  /* form border */
  .form-control {
    border: solid #00000024 1px !important;
    padding: 10px !important;
  }

  .form-control:focus {
    border: solid #00000024 1px !important;
    padding: 10px !important;
  }

  /* close button */
  .btn-close {
    background: #000000 var(--bs-btn-close-bg) center / 1em auto no-repeat !important;
  }
</style>

<body class="g-sidenav-show  bg-gray-100">
  <?php 
  $indexPage = 2;
  include('sidebar.php'); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include('topbar.php'); ?>
    <!-- End Navbar -->
    <div class="container-fluid py-1">
      <div class="row">
        <div class="col-2 text-end ">
          <!-- Button trigger modal -->
          <button class="btn bg-gradient-dark mb-0" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="material-symbols-rounded text-sm">add</i>&nbsp;&nbsp;Adicionar Novo Cliente</button>
        </div>
      </div>
    </div>
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Clientes</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Nome</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">CPF</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Telefone</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Plano</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Data de Matricula</th>
                      <th class="text-secondary "></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $slq_client = mysqli_query($conexao, "SELECT c.cl_name as client, c.cl_cpf as cpf, c.cl_phone as phone, p.pl_name as plan, c.cl_dateInit as dateInit FROM client as c INNER JOIN plan as p on c.planID=p.planID WHERE c.cl_isActive IS TRUE ORDER BY c.cl_name ASC");
                    while ($client = mysqli_fetch_array($slq_client)) {
                      echo '
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6>' . $client['client'] . '</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">' . $client['cpf'] . '</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">' . $client['phone'] . '</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">' . $client['plan'] . '</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">' . $client['dateInit'] . '</span>
                      </td>
                      </a>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                      </td>
                    </tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar Cliente</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <!-- form  -->
            <!-- input name -->
            <div class="mb-3">
              <label for="name" class="form-label font-weight-bold">Nome *</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Ex: José da Silva Sauro" required>
            </div>
            <hr>
            <!-- input CPF -->
            <div class="mb-3">
              <label for="cpf" class="form-label font-weight-bold">CPF</label>
              <input type="text" name="cpf" class="form-control" id="cpf" placeholder="Ex: 000.000.000-00">
            </div>
            <hr>
            <!-- input phone -->
            <div class="mb-3">
              <label for="phone" class="form-label font-weight-bold">Telefone</label>
              <input type="tel" name="phone" class="form-control" id="phone" placeholder="Ex: (16) 99000-0000">
            </div>
            <hr>
            <!-- input address -->
            <div class="mb-3">
              <label for="address" class="form-label font-weight-bold">Endereço</label>
              <input type="text" name="address" class="form-control" id="address" placeholder="Ex: Rua dos Bobos, 0">
            </div>
            <hr>
            <div class="mb-3">
              <label for="plan" class="form-label font-weight-bold">Selecione o Plano *</label>
              <select class="form-select form-control" name="plan" aria-label="Default select example" required>
                <?php 
                $slq_plan = mysqli_query($conexao, "SELECT p.planID as planID, p.pl_name as plan FROM plan as p  WHERE p.pl_isActive IS TRUE ORDER BY p.pl_name ASC");
                while ($plan = mysqli_fetch_array($slq_plan)) {
                echo '
                <option class="form-control" value="'.$plan['planID'].'">'.$plan['plan'].'</option>';}
                ?>
              </select>
            </div>
            <hr>
            <!-- <div class="mb-3">
              <label for="descript" class="form-label">Descrição</label>
              <textarea class="form-control" name="descript" id="descript" rows="3" placeholder="(Opcional)"></textarea>
            </div> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn bg-gradient-dark" value="Confirmar"></input>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>