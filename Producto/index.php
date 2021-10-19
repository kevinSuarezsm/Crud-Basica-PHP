<?php
include("../bd/db.php");
include('../includes/header.php');
?>
<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
          <?= $_SESSION['message'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php session_unset();
      } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save.php" method="POST">
          <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" autofocus required>
          </div>
          <div class="form-group">
            <input type="numeric" name="cantidad" id="cantidad" class="form-control" placeholder="cantidad" autofocus required>
          </div>
          <div class="form-group">
            <input type="numeric" name="precio" class="form-control" placeholder="precio" autofocus required>
          </div>

          <div class="form-group">
            <label>Fecha vencimiento </label>
            <input type="date" name="fechavencimiento" class="form-control" autofocus required>
          </div>
          <input type="submit" name="save" class="btn btn-success btn-block" value="Guardar">
          <br />

          <script type="text/javascript">
            function cargarHojaExcel() {
              if (document.frmcargararchivo.excel.value == "") {
                alert("Seleccione un archivo");
                document.frmcargararchivo.excel.focus();
                return false;
              }
              document.frmcargararchivo.action = "procesar.php";
              document.frmcargararchivo.submit();
            }
          </script>
        </form>
      </div>

      <div class="card card-body col-md-12">
        <form name="frmcargararchivo" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
            <label>Carga masiva productos</label>
          </div>
          <div class="col-md-12">
            <input type="file" name="excel" id="excel" />
          </div>
          <div class="col-md-12">
            <input type="button" value="subir" onclick="cargarHojaExcel();" /></p>
          </div>

        </form>
      </div>
    </div>
    <div class="col-md-8" style="background-color:whitesmoke;">
      <div class="col-md-12" style="text-align:right;margin-top:5px;">
        <a href="reportePDF.php" target="_blank" class="btn btn-secondary">
          <i class="fa fa-download"></i>
          GENERAR PDF
        </a>
      </div>

      <table class="table table-bordered">
        <h1>PRODUCTOS</h1>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Fecha vencimiento</th>
            <th></th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM productos";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['prod_nombre']; ?></td>
              <td><?php echo $row['prod_stock']; ?></td>
              <td><?php echo $row['prod_precio']; ?></td>
              <td><?php echo $row['prod_fechavencimiento']; ?></td>
              <td>
                <a href="edit.php?id=<?php echo $row['prod_id'] ?>" class="btn btn-secondary">
                  <i class="fas fa-marker"></i>
                </a>
                <a href="delete.php?id=<?php echo $row['prod_id'] ?>" class="btn btn-danger">
                  <i class="far fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>



<?php include('../includes/footer.php'); ?>