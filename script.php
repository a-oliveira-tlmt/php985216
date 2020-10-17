<?php

$servidor = "localhost";
$usuario = "usuario";
$senha = "senha_123";
$nomedb = "myDB"

//Considerando tabela MySQL...
$conn = new mysqli($servidor, $usuario, $senha, $nomedb);

if ($conn->connect_error) {
  die("Falha ao conectar: " . $conn->connect_error);
}

echo "Conectado com Sucesso!";

$sql1 = "SELECT codigo, prazo, valor, data_inclusao FROM Tb_contrato";
$sql2a = "SELECT convenio_servico FROM Tb_contrato";
$sql2b = "SELECT convenio FROM Tb_convenio_servico WHERE codigo IN (";
$sql2c = "SELECT verba, banco FROM Tb_convenio WHERE convenio IN (" . $sql2b . $sql2a . "))";

$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2c);

if ($result1->num_rows > 0) {

  echo "<table><tr><th>Nome do Banco</th><th>Verba</th><th>Código do Contrato</th><th>Data de Inclusão</th><th>Valor</th><th>Prazo</th></tr>";
  while($row1 = $result1->fetch_assoc()) {
	$row2 = $result2->fetch_assoc()
    echo "<tr><td>".$row2["banco"]."</td><td>".$row2["verba"]."</td></tr>".$row1["codigo"]."</td></tr>".$row1["data_inclusao"]."</td></tr>".$row1["valor"]."</td></tr>".$row1["prazo"]."</td></tr>";
  }
  echo "</table>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>