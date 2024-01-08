-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 03:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nus_test3`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientarchieve`
--

CREATE TABLE `clientarchieve` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `clientcompany` varchar(200) NOT NULL,
  `state` enum('Active','Archieved','Cancelled') NOT NULL,
  `user` varchar(200) NOT NULL,
  `datevalue` date NOT NULL,
  `description` mediumtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clientcompanydata`
--

CREATE TABLE `clientcompanydata` (
  `id` int(11) NOT NULL,
  `parentcompany` varchar(255) NOT NULL,
  `clientcompany` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `serialno` int(11) NOT NULL DEFAULT 0,
  `state` enum('Active','Archived','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enter_trade`
--

CREATE TABLE `enter_trade` (
  `tradeId` int(11) NOT NULL,
  `parentId` varchar(50) DEFAULT NULL,
  `clientId` int(11) DEFAULT NULL,
  `supplycontractid` varchar(128) DEFAULT NULL,
  `mw` float(10,2) DEFAULT NULL,
  `mwh` varchar(30) DEFAULT NULL,
  `percentage` varchar(30) DEFAULT NULL,
  `tradevolume` varchar(50) DEFAULT NULL,
  `baseload` float(10,2) DEFAULT NULL,
  `effectiveprice` float(10,2) DEFAULT NULL,
  `trade` varchar(30) DEFAULT NULL,
  `tradevalue` varchar(20) DEFAULT NULL,
  `tradingId` int(11) DEFAULT NULL,
  `nustradeId` int(11) DEFAULT NULL,
  `tradeDate` varchar(30) DEFAULT NULL,
  `quartval` varchar(30) DEFAULT NULL,
  `tradequarvol` varchar(30) DEFAULT NULL,
  `tradeexecuted` enum('Executed','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nususerdata`
--

CREATE TABLE `nususerdata` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `accountstatus` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `parentcompany` varchar(100) DEFAULT NULL,
  `bussinessunit` varchar(255) DEFAULT NULL,
  `active` enum('Active','Inactive') NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nususerdata`
--

INSERT INTO `nususerdata` (`id`, `role`, `username`, `emailId`, `accountstatus`, `password`, `parentcompany`, `bussinessunit`, `active`, `created_time`) VALUES
(1, 'Admin', 'NUSADMIN', 'admin1@nusconsulting.com', 'Confirmed', '$argon2i$v=19$m=65536,t=4,p=1$bUNqNmVGb2lTUDRvUmhjbQ$WIKpouX2l+YA9t4xPrmYRxQAOijxd+XdNYUp76e3IeU', '', '', 'Active', '2023-07-03 09:08:45'),
(12, 'NUS Manager', 'luffy', 'luffy@onepiece.com', 'Confirmed', '$argon2i$v=19$m=65536,t=4,p=1$bUNqNmVGb2lTUDRvUmhjbQ$WIKpouX2l+YA9t4xPrmYRxQAOijxd+XdNYUp76e3IeU', '', '', 'Active', '2023-07-04 15:38:41'),
(13, 'NUS User', 'zoro', 'zoro@onepiece.com', 'Confirmed', '$argon2i$v=19$m=65536,t=4,p=1$bUNqNmVGb2lTUDRvUmhjbQ$WIKpouX2l+YA9t4xPrmYRxQAOijxd+XdNYUp76e3IeU', '', '', 'Active', '2023-07-04 15:39:06'),
(14, 'Parent company', 'Vijay', 'vijaygowda973012@gmail.com', 'Confirmed', '$argon2i$v=19$m=65536,t=4,p=1$bUNqNmVGb2lTUDRvUmhjbQ$WIKpouX2l+YA9t4xPrmYRxQAOijxd+XdNYUp76e3IeU', '10', '', 'Active', '2023-07-28 12:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `nus_calendermonth`
--

CREATE TABLE `nus_calendermonth` (
  `monthId` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `clicks` int(11) NOT NULL,
  `TradeId` int(11) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nus_calenderquarter`
--

CREATE TABLE `nus_calenderquarter` (
  `querterid` int(11) NOT NULL,
  `quarters` varchar(50) NOT NULL,
  `clicks` int(11) NOT NULL,
  `tradeid` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `yearoftrade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nus_calenderyear`
--

CREATE TABLE `nus_calenderyear` (
  `calenderId` int(11) NOT NULL,
  `calenderyear` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `tradeId` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `timeperiod` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nus_countries`
--

CREATE TABLE `nus_countries` (
  `countryId` int(11) NOT NULL,
  `countryName` varchar(255) NOT NULL,
  `addedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nus_countries`
--

INSERT INTO `nus_countries` (`countryId`, `countryName`, `addedOn`) VALUES
(1, 'India', '2022-05-19 13:20:42'),
(2, 'Sri Lanka', '2022-05-19 13:20:42'),
(3, 'United Kingdom', '2022-07-20 15:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `nus_currencies`
--

CREATE TABLE `nus_currencies` (
  `id` tinyint(4) NOT NULL,
  `currencies` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nus_currencies`
--

INSERT INTO `nus_currencies` (`id`, `currencies`) VALUES
(3, 'AUD'),
(4, 'CAD'),
(5, 'CHF'),
(6, 'CZK'),
(12, 'DKK'),
(2, 'EUR'),
(7, 'GBP'),
(8, 'HUF'),
(9, 'PLN'),
(10, 'SEK'),
(11, 'SGD'),
(1, 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `nus_electricity_index`
--

CREATE TABLE `nus_electricity_index` (
  `id` tinyint(4) NOT NULL,
  `country` varchar(30) NOT NULL,
  `indexlist` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nus_electricity_index`
--

INSERT INTO `nus_electricity_index` (`id`, `country`, `indexlist`) VALUES
(1, 'Australia', 'ASX'),
(2, 'Austria', 'EEX'),
(3, 'Croatia', 'Hudex'),
(4, 'Czechia', 'EEX-PXE'),
(5, 'Denmark', 'Nasdaq OMX'),
(6, 'Finland', 'Nasdaq OMX'),
(7, 'France', 'EEX'),
(8, 'Germany', 'EEX'),
(9, 'Hungary', 'EEX-PXE'),
(10, 'Hungary', 'PXE'),
(11, 'International', 'Financial Hedging'),
(12, 'Italy', 'EEX'),
(13, 'Netherlands - Belgium', 'Ice Endex'),
(14, 'Norway', 'Nasdaq OMX'),
(15, 'Poland', 'TGE (EFM)'),
(16, 'Romania', 'OPCOM'),
(17, 'Slovakia', 'EEX-PXE'),
(18, 'Slovenia', 'EEX-PXE'),
(19, 'Spain & Portugal', 'OMIP'),
(20, 'Sweden', 'Nasdaq OMX'),
(21, 'Switzerland', 'EEX'),
(22, 'UK', 'Futures - ICE'),
(23, 'UK', 'N2EX Day-Ahead'),
(24, 'UK', 'OTC - NBP'),
(25, 'USA', 'CAISO NP-15'),
(26, 'USA', 'CAISO SP-15'),
(27, 'USA', 'ERCOT North or Houston'),
(28, 'USA', 'Illinois Hub (MISO)'),
(29, 'USA', 'NEPOOL Internal Hub'),
(30, 'USA', 'NYISO Zone J (NYC area)'),
(31, 'USA', 'PJM Western Hub');

-- --------------------------------------------------------

--
-- Table structure for table `nus_naturalgas_index`
--

CREATE TABLE `nus_naturalgas_index` (
  `id` tinyint(4) NOT NULL,
  `country` varchar(30) NOT NULL,
  `indexlist` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nus_naturalgas_index`
--

INSERT INTO `nus_naturalgas_index` (`id`, `country`, `indexlist`) VALUES
(1, 'Austria', 'CEGH VTP'),
(2, 'Austria', 'PEGAS/CEGH VTP'),
(3, 'Croatia', 'Argus Day Ahead TTF'),
(4, 'Czech', 'CZ VTP'),
(5, 'Denmark', 'ETF'),
(6, 'France', 'PEG'),
(7, 'Germany - Switzerland', 'THE/PEGAS'),
(8, 'Hungary', 'CEEGEX'),
(9, 'International', 'Financial Hedging'),
(10, 'Italy', 'PSV'),
(11, 'Netherlands', 'TTF'),
(12, 'Norway', 'ETF'),
(13, 'Poland', 'TGE (GFM)'),
(14, 'Romania', 'OPCOM'),
(15, 'Spain & Portugal', 'MIBGAS'),
(16, 'Sweden', 'ETF'),
(17, 'UK', 'Futures - ICE'),
(18, 'UK', 'Heren Day-Ahead'),
(19, 'UK', 'OTC - NBP'),
(20, 'USA', 'NYMEX'),
(21, 'USA & Mexico', 'HSC [Houston Ship Channel]');

-- --------------------------------------------------------

--
-- Table structure for table `nus_pricing_mechanisam`
--

CREATE TABLE `nus_pricing_mechanisam` (
  `priMechId` int(11) NOT NULL,
  `pricingMechName` varchar(128) NOT NULL,
  `priceMechDesc` varchar(255) NOT NULL,
  `addedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nus_pricing_mechanisam`
--

INSERT INTO `nus_pricing_mechanisam` (`priMechId`, `pricingMechName`, `priceMechDesc`, `addedOn`) VALUES
(1, 'Day Ahead', 'Spot Daily Market', '2022-05-23 13:07:28'),
(2, 'Day Ahead', 'Spot Average for month', '2022-05-23 13:08:14'),
(3, 'Month Ahead', 'Last Value', '2022-05-23 13:08:14'),
(4, 'Month Ahead', 'Average Value', '2022-05-23 13:09:07'),
(5, 'Quarter Ahead', 'Last Value', '2022-05-23 13:09:07'),
(6, 'Quarter Ahead', 'Average Value', '2022-05-23 13:09:46'),
(7, 'Calendar Ahead', 'Last Value', '2022-05-23 13:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `nus_season`
--

CREATE TABLE `nus_season` (
  `seasonId` int(11) NOT NULL,
  `tradeId` int(11) NOT NULL,
  `yeartrade` int(11) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `season` varchar(30) NOT NULL,
  `clicks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nus_supply_archieve`
--

CREATE TABLE `nus_supply_archieve` (
  `id` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `state` enum('Active','Archived','Cancelled') NOT NULL,
  `user` varchar(200) NOT NULL,
  `datevalue` date NOT NULL,
  `description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nus_supply_contract`
--

CREATE TABLE `nus_supply_contract` (
  `supplierId` int(11) NOT NULL,
  `parentId` varchar(100) DEFAULT NULL,
  `clientId` int(11) DEFAULT NULL,
  `contract_id` varchar(128) DEFAULT NULL,
  `countryName` varchar(64) DEFAULT NULL,
  `commodityName` varchar(64) DEFAULT NULL,
  `commodityUnits` varchar(32) DEFAULT NULL,
  `supplyName` varchar(255) DEFAULT NULL,
  `contractType` varchar(32) DEFAULT NULL,
  `contractIndexId` varchar(64) DEFAULT NULL,
  `contractTermfromDate` date DEFAULT NULL,
  `contractTermtoDate` date DEFAULT NULL,
  `commodityPrice` float(10,2) DEFAULT 0.00,
  `totalAnualConsumption` varchar(30) DEFAULT NULL,
  `totlconsumption` varchar(50) DEFAULT NULL,
  `allmonts` text DEFAULT NULL,
  `contractpricetype` varchar(30) DEFAULT NULL,
  `indexStructureType` varchar(64) DEFAULT NULL,
  `consumMinsize` varchar(64) DEFAULT NULL,
  `clickTrancheminsize` int(11) DEFAULT NULL,
  `openPrizemechanism` varchar(255) DEFAULT NULL,
  `contractstatus` varchar(16) NOT NULL DEFAULT 'A',
  `consumptionmonth` text DEFAULT NULL,
  `hedgeconsumption` text DEFAULT NULL,
  `openconsumption` text DEFAULT NULL,
  `basegenconsumption` text DEFAULT NULL,
  `effectcon` text DEFAULT NULL,
  `state` enum('Active','Archived','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nus_tradeexecuted_state`
--

CREATE TABLE `nus_tradeexecuted_state` (
  `id` int(11) NOT NULL,
  `trade_id` int(11) NOT NULL,
  `state` varchar(15) NOT NULL,
  `user` varchar(20) NOT NULL,
  `datevalue` date NOT NULL,
  `description` mediumtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nus_tradeperiods`
--

CREATE TABLE `nus_tradeperiods` (
  `tradePerId` int(11) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `periodsId` varchar(128) DEFAULT NULL,
  `clicktracnches` int(11) DEFAULT NULL,
  `clicktranches` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nus_trade_periods_list`
--

CREATE TABLE `nus_trade_periods_list` (
  `tPeriodsId` int(11) NOT NULL,
  `periodsName` varchar(128) NOT NULL,
  `addedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parentarchieved`
--

CREATE TABLE `parentarchieved` (
  `id` int(11) NOT NULL,
  `parentcompany` varchar(120) NOT NULL,
  `clientid` int(11) NOT NULL,
  `supplier_Id` int(11) NOT NULL,
  `state` enum('Active','Archived','Cancelled') NOT NULL,
  `datevalue` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user` varchar(40) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parentcompanydata`
--

CREATE TABLE `parentcompanydata` (
  `id` int(11) NOT NULL,
  `parentcompany` varchar(255) NOT NULL,
  `state` enum('Active','Archived','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientarchieve`
--
ALTER TABLE `clientarchieve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientcompanydata`
--
ALTER TABLE `clientcompanydata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enter_trade`
--
ALTER TABLE `enter_trade`
  ADD PRIMARY KEY (`tradeId`);

--
-- Indexes for table `nususerdata`
--
ALTER TABLE `nususerdata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`emailId`),
  ADD UNIQUE KEY `username_2` (`username`,`emailId`),
  ADD UNIQUE KEY `username_3` (`username`),
  ADD UNIQUE KEY `emailId` (`emailId`);

--
-- Indexes for table `nus_calendermonth`
--
ALTER TABLE `nus_calendermonth`
  ADD PRIMARY KEY (`monthId`);

--
-- Indexes for table `nus_calenderquarter`
--
ALTER TABLE `nus_calenderquarter`
  ADD PRIMARY KEY (`querterid`);

--
-- Indexes for table `nus_calenderyear`
--
ALTER TABLE `nus_calenderyear`
  ADD PRIMARY KEY (`calenderId`);

--
-- Indexes for table `nus_countries`
--
ALTER TABLE `nus_countries`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `nus_currencies`
--
ALTER TABLE `nus_currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies` (`currencies`);

--
-- Indexes for table `nus_electricity_index`
--
ALTER TABLE `nus_electricity_index`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nus_naturalgas_index`
--
ALTER TABLE `nus_naturalgas_index`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nus_pricing_mechanisam`
--
ALTER TABLE `nus_pricing_mechanisam`
  ADD PRIMARY KEY (`priMechId`);

--
-- Indexes for table `nus_season`
--
ALTER TABLE `nus_season`
  ADD PRIMARY KEY (`seasonId`);

--
-- Indexes for table `nus_supply_archieve`
--
ALTER TABLE `nus_supply_archieve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nus_supply_contract`
--
ALTER TABLE `nus_supply_contract`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `nus_tradeexecuted_state`
--
ALTER TABLE `nus_tradeexecuted_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nus_tradeperiods`
--
ALTER TABLE `nus_tradeperiods`
  ADD PRIMARY KEY (`tradePerId`);

--
-- Indexes for table `nus_trade_periods_list`
--
ALTER TABLE `nus_trade_periods_list`
  ADD PRIMARY KEY (`tPeriodsId`);

--
-- Indexes for table `parentarchieved`
--
ALTER TABLE `parentarchieved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parentcompanydata`
--
ALTER TABLE `parentcompanydata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parentcompany` (`parentcompany`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientarchieve`
--
ALTER TABLE `clientarchieve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientcompanydata`
--
ALTER TABLE `clientcompanydata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enter_trade`
--
ALTER TABLE `enter_trade`
  MODIFY `tradeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nususerdata`
--
ALTER TABLE `nususerdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nus_calendermonth`
--
ALTER TABLE `nus_calendermonth`
  MODIFY `monthId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nus_calenderquarter`
--
ALTER TABLE `nus_calenderquarter`
  MODIFY `querterid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nus_calenderyear`
--
ALTER TABLE `nus_calenderyear`
  MODIFY `calenderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nus_currencies`
--
ALTER TABLE `nus_currencies`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nus_electricity_index`
--
ALTER TABLE `nus_electricity_index`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `nus_naturalgas_index`
--
ALTER TABLE `nus_naturalgas_index`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nus_season`
--
ALTER TABLE `nus_season`
  MODIFY `seasonId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nus_supply_archieve`
--
ALTER TABLE `nus_supply_archieve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nus_supply_contract`
--
ALTER TABLE `nus_supply_contract`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nus_tradeexecuted_state`
--
ALTER TABLE `nus_tradeexecuted_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nus_tradeperiods`
--
ALTER TABLE `nus_tradeperiods`
  MODIFY `tradePerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nus_trade_periods_list`
--
ALTER TABLE `nus_trade_periods_list`
  MODIFY `tPeriodsId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parentarchieved`
--
ALTER TABLE `parentarchieved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parentcompanydata`
--
ALTER TABLE `parentcompanydata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
