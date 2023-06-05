<!DOCTYPE html>
<html>
<head>
  <title>Árbol: Verificar si es antecesor</title>
  <style>
    #output {
      margin-top: 20px;
      padding: 10px;
      border: 1px solid #ccc;
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>
  <h1>Árbol: Verificar si es antecesor</h1>

  <form method="post" action="procesar.php">
    <label for="input">Input:</label>
    <textarea id="input" name="input" rows="10" cols="30" placeholder="Ingrese las relaciones del árbol..."></textarea>

    <br>

    <input type="submit" value="Procesar">
  </form>

  <div id="output">
    <?php
    if (isset($_GET['output'])) {
      echo $_GET['output'];
    }
    ?>
  </div>

</body>
</html>
