<?php
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// Atribui uma conexão PDO
require_once $_SERVER['DOCUMENT_ROOT'] . '/conexao.php';
$conexao = Conexao::getInstance();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud/login/verifica_sessao.php';

$_SESSION['pagina_atual'] = 'Arquivos do Projeto';

$projeto_id = isset($_GET['id']) && is_numeric($_GET['id']) 
                ? intval($_GET['id']) 
                : $_COOKIE['projeto_atual'];




$nivel_acesso_user_sessao = trim(isset($_COOKIE['nivel_acesso_usuario'])) ? $_COOKIE['nivel_acesso_usuario'] : '';
$id_tabela_cliente_sessao = trim(isset($_COOKIE['id_tabela_cliente'])) ? $_COOKIE['id_tabela_cliente'] : '';
$id_BD_Colaborador = trim(isset($_SESSION['bd_id'])) ? $_SESSION['bd_id'] : '';

if ($nivel_acesso_user_sessao == "" or  $nivel_acesso_user_sessao == 'undefined' or $projeto_id == '') {


    $value = 'Sentimos muito! <br/>Sentimos muito! <br/>O STEP Não Conseguiu Validar seu Login Ativo na Sessão, Por gentileza, refaça seu Login.';

    setcookie("seguranca", $value, [
    'expires' => time() + 3600,
    'path' => '/',
    'domain' => 'step.eco.br',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax',
]);  /* expira em 1 hora */
    header("Location: /crud/login/logout.php");
    exit;
}



$hr = date(" H ");
if ($hr >= 12 && $hr < 18) {
    $saudacao = "Boa tarde!";
} else if ($hr >= 0 && $hr < 12) {
    $saudacao = "Bom dia!";
} else {
    $saudacao = "Boa noite!";
}

//tratativa caso o cliente seja o acesso solicitado do Dashboard:
// localizo o cliente atraves do id_usuario_sessao: id do bd
//nivel_acesso_usuario: cliente




function mintohora($minutos)
{
    $hora = floor($minutos / 60);
    $resto = $minutos % 60;
    return $hora . ':' . $resto;
}


// pega hora atual php
$hora_atual = date('H:i');

function intervalo($entrada, $saida)
{
    $entrada = explode(':', $entrada);
    $saida = explode(':', $saida);
    $minutos = ($saida[0] - $entrada[0]) * 60 + $saida[1] - $entrada[1];
    if ($minutos < 0) $minutos += 24 * 60;
    return sprintf('%d:%d', $minutos / 60, $minutos % 60);
}


// consulta Projeto
$sql_projeto = $conexao->query("SELECT 
o.id_obra,
o.nome_obra,
o.status_cadastro,
o.data_cadastro,
cli.nome_fantasia,
ct.nome as nome_contato,
ct.sobrenome as sobrenome_contato 
FROM obras o
INNER JOIN clientes cli ON cli.id_cliente = o.id_cliente
LEFT JOIN contatos ct ON ct.id_cliente= cli.id_cliente
WHERE o.id_obra='$projeto_id' ");

$conta_projeto = $sql_projeto->rowCount();


if($conta_projeto ==null){

    
    $value = 'Sentimos muito! <br/>O STEP detectou uma tentativa de acesso incorreta.';

    $_SESSION['error'] =  $value;
   
    header("Location: /views/login/sign-in.php");
    exit;
} else {

    $_SESSION['error'] =  '';

}

$r_proj = $sql_projeto->fetch(PDO::FETCH_ASSOC);

$status_cadastro = $r_proj['status_cadastro'];

$brev_nome_projeto = substr($r_proj['nome_obra'], 0, 11);


if ($status_cadastro == '1') {

    $nome_status = 'Projeto Ativo';
    $classe_status = 'success';
} elseif ($status_cadastro == '2') {

    $nome_status = 'Projeto em Alerta';
    $classe_status = 'danger';
} else {

    $nome_status = 'Projeto Inativo';
    $classe_status = 'secundary';
}

$sql_personalizado = '';

if ($nivel_acesso_user_sessao == 'supervisor') {

    $sql_personalizado = "WHERE e.supervisor = '$id_BD_Colaborador'";
}

if ($nivel_acesso_user_sessao == 'cliente') {

    $sql_personalizado = "WHERE e.id_cliente= '$id_tabela_cliente_sessao'";
}

?>
<!DOCTYPE html>
<!--
Author: Fabiano Barros
Product Name: STEP Sistema de Tratamento EP
Purchase: https://step.eco.br
Website: http://step.eco.br
Contact: dev@grupoep.com.br
Versão: 3.01
-->
<html lang="pt-br">

    <head>
        <base href="../../../tema/dist/">
        <title>STEP &amp; GrupoEP</title>
        <meta charset="utf-8" />
        <meta name="description" content="Sistema de Tratamento Grupo EP - Iot - Tratamento de Efluentes" />
        <meta name="keywords" content="STEP, GrupoEP, EP, Tratamento de Efluentes, iot, Sistema, Controle, Tratamento Inteligente, água, osmose, osmose reversa" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="STEP, GrupoEP, EP, Tratamento de Efluentes, iot, Sistema, Controle, Tratamento Inteligente, água, osmose, osmose revers" />
        <meta property="og:url" content="https://grupoep.com.br/eptech" />
        <meta property="og:site_name" content="STEP | GrupoEP" />
        <link rel="canonical" href="https://step.eco.br" />
        <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Vendor Stylesheets(used by this page)-->
        <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../../node_modules/print-js/dist/print.css">
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->

    <!--begin::Body-->

    <body data-kt-name="metronic" id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
        <!--begin::Theme mode setup on page load-->
        <script>
            if (document.documentElement) {
                 const defaultThemeMode = "dark";
                const name = document.body.getAttribute("data-kt-name");
                let themeMode = localStorage.getItem("kt_" + (name !== null ? name + "_" : "") + "theme_mode_value");
                if (themeMode === null) {
                    if (defaultThemeMode === "system") {
                        themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }
                document.documentElement.setAttribute("data-theme", themeMode);
            }
        </script>
        <!--end::Theme mode setup on page load-->
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <!--begin::Header-->
                    <?php include_once '../../header.php'; ?>
                    <!--end::Header-->


                    <!--begin::Toolbar-->
                    <?php include_once '../../toolbar.php'; ?>
                    <!--end::Toolbar-->
                    <!--begin::Container-->
                    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                        <!--begin::Post-->
                        <div class="content flex-row-fluid" id="kt_content">


                        <!--:Início do novo cockpit -->
                        <div class="card card-bordered mb-10 d-none" id="div_draggable_cockpit">
												<!--begin::Card header-->
												<div class="card-header">
													<div class="card-title">
														<h3 class="d-flex text-white fw-bold my-1 fs-4">Cockpit - Gestão Online de Dados em Tempo Real</h3>
													</div>
												</div>
												<!--end::Card header-->

												<!--begin::Card body-->
												<div class="card-body">
													<!--begin::Row-->
													<div class="row row-cols-lg-3 g-10 min-h-200px draggable-zone" tabindex="0" id="div_cockpit">
														<!--begin::Col-->
														
													
														<!--end::Col-->
													</div>
													<!--end::Row-->
												</div>
												<!--end::Card body-->
										</div>
                            <!--:Fim do novo cockpit -->

                            <!--begin::Navbar-->
                            <div class="card mb-6 mb-xl-9">
                                <?php


                                ?>
                                <div class="card-body pt-9 pb-0">
                                    <!--begin::Details-->
                                    <?php include_once "../../../views/projetos/topo-projeto.php";?>
                                    <!--end::Details-->
                                    <div class="separator"></div>
                                    <!--begin::Nav-->
                                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                        <!--begin::Nav item-->
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary py-5 me-6 " href="../../views/projetos/view-project.php?id=<?php echo $projeto_id; ?>">Overview</a>
                                        </li>
                                        <!--end::Nav item-->
                                        <!--begin::Nav item-->
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary py-5 me-6" href="../../views/projetos/tarefas/tarefas.php?id=<?php echo $projeto_id; ?>">Tarefas</a>
                                        </li>
                                        <!--end::Nav item-->

                                        <!--begin::Nav item-->
                                        <li class="nav-item">
                                        <a class="nav-link text-active-primary py-5 me-6" href="../../views/projetos/nucleos/nucleos.php?id=<?php echo $projeto_id;?>"><?php if($nivel_acesso_user_sessao=='engenheiro'){ echo 'PLC';}else{ echo 'Núcleos';}?></a>
                                        </li>
                                        <!--end::Nav item-->


                                        <!--begin::Nav item-->
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary py-5 me-6" href="../../views/projetos/plcodes/plcodes.php?id=<?php echo $projeto_id; ?>"><?php if($nivel_acesso_user_sessao=='engenheiro'){ echo 'Instrumentos';}else{ echo 'PlCodes';}?></a>
                                        </li>
                                        <!--end::Nav item-->



                                        <!--begin::Nav item-->
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary py-5 me-6" href="../../views/projetos/usuarios/usuarios.php?id=<?php echo $projeto_id; ?>">Usuários</a>
                                        </li>
                                        <!--end::Nav item-->
                                        <!--begin::Nav item-->
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary py-5 me-6 active" href="../../views/projetos/arquivos/files-project.php?id=<?php echo $projeto_id; ?>">Arquivos</a>
                                        </li>
                                        <!--end::Nav item-->
                                        <!--begin::Nav item-
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary py-5 me-6" href="../../views/projetos/atividades.php?id=">Atividades</a>
                                        </li>
                                        end::Nav item-->

                                        <!--begin::Configurações
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary py-5 me-6" href="../../tema/dist/apps/projetos/settings.html">Configurações</a>
                                        </li>
                                      -end::Configurações-->

                                        <!--begin::ABA Orçamentos -- 
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary py-5 me-6" href="../../views/projetos/orcamento.php?id=<?php echo $projeto_id; ?>">Orçamentos</a>
                                        </li>
                                        end::ABA Orçamentos-->

                                    </ul>
                                    <!--end::Nav-->
                                </div>
                            </div>
                            <!--end::Navbar-->

                            <!--begin::Toolbar-->
                            <div class="d-flex flex-wrap flex-stack my-5">
                                <!--begin::Heading-->
                                <h3 class="fw-bold my-2">Arquivos do Projeto

                                    <?php
                                    // consultar as tarefas personalizadas
                                    $sql = $conexao->query("SELECT COUNT(DISTINCT aq.id_doc) as Total_DOC
                                                FROM arquivos_projeto aq 
                                              
                                              WHERE aq.id_obra='$projeto_id'
                                                ");

                                    $r = $sql->rowCount();


                                    if ($r > 0) {

                                        $rtow = $sql->fetch(PDO::FETCH_ASSOC);

                                        $total = $rtow['Total_DOC'];

                                        echo '<span class="fs-6 text-gray-400 fw-semibold ms-1">+' . $total . '</span>';
                                    } else {

                                        echo '<span class="fs-6 text-gray-400 fw-semibold ms-1">Nenhum arquivo foi adicionado à este Projeto, até o momento.</span>';
                                    }
                                    ?>



                                </h3>
                                <!--end::Heading-->

                                <!--begin::Controls-->
                                <div class="d-flex my-2">
                                   
                                    
                                    <a href="../../views/projetos/arquivos/file-manager.php?id=<?=$projeto_id;?>" class='btn btn-primary btn-flex h-40px border-0 fw-bold px-4 px-lg-6 ms-2 ms-lg-3'>Gerenciar Arquivos</a>
                                </div>
                                <!--end::Controls-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Row-->
                            <!--begin::Row Bloco Arquivo-->
                            <div class="row g-6 g-xl-9 mb-6 mb-xl-9" id="div_lista_arquivos">

                              <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/projetos/arquivos/lista-arquivos.php';?>


                            </div>
                            <!--end:Row Bloco Arquivo-->


                            <!--end::Card-->
                        </div>
                        <!--end::Post-->
                    </div>
                    <!--end::Container-->
                    <!--begin::Footer-->
                    <?php include '../../../views/footer.php'; ?>
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->
        <!--begin::Drawers-->
    <!--begin::Activities drawer-->
    <?php include './../../../views/conta-usuario/atividade-usuario.php'; ?>
    <!--end::Activities drawer-->
        <!--end::Activities drawer-->
 <!--begin::Chat drawer-->
 <?php include './../../../views/chat/chat-usuario.php'; ?>
   
    
   <!--end::Chat drawer-->

     <!--begin::Modal - View Users-->
     <?php include_once "../../../views/usuarios/modal-view-users.php"; ?>
        <!--end::Modal - View Users-->
        <!--end::Drawers-->
        <!--end::Main-->


        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
            <span class="svg-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                    <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Scrolltop-->
        <!--begin::Modals-->


       
  


        
        
  <!--inicio::Modal - Busca Usuários-->      
<div class="modal fade" id="kt_modal_users_search" tabindex="-1" aria-hidden="true">
<!--begin::Modal dialog-->
<div class="modal-dialog modal-dialog-centered mw-900px" id='conteudo_modal_dinamico_usuarios'>
    <!--begin::Modal content-->
   <!--begin::Page loading(append to body)-->
        <div class="alert alert-primary d-flex align-items-center p-5 mb-10" id="aguardar_modal_carregar_usuarios">
            <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
            <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                    <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                </svg>
            </span>
            <!--end::Svg Icon-->
            <div class="d-flex flex-column">
                <h4 class="mb-1 text-primary">Por favor, aguarde.</h4>
                <span class="spinner-border text-primary" role="status"></span>
                <span class="text-gray-800 fs-6 fw-semibold mt-5">Carregando...</span>
            </div>
        </div>

<!--end::Page loading-->
</div>
<!--end::Modal dialog-->

</div>
<!--end::Modal - Busca Usuários-->
     
        <!--end::Modals-->
        <!--begin::Javascript-->
        <script>
            var hostUrl = "assets/";
        </script>
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Vendors Javascript(used by this page)-->
        <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <!--end::Vendors Javascript-->
        <!--begin::Custom Javascript(used by this page)-->
        <script src="../../js/dashboard/step-js.js"></script>
        <script src="../../node_modules/print-js/dist/print.js"></script>
        <script src="../../js/projetos/project.js"></script>
        <script src="assets/js/widgets.bundle.js"></script>
        <script src="assets/js/custom/widgets.js"></script>
        <script src="../../js/suportes/chat/chat.js"></script>
        <script src="../../js/usuarios/users-search.js"></script>
       
       
        <!--end::Custom Javascript-->
        <script src="../../js/cockpit/create-cockpit.js"></script>


    

<script>
      var projeto ="<?php echo $projeto_id; ?>";
      
if (projeto) {
        // Inicializa o Dropzone se o cookie existir
        var myDropzone = new Dropzone("#kt_dropzonejs_arquivos_projeto", {
            url: '../../crud/projetos/arquivos/upload.php?projeto=' + projeto, // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            
            init: function () {

                this.on("success", function (file, responseText) {
                    // Handle the responseText here. For example, add the text to the preview element:
                    file.previewTemplate.appendChild(document.createTextNode(responseText.retorno));
                    console.log("arquivo enviado");

                    createMetronicToast('Enviando Documento', 'Assim que armazenado, sua sessão será atualizada, aguarde por favor...', 5000, 'success', 'bi bi-check2-square');

                    setTimeout(() => {
                    

                        location.reload();
                    }, 5000);

                });
                this.on("error", function (file, responseText) {
                    // Handle the responseText here. For example, add the text to the preview element:
                    file.previewTemplate.appendChild(document.createTextNode(responseText.retorno));
                    console.log("arquivo não enviado");
                });
            }
        });
    } else {
        console.log("Id do projeto que tem arquivos não foi lido.");
    }

</script>
       

        <!--end::Javascript-->
    </body>
    <!--end::Body-->

    </html>