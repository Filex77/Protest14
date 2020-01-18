<?php
$dbc = mysqli_connect('localhost', 'root', '', 'protest14') or die('Нет подключения к БД');
mysqli_set_charset($dbc, "utf8");
$query_oblast = "SELECT ter_id, ter_name FROM `t_koatuu_tree` WHERE `ter_type_id` = 0";
$data_oblast  = mysqli_query($dbc, $query_oblast);
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $territory_index = mysqli_real_escape_string($dbc, trim($_POST['territory']));
    $query_territory = "SELECT ter_address FROM `t_koatuu_tree`where `ter_id`='$territory_index'";
    $territory = mysqli_fetch_assoc(mysqli_query($dbc, $query_territory))['ter_address'];
    if (!empty($username) && (!empty($email))) {
        $query = "SELECT * FROM `main` WHERE email = '$email'";
        $data = mysqli_query($dbc, $query);
        if (mysqli_num_rows($data) == 0) {
            $query = "INSERT INTO `main` (username, email, territory) VALUES ('$username', '$email', '$territory' )";
            mysqli_query($dbc, $query);
            echo 'Данные записаны';  
        } else {
            if (mysqli_num_rows($data) == 1) {
                $row = mysqli_fetch_assoc($data);
                if ($row['email'] = $email) {
                    echo "Такой Email уже зарегистрирован ! </br>";
                    echo 'ФИО: ' . $row['username'] . "</br>" . 'EMail: ' . $row['email'] . "</br>" . 'Район: ' . $row['territory'] . '</br>';   
                }
            }
        }
        echo "<a href =" . $_SERVER['HTTP_REFERER'] . "></br>Ввести новые данные</a>";
        mysqli_close($dbc);     
        exit();
    }
} else {
    echo 'Выберите область:</br><select id ="sel_oblast" class="chosen-select" data-placeholder="Выберите ..."><option></option>';
    while ($arr = mysqli_fetch_array($data_oblast)) {
        echo '<option value=' . $arr['ter_id'] . '>' . $arr['ter_name'] . '</option>';
    }
    echo '</select>';
    mysqli_close($dbc);  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="docsupport/prism.css">
    <link rel="stylesheet" href="css/chosen.css">
    <link rel="stylesheet" href="docsupport/style.css">
</head>
<body>
    <form id="register" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
        <label for="city">Выберите город:</label>
        </br>
        <select id="sel_city" class="chosen-select" data-placeholder="Выберите ...">
         <option></option>
        </select>
        </br>
        <label for="territory">Выберите район:</label>
        </br>
        <select name="territory" id="sel_ter" class="chosen-select" data-placeholder="Выберите ...">
        </select>
        </br>
        <label for="username">Введите ваше ФИО:</label>
        <input type="text" name="username" id="username">
        </br>
        <label for="email">Введите ваш EMAIL:</label>
        <input type="text" name="email" id="email">
        </br></br>
        <button id="submit" type="submit" name="submit">Сохранить</button>
    </form>
    <script src="docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/chosen.jquery.min.js" type="text/javascript"></script>
    <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="docsupport/init.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/validation.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/ajax.js" type="text/javascript" charset="utf-8"></script
    </script>
</body>
</html>