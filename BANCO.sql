-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Mar-2017 às 22:29
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u619293682_sodes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `ID` int(10) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `DESCRICAO` varchar(150) NOT NULL,
  `CATEGORIA` varchar(50) NOT NULL,
  `URL` varchar(50) NOT NULL,
  `DATA_UPLOAD` date NOT NULL,
  `USUARIO_UPLOAD` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `ID` int(10) NOT NULL,
  `NOME` varchar(100) NOT NULL,
  `CPF_CNPJ` varchar(14) NOT NULL,
  `FISICA_JURIDICA` varchar(1) NOT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `SENHA` varchar(50) NOT NULL,
  `DATA_CADASTRO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `ID` int(10) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `DESCRICAO` varchar(150) NOT NULL,
  `CATEGORIA` varchar(50) NOT NULL,
  `URL_IMAGEM` varchar(50) NOT NULL,
  `URL_ARQUIVO` varchar(50) NOT NULL,
  `DATA_UPLOAD` date NOT NULL,
  `USUARIO_UPLOAD` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE `vaga` (
  `ID` int(10) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `DESCRICAO` varchar(150) NOT NULL,
  `SALARIO` double DEFAULT NULL,
  `CATEGORIA` varchar(50) NOT NULL,
  `LOCALIZACAO` varchar(100) DEFAULT NULL,
  `DATA_VAGA` date NOT NULL,
  `USUARIO_VAGA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USUARIO` (`USUARIO_UPLOAD`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USUARIO_PRODUTO` (`USUARIO_UPLOAD`);

--
-- Indexes for table `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USUARIO_VAGA` (`USUARIO_VAGA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagem`
--
ALTER TABLE `imagem`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`USUARIO_UPLOAD`) REFERENCES `pessoa` (`ID`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `FK_USUARIO_PRODUTO` FOREIGN KEY (`USUARIO_UPLOAD`) REFERENCES `pessoa` (`ID`);

--
-- Limitadores para a tabela `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `FK_USUARIO_VAGA` FOREIGN KEY (`USUARIO_VAGA`) REFERENCES `pessoa` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
