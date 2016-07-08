<?php

/**
 * @var $user \app\models\User
 */
use yii\helpers\Html;

?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <!-- NAME: 1:3 COLUMN -->
    <!--[if gte mso 15]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>*|MC:SUBJECT|*</title>

    <style type="text/css">
        p{
            margin:10px 0;
            padding:0;
        }
        table{
            border-collapse:collapse;
        }
        h1,h2,h3,h4,h5,h6{
            display:block;
            margin:0;
            padding:0;
        }
        img,a img{
            border:0;
            height:auto;
            outline:none;
            text-decoration:none;
        }
        body,#bodyTable,#bodyCell{
            height:100%;
            margin:0;
            padding:0;
            width:100%;
        }
        #outlook a{
            padding:0;
        }
        img{
            -ms-interpolation-mode:bicubic;
        }
        table{
            mso-table-lspace:0pt;
            mso-table-rspace:0pt;
        }
        .ReadMsgBody{
            width:100%;
        }
        .ExternalClass{
            width:100%;
        }
        p,a,li,td,blockquote{
            mso-line-height-rule:exactly;
        }
        a[href^=tel],a[href^=sms]{
            color:inherit;
            cursor:default;
            text-decoration:none;
        }
        p,a,li,td,body,table,blockquote{
            -ms-text-size-adjust:100%;
            -webkit-text-size-adjust:100%;
        }
        .ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{
            line-height:100%;
        }
        a[x-apple-data-detectors]{
            color:inherit !important;
            text-decoration:none !important;
            font-size:inherit !important;
            font-family:inherit !important;
            font-weight:inherit !important;
            line-height:inherit !important;
        }
        #bodyCell{
            padding:10px;
        }
        .templateContainer{
            max-width:600px !important;
        }
        a.mcnButton{
            display:block;
        }
        .mcnImage{
            vertical-align:bottom;
        }
        .mcnTextContent{
            word-break:break-word;
        }
        .mcnTextContent img{
            height:auto !important;
        }
        .mcnDividerBlock{
            table-layout:fixed !important;
        }
        body,#bodyTable{
            background-color:#eeeeee;
        }
        #bodyCell{
            border-top:0;
        }
        .templateContainer{
            border:0;
        }
        h1{
            color:#000000;
            font-family:Helvetica;
            font-size:26px;
            font-style:normal;
            font-weight:bold;
            line-height:125%;
            letter-spacing:normal;
            text-align:left;
        }
        h2{
            color:#202020;
            font-family:Helvetica;
            font-size:22px;
            font-style:normal;
            font-weight:bold;
            line-height:125%;
            letter-spacing:normal;
            text-align:left;
        }
        h3{
            color:#202020;
            font-family:Helvetica;
            font-size:20px;
            font-style:normal;
            font-weight:bold;
            line-height:125%;
            letter-spacing:normal;
            text-align:left;
        }
        h4{
            color:#202020;
            font-family:Helvetica;
            font-size:18px;
            font-style:normal;
            font-weight:bold;
            line-height:125%;
            letter-spacing:normal;
            text-align:left;
        }
        #templatePreheader{
            background-color:#FAFAFA;
            border-top:0;
            border-bottom:0;
            padding-top:9px;
            padding-bottom:9px;
        }
        #templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
            color:#656565;
            font-family:Helvetica;
            font-size:12px;
            line-height:150%;
            text-align:left;
        }
        #templatePreheader .mcnTextContent a,#templatePreheader .mcnTextContent p a{
            color:#656565;
            font-weight:normal;
            text-decoration:underline;
        }
        #templateHeader{
            background-color:#FFFFFF;
            border-top:0;
            border-bottom:0;
            padding-top:9px;
            padding-bottom:0;
        }
        #templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
            color:#202020;
            font-family:Helvetica;
            font-size:16px;
            line-height:150%;
            text-align:left;
        }
        #templateHeader .mcnTextContent a,#templateHeader .mcnTextContent p a{
            color:#2BAADF;
            font-weight:normal;
            text-decoration:underline;
        }
        #templateBody{
            background-color:#FFFFFF;
            border-top:0;
            border-bottom:0;
            padding-top:0;
            padding-bottom:0;
        }
        #templateBody .mcnTextContent,#templateBody .mcnTextContent p{
            color:#202020;
            font-family:Helvetica;
            font-size:16px;
            line-height:150%;
            text-align:left;
        }
        #templateBody .mcnTextContent a,#templateBody .mcnTextContent p a{
            color:#2BAADF;
            font-weight:normal;
            text-decoration:underline;
        }
        #templateColumns{
            background-color:#FFFFFF;
            border-top:0;
            border-bottom:2px solid #EAEAEA;
            padding-top:0;
            padding-bottom:9px;
        }
        #templateColumns .columnContainer .mcnTextContent,#templateColumns .columnContainer .mcnTextContent p{
            color:#202020;
            font-family:Helvetica;
            font-size:16px;
            line-height:150%;
            text-align:left;
        }
        #templateColumns .columnContainer .mcnTextContent a,#templateColumns .columnContainer .mcnTextContent p a{
            color:#2BAADF;
            font-weight:normal;
            text-decoration:underline;
        }
        #templateFooter{
            background-color:#FAFAFA;
            border-top:0;
            border-bottom:0;
            padding-top:9px;
            padding-bottom:9px;
        }
        #templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
            color:#656565;
            font-family:Helvetica;
            font-size:12px;
            line-height:150%;
            text-align:center;
        }
        #templateFooter .mcnTextContent a,#templateFooter .mcnTextContent p a{
            color:#656565;
            font-weight:normal;
            text-decoration:underline;
        }
        @media only screen and (min-width:768px){
            .templateContainer{
                width:600px !important;
            }

        }	@media only screen and (max-width: 480px){
            body,table,td,p,a,li,blockquote{
                -webkit-text-size-adjust:none !important;
            }

        }	@media only screen and (max-width: 480px){
            body{
                width:100% !important;
                min-width:100% !important;
            }

        }	@media only screen and (max-width: 480px){
            #bodyCell{
                padding-top:10px !important;
            }

        }	@media only screen and (max-width: 480px){
            .columnWrapper{
                max-width:100% !important;
                width:100% !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnImage{
                width:100% !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnCaptionTopContent,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{
                max-width:100% !important;
                width:100% !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnBoxedTextContentContainer{
                min-width:100% !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnImageGroupContent{
                padding:9px !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{
                padding-top:9px !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnImageCardTopImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{
                padding-top:18px !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnImageCardBottomImageContent{
                padding-bottom:9px !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnImageGroupBlockInner{
                padding-top:0 !important;
                padding-bottom:0 !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnImageGroupBlockOuter{
                padding-top:9px !important;
                padding-bottom:9px !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnTextContent,.mcnBoxedTextContentColumn{
                padding-right:18px !important;
                padding-left:18px !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{
                padding-right:18px !important;
                padding-bottom:0 !important;
                padding-left:18px !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcpreview-image-uploader{
                display:none !important;
                width:100% !important;
            }

        }	@media only screen and (max-width: 480px){
            h1{
                font-size:22px !important;
                line-height:125% !important;
            }

        }	@media only screen and (max-width: 480px){
            h2{
                font-size:20px !important;
                line-height:125% !important;
            }

        }	@media only screen and (max-width: 480px){
            h3{
                font-size:18px !important;
                line-height:125% !important;
            }

        }	@media only screen and (max-width: 480px){
            h4{
                font-size:16px !important;
                line-height:150% !important;
            }

        }	@media only screen and (max-width: 480px){
            .mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{
                font-size:14px !important;
                line-height:150% !important;
            }

        }	@media only screen and (max-width: 480px){
            #templatePreheader{
                display:block !important;
            }

        }	@media only screen and (max-width: 480px){
            #templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
                font-size:14px !important;
                line-height:150% !important;
            }

        }	@media only screen and (max-width: 480px){
            #templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
                font-size:16px !important;
                line-height:150% !important;
            }

        }	@media only screen and (max-width: 480px){
            #templateBody .mcnTextContent,#templateBody .mcnTextContent p{
                font-size:16px !important;
                line-height:150% !important;
            }

        }	@media only screen and (max-width: 480px){
            #templateColumns .columnContainer .mcnTextContent,#templateColumns .columnContainer .mcnTextContent p{
                font-size:16px !important;
                line-height:150% !important;
            }

        }	@media only screen and (max-width: 480px){
            #templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
                font-size:14px !important;
                line-height:150% !important;
            }

        }</style></head>
<body style="height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #eeeeee;">
<center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;background-color: #eeeeee;">
        <tr>
            <td align="center" valign="top" id="bodyCell" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 10px;width: 100%;border-top: 0;">
                <!-- BEGIN TEMPLATE // -->
                <!--[if gte mso 9]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                    <tr>
                        <td align="center" valign="top" width="600" style="width:600px;">
                <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border: 0;max-width: 600px !important;">
                    <tr>
                        <td valign="top" id="templatePreheader" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FAFAFA;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;"></td>
                    </tr>
                    <tr>
                        <td valign="top" id="templateHeader" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnImageBlockOuter">
                                <tr>
                                    <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                                        <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                                    <img align="center" alt="" src="https://gallery.mailchimp.com/1c8eaa4d7119b68921d6fc936/images/dabe83f9-9450-4f37-b956-ffec9e66757e.jpg" width="564" style="max-width: 1024px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">


                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <!--[if gte mso 9]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
                                <![endif]-->
                                <tbody class="mcnBoxedTextBlockOuter">
                                <tr>
                                    <td valign="top" class="mcnBoxedTextBlockInner" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                                        <!--[if gte mso 9]>
                                        <td align="center" valign="top" ">
                                        <![endif]-->
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnBoxedTextContentContainer">
                                            <tbody><tr>

                                                <td style="padding-top: 9px;padding-left: 18px;padding-bottom: 9px;padding-right: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                                                    <table border="0" cellpadding="18" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                        <tbody><tr>
                                                            <td valign="top" class="mcnTextContent" style="color: #000000;font-family: Verdana, Geneva, sans-serif;font-size: 14px;font-weight: normal;text-align: justify;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;line-height: 150%;">
                                                                <h1 style="display: block;margin: 0;padding: 0;color: #000000;font-family: Helvetica;font-size: 26px;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;text-align: left;">Добрый день!</h1>

                                                                <p style="text-align: justify;color: #000000;font-family: Verdana, Geneva, sans-serif;font-size: 14px;font-weight: normal;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;line-height: 150%;">Мы занимаемся производством качественной стильной женской обуви и сумок из натуральной кожи. Посмотрите пожалуйста наши каталоги возможно вас заинтересуют наши модели.<br>
                                                                    <br>
                                                                    Пожалуйста передайте это письмо человеку который занимается вопросами развития или закупками, огромное спасибо, извиняемся за беспокойство!<br>
                                                                    <br>
                                                                    <span style="font-family:tahoma,verdana,segoe,sans-serif">Каталоги:</span><br>
                                                                    Прайс(обувь) в формате Line sheet: <a href="http://bit.ly/1rtRWcW" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;">http://bit.ly/1rtRWcW</a><br>
                                                                    Обувь Лето 2016: <a href="http://bit.ly/1SqUo9L" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;">http://bit.ly/1SqUo9L</a><br>
                                                                    Сумки: <a href="http://bit.ly/1YaaOba" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;">http://bit.ly/1YaaOba</a></p>

                                                            </td>
                                                        </tr>
                                                        </tbody></table>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!--[if gte mso 9]>
                                        </td>
                                        <![endif]-->

                                        <!--[if gte mso 9]>
                                        </tr>
                                        </table>
                                        <![endif]-->
                                    </td>
                                </tr>
                                </tbody>
                            </table></td>
                    </tr>
                    <tr>
                        <td valign="top" id="templateBody" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnCodeBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnTextBlockOuter">
                                <tr>
                                    <td valign="top" class="mcnTextBlockInner" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <div><a href="https://drive.google.com/file/d/0B9TiOeaiEhkdaFZ2c0FfMExXUVk/view?usp=sharing" target="_blank" class="btn btn-success" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 22px;width: 210px;text-align: center;text-decoration: none;line-height: 45px;padding: 0px 20px 0 20px;display: inline-block;border: none;border-radius: 3px;font-weight: bold;font-family: Arial;font-size: 16px;color: white;height: 45px;background: #1bc960;">Каталог Лето 2016</a>
                                            <a href="https://drive.google.com/file/d/0B9TiOeaiEhkdcHNHOUlEQl9fV2M/view?usp=sharing" target="_blank" class="btn2 btn-success" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 22px;width: 210px;text-align: center;text-decoration: none;line-height: 45px;padding: 0px 20px 0 20px;display: inline-block;border: none;border-radius: 3px;font-weight: bold;font-family: Arial;font-size: 16px;color: white;height: 45px;background: #1bc960;">Каталог Сумки</a>
                                        </div>
                                        <style type="text/css">
                                            .btn {

                                                margin: 22px;
                                                width: 210px;
                                                text-align: center;
                                                text-decoration: none;
                                                line-height: 45px;
                                                padding: 0px 20px 0 20px;
                                                display: inline-block;
                                                border: none;
                                                border-radius: 3px;
                                                font-weight: bold;
                                                font-family: Arial;
                                                font-size: 16px;
                                                color: white;
                                                height: 45px;
                                                background: #1bc960;
                                            }

                                            .btn2 {
                                                margin: 22px;
                                                width: 210px;
                                                text-align: center;
                                                text-decoration: none;
                                                line-height: 45px;
                                                padding: 0px 20px 0 20px;
                                                display: inline-block;
                                                border: none;
                                                border-radius: 3px;
                                                font-weight: bold;
                                                font-family: Arial;
                                                font-size: 16px;
                                                color: white;
                                                height: 45px;
                                                background: #1bc960;
                                            }

                                        </style>

                                    </td>
                                </tr>
                                </tbody>
                            </table></td>
                    </tr>
                    <tr>
                        <td valign="top" id="templateColumns" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 2px solid #EAEAEA;padding-top: 0;padding-bottom: 9px;">
                            <!--[if gte mso 9]>
                            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                <tr>
                                    <td align="center" valign="top" width="200" style="width:200px;">
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="200" class="columnWrapper" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tr>
                                    <td valign="top" class="columnContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"></td>
                                </tr>
                            </table>
                            <!--[if gte mso 9]>
                            </td>
                            <td align="center" valign="top" width="200" style="width:200px;">
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="200" class="columnWrapper" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tr>
                                    <td valign="top" class="columnContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"></td>
                                </tr>
                            </table>
                            <!--[if gte mso 9]>
                            </td>
                            <td align="center" valign="top" width="200" style="width:200px;">
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="200" class="columnWrapper" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tr>
                                    <td valign="top" class="columnContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"></td>
                                </tr>
                            </table>
                            <!--[if gte mso 9]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" id="templateFooter" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FAFAFA;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageGroupBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnImageGroupBlockOuter">

                                <tr>
                                    <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageGroupBlockInner">

                                        <table align="left" width="273" border="0" cellpadding="0" cellspacing="0" class="mcnImageGroupContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td class="mcnImageGroupContent" valign="top" style="padding-left: 9px;padding-top: 0;padding-bottom: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                                    <img alt="" src="https://gallery.mailchimp.com/1c8eaa4d7119b68921d6fc936/images/d05c16a1-6fc0-4120-87c1-db8eaf188756.jpg" width="264" style="max-width: 530px;padding-bottom: 0;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;" class="mcnImage">


                                                </td>
                                            </tr>
                                            </tbody></table>

                                        <table align="right" width="273" border="0" cellpadding="0" cellspacing="0" class="mcnImageGroupContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td class="mcnImageGroupContent" valign="top" style="padding-right: 9px;padding-top: 0;padding-bottom: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                                    <img alt="" src="https://gallery.mailchimp.com/1c8eaa4d7119b68921d6fc936/images/44ce686b-4854-4e09-b00d-2be5114ab168.jpg" width="264" style="max-width: 544px;padding-bottom: 0;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;" class="mcnImage">


                                                </td>
                                            </tr>
                                            </tbody></table>

                                    </td>
                                </tr>

                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnImageBlockOuter">
                                <tr>
                                    <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                                        <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                                    <img align="center" alt="" src="https://gallery.mailchimp.com/1c8eaa4d7119b68921d6fc936/images/ef4deb0d-3e13-4dab-91dd-a4935d14ebd0.jpg" width="564" style="max-width: 3880px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">


                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageGroupBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnImageGroupBlockOuter">

                                <tr>
                                    <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageGroupBlockInner">

                                        <table align="left" width="273" border="0" cellpadding="0" cellspacing="0" class="mcnImageGroupContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td class="mcnImageGroupContent" valign="top" style="padding-left: 9px;padding-top: 0;padding-bottom: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                                    <img alt="" src="https://gallery.mailchimp.com/1c8eaa4d7119b68921d6fc936/images/ddf1deac-a277-49a1-acb8-2946478b69de.jpg" width="264" style="max-width: 498px;padding-bottom: 0;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;" class="mcnImage">


                                                </td>
                                            </tr>
                                            </tbody></table>

                                        <table align="right" width="273" border="0" cellpadding="0" cellspacing="0" class="mcnImageGroupContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td class="mcnImageGroupContent" valign="top" style="padding-right: 9px;padding-top: 0;padding-bottom: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                                    <img alt="" src="https://gallery.mailchimp.com/1c8eaa4d7119b68921d6fc936/images/d2796dd4-3f97-431a-aaf1-ee13b1d23f6f.jpg" width="264" style="max-width: 570px;padding-bottom: 0;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;" class="mcnImage">


                                                </td>
                                            </tr>
                                            </tbody></table>

                                    </td>
                                </tr>

                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;">
                                <tbody class="mcnDividerBlockOuter">
                                <tr>
                                    <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top-width: 2px;border-top-style: solid;border-top-color: #EAEAEA;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <span></span>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!--
                                                        <td class="mcnDividerBlockInner" style="padding: 18px;">
                                                        <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
                                        -->
                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnCodeBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnTextBlockOuter">
                                <tr>
                                    <td valign="top" class="mcnTextBlockInner" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <div><a href="https://drive.google.com/file/d/0B9TiOeaiEhkdaFZ2c0FfMExXUVk/view?usp=sharing" target="_blank" class="btn btn-success" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 22px;width: 210px;text-align: center;text-decoration: none;line-height: 45px;padding: 0px 20px 0 20px;display: inline-block;border: none;border-radius: 3px;font-weight: bold;font-family: Arial;font-size: 16px;color: white;height: 45px;background: #1bc960;">Каталог Лето 2016</a>
                                            <a href="https://drive.google.com/file/d/0B9TiOeaiEhkdcHNHOUlEQl9fV2M/view?usp=sharing" target="_blank" class="btn2 btn-success" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 22px;width: 210px;text-align: center;text-decoration: none;line-height: 45px;padding: 0px 20px 0 20px;display: inline-block;border: none;border-radius: 3px;font-weight: bold;font-family: Arial;font-size: 16px;color: white;height: 45px;background: #1bc960;">Каталог Сумки</a>
                                        </div>
                                        <style type="text/css">
                                            .btn {

                                                margin: 22px;
                                                width: 210px;
                                                text-align: center;
                                                text-decoration: none;
                                                line-height: 45px;
                                                padding: 0px 20px 0 20px;
                                                display: inline-block;
                                                border: none;
                                                border-radius: 3px;
                                                font-weight: bold;
                                                font-family: Arial;
                                                font-size: 16px;
                                                color: white;
                                                height: 45px;
                                                background: #1bc960;
                                            }

                                            .btn2 {
                                                margin: 22px;
                                                width: 210px;
                                                text-align: center;
                                                text-decoration: none;
                                                line-height: 45px;
                                                padding: 0px 20px 0 20px;
                                                display: inline-block;
                                                border: none;
                                                border-radius: 3px;
                                                font-weight: bold;
                                                font-family: Arial;
                                                font-size: 16px;
                                                color: white;
                                                height: 45px;
                                                background: #1bc960;
                                            }

                                        </style>


                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;">
                                <tbody class="mcnDividerBlockOuter">
                                <tr>
                                    <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top-width: 2px;border-top-style: solid;border-top-color: #EAEAEA;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <span></span>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!--
                                                        <td class="mcnDividerBlockInner" style="padding: 18px;">
                                                        <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
                                        -->
                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnTextBlockOuter">
                                <tr>
                                    <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <!--[if mso]>
                                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                            <tr>
                                        <![endif]-->

                                        <!--[if mso]>
                                        <td valign="top" width="600" style="width:600px;">
                                        <![endif]-->
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                                            <tbody><tr>

                                                <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #656565;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;">

                                                    <p style="text-align: justify;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #656565;font-family: Helvetica;font-size: 12px;line-height: 150%;"><span style="color:#000000"><span style="font-family:tahoma,verdana,segoe,sans-serif"><span style="font-size:14px">Мы ценим каждого из наших клиентов и делаем все для того, чтобы Вы оставались довольными сотрудничеством, увеличивали прибыль и развивали бизнес.</span></span></span></p>

                                                    <p style="text-align: center;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #656565;font-family: Helvetica;font-size: 12px;line-height: 150%;"><span style="color:#000000"><span style="font-family:tahoma,verdana,segoe,sans-serif"><span style="font-size:14px">Присоединяйтесь к нам уже сегодня.</span></span></span></p>

                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->

                                        <!--[if mso]>
                                        </tr>
                                        </table>
                                        <![endif]-->
                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;">
                                <tbody class="mcnDividerBlockOuter">
                                <tr>
                                    <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top-width: 2px;border-top-style: solid;border-top-color: #EAEAEA;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <span></span>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!--
                                                        <td class="mcnDividerBlockInner" style="padding: 18px;">
                                                        <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
                                        -->
                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnFollowBlockOuter">
                                <tr>
                                    <td align="center" valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowBlockInner">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td align="center" style="padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContent">
                                                        <tbody><tr>
                                                            <td align="center" valign="top" style="padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                    <tbody><tr>
                                                                        <td align="center" valign="top" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                            <!--[if mso]>
                                                                            <table align="center" border="0" cellspacing="0" cellpadding="0">
                                                                                <tr>
                                                                            <![endif]-->

                                                                            <!--[if mso]>
                                                                            <td align="center" valign="top">
                                                                            <![endif]-->


                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                <tbody><tr>
                                                                                    <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                            <tbody><tr>
                                                                                                <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                        <tbody><tr>

                                                                                                            <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                <a href="http://instagram.com/miolishoes" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-instagram-48.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" height="24" width="24" class=""></a>
                                                                                                            </td>


                                                                                                        </tr>
                                                                                                        </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody></table>

                                                                            <!--[if mso]>
                                                                            </td>
                                                                            <![endif]-->

                                                                            <!--[if mso]>
                                                                            <td align="center" valign="top">
                                                                            <![endif]-->


                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                <tbody><tr>
                                                                                    <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                            <tbody><tr>
                                                                                                <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                        <tbody><tr>

                                                                                                            <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                <a href="http://vk.com/mioli_shoes" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-vk-48.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" height="24" width="24" class=""></a>
                                                                                                            </td>


                                                                                                        </tr>
                                                                                                        </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody></table>

                                                                            <!--[if mso]>
                                                                            </td>
                                                                            <![endif]-->

                                                                            <!--[if mso]>
                                                                            <td align="center" valign="top">
                                                                            <![endif]-->


                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                <tbody><tr>
                                                                                    <td valign="top" style="padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                            <tbody><tr>
                                                                                                <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                        <tbody><tr>

                                                                                                            <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                <a href="mailto:miolishop@gmail.com" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-forwardtofriend-48.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" height="24" width="24" class=""></a>
                                                                                                            </td>


                                                                                                        </tr>
                                                                                                        </tbody></table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody></table>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody></table>

                                                                            <!--[if mso]>
                                                                            </td>
                                                                            <![endif]-->

                                                                            <!--[if mso]>
                                                                            </tr>
                                                                            </table>
                                                                            <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                    </tbody></table>
                                                            </td>
                                                        </tr>
                                                        </tbody></table>
                                                </td>
                                            </tr>
                                            </tbody></table>

                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;">
                                <tbody class="mcnDividerBlockOuter">
                                <tr>
                                    <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 10px 18px 25px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top-width: 2px;border-top-style: solid;border-top-color: #EEEEEE;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            <tbody><tr>
                                                <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <span></span>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!--
                                                        <td class="mcnDividerBlockInner" style="padding: 18px;">
                                                        <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
                                        -->
                                    </td>
                                </tr>
                                </tbody>
                            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody class="mcnTextBlockOuter">
                                <tr>
                                    <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <!--[if mso]>
                                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                            <tr>
                                        <![endif]-->

                                        <!--[if mso]>
                                        <td valign="top" width="600" style="width:600px;">
                                        <![endif]-->
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                                            <tbody><tr>

                                                <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #656565;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;">

                                                    <em>Copyright © 2016, All rights reserved.</em><br>
                                                    <br>
                                                    <strong>Email:</strong><br>
                                                    miolishop@gmail.com<br>
                                                    optmioli@gmail.com<br>
                                                    <br>
                                                    <strong>Контакты:</strong><br>
                                                    - 0938914891<br>
                                                    - 0982247816
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->

                                        <!--[if mso]>
                                        </tr>
                                        </table>
                                        <![endif]-->
                                    </td>
                                </tr>
                                </tbody>
                            </table></td>
                    </tr>
                </table>
                <!--[if gte mso 9]>
                </td>
                </tr>
                </table>
                <![endif]-->
                <!-- // END TEMPLATE -->
            </td>
        </tr>
    </table>
</center>
<center>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
<!--    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="canspamBarWrapper" style="background-color:#FFFFFF; border-top:1px solid #E5E5E5;">-->
<!--        <tr>-->
<!--            <td align="center" valign="top" style="padding-top:20px; padding-bottom:20px;">-->
<!--                <table border="0" cellpadding="0" cellspacing="0" id="canspamBar">-->
<!--                    <tr>-->
<!--                        <td align="center" valign="top" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:11px; line-height:150%; padding-right:20px; padding-bottom:5px; padding-left:20px; text-align:center;">-->
<!--                            This email was sent to <a href="mailto:*|EMAIL|*" target="_blank" style="color:#404040 !important;">*|EMAIL|*</a>-->
<!--                            <br />-->
<!--                            <a href="*|ABOUT_LIST|*" target="_blank" style="color:#404040 !important;"><em>why did I get this?</em></a>    <a href="*|UNSUB|*" style="color:#404040 !important;">unsubscribe from this list</a>    <a href="*|UPDATE_PROFILE|*" style="color:#404040 !important;">update subscription preferences</a>-->
<!--                            <br />-->
<!--                            *|LIST:ADDRESSLINE|*-->
<!--                            <br />-->
<!--                            <br />-->
<!--                            *|REWARDS|*-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                </table>-->
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->
    <style type="text/css">
        @media only screen and (max-width: 480px){
            table[id="canspamBar"] td{font-size:14px !important;}
            table[id="canspamBar"] td a{display:block !important; margin-top:10px !important;}
        }
    </style>
</center></body>
</html>