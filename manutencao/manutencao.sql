-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2016 at 08:58 
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manutencao`
--

-- --------------------------------------------------------

--
-- Table structure for table `hardware`
--

CREATE TABLE `hardware` (
  `id_hardware` int(11) NOT NULL,
  `tipo_hardware` int(11) NOT NULL,
  `marca_hardware` varchar(500) NOT NULL,
  `modelo_hardware` varchar(500) NOT NULL,
  `descricao_hardware` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hardware`
--

INSERT INTO `hardware` (`id_hardware`, `tipo_hardware`, `marca_hardware`, `modelo_hardware`, `descricao_hardware`) VALUES
(15, 5, 'Western Digital', 'WD1600AAJS', 'NÃºmero modelo	WD1600AAJS, WD1600AABS\r\nCapacidade formatada1	160.041 MB\r\nSetores usados por drive	312581808\r\nInterface	300 MB / s Serial ATA 2.0 (compatÃ­vel com Serial ATA 1.0)\r\nBytes por setor	512\r\nDedicado Landing Zone	Sim\r\nAtuador Trava / Auto Park	Sim'),
(18, 1, 'Asus', 'P8H61-M LX2 R2.0', 'Processador:\r\n- Soquete IntelÂ® 1155 para para 3Âª/2Âª geraÃ§Ã£o de processadores Coreâ„¢ i7/Coreâ„¢ i5/Coreâ„¢ i3/PentiumÂ®/CeleronÂ®\r\n- Suporta processadores IntelÂ® de 22 nm\r\n- Suporta a tecnologia IntelÂ® Turbo Boost 2.0\r\n- Suporta IntelÂ® 32 nm\r\n\r\n \r\n\r\nChipset:\r\n- Soquete IntelÂ® H61(B3)\r\n\r\n \r\n\r\nMemÃ³ria:\r\n- MemÃ³ria 2 x DIMM\r\n- MÃ¡ximo de 16GB\r\n- DDR3 2200(O.C.)/2133(O.C.)/2000(O.C.)/1866(O.C.) 1600/1333/1066 MHz Non-ECC, Un-buffered\r\n- Arquitetura de memÃ³ria: Dual Channel\r\n\r\n \r\n\r\nGrÃ¡fico:\r\n- Processador GrÃ¡fico Integrado\r\n- SaÃ­da Multi-VGA: portas DVI-D/RGB -\r\n- Suporta DVI com resoluÃ§Ã£o mÃ¡xima de 1920 por 1200 / 60 Hz\r\n- Suporta RGB com resoluÃ§Ã£o mÃ¡xima de 2048 por 1536 / 75 Hz\r\n- MÃ¡ximo de memÃ³ria compartilhada 1748 MB\r\n\r\n \r\n\r\nSlots de expansÃ£o:\r\n- 1x PCIe 3.0/2.0 x16\r\n- 2x PCIe 2.0 x1\r\n- 1x PCI\r\n\r\n \r\n\r\nArmazenamento:\r\n- 4x Porta(s) SATA 3Gb/s, azul\r\n\r\n \r\n\r\nPortas Painal Traseiro I / O:\r\n- 1x PS/2 teclado (roxo)\r\n- 1x saÃ­da(s) DVI\r\n- 1x saÃ­da(s) D-Sub\r\n- 1x porta(s) LAN (RJ45)\r\n- 6x porta(s) USB 2.0\r\n- 3x entrada(s) de Ã¡udio\r\n\r\n \r\n\r\nPortas Painel Interno I / O:\r\n- 2x entrada(s) USB 2.0, com suporte a 4 portas USB 2.0 adicional(s)\r\n- 1x TPM connector(s)\r\n- 4x conector(es) SATA 3Gb/s\r\n- 1x conector(es) de ventoinha do processador\r\n- 1x conector(es) de ventoinha do chassi\r\n- 1x leitor(es) externo(s) S/PDIF\r\n- 1x conector(es) de forÃ§a EATX de 24 pinos\r\n- 1x conector(es) de forÃ§a ATX 12V de 4 pinos\r\n- 1x conector(es) de Ã¡udio para o painel frontal (AAFP)\r\n- 1x painel(s) do sistema\r\n- 1x mPCIe Combo header(s)'),
(19, 3, 'Kingston', 'kvr133d3n9/4g - 4gb ddr3', '- Kingston\r\n- DDR3 4GB (1 x 4GB)\r\n- 1333MHZ\r\n- CL9 DIMM'),
(20, 4, 'Intel', 'Coreâ„¢ i3-2120 ', '- Fabricante: Intel\r\n- Modelo: BX80623I32120\r\n- Tipo de soquete: LGA 1155Dados TÃ©cnicos:\r\n- Core: Sandy Bridge\r\n- Multi-Core: Dual-Core\r\n- FreqÃ¼Ãªncia de operaÃ§Ã£o: 3.3 GHz\r\n- NCache L2: 2 x 256KB\r\n- Cache L3: 3MB\r\n- Manufacturing Tech: 32 nm\r\n- Suporte 64 bit: Sim\r\n- NÂº de nÃºcleos 2\r\n- NÂº de threads 4EspecificaÃ§Ãµes da memÃ³ria:\r\n- Tipos de memÃ³ria DDR3-1066/1333\r\n- NÂº de canais de memÃ³ria 2\r\n- Largura de banda mÃ¡xima da memÃ³ria 21 GB/s EspecificaÃ§Ãµes grÃ¡ficas:\r\n- GrÃ¡ficos integrado\r\n- GrÃ¡ficos HD IntelÂ®\r\n- IntelÂ® HD Graphics com frequÃªncia dinÃ¢mica\r\n- FrequÃªncia da base grÃ¡fica 850 MHz\r\n- MÃ¡xima frequÃªncia dinÃ¢mica da placa grÃ¡fica 1.1 GHz\r\n- IntelÂ® Quick Sync Video\r\n- IntelÂ® InTRUâ„¢ 3D Technology\r\n- Interface de VÃ­deo FlexÃ­vel IntelÂ® (IntelÂ® FDI)\r\n- Tecnologia de Alta DefiniÃ§Ã£o IntelÂ® Clear Video\r\n- Capaz de exibiÃ§Ã£o dual Tecnologias avanÃ§adas:\r\n- Tecnologia Hyper-Threading IntelÂ®\r\n- Tecnologia de virtualizaÃ§Ã£o IntelÂ® (VT-x)\r\n- IntelÂ® 64\r\n- Estados ociosos\r\n- Tecnologia Enhanced Intel SpeedStepÂ®\r\n- Tecnologias de monitoramento tÃ©rmico\r\nTecnologias avanÃ§adas: - Tecnologia Hyper-Threading IntelÂ® - Tecnologia de virtualizaÃ§Ã£o IntelÂ® (VT-x) - IntelÂ® 64 - Estados ociosos - Tecnologia Enhanced Intel SpeedStepÂ® - Tecnologias de monitoramento tÃ©rmico '),
(21, 2, 'Mymax', 'Fonte High Power 500W ', 'PotÃªncia real: 500W\r\n\r\nSuporte: PCI-E 16X / 8X\r\n\r\nCompatibilidade: ATX 12V V2.31\r\n\r\nFan: 120 mm\r\n\r\nVoltagem: 110 V / 220 V\r\n\r\n   Entrada - AC\r\n   Voltagem: 115V / 230V\r\n   Corrente: 8A/5A\r\n\r\n   SaÃ­da - DC\r\n   Voltagem: +12V / 18.5A\r\n   Corrente: +5V / 2A\r\n\r\n   MÃ¡xima\r\n   Voltagem: 236.5W / 263.5W\r\n   Corrente: 3W / 7W / 12.5W\r\n\r\nEspecificaÃ§Ãµes do Produto:\r\n\r\nDimensÃ£o / Peso: 150 x 86 x 140 mm / 800 gr\r\n\r\nEspecificaÃ§Ãµes da Embalagem:\r\n\r\nDimensÃ£o / Peso: 300 x 100 x 250 mm / 1 Kg\r\n\r\nDimensÃ£o / Peso (Master): 460 x 370 x 370 mm / 10 Kg\r\n\r\nQuantidade (Emb. Master): 10 unids'),
(22, 6, 'EVGA', '04G-P4-2981-KR - GTX 980', 'Interface:\r\n- PCI Express 3.0 x16\r\n\r\nChipset:\r\n- Fabricante: NVIDIA\r\n- GPU: GeForce GTX 980\r\n- NÃºcleo Clock: 1126 MHz\r\n- Boost Clock: 1216 MHz\r\n- CUDA Cores: 2.048\r\n\r\nMemÃ³ria:\r\n- MemÃ³ria efetiva do clock: 7010 MHz\r\n- Tamanho da MemÃ³ria: 4GB\r\n- Interface de MemÃ³ria: 256-Bit\r\n- Tipo de memÃ³ria: GDDR5\r\n\r\nAPI 3D:\r\n- DirectX 12\r\n- OpenGL 4.4\r\n\r\nPortas:\r\n- 1 x HDMI\r\n- 3 x DisplayPort\r\n- 1 x DVI\r\n\r\nGeral:\r\n- ResoluÃ§Ã£o MÃ¡xima: 4096 x 2160\r\n- Suporte SLI\r\n- Refrigerador: Com Fan\r\n- Requisitos do sistema: Fonte de no mÃ­nimo 500W\r\n- Conector de AlimentaÃ§Ã£o: 2 x 6-Pin\r\n- Dual-Link DVI com suporte \r\n'),
(23, 10, 'Positivo', 'MEC/SEED(sem modelo)', 'Gabinete preto\r\n3 baias'),
(24, 4, 'Intel', 'Coreâ„¢2 Quad Q8400 ', 'Status 	End of Life\r\nData de introduÃ§Ã£o 	Q2''09\r\nNÃºmero do processador 	Q8400\r\nCache 	4 MB L2\r\nVelocidade do barramento 	1333 MHz FSB\r\nParidade FSB 	NÃ£o\r\nConjunto de instruÃ§Ãµes 	64-bit\r\nOpÃ§Ãµes integradas disponÃ­veis NÃ£o\r\nLitografia 	45 nm\r\nIntervalo de voltagem VID 	0.8500V-1.3625V');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE `pc` (
  `id_pc` int(11) NOT NULL,
  `tipo_pc` int(11) NOT NULL,
  `setor_pc` int(11) NOT NULL,
  `codigo_pc` int(11) NOT NULL,
  `placa_mae_pc` int(11) NOT NULL,
  `processador_pc` int(11) NOT NULL,
  `memoria_pc` int(11) NOT NULL,
  `fonte_pc` int(11) NOT NULL,
  `hd_pc` int(11) NOT NULL,
  `gabinete_pc` int(11) NOT NULL,
  `off_board_pc` int(11) NOT NULL,
  `descricao_pc` text NOT NULL,
  `memoria_quantia` int(11) NOT NULL,
  `hd_quantia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pc`
--

INSERT INTO `pc` (`id_pc`, `tipo_pc`, `setor_pc`, `codigo_pc`, `placa_mae_pc`, `processador_pc`, `memoria_pc`, `fonte_pc`, `hd_pc`, `gabinete_pc`, `off_board_pc`, `descricao_pc`, `memoria_quantia`, `hd_quantia`) VALUES
(1, 1, 2, 123, 18, 20, 19, 21, 15, 0, 0, '123', 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(11) NOT NULL,
  `nome_setor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setor`
--

INSERT INTO `setor` (`id_setor`, `nome_setor`) VALUES
(2, 'CPD'),
(3, 'Contabilidade'),
(4, 'Tesouraria'),
(5, 'Cadastro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`id_hardware`);

--
-- Indexes for table `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id_pc`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hardware`
--
ALTER TABLE `hardware`
  MODIFY `id_hardware` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pc`
--
ALTER TABLE `pc`
  MODIFY `id_pc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
