<?php
require_once '../../conexao.php';
// Atribui uma conexão PDOcolab
$conexao = Conexao::getInstance();
if (!isset($_SESSION)) session_start();

// Get and decode the POST data
$userData = json_decode($_POST['userData']);

if(!empty($userData)){
    // The user's profile info
    $oauth_provider = $_POST['oauth_provider'];
    $oauth_uid  = !empty($userData->id)?$userData->id:'';
    $first_name = !empty($userData->given_name)?$userData->given_name:'';
    $last_name  = !empty($userData->family_name)?$userData->family_name:'';
    $email      = !empty($userData->email)?$userData->email:'';
    $gender     = !empty($userData->gender)?$userData->gender:'';
    $locale     = !empty($userData->locale)?$userData->locale:'';
    $picture    = !empty($userData->picture)?$userData->picture:'';
    $link       = !empty($userData->link)?$userData->link:'';
    
    // Check whether the user data already exist in the database
    $query = "SELECT * FROM usuarios WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'";
    $result = $conexao->query($query);
    
    if($result->num_rows > 0){ 
        // Update user data if already exists
        $query = "UPDATE usuarios SET first_name = '".$first_name."', last_name = '".$last_name."', email = '".$email."', gender = '".$gender."', locale = '".$locale."', picture = '".$picture."', link = '".$link."', modified = NOW() WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'";
        $update = $conexao->query($query);
    }else{
        // Insert user data
        $query = "INSERT INTO usuarios VALUES (NULL, '".$oauth_provider."', '".$oauth_uid."', '".$first_name."', '".$last_name."', '".$email."', '".$gender."', '".$locale."', '".$picture."', '".$link."', NOW(), NOW())";
        $insert = $conexao->query($query);
    }
    
    return true;
}
?>