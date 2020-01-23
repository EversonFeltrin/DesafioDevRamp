<?php

	//busca o arquico no caminho raiz
	$name_file = 'C:\wamp64\www\devramp\teste.java';

	// vai abrir o arquivo informado
	$file = file($name_file);

	//verifica se conseguiu abrir o arquivo
	if (empty($file)){
		echo 'arquivo não abriu.<br>';
	}
	else{
		echo 'arquivo aberto.<br>';
	}

	//$num_linhas = count($arq);
	
	// variavel para guardar o indice do array com o conteudo das linhas
	$index = 0;
	
	// variavel para controlar as verificações de comentários de multiplas linhas, não permitinho outra verificação de inicio de comentário até achar fim do comentário
	$blocker = 0;

	// variavel para controlar o numero da linha com abertuda de comentário */ 
	$ini_n_lines_coments = 0;

	// variavel para controlar o numero da linha com abertuda de comentário */
	$end_n_lines_coments = 0;
	
	// Variavel para armazenar o número de linhas descartáveis
	$count_lines = 0;



	foreach($file as $index => $content){
		//$conteudo_linha[$i] =  $conteudo;

		echo '<br> Linha: ' . $index . ' Conteúdo: '. $content . '<br>'; // . '<br>Substring:' . substr($conteudo, 0); 
	}
	//
	foreach($file as $index => $content)
	{
		/*
		if ($ini_coment_pos == 0 && $fim_coment_pos == 0)
			if ($bloqueador == 0 && stripos($conteudo, '//') > -1){
				$position = stripos(ltrim($conteudo), '//');
				if ($position == 0){
					//echo '<br>' .$i . ' | ' . $position . '<br>';
				//echo '<br>Comentário Simples.' . stripos($conteudo, '//');
				$count_linhas++;}
			}
		*/
		// Verifica se a contagem de linhas para comentários de n linhas está iniciada		
		if($ini_n_lines_coments == 0 && $end_n_lines_coments == 0)
			//verifica se as linhas estão desbloqueadas para buscar comentário de uma linha
			//ltrim elimina os espaços a esquerda fazendo com que comentário de uma linha sempre inicie na posição 0 da linha
			if($blocker == 0 && stripos($content, '//') > -1)
			{
				$position = stripos(ltrim($content), '//');
				if ($position == 0)
				{
					echo '<br>' . $index . ' | '. $position . '<br>';
					$count_lines++;
				}
			}


		if($blocker == 0  && stripos($content, '/*') > -1){
			$ini_n_lines_coments = $index;
			$blocker = 1;
		}

		if ($blocker == 1 && stripos($content, '*/') > -1){
			$end_n_lines_coments = $index;
			$blocker = 0;
		}

		if ($ini_n_lines_coments > 0 && $end_n_lines_coments > 0 )
		{

			if ($ini_n_lines_coments != $end_n_lines_coments)
			{

				$count_lines = $count_lines + (($end_n_lines_coments - $ini_n_lines_coments) + 1);
				echo '<br>'.$index.'Inicio Comentarios Compostos:' . $ini_n_lines_coments;
				echo '<br>'.$index.'Fim Comentários Compostos:' . $end_n_lines_coments;
				$ini_n_lines_coments = 0;
				$end_n_lines_coments = 0;		
			}
		}

		if (empty(trim($content))){
			echo '<br>' . $index . '| Linha vazia';
			$count_lines++;
		}
		/*else {
			echo $index . '| Linha com caracteres: ' . $content;
		}*/

	}
	echo '<br>' . $count_lines;

		
	
	
