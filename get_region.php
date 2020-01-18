<?php
if (!empty($_POST['oblast_id'])) $oblast_id = $_POST['oblast_id'];
if (isset($oblast_id)) {
   $dbc = mysqli_connect('localhost', 'root', '', 'protest14') or die('Нет подключения к БД');
   mysqli_set_charset($dbc, "utf8");
   $query_city = "SELECT ter_name, ter_id FROM `t_koatuu_tree` WHERE `ter_pid`= '$oblast_id'";
   $data_city  = mysqli_query($dbc, $query_city);
   while ($row = mysqli_fetch_array($data_city)) {
      echo "<option value=" . $row['ter_id'] . ">";
      echo $row['ter_name'];
      echo ("</option>");
   }
   exit;
}
