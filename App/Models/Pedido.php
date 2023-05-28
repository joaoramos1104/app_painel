<?php

namespace App\Models;

use MF\Model\Model;

class Pedido extends Model {

	private $id;
	private $numero_pedido;
	private $status;
	private $descricao_video;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	// //listar
	public function ListarPedidoRetirada() {

		$query = "SELECT id, numero_pedido FROM tb_pedido WHERE status = 2 LIMIT 10";

		$stmt = $this->db->query($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function ListarPedidoSeparacao()
	{

		$query = "SELECT id, numero_pedido FROM tb_pedido WHERE status = 1 LIMIT 10";

		$stmt = $this->db->query($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function ListarPedidoRetiradaControle()
	{

		$query = "SELECT id, numero_pedido FROM tb_pedido WHERE status = 2";

		$stmt = $this->db->query($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function ListarPedidoSeparandoControle()
	{

		$query = "SELECT id, numero_pedido FROM tb_pedido WHERE status = 1";

		$stmt = $this->db->query($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function inserir_pedido()
	{

		$query = " INSERT INTO tb_pedido (numero_pedido) VALUES (:numero_pedido)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':numero_pedido', $this->__get('numero_pedido'));
		$stmt->execute();
		return $this;
	}

	public function mudarStatus()
	{

		$query = " UPDATE tb_pedido SET status = :status WHERE id = :id ";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->bindValue(':status', $this->__get('status'));
		$stmt->execute();
		return $this;
	}


	public function retirarPedido()
	{

		$query = "	UPDATE tb_pedido SET status = :status WHERE id = :id;
					INSERT INTO tb_pedido_retirado (id_pedido, user_liberacao, placa_veiculo, tipo_veiculo, responsavel_veiculo, telefone, data_retirada)
					VALUES (:id, :user_liberacao, :placa_veiculo, :tipo_veiculo, :responsavel_veiculo, :telefone, CURRENT_TIMESTAMP());";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->bindValue(':status', $this->__get('status'));

		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->bindValue(':user_liberacao', $this->__get('user_liberacao'));
		$stmt->bindValue(':placa_veiculo', $this->__get('placa_veiculo'));
		$stmt->bindValue(':tipo_veiculo', $this->__get('tipo_veiculo'));
		$stmt->bindValue(':responsavel_veiculo', $this->__get('nome_responsavel'));
		$stmt->bindValue(':telefone', $this->__get('telefone'));
		$stmt->execute();
		return $this;
	}


	public function excluir()
	{

		$query = " DELETE FROM tb_pedido WHERE id = :numero_pedido;";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':numero_pedido', $this->__get('numero_pedido'));
		$stmt->execute();
		return $this;
	}

	public function atualizarVideo()
	{
		$query = " UPDATE tb_media SET descricao_video = :descricao_video";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':descricao_video', $this->__get('descricao_video'));
		$stmt->execute();
		return $this;
	}

	public function listarVideo()
	{
		$query = "SELECT * FROM tb_media";
		$stmt = $this->db->query($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function logo()
	{
		$query = "SELECT * FROM tb_logo";
		$stmt = $this->db->query($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	public function atualizarlogo()
	{
		$query = " UPDATE tb_logo SET logo = :logo";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':logo', $this->__get('logo'));
		$stmt->execute();
		return $this;
	}

}
