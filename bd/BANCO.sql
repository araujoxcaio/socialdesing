-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Abr-2017 às 03:02
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.0.15

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
  `DESTAQUE` varchar(2) NOT NULL,
  `ID_PESSOA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `ID` int(10) NOT NULL,
  `NOME` varchar(100) NOT NULL,
  `SOBRE` varchar(300) NOT NULL,
  `CPF_CNPJ` varchar(18) NOT NULL,
  `FISICA_JURIDICA` varchar(1) NOT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `SENHA` varchar(50) NOT NULL,
  `DATA_CADASTRO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`ID`, `NOME`, `SOBRE`, `CPF_CNPJ`, `FISICA_JURIDICA`, `TELEFONE`, `EMAIL`, `SENHA`, `DATA_CADASTRO`) VALUES
(1, 'Administrador', 'rem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel ligula viverra dolor sollicitudin semper. Morbi varius mauris a hendrerit viverra. Aliquam eleifend mi elit, et tempus enim feugiat nec. Vivamus at facilisis mauris. Sed vestibulum nibh et lectus pharetra, eu viverra ipsum imperdie', '000.000.000-00', 'J', '(00) 00000-0000', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-03-26'),

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
  `ID_PESSOA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE `vaga` (
  `ID` int(10) NOT NULL,
  `TITULO` varchar(50) NOT NULL,
  `DESCRICAO` varchar(300) NOT NULL,
  `SALARIO` double DEFAULT NULL,
  `CATEGORIA` varchar(50) NOT NULL,
  `LOCALIZACAO` varchar(100) DEFAULT NULL,
  `DATA_VAGA` date NOT NULL,
  `ID_PESSOA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USUARIO` (`ID_PESSOA`);

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
  ADD KEY `FK_USUARIO_PRODUTO` (`ID_PESSOA`);

--
-- Indexes for table `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USUARIO_VAGA` (`ID_PESSOA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagem`
--
ALTER TABLE `imagem`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`ID_PESSOA`) REFERENCES `pessoa` (`ID`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `FK_USUARIO_PRODUTO` FOREIGN KEY (`ID_PESSOA`) REFERENCES `pessoa` (`ID`);

--
-- Limitadores para a tabela `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `FK_USUARIO_VAGA` FOREIGN KEY (`ID_PESSOA`) REFERENCES `pessoa` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
