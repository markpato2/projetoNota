<!DOCTYPE HTML>
<html>
<?php include("head.php") ?>

<body>
    <?php include("menu.php") ?>
    <div class="row">
        <form method="post" action="../controller/ControllerCadastro.php" id="form" name="form" class="col-10" enctype="multipart/form-data">
            <div class="form-group">
                 <input class="form-control" type="file" id="arquivo" name="arquivo" placeholder="XML" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" id="cadastrar">Upload</button>
            </div>
        </form>
    </div>


</body>

</html>
