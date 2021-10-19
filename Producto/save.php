<?php

include('../bd/db.php');

if (isset($_POST['save'])) {
  $nombre = $_POST['nombre'];
  $precio = $_POST['precio'];
  $cantidad = $_POST['cantidad'];
  $fechaVencimiento = $_POST['fechavencimiento'];

  $query = "INSERT INTO productos(prod_nombre, prod_precio, prod_stock, prod_fechavencimiento) VALUES ('$nombre','$precio', '$cantidad','$fechaVencimiento')";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Operacion fallida.");
  }

  $_SESSION['message'] = 'Producto insertado';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');
}
