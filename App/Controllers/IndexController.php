<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {


	//Painel 

	public function index()
	{
		$this->render('index');
	}

	public function painel()
	{
		$this->render('painel');
	}

	public function media()
	{
		// $this->view->arquivo = $_GET = "";
		$this->render('media');
	}

	public function listar_pedido_retirada()
	{
		$dados = Container::getModel('Pedido');
		$pedido = $dados->listarPedidoRetirada();
		$pedidos = json_encode($pedido);
		echo $pedidos;

		// $this->render('index');
	}

	public function listar_pedido_separacao()
	{
		$dados = Container::getModel('Pedido');
		$pedido = $dados->listarPedidoSeparacao();
		$pedidos = json_encode($pedido);
		echo $pedidos;

		// $this->render('index');
	}


	//Controle

		public function controle()
		{
			$dados = Container::getModel('Pedido');
			$pedido = $dados->listarPedidoRetiradaControle();
			$this->view->dados = $pedido;
			$this->view->listarPedidoSeparacao = $dados->listarPedidoSeparandoControle();
			$this->render('controle');
		}

		public function inserir_pedido()
		{
			$inserir = Container::getModel('Pedido');
			$inserir->__set('numero_pedido', $_POST['numero_pedido']);
			$inserir->inserir_pedido();
			header('Location:/controle ');
		}


	public function mudar_status()
	{
		$status = Container::getModel('Pedido');
		$status->__set('numero_pedido', $_GET['numero_pedido']);
		$status->__set('status', $_GET['status']);
		$status->mudarStatus();
		header('Location:/controle ');
		// print_r($_GET);
	}

	public function excluir()
	{
		$excluir = Container::getModel('Pedido');
		$excluir->__set('numero_pedido', $_GET['numero_pedido']);
		$excluir->excluir();
		header('Location:/controle ');
		// print_r($_GET);
	}

	public function atualizar_video()
	{
		if ($_FILES['arquivo'] && $_FILES['arquivo']['name'] != '') {

			$size['tamanho'] = 2048 * 2048 * 6; // 24Mb
			$extensao_arquivo['extensoes'] = array('mp4');

			$ext = strtolower(substr($_FILES['arquivo']['name'],-4));				
			$new_name = "video" . $ext;
			$dir = './img/'; 
			move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$new_name);

			$atualizar = Container::getModel('Pedido');
			$atualizar->__set('arquivo',$new_name);
			$atualizar->atualizarLogo();
			header('Location:/media?success=success');
		
	
	} else {
		header('Location:/media?error=erro');
	}
		
			$target_dir = "video/";
			$target_file = $target_dir . basename($_FILES["arquivo"]["name"]);
			$size['tamanho'] = 2048 * 2048 * 6; // 24Mb
			$extensao_arquivo['extensoes'] = array('mp4');

			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			if (array_search($extensao, $extensao_arquivo['extensoes']) === false) {
			echo "Por favor, envie arquivo com a extensão mp4";
			header('Location:/media?error=extensao ');
			exit;
			}

			if ($size['tamanho'] < $_FILES['arquivo']['size']) {
			echo "O arquivo enviado é muito grande, envie arquivos de até 24Mb.";
			header('Location:/media?error=size');
				
			} else {
			@move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file);

			$atualizar = Container::getModel('Pedido');
			$atualizar->__set('descricao_video', $_FILES['arquivo']['name']);
			$atualizar->atualizarVideo();
			header('Location:/media?success=success');
		}
		header('Location:/media?error=erro');

	}

	public function listar_video()
	{
		$dados = Container::getModel('Pedido');
		$media = $dados->listarVideo();
		$video = json_encode($media);
		echo $video;

	}

	public function logo()
	{
		$dados = Container::getModel('Pedido');
		$media = $dados->logo();
		$logo = json_encode($media);
		echo $logo;

	}

	public function atualizar_logo()
	{
		
		if ($_FILES['logo'] && $_FILES['logo']['name'] != '') {
				$ext = strtolower(substr($_FILES['logo']['name'],-4));				
				$new_name = "logo" . $ext;
				$dir = './img/'; 
				move_uploaded_file($_FILES['logo']['tmp_name'], $dir.$new_name);

				$atualizar = Container::getModel('Pedido');
				$atualizar->__set('logo',$new_name);
				$atualizar->atualizarLogo();
				header('Location:/media?message=success');
			
		
		} else {
			header('Location:/media?message=error');
		}
		
	}

}


?>