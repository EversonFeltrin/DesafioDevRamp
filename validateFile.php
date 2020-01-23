<?php

	//busca o arquico no caminho raiz
	$name_file = $_GET['name_file'];

	

	


	checkExtensionFile($name_file);

	$file = checkContentFile($name_file);

	lineCounter($file);


	function lineCounter($file){

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

		// Percorre o arquivo e aribui o conteudo de cada linha a um array $content
		foreach($file as $index => $content)
		{
			// Verifica se a contagem de linhas para comentários de n linhas não está ativa		
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
	}



	//Função que verifica se o arquivo possui conteudo
	function checkContentFile($name_file){
		$file = file($name_file);
		
		//verifica se o arquivo tem conteudo para analisar
		if (empty($file)){
			return header('Location: index.php?codigo=2');
		}
		else {
			return $file;
		}

	}	
	
	//Função que verifica se a extensão do arquivo é .java
	function checkExtensionFile($name_file){
		//verifica a extensão do arquivo
		$file_extension = substr($name_file, -4);

		if (strcmp($file_extension, 'java') != 0){
			return header('Location: index.php?codigo=1');
		}
		return 0;
	}		
		



		
		
	
	
