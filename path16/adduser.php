<?php
$forename = $surname = $username = $password = $age = $email = '';

if(isset($_POST['forename'])){
    $forename = fix_string($_POST['forename']);
}
if(isset($_POST['surname'])){
    $surname = fix_string($_POST['surname']);
}
if(isset($_POST['username'])){
    $username = fix_string($_POST['username']);
}
if(isset($_POST['password'])){
    $password = fix_string($_POST['password']);
}
if(isset($_POST['age'])){
    $age = fix_string($_POST['age']);
}
if(isset($_POST['email'])){
    $email = fix_string($_POST['email']);
}

$fail = validate_forename($forename);
$fail .= validate_surname($surname);
$fail .= validate_username($username);
$fail .= validate_password($password);
$fail .= validate_age($age);
$fail .= validate_email($email);

echo "<!DOCTYPE html>\n<html><head><title>Пример формы</title>";
if($fail == ""){
    echo "</head><body>Проверка прошла успешно: $forename, $surname, $username, $password, $age, $email</body></html>";
    exit();
}

echo <<<_END
<style>
    .signup {
      border: 1px solid #999999;
      font: normal 14px helvetica;
      color: #444444;
    }
  </style>
  <script>
      function validate(form) {
          fail = validateForename(form.forename.value);
          fail += validateSurname(form.surname.value);
          fail += validateUsername(form.username.value);
          fail += validatePassword(form.password.value);
          fail += validateAge(form.age.value);
          fail += validateEmail(form.email.value);
          if (fail == "") {
              return true;
          } else {
              alert(fail);
              return false;
          }
      }

      function validateForename(field) {
          return (field == "") ? "Не введено имя. \n" : ""
      }

      function validateSurname(field) {
          return (field == "") ? "Не введена фамилия.\n" : ""
      }

      function validateUsername(field) {
          if (field == "") {
              return "Не введено имя пользователя.\n"
          } else if (field.length < 5) {
              return "В имени пользователя должно быть не менее 5 символов.\n"
          } else if (/[^a-zA-Z0-9_-]/.test(field)) {
              return "В имени пользователя разрешены только a-z, A-Z,0-9, - и _.\n"
          }
          return ""
      }

      function validatePassword(field) {
          if (field == "") {
              return "Не введен пароль.\n"
          } else if (field.length < 6) {
              return "В Пароле должно быть не менее 6 символов.\n"
          } else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field)) {
              return "Пароль требует 1 символ из каждого набора a-z A-Z 0-9.\n"
          }
          return ""
      }
      function validateAge(field) {
          if(field == "" || isNaN(field)) {
              return "Не введен возраст.\n"
          }else if (field < 18 || field > 110){
              return "Возраст должен быть между 18 и 110.\n"
          }return ""
      }

      function validateEmail(field) {
          if(field == ""){
              return "Не введен адрес электронной почты.\n"
          }else if (!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field)){
              return "Электронный адресс имеет неверный формат.\n"
          }return ""
      }
  </script>
</head>
<body>
<table class="signup" border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeee">
  <tr>
    <th colspan="2" align="center">Регистрационная форма</th>
  </tr>
  <tr><td colspan="2">К сожалению, в вашей форме найдены следующие ошибки: <p style="color: red"><i>$fail</i> </td></tr>
  <form action="adduser.php" method="post" onSubmit="return validate(this)">
    <tr>
      <td>Имя</td>
      <td><input type="text" maxlength="32" name="forename" value="$forename"></td>
    </tr>
    <tr>
      <td>Фамилия</td>
      <td><input type="text" maxlength="32" name="surname" value="$surname"></td>
    </tr>
    <tr>
      <td>Пользовательское имя</td>
      <td><input type="text" maxlength="16" name="username" value="$username"></td>
    </tr>
    <tr>
      <td>Пароль</td>
      <td><input type="text" maxlength="12" name="password" value="$password"></td>
    </tr>
    <tr>
      <td>Возвраст</td>
      <td><input type="text" maxlength="3" name="age" value="$age"></td>
    </tr>
    <tr>
      <td>Электронный адрес</td>
      <td><input type="text" maxlength="64" name="email" value="$email"></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" value="арегистрироваться">
      </td>
    </tr>
  </form>
</table>
</body>
</html>
_END;

function validate_forename($field){
    return ($field == "") ? "Не введено имя<br>" : "";
}

function validate_surname($field){
    return ($field == "") ? "Не введена фамилия<br>" : "";
}

function validate_username($field){
    if($field == ""){
        return "Не введено имя пользователя<br>";
    }elseif(strlen($field) < 5){
        return "В имени пользователя должно быть не менее 5 символов<br>";
    }elseif(preg_match("/[^a-zA-Z0-9_-]/", $field)){
        return "В имени пользователя допускаются только буквы, цифры, - и _ <br>";
    }

    return "";
}

function validate_password($field){
    if($field == ""){
        return "Не введен пароль<br>";
    }elseif(!preg_match("/[a-z]/", $field) || !preg_match("/[A-Z]/", $field) || !preg_match("/[0-9]/", $field)){
        return "Пароль требует 1 символ из каждого набора a-z A-Z 0-9<br>";
    }

    return "";
}

function validate_age($field){
    if($field == ""){
        return "Не введен возраст<br>";
    }elseif($field < 18 || $field > 110){
        return "Возраст должен быть между 18 и 110<br>";
    }

    return "";
}

function validate_email($field){
    if($field == ""){
        return "Не введен адрес электронноый почты<br>";
    }elseif(!((strpos($field, ".") > 0) && (strpos($field, "@") > 0)) || preg_match("/[^a-zA-Z0-9.@_-]/", $field)){
        return "Электронный адрес имеет неверный формат<br>";
    }

    return "";
}

function fix_string($str){
    if(get_magic_quotes_gpc()){
        $str = stripslashes($str);
    }

    return htmlentities($str);
}