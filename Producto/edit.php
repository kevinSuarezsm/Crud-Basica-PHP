<?php
include("../bd/db.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM productos WHERE prod_id = $id";

  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nombre = $row['prod_nombre'];
    $cantidad = $row['prod_stock'];
    $precio = $row['prod_precio'];
    $fechavencimiento = $row['prod_fechavencimiento'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $nombre = $_POST['nombre'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];
  $fechavencimiento = $_POST['fechavencimiento'];

  $query = "UPDATE productos set prod_nombre = '$nombre', prod_precio = '$precio', prod_stock = '$cantidad', prod_fechavencimiento = '$fechavencimiento' WHERE prod_id=$id";
  mysqli_query($conn, $query);

  $_SESSION['message'] = 'Producto editado: ' . $nombre;
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}
if (isset($_POST['cancelar'])) {
  header('Location: index.php');
}

?>
<?php include('../includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Nombre" required>
          </div>
          <div class="form-group">
            <input name="cantidad" type="text" class="form-control" value="<?php echo $cantidad; ?>" placeholder="Cantidad" required>
          </div>
          <div class="form-group">
            <input name="precio" type="numeric" class="form-control" value="<?php echo $precio; ?>" placeholder="Precio" required>
          </div>
          <div class="form-group">
            <input name="fechavencimiento" type="date" class="form-control" value="<?php echo $fechavencimiento; ?>" placeholder="Contraseña" required>
          </div>
          <button class="btn btn-success" name="update">Actualizar</button>
          <button class="btn btn-danger" name="cancelar">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('../includes/footer.php'); ?>