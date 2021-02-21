<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
	<title>Worker</title>
	<meta charset="utf-8">
    <!-- Настройка viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Подключаем Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
</head>
<body>

<form class="needs-validation" novalidate>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="validationCustom03">Имя сотрудника 1</label>
            <input type="text" class="form-control" id="user1name" placeholder="Имя сотрудника 1" value="Иван" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="validationCustom04">Возраст сотрудника 1</label>
            <input type="text" class="form-control" id="user1age" placeholder="Возраст сотрудника 1" value="25" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="validationCustom05">Зарплата сотрудника 1</label>
            <input type="text" class="form-control" id="user1salary" placeholder="Зарплата сотрудника 1" value="1000" required>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="validationCustom03">Имя сотрудника 2</label>
            <input type="text" class="form-control" id="user2name" placeholder="Имя сотрудника 2" value="Василий" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="validationCustom04">Возраст сотрудника 2</label>
            <input type="text" class="form-control" id="user2age" placeholder="Возраст сотрудника 2" value="26" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="validationCustom05">Зарплата сотрудника 2</label>
            <input type="text" class="form-control" id="user2salary" placeholder="Зарплата сотрудника 2" value="2000" required>
        </div>
    </div>
    <!--Generate token csrf and write in session-->
    <div class="form-row">
       <?php
           if (!array_key_exists('token', $_SESSION)) {
	           $_SESSION['token'] = bin2hex(random_bytes(5));
           }
          echo '<input type="hidden" name="token" id="token" value="' . $_SESSION['token'] . '" />';
       ?>
    </div>
    <button class="btn btn-primary btn-submit" type="submit">Результат</button>
</form>
<br>
<div  id="contentdataapi">
</div>

<!-- Подключаем jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Подключаем плагин Popper (необходим для работы компонента Dropdown и др.) -->
<script src="js/popper.min.js"></script>
<!-- Подключаем Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>

<script>

    function setResult()
    {
        $.ajax({
            type: "POST",
            url: 'request.php',
            cache: false,
            data: "user1name="+$("#user1name").val()+"&user1age="+$("#user1age").val()+"&user1salary="+$("#user1salary").val()+"&user2name="+$("#user2name").val()+"&user2age="+$("#user2age").val()+"&user2salary="+$("#user2salary").val()+"&token="+$("#token").val(),
            success: function(html){
                $("#contentdataapi").html(html);
            }
        });
    }

    $(document).ready(function(){
        $(".btn-submit").click(function(e){
            e.preventDefault();
            setResult();
        });
    });
</script>
</body>

</html>