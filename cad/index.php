<?php 
include_once("conexao.php")
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ítalo Nunes">
    <title>Document</title>
</head>
<body>

  <form action="cadastro.php" method="post">
    <label for="descricao">Descrição</label>
    <input type="text" id="descricao" name="descricao" required><br><br>
    <label for="valor">Valor</label>
    <input type="text" id="valor" name="valor" required><br><br>
    <h2>Registro das Vendas</h2>
  
  <table id="registro_vendas" name="registro_vendas">
    <tr>
      <th>Descrição</th>
      <th>Valor</th>
    </tr>
    <?php
    include("conexao.php");

    $sql = "SELECT descricao, valor FROM cadastro";
    $result = mysqli_query($conexao, $sql);
    $totalVendas = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['descricao'] . "</td>";
        echo "<td>" . $row['valor'] . "</td>";
        echo "</tr>";
        $totalVendas += floatval($row['valor']); // Adiciona o valor da venda ao total da soma geral 

    }

    mysqli_close($conexao);
    ?>
  </table>



  
  <p>Total de Vendas: <span id="totalVendas" name="totalVendas"><?php echo $totalVendas; ?></span></p>
  <input type="submit" value="Cadastrar">
  </form>
<hr>


  <script>
    var total = 0; // Variável para armazenar o total de vendas, assim o valor inícial será sempre o 0
    
    document.getElementById("cad_venda").addEventListener("submit", function(event) {
      event.preventDefault();
      
      var description = document.getElementById("descricao").value;
      var value = parseFloat(document.getElementById("valor").value); // Converte para número o valor inserido em texto
      
      var table = document.getElementById("registro_vendas");
      var row = table.insertRow(-1);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      cell1.innerHTML = description;
      cell2.innerHTML = value.toFixed(2); // Formatando o valor para exibir apenas duas casas decimais ao final
      
      total += value; // faz a soma total dos valor, atualizando ele sempre que inserido um novo valor
      document.getElementById("totalVendas").textContent = total.toFixed(2); // Atualiza o total no final da página, deixando assim este valor mais elegante
      
      document.getElementById("descricao").value = "";
      document.getElementById("valor").value = "";
    });
  </script>
</body>
</html>