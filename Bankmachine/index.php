﻿<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Банкомат "Ваше солнышко"</title>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="ajax.js"></script>

</head>

<body>
    <form method="post" id="ajax_form" action="" >
        <input type="text" name="denomination" placeholder="НОМИНАЛ" /><br>
        <input type="text" name="money" placeholder="ВАША СУММА" /><br>
        <input type="button" id="btn" value="Отправить" />
    </form>

    <br>

    <div id="result_form"></div> 
</body>
</html>