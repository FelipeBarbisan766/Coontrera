<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="pt-br">
<?php include 'head.php'; ?>

<body class="">
  <?php include 'navBar.php'; ?>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('Image/iconcoontrera.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  <p class="mb-0">Enter your email and password to register</p>
                </div>
                <div class="card-body">
                  <form role="form" method="post">
                    <!-- <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control">
                    </div> -->
                    <div class="input-group input-group-outline mb-3">
                      <!-- <label class="form-label">E-mail</label> -->
                      <input name="email" type="email" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <!-- <label class="form-label">Senha</label> -->
                      <input name="password" type="password" class="form-control" placeholder="Senha" maxlength="15">
                    </div>
                    <!-- <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" name="session" value="1" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        Manter Logado
                      </label>
                    </div> -->
                    <div class="text-center">
                      <input type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0" value="Logar"></input>
                    </div>
                  </form>
                </div>
                <?php
                include_once("conexao.php");
                if (!isset($_SESSION)) {
                  session_start();
                  if (isset($_SESSION['cod'])) {
                    echo '<script>alert("Você já está logado!"); window.location.href = "index.php";</script>';
                    exit;
                  }
                }

                if (isset($_POST['email']) || isset($_POST['password'])) // verifica se existe as variaveis email e senha
                {
                  if (strlen($_POST['email']) == 0) // o "strlen" conta quantas letras existe na variavel então se for = a 0 nada foi escrito
                  {
                    echo '<div class="alert alert-danger" role="alert">Preencha seu E-mail!</div>';
                  } else if (strlen($_POST['password']) == 0) {
                    echo '<div class="alert alert-danger" role="alert">Preencha sua Senha!</div>';
                  } else {
                    $email = $conexao->real_escape_string($_POST['email']); //codigo para evitar invasão (pode ser retirado se quiser)
                    $senha = $conexao->real_escape_string($_POST['password']);

                    $email = strtolower($email);

                    $sql_email = mysqli_query($conexao, "SELECT * FROM Employee WHERE em_email = '$email' AND em_senha ='$senha' and em_isActive is true"); //select do email e da senha
                    $quantEmail = $sql_email->num_rows;


                    if ($quantEmail == 1) {
                      $usuario = $sql_email->fetch_assoc();
                    } else {
                      echo '<div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                              <span class="font-medium">Erro!  Usuário ou senha incorretos. </span>
                              </div>';
                    }

                    $_SESSION['cod'] = $usuario['employeeID'];
                    $_SESSION['name'] = $usuario['em_name'];
                    $_SESSION['role'] = $usuario['em_role'];

                    echo '<script>window.location.href = "dashboard.php";</script>';
                  }
                }
                ?>
                <!-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="pages/sign-in.html" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <?php include 'footer.php'; ?>
</body>

</html>