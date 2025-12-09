<?php
SESSION_START();

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "login";

//coneção
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
if(!$conexao){
    die("conexão falhou: " . mysqli_connect_error());
}
echo "conectado com secesso!";

mysqli_set_charset($conexao, "utf8");




// Se o formulário foi enviado
if($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

//buscar usuario no banco
$sql = "SELECT * FROM usuario WHERE nome = '$nome' LIMIT 1";
$resultado = mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultado) > 0){

    $usuarioDados = mysqli_fetch_assoc($resultado);
    $senhaBanco = $usuarioDados["senha"];

    //verificar senha
    if($senha === $senhaBanco){

        //Login ok 
        $_SESSION["usuario"] = $usuarioDados["nome"];
        echo "login realiazdo com sucesso! Bem-vindo," . $usuarioDados["nome"];

    }else{
        echo "senha incorreta!";
    }

    }else{
        echo "usuario não encontrado!";
    }
}

mysqli_close($conexao);

?>