<?php


echo '<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
            font-weight: normal;
            font-size: 15px;
            color: #2F3044;
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #edf2f7;
        }
        .email-container {
            border-collapse: collapse;
            margin: 0 auto;
            padding: 0;
            max-width: 600px;
            border-radius: 6px;
            background-color: #EDEDED;
        }
        .email-logo {
            text-align: center;
            padding: 40px;
        }
        .email-content {
            text-align: left;
            margin: 0 20px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 6px;
        }
        .message-highlight {
            background-color: #DDDDDD;
            border-radius: 10px;
            padding: 20px;
            font-size: 16px;
            font-weight: bold;
        }
        .email-footer {
            font-size: 10px;
            text-align: center;
            padding: 20px;
            color: #6d6e7c;
        }
    </style>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin: 0; padding: 0; width: 100%; background-color: #edf2f7;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin: 0 auto; padding: 0; max-width: 600px; border-radius: 6px; background-color: #EDEDED;">
        <tbody>
            <tr>
                <td align="center" valign="center" style="text-align: center; padding: 40px;">
                    <a href="https://step.eco.br" rel="noopener" target="_blank">
                        <img alt="Logo" src="https://step.eco.br/tema/dist/assets/media/logos/logo-4.png" width="100"/>
                    </a>
                </td>
            </tr>
            <tr>
                <td align="left" valign="center" style="text-align: left; margin: 0 20px; padding: 40px; background-color: #ffffff; border-radius: 6px;">
                    <div style="padding-bottom: 30px; font-size: 17px;">
                        <strong>Olá, ' . $nome_usuario . '!</strong>
                    </div>
                    <div style="padding-bottom: 30px">Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta. Para prosseguir com a redefinição de senha, clique no botão abaixo:</div>
                    <div style="padding-bottom: 40px; text-align:center;">
                        <a href="https://step.eco.br/views/login/new-password.php?i='.$id_usuario.'&c='.$chave_unica.'" rel="noopener" style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#009EF7;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle" target="_blank">Reiniciar Senha</a>
                    </div>
                    <div style="padding-bottom: 30px">Este link de redefinição de senha expirará em 60 minutos. Se você não solicitou uma redefinição de senha, nenhuma outra ação é necessária.</div>
                    <div style="border-bottom: 1px solid #eeeeee; margin: 15px 0"></div>
                    <div style="padding-bottom: 50px; word-wrap: break-all;">
                        <p style="margin-bottom: 10px;">Botão não funciona? Tente colar este URL no seu navegador:</p>
                        <a href="https://step.eco.br/views/login/new-password.php?i='.$id_usuario.'&c='.$chave_unica.'" rel="noopener" target="_blank" style="text-decoration:none;color: #009EF7">https://step.eco.br/views/login/new-password.php?c='.$Chave_Unica_Email.'&email='.$email_usuario.'</a>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td align="center" valign="center" class="email-footer"">
                    <p>STEP - Sistema de Tratamento EP</p>
                    '.$chave_unica.'
                    <p>Copyright © <a href="https://step.eco.br" rel="noopener" target="_blank">STEP</a>.</p>
                    <p style="color: #6d6e7c; font-size: 13px">Este é um e-mail confidencial e está sujeito às leis de proteção de dados, incluindo a LGPD. Se você não é o destinatário deste e-mail, por favor, notifique imediatamente o remetente e apague todas as cópias deste e-mail.</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>';

?>
