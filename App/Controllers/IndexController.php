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
		
			$target_dir = "video/";
			$target_file = $target_dir . basename($_FILES["arquivo"]["name"]);
			$size['tamanho'] = 2048 * 2048 * 6; // 24Mb
			$extensao_arquivo['extensoes'] = array('mp4');

			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			if (array_search($extensao, $extensao_arquivo['extensoes']) === false) {
			echo "Por favor, envie arquivo com a extensão mp4";
			header('Location:/media?error=extensao ');
			// $this->view->arquivo = "Por favor, envie arquivo com a extensão mp4";
			// $this->render('media');
				exit;
			}

			if ($size['tamanho'] < $_FILES['arquivo']['size']) {
			echo "O arquivo enviado é muito grande, envie arquivos de até 24Mb.";
			header('Location:/media?error=size');
			// $this->view->arquivo = "O arquivo enviado é muito grande, envie arquivos de até 24Mb.";
			// $this->render('media');
				
			} else {
			@move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file);

			$atualizar = Container::getModel('Pedido');
			$atualizar->__set('descricao_video', $_FILES['arquivo']['name']);
			$atualizar->atualizarVideo();
			header('Location:/media');

		}

	}

	public function listar_video()
	{
		$dados = Container::getModel('Pedido');
		$media = $dados->listarVideo();
		$video = json_encode($media);
		echo $video;


		// $this->render('index');
	}

	public function controle_lista_pedido_retirada()
	{
		// $dados = Container::getModel('Pedido');
		// $pedido = $dados->listarPedidoSeparando();
		// $pedidos = json_encode($pedido);
		// echo $pedidos;


		// $this->render('index');
	}

	public function controle_lista_pedido_separando()
	{
		// $dados = Container::getModel('Pedido');
		// $pedido = $dados->listarPedidoSeparando();
		// $pedidos = json_encode($pedido);
		// echo $pedidos;


		// $this->render('index');
	}

	}


?>