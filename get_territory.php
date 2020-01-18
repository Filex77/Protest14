<?php
if (!empty($_POST['city_id'])) $city_id = $_POST['city_id'];
if (isset($city_id)) {
   $dbc = mysqli_connect('localhost', 'root', '', 'protest14') or die('Нет подключения к БД');
   mysqli_set_charset($dbc, "utf8");
   $query_ter = "SELECT ter_address, ter_id, ter_type_id FROM `t_koatuu_tree` WHERE (`ter_pid`= '$city_id') OR( (`ter_type_id`=1)AND(`ter_id`= '$city_id'))";
   $data_ter  = mysqli_query($dbc, $query_ter);
   while ($row = mysqli_fetch_array($data_ter)) {
      echo "<option value=" . $row['ter_id'] . ">";
      echo $row['ter_address'];
      echo ("</option>");
   }
   exit;
}
