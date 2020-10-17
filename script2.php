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

$sql = "SELECT Tb_convenio.verba, Tb_convenio.banco, MIN(data_inclusao), MAX(data_inclusao), SUM(valor) FROM Tb_contrato LEFT JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.codigo LEFT JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.convenio GROUP BY Tb_convenio.banco, Tb_convenio.verba;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

  echo "<table><tr><th>Banco</th><th>Verba</th><th>Data mais Antiga</th><th>Data mais Recente</th><th>Soma dos Valores</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["banco"]."</td><td>".$row["verba"]."</td></tr>".$row["MIN(data_inclusao)"]."</td></tr>".$row["MAX(data_inclusao)"]."</td></tr>".$row["SUM(valor)"]."</td></tr>";
  }
  echo "</table>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>