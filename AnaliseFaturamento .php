<?php
#importa os dados da tabela em .JSON
$json_data = file_get_contents('dados.json');
$data = json_decode($json_data, true); 
#Declara os valores para ser substituidos
$valormax = $data[0]['valor'];
$valormin = $data[0]['valor']; 
$soma = 0;
$count = 0;
/*passa por toda a tabela pegando o item "valor", comparando com o valor declarado,
substituindo se for menor ou maior. Somando com a variavel para obter a soma geral
dos valores
*/
foreach ($data as $item) {
     if ($item['valor'] > $valormax) {
        $valormax = $item['valor'];
    }
    
    if ($item['valor'] < $valormin || $item['valor'] > 0) {
        $valormin = $item['valor'];
    }

    $soma += $item['valor'];
    
 //if usado para pular os dias que não obteve faturamento   
    if ($item['valor'] > 0) {
        $count++;     
    }
}
/*calcula a media declara a variavel de contagem de dias, 
 passa pela tabela comparando se os valores dos dias são 
maiores que a media geral, assim somando a quantidades de 
dias q os valores são maiores.
*/
$media = $soma / $count;
$diassup = 0;
foreach ($data as $item) {
    if ($item['valor'] > $media) {
        $diassup++;
    }
}
echo "O valor máximo da tabela é: " . $valormax . "<br>";
echo "O valor mínimo da tabela é: " . $valormin . "<br>";
echo "quantidade de dias que o valor de faturamento diário foi superior à média mensal: " . $diassup;
?>