<?php
    //inicia a sessão para guardar o número escolhido pelo PC
    session_start();
      
    //cria o formulário para interação 
    echo "
        <p>Adivinhe o Número que eu estou pensando entre 1 e 100.</p>
        <form action='#' method='post'>
            <input type='text' name='entrada'>
            <input type='submit' value='Tentar'>
        </form><br/>
    ";
      
    //se o jogo não foi iniciado ainda, inicia a contagem de tentativas e sorteia o número
    if (!isset($_SESSION['tentativa'])) {
        $_SESSION['tentativa'] = 1;
        $_SESSION['numero'] = rand(1,100);
    }
      
    //se o usuário digitou algo e não foi a letra s
    if (isset($_POST['entrada']) && $_POST['entrada'] != "s") {
        //lê a entrada do usuário
        $entrada = $_POST['entrada'];
        //se o número digitado for o mesmo que o sorteado exibe mensagem para reinício
        if ($_SESSION['numero'] == $entrada) {
            echo "
                Parabéns, você acertou! O número era <strong>".$_SESSION['numero']."</strong>.<br/>
                Você usou <strong>".$_SESSION['tentativa']."</strong> tentativas.<br/>
                Para jogar novamente digite <strong>s</strong>.
            ";
        //se o número digitado for menor... 
        } elseif ($_SESSION['numero'] > $entrada) {
            echo "O número é maior que ".$entrada."!";
        //se o número digitado for maior...     
        } else {
            echo "O número é menor que ".$entrada."!";
        }
        //incrementa a tentativa
        $_SESSION['tentativa']++;
      
    //se o usuário digitou a letra s para começar de novo, destroi a variável de sessão com o número sorteado
    } elseif (isset($_POST['entrada']) && $_POST['entrada'] == "s") {
        unset($_SESSION['numero']);
        session_destroy();
    }
?>