<?php

//=====[ Inicio da classe envia email]=====================<<
  // Compo E-mail
      $arquivo = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
      <html xmlns='http://www.w3.org/1999/xhtml'>
      <head>
      <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1' />
      <title>STEP - Grupo EP</title>
  
      <style type='text/css'>
          /* Take care of image borders and formatting, client hacks */
          img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
          a img { border: none; }
          table { border-collapse: collapse !important;}
          #outlook a { padding:0; }
          .ReadMsgBody { width: 100%; }
          .ExternalClass { width: 100%; }
          .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
          table td { border-collapse: collapse; }
          .ExternalClass * { line-height: 115%; }
          .container-for-gmail-android { min-width: 600px; }
  
  
          /* General styling */
          * {
          font-family: Helvetica, Arial, sans-serif;
          }
  
          body {
          -webkit-font-smoothing: antialiased;
          -webkit-text-size-adjust: none;
          width: 100% !important;
          margin: 0 !important;
          height: 100%;
          color: #676767;
          }
  
          td {
          font-family: Helvetica, Arial, sans-serif;
          font-size: 14px;
          color: #777777;
          text-align: center;
          line-height: 21px;
          }
  
          a {
          color: #676767;
          text-decoration: none !important;
          }
  
          .pull-left {
          text-align: left;
          }
  
          .pull-right {
          text-align: right;
          }
  
          .header-lg,
          .header-md,
          .header-sm {
          font-size: 32px;
          font-weight: 700;
          line-height: normal;
          padding: 35px 0 0;
          color: #4d4d4d;
          }
  
          .header-md {
          font-size: 24px;
          }
  
          .header-sm {
          padding: 5px 0;
          font-size: 18px;
          line-height: 1.3;
          }
  
          .content-padding {
          padding: 20px 0 5px;
          }
  
          .mobile-header-padding-right {
          width: 290px;
          text-align: right;
          padding-left: 10px;
          }
  
          .mobile-header-padding-left {
          width: 290px;
          text-align: left;
          padding-left: 10px;
          }
  
          .free-text {
          width: 100% !important;
          padding: 10px 60px 0px;
          }
  
          .button {
          padding: 30px 0;
          }
  
          .mini-block {
          border: 1px solid #e5e5e5;
          border-radius: 5px;
          background-color: #ffffff;
          padding: 12px 15px 15px;
          text-align: left;
          width: 253px;
          }
  
          .mini-container-left {
          width: 278px;
          padding: 10px 0 10px 15px;
          }
  
          .mini-container-right {
          width: 278px;
          padding: 10px 14px 10px 15px;
          }
  
          .product {
          text-align: left;
          vertical-align: top;
          width: 175px;
          }
  
          .total-space {
          padding-bottom: 8px;
          display: inline-block;
          }
  
          .item-table {
          padding: 50px 20px;
          width: 560px;
          }
  
          .item {
          width: 300px;
          }
  
          .mobile-hide-img {
          text-align: left;
          width: 125px;
          }
  
          .mobile-hide-img img {
          border: 1px solid #e6e6e6;
          border-radius: 4px;
          }
  
          .title-dark {
          text-align: left;
          border-bottom: 1px solid #cccccc;
          color: #4d4d4d;
          font-weight: 700;
          padding-bottom: 5px;
          }
  
          .item-col {
          padding-top: 20px;
          text-align: left;
          vertical-align: top;
          }
  
          .force-width-gmail {
          min-width:600px;
          height: 0px !important;
          line-height: 1px !important;
          font-size: 1px !important;
          }
  
      </style>
  
      <style type='text/css' media='screen'>
          @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
      </style>
  
      <style type='text/css' media='screen'>
          @media screen {
          /* Thanks Outlook 2013! */
          * {
              font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
          }
          }
      </style>
  
      <style type='text/css' media='only screen and (max-width: 480px)'>
          /* Mobile styles */
          @media only screen and (max-width: 480px) {
  
          table[class*='container-for-gmail-android'] {
              min-width: 290px !important;
              width: 100% !important;
          }
  
          img[class='force-width-gmail'] {
              display: none !important;
              width: 0 !important;
              height: 0 !important;
          }
  
          table[class='w320'] {
              width: 320px !important;
          }
  
          td[class*='mobile-header-padding-left'] {
              width: 160px !important;
              padding-left: 0 !important;
          }
  
          td[class*='mobile-header-padding-right'] {
              width: 160px !important;
              padding-right: 0 !important;
          }
  
          td[class='header-lg'] {
              font-size: 24px !important;
              padding-bottom: 5px !important;
          }
  
          td[class='content-padding'] {
              padding: 5px 0 5px !important;
          }
  
          td[class='button'] {
              padding: 5px 5px 30px !important;
          }
  
          td[class*='free-text'] {
              padding: 10px 18px 30px !important;
          }
  
          td[class~='mobile-hide-img'] {
              display: none !important;
              height: 0 !important;
              width: 0 !important;
              line-height: 0 !important;
          }
  
          td[class~='item'] {
              width: 140px !important;
              vertical-align: top !important;
          }
  
          td[class~='quantity'] {
              width: 50px !important;
          }
  
          td[class~='price'] {
              width: 90px !important;
          }
  
          td[class='item-table'] {
              padding: 30px 20px !important;
          }
  
          td[class='mini-container-left'],
          td[class='mini-container-right'] {
              padding: 0 15px 15px !important;
              display: block !important;
              width: 290px !important;
          }
  
          }
      </style>
      </head>
  
      <body bgcolor='#f7f7f7'>
      <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
      <tr>
          <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
          <center>
          <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
              <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
              <tr>
                  <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                  <!--[if gte mso 9]>
                  <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                  <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                  <v:textbox inset='0,0,0,0'>
                  <![endif]-->
                  <center>
                      <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                      <tr>
                          <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                          <a href='https://step.eco.br'><img width='50' height='50' src='https://step.eco.br/images/logo-4-sm.png' alt='STEP'></a>
                          </td>
                          <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                          <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                          <a href='https://www.facebook.com/epengenharia/'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                          <a href=''><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                          </td>
                      </tr>
                      </table>
                  </center>
                  <!--[if gte mso 9]>
                  </v:textbox>
                  </v:rect>
                  <![endif]-->
                  </td>
              </tr>
              </table>
          </center>
          </td>
      </tr>
      <tr>
          <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
          <center>
              <table cellspacing='0' cellpadding='0' width='600' class='w320'>
              <tr>
                  <td class='header-lg'>
                  ".$retorno_alerta."
                  </td>
              </tr>
              <tr>
                  <td class='free-text'>
                  ".$Saudacao.", ".$nome_para."
                  
                      
                  </td>
              </tr>
              
              <tr>
                  <td class='w320'>
                  <table cellpadding='0' cellspacing='0' width='100%'>
                      <tr>
                      <td class='mini-container-left'>
                          <table cellpadding='0' cellspacing='0' width='100%'>
                          <tr>
                              <td class='mini-block-padding'>
                              <table cellspacing='0' cellpadding='0' width='100%' style='border-collapse:separate !important;'>
                                  <tr>
                                  <td class='mini-block' >
                                      <span class='header-sm'>STEP Comunica:</span><br />
                                  <p style='text-align:center'> Categoria do Suporte <b>".$nome_tipo_suporte." </b><br/>
                                  Obra: ".$nome_obra." 
                                  Estação: ".$nome_estacao." <br/>
                                  PLCode:".$nome_plcode." <br/>
                                  Operador: ".$nome_Operador." <br/>
                                  Telefone Direto do Operador: ".$Tel_OP."
<br/>
                                  $hora_min
<br/>
                                  $dia_mes_ano
                             <br/>    
                             Origem da Leitura: ".$Endereco_Origem." 
                                  </td>
                                  </tr>
                              </table>
                              </td>
                          </tr>
                          </table>
                      </td>
                      
                      </tr>
                  </table>
                  </td>
                  
              </tr>
  
              
              </table>
          </center>
          </td>
      </tr>
      
      <tr>
          <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
          <center>
              <table cellspacing='0' cellpadding='0' width='600' class='w320'>
              <tr>
                  <td style='padding: 25px 0 25px'>
                  <strong>STEP - Sistema de Tratamento EP</strong><br />
                  EPTech - 2019<br />
                  Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b>
                  </td>
              </tr>
              </table>
          </center>
          </td>
      </tr>
      </table>     
      </body>
      </html>";
  
      //enviar
      
      // emails para quem será enviado o formulário
      $emailenviar = "webmaster@step.eco.br";
  
      $destino = $email_para;
      
      //$destino .='fabiano.barros@grupoep.com.br';
      $assunto = "$assunto_email";
      
      // É necessário indicar que o formato do e-mail é html
      $headers  = 'MIME-Version: 1.1' . "\r\n";
          $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
          $headers .= 'From: STEP | GrupoEP <'.$emailenviar.'>';
          // para enviar a mensagem em prioridade máxima
      $headers .= "X-Priority: 1\n";
  
      $headers .= "Bcc:fabiano.barros@grupoep.com.br"."\r\n";
      
      $enviaremail = mail($destino, $assunto, $arquivo, $headers);

      if($enviaremail){
  

 //  Gera Log da Envio do Email
            $acao_log = "LOG Email - Suporte";
            $tipo_log = '42'; // Envio Automático de E-mail para o Suporte, Email enviado com Sucesso!

            $sql_log = "INSERT INTO log_leitura (
            chave_unica,
            id_usuario, 
            acao,
            acao_log,
            id_acao_log,
            estacao_logada,
            tipo_log) 
            VALUES (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
                )";
            $conexao->prepare($sql_log)->execute([
                $Chave_Unica_Rmm,
                $id_operador,
                'E-mail enviado com sucesso para o '.$nome_para.', no email: '.$emailenviar.' ',
                $acao_log,
                $ultimo_id_suporte,
                $id_estacao,
                $tipo_log ]);
//  Gera Log da Envio do Email
      
      } else {
      //  Gera Log da Envio do Email
            $acao_log = "LOG Email - Suporte";
            $tipo_log = '43'; // Envio Automático de E-mail para o Suporte, Falha no Envio do Email!

            $sql_log = "INSERT INTO log_leitura (
            chave_unica,
            id_usuario, 
            acao,
            acao_log,
            id_acao_log,
            estacao_logada,
            tipo_log) 
            VALUES (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
                )";
            $conexao->prepare($sql_log)->execute([
                $Chave_Unica_Rmm,
                $id_operador,
                "Falha ao Enviar E-mail  para o '.$nome_para.', no email: '.$emailenviar.' ",
                $acao_log,
                $ultimo_id_suporte,
                $id_estacao,
                $tipo_log ]);
//  Gera Log da Envio do Email
      
      }
//=====[ final da classe envia email]=====================<<


?>