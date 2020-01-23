<?php

	//busca o arquico no caminho raiz
	$name_file = $_GET['name_file'];

	checkExtensionFile($name_file);
	


	function effectivelines($lines, $discardLines){
		

		// Gera o resultados de linhas de codigo-efetivas
		$result = $lines - $discardLines;

		//echo $result;
		return header('Location: index.php?result='.$result);
	}



	function lineCounter($file){

		// Contabiliza o total de linhas do arquivo
		$lines = count($file);

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
	
		
		// Percorre o arquivo e aribui o conteudo de cada linha a um array $content
		foreach($file as $index => $content){
			// Verifica se a contagem de linhas para comentários de n linhas não está ativa		
			if($ini_n_lines_coments == 0 && $end_n_lines_coments == 0){
				//verifica se as linhas estão desbloqueadas para buscar comentário de uma linha		
				//ltrim elimina os espaços a esquerda fazendo com que comentário de uma linha sempre inicie na posição 0 da linha
				if($blocker == 0 && stripos($content, '//') > -1){
					$position = stripos(ltrim($content), '//');
					if ($position == 0)
						$count_lines++;
					
				}
			}


			// Verifica a ocorrencia que caracteriza o inicio de um comentário de n linhas
			if($blocker == 0  && stripos($content, '/*') > -1){
				// Armazena a posição de inico do comentário
				$ini_n_lines_coments = $index;
				// Bloqueia para que essa verificação não ocorra nas linhas seguintes até achar o final */
				$blocker = 1;
			}

			// Verifica a ocorrencia de termino de comentário sendo que já foi iniciado um comentário /*
			if ($blocker == 1 && stripos($content, '*/') > -1){
				// Armazena a posição de termino do comentário
				$end_n_lines_coments = $index;
				// Ao encontrar o fim do comentário libera para que busquem novos inicios /*
				$blocker = 0;
			}

			// Verifica se os armazenadores das posições de comentários de n linhas estão preenchidos - existencia de comentário identificado
			if ($ini_n_lines_coments > 0 && $end_n_lines_coments > 0 ){
				// Trata os comentários de n linhas que possam estar após uma string que devem ser desconsiderados dos descartes
				if ($ini_n_lines_coments != $end_n_lines_coments)
				{
					// Ajusta o contador de linhas a serem descartadas
					$count_lines = $count_lines + (($end_n_lines_coments - $ini_n_lines_coments) + 1);
					/* 
						Seta os marcadores de posição para zero para posibilitar encontrar comentários simples
						também auxilia para desconsiderar a caracterização de ocorrência de comentários simples 
						em meio a comentários de n linhas
					*/
					$ini_n_lines_coments = 0;
					$end_n_lines_coments = 0;		
				}
			}

			//Verifica a ocorrencia de linhas vazias
			if (empty(trim($content)))
				$count_lines++;		

		}
		//Vai chamar a função geradora de resultado
		effectivelines($lines, $count_lines);
	}



	//Função que verifica se o arquivo possui conteudo
	function checkContentFile($name_file){
		$file = file($name_file);
		
		//verifica se o arquivo tem conteudo para analisar
		if (empty($file)){
			return header('Location: index.php?error=2');
		}
		else {
			// vai chamar a funcao que identifica as ocorrências de comentários
			lineCounter($file);
		}

	}	
	
	//Função que verifica se a extensão do arquivo é .java
	function checkExtensionFile($name_file){
		//verifica a extensão do arquivo
		$file_extension = substr($name_file, -4);

		if (strcmp($file_extension, 'java') != 0){
			return header('Location: index.php?error=1');
		}
		else{
			//vai chamar a verificação do arquivo para ver se não é vazio
			checkContentFile($name_file);
		}
	}		
?>	



		
		
	
	
