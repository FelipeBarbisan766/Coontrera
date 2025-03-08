<!DOCTYPE html>
<html lang="pt-BR">
<?php
include_once("head.php");

if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['period'])) {
    $name = $_POST['name'];
    $descr = $_POST['descript'];
    $price = $_POST['price'];
    $period = $_POST['period'];
    $typePeriod = $_POST['typePeriod'];
    $isActive = 1;

    $sql = "INSERT INTO plan (pl_name, pl_descr , pl_price, pl_period, pl_typePeriod, pl_isActive) VALUES ('$name', '$descr' , '$price', '$period', '$typePeriod','$isActive')";
    $result = mysqli_query($conexao, $sql);
    if ($result) {
    } else {
        echo '<script>alert("Erro ao cadastrar cliente!");</script>';
    }
}

$typePeriod = [1 => "Dia", 2 => "Mês", 3 => "Bimestre", 4 => "Semenstre", 5 => "Ano"];
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

<body>
    <?php
    $indexPage = 5;
    include_once("sidebar.php");
    ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps">

        <div class="container-fluid py-2">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-4 ">
                            <h4 class="mb-0">Informações de Planos</h4>
                        </div>
                        <div class="col-8 text-end ">
                            <button class="btn bg-gradient-dark mb-0" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#planModal"><i class="material-symbols-rounded text-sm">add</i>&nbsp;&nbsp;Adicionar Novo Plano</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <!-- ----------------- -->
                        <?php
                        $slq_plan = mysqli_query($conexao, "SELECT * FROM plan WHERE pl_isActive IS TRUE ORDER BY pl_name ASC");
                        while ($plan = mysqli_fetch_array($slq_plan)) {
                            echo '
                           <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h5 class="mb-3 text-x">' . $plan["pl_name"] . '</h5>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="mb-2 text-x">Descrição: <span class="text-dark font-weight-bold ms-sm-2">' . $plan["pl_descr"] . '</span></span>
                                        </div>
                                        <div class="col-6">
                                            <span class="mb-2 text-x">Pagamento: <span class="text-dark ms-sm-2 font-weight-bold">A Cada ' . $plan["pl_period"] . ' ' . $typePeriod[$plan["pl_typePeriod"]] . '</span></span>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-x">Valor: <span class="text-dark ms-sm-2 font-weight-bold">R$ ' . $plan["pl_price"] . '</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-symbols-rounded text-sm me-2">delete</i>Delete</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-symbols-rounded text-sm me-2">edit</i>Edit</a>
                            </div>
                        </li>
                        ';
                        }
                        ?>
                        <!-- ----------------- -->
                    </ul>
                </div>
            </div>
        </div>

        </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="planModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Criar Plano</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <!-- form  -->
                            <div class="mb-3">
                                <label for="name" class="form-label font-weight-bold">Nome</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Ex: Fisioterapia" required>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="descript" class="form-label">Descrição</label>
                                <textarea class="form-control" name="descript" id="descript" rows="3" placeholder="(Opcional)"></textarea>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="price" class="form-label font-weight-bold">Preço</label>
                                <input type="number" name="price" class="form-control" id="price" placeholder="Ex: 100.00" required step="0.01" min="0">
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="price" class="form-label font-weight-bold">Periodo para Pagamento</label>
                                <div class="row">
                                    <div class="col-4">
                                        <input type="number" name="period" class="form-control" id="period" placeholder="" required>
                                    </div>
                                    <div class="col-8">
                                        <select class="form-select form-control" name="typePeriod" aria-label="Default select example" required>
                                            <option class="form-control" value="1">Dias</option>
                                            <option class="form-control" value="2">Meses</option>
                                            <option class="form-control" value="3">Bimestres</option>
                                            <option class="form-control" value="4">Semestres</option>
                                            <option class="form-control" value="5">Anos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn bg-gradient-dark" value="Confirmar"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
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