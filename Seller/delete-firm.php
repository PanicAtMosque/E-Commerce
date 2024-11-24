<?php

require 'config.php';
  $conn = connection();
  $sql = "DELETE FROM customer_info WHERE customer_id='" . $_GET["customer_id"] . "'";
  $data = $conn->query($sql);
  $conn=null;

  header('Location: index.php');
?>