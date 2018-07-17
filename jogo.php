<?php
    //inicia a sess�o para guardar o n�mero escolhido pelo PC
    session_start();
      
    //cria o formul�rio para intera��o 
    echo "
        <p>Adivinhe o N�mero que eu estou pensando entre 1 e 100.</p>
        <form action='#' method='post'>
            <input type='text' name='entrada'>
            <input type='submit' value='Tentar'>
        </form><br/>
    ";
      
    //se o jogo n�o foi iniciado ainda, inicia a contagem de tentativas e sorteia o n�mero
    if (!isset($_SESSION['tentativa'])) {
        $_SESSION['tentativa'] = 1;
        $_SESSION['numero'] = rand(1,100);
    }
      
    //se o usu�rio digitou algo e n�o foi a letra s
    if (isset($_POST['entrada']) && $_POST['entrada'] != "s") {
        //l� a entrada do usu�rio
        $entrada = $_POST['entrada'];
        //se o n�mero digitado for o mesmo que o sorteado exibe mensagem para rein�cio
        if ($_SESSION['numero'] == $entrada) {
            echo "
                Parab�ns, voc� acertou! O n�mero era <strong>".$_SESSION['numero']."</strong>.<br/>
                Voc� usou <strong>".$_SESSION['tentativa']."</strong> tentativas.<br/>
                Para jogar novamente digite <strong>s</strong>.
            ";
        //se o n�mero digitado for menor... 
        } elseif ($_SESSION['numero'] > $entrada) {
            echo "O n�mero � maior que ".$entrada."!";
        //se o n�mero digitado for maior...     
        } else {
            echo "O n�mero � menor que ".$entrada."!";
        }
        //incrementa a tentativa
        $_SESSION['tentativa']++;
      
    //se o usu�rio digitou a letra s para come�ar de novo, destroi a vari�vel de sess�o com o n�mero sorteado
    } elseif (isset($_POST['entrada']) && $_POST['entrada'] == "s") {
        unset($_SESSION['numero']);
        session_destroy();
    }
?>