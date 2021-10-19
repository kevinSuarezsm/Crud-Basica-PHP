<?php

include("../bd/db.php");

if(isset($_GET['id'])
) {
  $id = $_GET['id'];

  $query = "DELETE FROM inventario WHERE inv_idProducto = $id";
  $result = mysqli_query($conn, $query);

  $query = "DELETE FROM detalle_venta WHERE dt_idProducto = $id";
  $result = mysqli_query($conn, $query);

  $query = "DELETE FROM pre_venta WHERE pv_idProducto = $id";
  $result = mysqli_query($conn, $query);

  $query = "DELETE FROM productos WHERE prod_id = $id";
  $result = mysqli_query($conn, $query);

  if(!$result) {
    die("Operacion fallida.");
  }
  
  $_SESSION['message'] = 'producto eliminado';
  $_SESSION['message_type'] = 'danger';
  header('Location: index.php');
}

?>
