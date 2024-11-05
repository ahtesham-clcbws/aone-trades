<?php

use Livewire\Features\SupportQueryString\BaseUrl;
?>
<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            padding: 0
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: inherit !important
        }

        #MessageViewBody a {
            color: inherit;
            text-decoration: none
        }

        p {
            line-height: inherit
        }

        .desktop_hide,
        .desktop_hide table {
            mso-hide: all;
            display: none;
            max-height: 0;
            overflow: hidden
        }

        .image_block img+div {
            display: none
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0
        }

        @media (max-width:500px) {
            .social_block.desktop_hide .social-table {
                display: inline-block !important
            }

            .mobile_hide {
                display: none
            }

            .row-content {
                width: 100% !important
            }

            .stack .column {
                width: 100%;
                display: block
            }

            .mobile_hide {
                min-height: 0;
                max-height: 0;
                max-width: 0;
                overflow: hidden;
                font-size: 0
            }

            .desktop_hide,
            .desktop_hide table {
                display: table !important;
                max-height: none !important
            }
        }
    </style>
</head>

<body class="body" style="background-color:#fff;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none">
    <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff">
        <tbody>
            <tr>
                <td>
                    <table class="row row-1" align="center"
                        width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:480px;margin:0 auto" width="480">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" width="100%"
                                                    style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-bottom:20px;padding-top:30px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                    <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                                                        <tr>
                                                            <td class="pad" style="width:100%">
                                                                <div class="alignment" align="center" style="line-height:10px">
                                                                    <div style="max-width:480px">
                                                                        <a href="<?= URL('/') ?>" target="_blank" style="outline:none" tabindex="-1">
                                                                            <img src="<?= URL('/img/w-logo.png') ?>" style="display:block;height:auto;border:0;width:100%" width="480" alt="Aone Trades" title="Aone Trades" height="auto"></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                        style="mso-table-lspace:0;mso-table-rspace:0;background-image:url(<?= url('/img/galaxy-bg.webp') ?>);background-position:center center;background-repeat:no-repeat;background-size: cover;">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:480px;margin:0 auto" width="480">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-top:40px;padding-bottom:40px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                    <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px">
                                                                <div style="font-family:sans-serif">
                                                                    <div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:14.39px;color:#fff;line-height:1.2">
                                                                        <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px;word-break: break-word; font-size: 30px;">
                                                                            <strong>Hello, <?= $user->name ?></strong>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0; background-color:#f6f6f6 !important;padding-bottom:40px;">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="mso-table-lspace:0;mso-table-rspace:0;color:#000;background-color:#f6f6f6;width:480px;margin:0 auto" width="480">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-top:40px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                    <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:30px;padding-right:30px;padding-top:10px">
                                                                <div style="font-family:sans-serif">
                                                                    <div class
                                                                        style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:18px;color:#555;line-height:1.5">
                                                                        <p style="margin:0;font-size:14px;text-align:left;mso-line-height-alt:21px">
                                                                            {!! $content !!}
                                                                        </p>
                                                                        <p
                                                                            style="margin:0;font-size:14px;text-align:left;mso-line-height-alt:18px">&nbsp;</p>
                                                                        <p style="margin:0;font-size:14px;text-align:left;mso-line-height-alt:21px">Thank you and have a nice Trade!</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="row-content stack"
                                        align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:480px;margin:0 auto" width="480">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-bottom:25px;padding-top:25px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">

                                                    <table class="text_block block-2" width="100%" border="0" cellpadding="10"
                                                        cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                        <tr>
                                                            <td class="pad">
                                                                <div style="font-family:sans-serif">
                                                                    <div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:14.399999999999999px;color:#555;line-height:1.2">
                                                                        <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px">35th Floor, 3506, Ubora Tower Business Bay<br>Dubai, UAE</p>
                                                                        <p
                                                                            style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><a href="mailto:support@aonetrades.com" target="_blank" title="support@aonetrades.com" style="text-decoration: underline; color: #3f91d4;" rel="noopener">support@aonetrades.com</a> / <a href="tel:+97165616276" target="_blank" title="tel:+97165616276" style="text-decoration: underline; color: #3f91d4;" rel="noopener">+97165616276</a></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
