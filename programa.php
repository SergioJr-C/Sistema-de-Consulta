<?php
function conectar($banco) {
    return new PDO("mysql:host=localhost;dbname=$banco","root","");
}

function formulario(){
    echo '<form name="e" action="programa.php" method="post">
        <select name="combo">
        <option value="0"> Primeira Opção </option>';
    
        $con = conectar("agendap");
        $select = $con->prepare("SELECT nome FROM funcionario");
        $select->execute();
        $nomes = $select->fetchAll();
    foreach ($nomes as $elemento){
        echo '<option value="'.$elemento["nome"].'\'>'.$elemento["nome"].'</option>';
        
        // <option value="nome"> nome </option>
        // '<option value=' . '$variavel' . '> nome </option>'
    }
        echo '</select>
        <input type="submit" value="Consultar">
        </form>';
}


function Consultar($nome) {
        $con = conectar("agendap");
        $select = $con->prepare("SELECT * from funcionario where nome = :nome");
        $select->bindvalue(":nome", $nome);
        $select->execute();
        $dados = $select->fetch();
        
        echo "id: ". $dados["id"] ."<br>";
        echo "Nome: ". $dados["nome"] ."<br>";
        echo "E-mail: ". $dados["email"] ."<br>";
        echo "Cargo: ". $dados["cargo"] ."<br>";
    }
    
if(isset($_POST["combo"])){
        $nome = $_POST["combo"];
        Consultar($nome);
}

