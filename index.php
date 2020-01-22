<?php

	//busca o arquico no caminho raiz
	$name_arquivo = 'C:\wamp64\www\devramp\teste.java';


	$arq = file($name_arquivo);

	//verifica se arquivo tem conteudo
	if (empty($arq)){
		echo 'arquivo vazio';
	}
	else{
		echo 'arquivo com conteudo';
	}

	$num_linhas = count($arq);
	
	$i = 0;


		$bloqueador = 0;

		$count_linhas = 0;

		$ini_coment_pos = 0;
		$fim_coment_pos = 0;

	foreach($arq as $i => $conteudo){
		//$conteudo_linha[$i] =  $conteudo;

		echo '<br> Linha: ' . $i . ' Conteúdo: '. $conteudo . '<br>'; // . '<br>Substring:' . substr($conteudo, 0); 
	}	
	foreach($arq as $i => $conteudo){
		//$conteudo_linha[$i] =  $conteudo;
		//
		//echo '<br> Linha: ' . $i . ' Conteúdo: '. $conteudo . '<br>'; // . '<br>Substring:' . substr($conteudo, 0); 
		//stripos(string, find, start) - encontra a posição da primeira ocorrencia
		//echo '<br> Ocorrencia Posição: ' . stripos($conteudo, '/*') . '	';

		if ($ini_coment_pos == 0 && $fim_coment_pos == 0)
			if ($bloqueador == 0 && stripos($conteudo, '//') > -1){
				$position = stripos(ltrim($conteudo), '//');
				if ($position == 0){
					echo '<br>' .$i . ' | ' . $position . '<br>';
				//echo '<br>Comentário Simples.' . stripos($conteudo, '//');
				$count_linhas++;}
			}

		if($bloqueador == 0  && stripos($conteudo, '/*') > -1){
			$ini_coment_pos = $i;
			$bloqueador = 1;
		}

		if ($bloqueador == 1 && stripos($conteudo, '*/') > -1){
			$fim_coment_pos = $i;
			$bloqueador = 0;
		}

		if ($ini_coment_pos > 0 && $fim_coment_pos > 0){
			if ($ini_coment_pos != $fim_coment_pos){
				$count_linhas = $count_linhas + (($fim_coment_pos - $ini_coment_pos) + 1);
				echo '<br>'.$i.'Inicio Comentarios Compostos:' . $ini_coment_pos;
				echo '<br>'.$i.'Fim Comentários Compostos:' . $fim_coment_pos;
				$ini_coment_pos = 0;
				$fim_coment_pos = 0;		
			}
		}
		


		

		

	}

	echo '<br>' . $count_linhas;

		
	
	
