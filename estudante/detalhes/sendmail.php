<?php

require_once("../../conexao.php");

      
        
        $nome_doc = $_POST['docente'];
        $nome_estu = $_POST['estudante'];
        $titulo = $_POST['titulo'];
        
        $res = $pdo->query("SELECT * FROM docentes Where nome ='$nome_doc'");
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        $email_docente = $dados[0]['email'];
        
        $res2 = $pdo->query("SELECT * FROM estudantes Where nome ='$nome_estu'");
        $dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
        $email_est = $dados2[0]['email'];
        
        $query = $pdo->query("SELECT * FROM escolhidos where nome_estudante ='$nome_estu'");
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        $reg = count($dados);
        
        $query_tema = $pdo->query("SELECT * FROM escolhidos where tema='$titulo'");
        $dados_tema = $query_tema->fetchAll(PDO::FETCH_ASSOC);
        @$escolha = count($dados_tema);
        
        if ($reg > 0) {
            echo "Voce ja escolheu um tema";
            exit();
        }
        
        if ($escolha > 3) {
            echo "Este tema ja não pode ser escolhido";
            exit();
        }
        
                
   
        $subject = "Escolha do tema";
        $name = utf8_decode("Universidade Zambeze");
        $email_to= $email_docente;
        $message = utf8_decode("O estudante $email_est escolheu o tema $titulo ");
        
        
       
        $content = "Name: $name\n";
        $content .= "Email: $email_to\n\n";
        $content .= "Message:\n$message\n";

        
        $headers = "From: $name <$email_principal>";
        


      
        $success = mail($email_to, $subject, $content, $headers);
        if ($success) {
           
            $res = $pdo->prepare("INSERT INTO escolhidos SET tema=:titulo, nome_docente = :docente, nome_estudante = :estudante,email_estudante = :email, escolha=:escolha");	
            $res->bindValue(":titulo", $titulo);
            $res->bindValue(":estudante", $nome_estu);
            $res->bindValue(":email", $email_est);
            $res->bindValue(":docente", $nome_doc);
            $res->bindValue(":escolha", $escolha);
            $res->execute();

        
            
            
            echo "Parabens Escolheu o tema ".$titulo." aguarde a confirmação";
        } else {
          
            
            echo "Oops! Alvo esta errado, Seu Pedido não foi completado.";
        }


