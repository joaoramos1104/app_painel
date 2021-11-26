<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['paine'] = array(
			'route' => '/painel',
			'controller' => 'indexController',
			'action' => 'painel'
		);

		$routes['media'] = array(
			'route' => '/media',
			'controller' => 'indexController',
			'action' => 'media'
		);

		$routes['listar_video'] = array(
			'route' => '/listar_video',
			'controller' => 'indexController',
			'action' => 'listar_video'
		);

		$routes['atualizar_video'] = array(
			'route' => '/atualizar_video',
			'controller' => 'indexController',
			'action' => 'atualizar_video'
		);

		$routes['logo'] = array(
			'route' => '/logo',
			'controller' => 'indexController',
			'action' => 'logo'
		);

		$routes['atualizar_logo'] = array(
			'route' => '/atualizar_logo',
			'controller' => 'indexController',
			'action' => 'atualizar_logo'
		);

		$routes['listar_pedido_retirada'] = array(
			'route' => '/listar_pedido_retirada',
			'controller' => 'indexController',
			'action' => 'listar_pedido_retirada'
		);

		$routes['listar_pedido_separacao'] = array(
			'route' => '/listar_pedido_separacao',
			'controller' => 'indexController',
			'action' => 'listar_pedido_separacao'
		);

		$routes['controle'] = array(
			'route' => '/controle',
			'controller' => 'indexController',
			'action' => 'controle'
		);

		$routes['inserir_pedido'] = array(
			'route' => '/inserir_pedido',
			'controller' => 'indexController',
			'action' => 'inserir_pedido'
		);

		$routes['mudar_status'] = array(
			'route' => '/mudar_status',
			'controller' => 'indexController',
			'action' => 'mudar_status'
		);

		$routes['excluir'] = array(
			'route' => '/excluir',
			'controller' => 'indexController',
			'action' => 'excluir'
		);

		$routes['controle_lista_pedido_retirada'] = array(
			'route' => '/controle_lista_pedido_retirada',
			'controller' => 'indexController',
			'action' => 'controle_lista_pedido_retirada'
		);

		$routes['controle_lista_pedido_separando'] = array(
			'route' => '/controle_lista_pedido_separacao',
			'controller' => 'indexController',
			'action' => 'controle_lista_pedido_separacao'
		);

		$this->setRoutes($routes);
	}

}

?>