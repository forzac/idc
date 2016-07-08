<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style type="text/css">


        .TTWForm{
            width: 500px;
        }


        /** Field Styles **/
        .TTWForm .field, #form-title.field {
            padding-bottom: 12px;
            padding-top: 12px;
           position: relative;
           /* clear: both;*/                    }
        .TTWForm .field:first-child{
            padding-top:0;
        }
        .TTWForm .field:last-child{
            padding-bottom:0;}

        .f_100 {
            width: 96%;
            /*display: inline;*/
           /* float: left;*/
            margin-left: 2%;
            margin-right: 2%; /* jquery ui resize grid hack - not sure why */
        }
        .TTWForm input, .TTWForm textarea, .TTWForm select, div.selector, div.uploader  {
            width:100%;
            font: 12px/14px Helvetica Neue, "Arial", Helvetica, Verdana, sans-serif;
            padding: 6px 0;
            color: #798e94;
            border: 3px solid #c2d3d7;
            outline: none;
            display: inline-block;
            position: relative;
            z-index: 2;
            box-shadow: 0 0 0 5px #f2f7f9;
            -moz-box-shadow: 0 0 0 5px #f2f7f9;
            -webkit-box-shadow: 0 0 0 5px #f2f7f9;
            border-radius: 2px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 2px;
            -webkit-transition: .3s ease-in-out;
            -moz-transition: .3s ease-in-out;
        }
        .TTWForm input[type=radio], .TTWForm input[type=checkbox] {
            width: 12px;
            margin: 15px 8px;
            top: 3px;
            position: relative;
        }
        .TTWForm .option{
            margin:6px 0;
        }
        .TTWForm label {
            color: #798e94;
            text-align: left;
            font: 14px/24px Helvetica Neue, "Arial", Helvetica, Verdana, sans-serif;
            margin-bottom:5px;
            display:inline-block;
        }


    </style>
    <meta charset="utf-8">
    <title></title>
    <link href="css/style.css" media="screen" rel="stylesheet" type="text/css"/>
    <link href="css/uniform.css" media="screen" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.tools.js"></script>
    <script type="text/javascript" src="js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>

<div class="TTWForm-container">


    <form action="process_form.php" class="TTWForm ui-sortable-disabled" method="post"
          novalidate="" enctype="multipart/form-data">


        <div id="field17-container" class="field f_100 ui-resizable-disabled ui-state-disabled">
            <label for="field17">
                Title
            </label>
            <input type="text" name="field17" id="field17" required="required">
        </div>


        <div id="field18-container" class="field f_100 ui-resizable-disabled ui-state-disabled">
            <label for="field18">
                Url
            </label>
            <input type="url" name="field18" id="field18" required="required">
        </div>


        <div id="field19-container" class="field f_100 ui-resizable-disabled ui-state-disabled">
            <label for="field19">
                Description
            </label>
            <input type="text" name="field19" id="field19" required="required">
        </div>


        <div id="field20-container" class="field f_100 checkbox-group required ui-resizable-disabled ui-state-disabled">
            <label for="field20-1">
                Status
            </label>


            <div class="option clearfix">
                <input type="checkbox" name="field20[]" id="field20-1" value="">
                    <span class="option-title">
                    </span>
                <br>
            </div>
        </div>


        <div id="field21-container" class="field f_100 ui-resizable-disabled ui-state-disabled">
            <label for="field21">
                CK Editor
            </label>
            <textarea rows="5" cols="20" name="field21" id="field21" required="required"></textarea>
        </div>


        <div id="form-submit" class="field f_100 clearfix submit">
            <input type="submit" value="Submit">
        </div>
    </form>
</div>

</body>
</html>