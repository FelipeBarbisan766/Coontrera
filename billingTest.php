<!DOCTYPE html>
<html lang="en">
<?php
include("head.php");
?>

<body>
    <?php
    $typePeriod = [1 => "Dia", 2 => "Mês", 3 => "Bimestre", 4 => "Semenstre", 5 => "Ano"];
    $slq_payment = mysqli_query($conexao, "SELECT pa.pa_datePay as datePay, pa.pa_dateToPay as dateToPay, cl.cl_name as client, pl.pl_price as price, pl.pl_period as periodPlan, pl.pl_typePeriod as typePeriodPlan FROM payment as pa INNER JOIN plan as pl on pa.planID=pl.planID INNER JOIN client as cl on pa.clientID = cl.clientID ORDER BY pa.pa_dateToPay ASC");
    while ($payment = mysqli_fetch_array($slq_payment)) {
        echo 'data do pagamento: '.$payment["datePay"].'<br>data proximo pagamento: '.$payment["dateToPay"].'<br>Nome do cliente: '.$payment["client"].'<br>Preço: '.$payment["price"].'<br>Periodo do plano: '.$payment["periodPlan"].'<br>tipo de periodo: '.$typePeriod[$payment["typePeriodPlan"]].'<br><hr>';
    };

    ?>
</body>

</html>