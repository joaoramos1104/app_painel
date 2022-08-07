CREATE DATABASE IF NOT EXISTS `painel` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `painel`;

DROP TABLE IF EXISTS `tb_status`;
CREATE TABLE IF NOT EXISTS `tb_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO_STATUS` int(11) NOT NULL,
  `DESCRICAO` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tb_status` (`ID`, `CODIGO_STATUS`, `DESCRICAO`) VALUES
(1, '1', 'EM SEPARAÇÃO'),
(2, '2', 'AGUARDANDO RETIRADA'),
(3, '3', 'FINALIZADO'),
(4, '4', 'CANCELADO');

DROP TABLE IF EXISTS `tb_pedido`;
CREATE TABLE IF NOT EXISTS `tb_pedido` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NUMERO_PEDIDO` varchar(20) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tb_media`;
CREATE TABLE `tb_media` (
  `descricao_video` LONGTEXT NOT NULL);
  
  INSERT INTO tb_media VALUES('video.mp4');

  DROP TABLE IF EXISTS `tb_logo`;
CREATE TABLE `tb_logo` (
  `logo` LONGTEXT NOT NULL);
  
  INSERT INTO tb_logo VALUES('logo.png');

ALTER TABLE `tb_pedido` 
ADD INDEX `FK_STATUS_PEDIDO_idx` (`STATUS` ASC);
;
ALTER TABLE `tb_pedido` 
ADD CONSTRAINT `FK_STATUS_PEDIDO`
  FOREIGN KEY (`STATUS`)
  REFERENCES `tb_status` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  