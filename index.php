<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
    	<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    	<title>Desafio DevRam</title>
	   	
	   	<!-- Bootstrap CSS -->
	    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>

	    <!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin='anonymous'></script>
	    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
	    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>

	    <style>
	    	.boxCenter{
	    		width: 500px;
	    		height: 500px;
	    		padding-top: 200px;
	    		text-align: center;
	    	}

	    	.boxCenter p{
	    		text-align: center;
	    	}
	    	.boxAlertError{
	    		margin-top: 20px;
	    		height: 100px;
	    		width: 300px;
	    		margin-left: auto;
	    		margin-right: auto;
	    		background-color: red;
	    		padding-top: 35px;
	    		text-align: center;
	    	}
	    	.boxAlertSuccess{
	    		margin-top: 20px;
	    		height: 100px;
	    		width: 300px;
	    		margin-left: auto;
	    		margin-right: auto;
	    		background-color: #00a86b;
	    		color: #ffffff;
	    		padding-top: 10px;
	    		text-align: center;
	    	}
	    	.result{
	    		font-size: 34px;
	    	}
	    </style>
	</head>

	<body>
		<div class = 'container-fluid'>
			<div class='row'>
				<div class='col-lg-4'></div>
				<div class='col-lg-4 boxCenter' >
					<form method='GET' action='validateFile.php' enctype='multipart/form-data'>
						<div>
							<p><strong>Informe o arquivo-fonte do Java que deseja inspecionar.<strong></p>
						</div>
						<div>
							<input type='file' name='name_file' id='name_file' required>
						</div>
						<br>
						<button class="btn btn-primary" type="submit">Contar Linhas Efetivas de Código</button>
					</form>

					<?php 
						if (empty($_GET['error']) && empty($_GET['result'])){
							echo '';
						}
						else{
							if(empty($_GET['result'])){
								if($_GET['error'] == 1) { 
								echo "
									<div class='boxAlertError'> 
										Erro na extensão de arquivo.
									</div>";
								} else if($_GET['error'] == 2){ 
									echo "
										<div class='boxAlertError'> 
											<p>Arquivo vazio.</p>
										</div>";
								}

							}
							else{
								echo "
									<div class='boxAlertSuccess'> 
										<p><stromg>Número de linhas de código-efetivo:</strong></p>
										<p class='result'><strong>" . $_GET['result'] . "</strong></p>
									</div>";
							}
						}
					?>
				</div>
				<div class='col-lg-4'></div>
			</div>
		</div>
	</body>
</hmtl>