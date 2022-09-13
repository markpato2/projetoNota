<?php require_once("../controller/ControllerListar.php");?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include("head.php"); ?>

<body>
   <?php include("menu.php"); ?>
    <table class="table">
        <thead>
            <tr>
                <th>Nota</th>
                <th>Data</th>
                <th>Destinatário</th>
                <th>CPF</th>
                <th>CEP</th>
                <th>UF</th>
                <th>Endereço</th>
                <th>Valor</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php new listarController();  ?>

        </tbody>
    </table>
   </body>
</html>
