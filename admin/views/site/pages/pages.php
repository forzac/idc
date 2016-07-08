<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style type="text/css">
        td {
            vertical-align: top;
            border:1px solid black;
            text-align: center;

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
        <td id="col2">Title</td>
        <td id="col3">Description</td>
        <td id="col4">Keyword</td>
        <td id="col5">Status</td>


    </tr>
    </tbody>


    <?php
    foreach ($pagesView as $item){
        echo "<tr>
        <td id=col1> $item->page_id </td>
        <td id=col2> $item->seo_title </td>
        <td id=col3> $item->seo_description </td>
        <td id=col4> $item->seo_keyword </td>
        <td id=col5> $item->status </td>

        </tr>";
    }
    ?>

</table>
</body>
</html>