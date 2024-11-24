<?php 

if(isset($_POST['submit']))
{ 
    print_r($_POST['Nome']);
    print_r('<br>');
    print_r($_POST['Email']);
    print_r('<br>');
    print_r($_POST['Telefone']);
    print_r('<br>');
    print_r($_POST['genero']);
    print_r('<br>');
    print_r($_POST['Cidade']);
    print_r('<br>');
    print_r($_POST['Estado']);
    print_r('<br>');
    print_r($_POST['Endereco']);

    include_once('config.php');

    $Nome = $_POST['Nome'];
    $Email = $_POST['Email'];
    $Telefone = $_POST['Telefone'];
    $genero = $_POST['genero'];
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao meu site</title>
    <style type="text/css">
        body {
            font-family: arial;
            background-image: linear-gradient(to right, rgb(75,150,250), rgb(250,250,250));
        }
        .box{
            position: absolute;
            top: 15%;
            left: 40%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 15px;
            padding: 15px;
            width: 20%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend {
            border: 2px solid dodgerblue;
            text-align: center;
            padding: 5px;
            border-radius: 8px;
            background-color: dodgerblue;
        }
        .inputbox{
            position: relative;
        }
        .inputuser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            font-size: 15px;
            color: white;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelinput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputuser:focus ~ .labelinput{
            top: -20px;
            font-size: 15px;
        }
        .inputuser:valid ~ .labelinput{
              top: -20px;
            font-size: 15px;
        }
        #datanascimento{
            border: none;
            padding: 4px;
            border-radius: 10px;
            outline: none;
            background-color: white;
            color: black;
            font-size: 15px;
        }
        #submit{
            background-image: linear-gradient(to right, rgb(75,150,250), rgb(250,250,250));
            width: 100%;
            border: none;
            padding: 15px;
            border-radius: 15px;
            color: black;
            font-size: 15px;
            cursor: pointer;
        }
        #submit:hover {
            background-image: linear-gradient(to right, rgb(75,150,250), rgb(75,150,250));
            color: white;
        }
    </style>
</head>
<body>
     <div class="box">
        <form action="Cadastro.php" method="POST">
          <fieldset>
              <legend>
                  <b>Formulário de Cadastro </b> </legend>
                  <br><br>
                  <div class="inputbox">
                  <input type="text" name="Nome" id="Nome" class="inputuser" required>
                  <label for="nome" class="labelinput">Nome Completo</label>
              </div>
              <br><br>
                 <div class="inputbox">
                  <input type="text" name="Email" id="Email" class="inputuser" required>
                  <label for="nome" class="labelinput">Email</label>
              </div>
              <br><br>
                 <div class="inputbox">
                  <input type="Tel" name="Telefone" id="Telefone" class="inputuser" required>
                  <label for="nome" class="labelinput">Telefone</label>
              </div>
              <br><br>
              <p>Sexo:</p>

              <input type="radio" name="genero" id="Feminino" value="Feminino" required>
              <label for="Feminino">Feminino</label>
              <br>
               <input type="radio" name="genero" id="Masculino" value="Masculino" required>
              <label for="Feminino">Masculino</label>
              <br>
               <input type="radio" name="genero" id="Outro" value="Outro" required>
              <label for="Feminino">Outro</label>
               <br>
               <br>
                 <div class="inputbox">
                 <label for="datanascimento"><b>Data de nascimento:</b></label>
                  <input type="date" name="datanascimento" id="datanascimento" class="inputuser" required>
              </div>
              <br><br>
              <div class="inputbox">
                  <input type="text" name="Cidade" id="Cidade" class="inputuser" required>
                  <label for="Cidade" class="labelinput">Cidade</label>
              </div>
              <br><br>
              <div class="inputbox">
                  <input type="text" name="Estado" id="Estado" class="inputuser" required>
                  <label for="Estado" class="labelinput">Estado</label>
              </div>
              <br><br>
              <div class="inputbox">
                  <input type="text" name="Endereco" id="Endereco" class="inputuser" required>
                  <label for="Endereco" class="labelinput">Endereço</label>
              </div>
              <br><br>
              <input type="submit" name="submit" id="submit">
          </fieldset>
        </form>
     </div>
</body>
</html>