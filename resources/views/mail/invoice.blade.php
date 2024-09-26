
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #2196F3; margin: 0 !important; padding: 0 !important;">
<!-- HIDDEN PREHEADER TEXT -->
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">¡Estamos encantados de tenerte aquí! Prepárate y activa tu cuenta Daytech México. </div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
        <td bgcolor="#2196F3" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#2196F3" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                    <a href="https://daytech.com.mx/">
                        <img class="logo img-fluid" src="https://daytech.com.mx/img/logo-1667338438.jpg" alt="Daytech México" loading="lazy" width="467" height="504">
                    </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p style="margin-top: 1px;"><strong>Estimado/a cliente</strong> {{$user->name}}</p>
                        <p style="margin-top: 1px;">Nos complace informarle que su factura ha sido generada y se encuentra adjunta en este correo en formato PDF y XML. A continuación, encontrará los detalles de su pedido:</p>
                        <p style="margin-top: 1px;">•<strong> Número de Pedido:</strong> {{isset($invoice['mkpOrder'])?$invoice['mkpOrder']['purchase_order']:''}}</p>
                        <p style="margin-top: 1px;">•<strong> Empresa Facturada:</strong> {{$invoice['entity_receiver']['business_name']}}</p>
                        <p style="margin-top: 1px;">•<strong> Importe:</strong> {{$invoice['amount']}}</p>
                        @if(isset($invoice['customer_name']))
                            <p style="margin-top: 1px;">
                                    •<strong> Plataforma de Compra:</strong> 
                                    {{$invoice['customer_name']}}
                            </p>
                        @endif
                        <p style="margin-top: 1px; color: #ffcc00;"> 
                            <strong>
                                Por favor, revise los documentos adjuntos y conserve esta información. Si tiene alguna consulta sobre su factura, no dude en contactarnos. Nuestro equipo de atención al cliente está disponible de lunes a viernes de 9:00 a.m. a 6:00 p.m. para asistirle.
                            </strong>
                        </p>
                        <p style="margin-top: 1px;">Agradecemos su preferencia y estamos a su disposición para cualquier asistencia adicional que requiera.</p>

                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;"><strong>Gracias por elegir nuestro servicio,<br>El equipo de atención al cliente Daytech</strong></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">¿Tienes dudas o necesitas alguna aclaración?</h2>
                        <p style="margin: 0;">Solicitar información al area de Administración:</p>
                        <p>
                            <a style="color: #2196F3;" href="mailto:facturacion@daytech.com.mx">facturacion@daytech.com.mx</a> o al
                            <a style="color: #2196F3;" href="tel:3385262665">33 8526 2665</a>
                        </p>
                        <p>
                            o al WhatsApp <a style="color: #5cd65c;" href="https://api.whatsapp.com/send?phone=+523327893169&text=%C2%A1Hola%20Daytech!%20Quiero%20hablar%20con%20un%20asesor%20experto%20en%20tecnolog%C3%ADa%20para%20que%20me%20responda%20algunas%20preguntas%20y%20dudas%20que%20tengo,%20gracias.%20">33 27 893169</a>
                        </p>
                        <p>
                            Visita nuestro sitio web <a style="color: #2196F3;" href="http://daytech.com.mx" target="_blank" rel="noopener noreferrer">Daytech.com.mx</a> o nuestra tienda física en <a style="color: #2196F3;" href="https://maps.app.goo.gl/5KCmXGVUL9LJvTnm9" target="_blank" rel="noopener noreferrer"> Av. Hidalgo 255A, Col. Zapopan Centro, Zapopan, Jalisco, México, 45100</a>
                        </p>
                    
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>