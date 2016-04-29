<?php

// ===========================================================================
// Programa 1 - pesquisa.php (primeiro protótipo)
//            - Guardar em public_html/aula_php/fachada
// ===========================================================================

// Início do documento HTML --------------------------------------------------

echo "<html><head><title>Pesquisa de produtos</title></head>";

// Corpo do documento HTML ---------------------------------------------------

echo "<body>";

// Exemplo de uma soma de variáveis 

$x = 9;
$y = 20;
$resultado = $x + $y;

// A concatenação de strings é feita com o ponto "."
echo "<p> Resultado= " . $resultado . "</p>";

// Exemplo da utilização de um ciclo for.

for ($i = 1; $i <= 10; $i++) {
  if ($i > 5) {
    echo "<p>" . $i . "</p>";
  } else {
    echo "<p>" . -$i . "</p>";
  }
}

// Mostrar o nome do browser do utilizador.
echo "<p>" . getenv("HTTP_USER_AGENT") . "</p>";

echo "</body>";

// Fim do documento HTML -----------------------------------------------------

echo "</html>";

// ===========================================================================

?>