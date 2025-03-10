<!DOCTYPE html>
<html lang="pt-BR">
<?php
date_default_timezone_set('America/Sao_Paulo');
include("head.php");
?>
<body>
    <?php
    $typePeriod = [1 => "day", 2 => "month", 3 => "Bimestre", 4 => "Semenstre", 5 => "year"];
    $dateNow = date("Y-m-d");
    // echo $dateNow;
    // $date->modify('-' . $diaN . ' day');
    if (isset($_POST['planid'])) {
        $slq_plan = mysqli_query($conexao, "SELECT * FROM plan where planID = ".$_POST['planid']." ");
        $plan = mysqli_fetch_array($slq_plan);
        $dateNext = new DateTime();
        $dateNext->modify('+'.$plan['pl_period'].' '.$typePeriod[$plan['pl_typePeriod']].'');
        $dateNext = $dateNext->format('Y-m-d');
        $slq_update = mysqli_query($conexao, 'UPDATE payment SET pa_datePay = "'.$dateNow.'" , pa_dateToPay = "'.$dateNext.'" WHERE paymentID = "'.$_POST["paymentid"].'" ');
        // echo var_dump($slq_update);
    }


    $slq_payment = mysqli_query($conexao, "SELECT pa.paymentId as paymentId, pl.planId as planId, pa.pa_datePay as datePay, pa.pa_dateToPay as dateToPay, cl.cl_name as client, pl.pl_price as price, pl.pl_period as periodPlan, pl.pl_typePeriod as typePeriodPlan FROM payment as pa INNER JOIN plan as pl on pa.planID=pl.planID INNER JOIN client as cl on pa.clientID = cl.clientID ORDER BY pa.pa_dateToPay ASC");

    while ($payment = mysqli_fetch_array($slq_payment)) {
        if ($payment["dateToPay"] <= $dateNow) {
            $status = "Devendo";
        } else {
            $status = "Dentro do Prazo";
        }
        echo 'data do pagamento: ' . $payment["datePay"] . '<br>data proximo pagamento: ' . $payment["dateToPay"] . '<br>Nome do cliente: ' . $payment["client"] . '<br>Preço: ' . $payment["price"] . '<br>Periodo do plano: ' . $payment["periodPlan"] . '<br>tipo de periodo: ' . $typePeriod[$payment["typePeriodPlan"]] . '<br>Status: ' . $status . '<br><form method="post"><input type="hidden" name="paymentid" value="' . $payment["paymentId"] . '"><input type="hidden" name="planid" value="' . $payment["planId"] . '"><input type="submit" value="Definir como pago"></form><br><br>';
    };

    ?>
</body>
<input type="hidden" name="">
<input type="submit" value="">

</html>