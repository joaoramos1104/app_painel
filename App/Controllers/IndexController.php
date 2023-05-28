<?php

namespace App\Controllers;

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
			$item = json_encode($inserir);
			echo $item;
			// return $this;

			// header('Location:/controle ');
		}


	public function mudar_status()
	{
		$status = Container::getModel('Pedido');
		$status->__set('id', $_POST['id_pedido']);
		$status->__set('status', $_POST['status']);
		$status->mudarStatus();

		$item = json_encode($status);
		echo $item;
		// header('Location:/controle ');
	}

	public function retirar_pedido()
	{
		$status = Container::getModel('Pedido');
		$status->__set('id', $_POST['id_pedido']);
		$status->__set('status', $_POST['status']);
		$status->__set('user_liberacao', $_POST['user']);
		$status->__set('nome_responsavel', $_POST['nome_responsavel']);
		$status->__set('telefone', $_POST['telefone']);
		$status->__set('placa_veiculo', $_POST['placa_veiculo']);
		$status->__set('tipo_veiculo', $_POST['tipo_veiculo']);
		$status->retirarPedido();
		header('Location:/controle ');
	}

	public function excluir()
	{
		$excluir = Container::getModel('Pedido');
		$excluir->__set('numero_pedido', $_GET['numero_pedido']);
		$excluir->excluir();
		header('Location:/controle ');
	}

	public function atualizar_video()
	{
		if ($_FILES['arquivo'] && $_FILES['arquivo']['name'] != '') {

			$size['tamanho'] = 2048 * 2048 * 6; // 24Mb
			$extensao_arquivo['extensao'] = array('mp4');

			$ext = strtolower(substr($_FILES['arquivo']['name'],-4));				
			$new_name = "video" . $ext;
			$dir = './video/'; 


			if (array_search($ext, $extensao_arquivo['extensao']) === false) {
				header('Location:/media?error=extensao ');
			}

			if ($_FILES['arquivo']['size'] > $size['tamanho']) {
				header('Location:/media?error=size');
			}

			move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$new_name);

			$atualizar = Container::getModel('Pedido');
			$atualizar->__set('descricao_video',$new_name);
			$atualizar->atualizarVideo();
			header('Location:/media?success=success');
		
		
		} else {
			header('Location:/media?error=erro');
		}
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