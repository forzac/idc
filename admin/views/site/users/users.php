<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style type="text/css">
        td {
            vertical-align: top;
            border:1px solid black;

        }
        th{
            padding:10px;
            border:1px solid black;
        }

        #col1 {
            width: 5%;
        }
        #col2 {
            width: 15%;
        }
        #col3 {
            width: 20%;
        #col4 {
            width: 10%;
        #col5 {
            width: 10%;
        #col6 {
            width: 30%;
        +
        }
    </style>
</head>
<body>
<table width="90%" cellpadding="5" cellspacing="0">
    <tbody>
    <tr>
        <td id="col1">ID</td>
        <td id="col2">Пользователь</td>
        <td id="col3">Email</td>
        <td id="col4">Phone</td>
        <td id="col5">Status</td>
        <td id="col6">Settings</td>

    </tr>
    </tbody>


    <?php
    foreach ($usersview as $item){
        echo "<tr>
        <td id=col1> $item[user_id] </td>
        <td id=col2> $item[name] </td>
        <td id=col3> $item[email] </td>
        <td id=col4> $item[phone] </td>
        <td id=col5> $item[status] </td>
        <td id=col6><button></button><button></button><button></button></td>
        </tr>";
    }
    ?>

</table>
</body>
</html>

<?php
//tr<php *user_id>td#col*6
?>