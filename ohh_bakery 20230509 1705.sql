-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.22-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema ohh_bakery
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ ohh_bakery;
USE ohh_bakery;

--
-- Table structure for table `ohh_bakery`.`app_notification`
--

DROP TABLE IF EXISTS `app_notification`;
CREATE TABLE `app_notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pur_no` varchar(50) NOT NULL,
  `notif_date` datetime DEFAULT NULL,
  `sender_id` varchar(50) NOT NULL DEFAULT '0',
  `sender_type` int(11) NOT NULL DEFAULT '0',
  `receiver_id` varchar(50) NOT NULL DEFAULT '0',
  `receiver_type` int(11) NOT NULL DEFAULT '0',
  `notif_type` int(11) NOT NULL DEFAULT '0',
  `is_read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`app_notification`
--

/*!40000 ALTER TABLE `app_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_notification` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`app_supplier`
--

DROP TABLE IF EXISTS `app_supplier`;
CREATE TABLE `app_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`app_supplier`
--

/*!40000 ALTER TABLE `app_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_supplier` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ci_session`
--

DROP TABLE IF EXISTS `ci_session`;
CREATE TABLE `ci_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`ci_session`
--

/*!40000 ALTER TABLE `ci_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_session` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_user_id` varchar(100) DEFAULT NULL,
  `device_user_type` enum('1','2') DEFAULT NULL COMMENT '1 = buyer, 2 = seller',
  `device_platform` enum('ios','android') DEFAULT NULL,
  `device_uuid` varchar(255) DEFAULT NULL,
  `device_app_version` varchar(10) DEFAULT NULL,
  `device_fcm_token` varchar(255) DEFAULT NULL,
  `device_model` varchar(100) DEFAULT NULL,
  `device_os` varchar(5) DEFAULT NULL,
  `device_status` enum('1','0','99') DEFAULT '1',
  `device_createddate` datetime DEFAULT NULL,
  PRIMARY KEY (`device_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`devices`
--

/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`product_master`
--

DROP TABLE IF EXISTS `product_master`;
CREATE TABLE `product_master` (
  `ITEMID` int(11) DEFAULT NULL,
  `ITEMCODE` varchar(100) DEFAULT NULL,
  `ITEMCODEALIAS` varchar(100) DEFAULT NULL,
  `ITEMNAME` varchar(250) DEFAULT NULL,
  `ITEMNAMEALIAS` varchar(250) DEFAULT NULL,
  `ITEMDEPTID` int(11) DEFAULT NULL,
  `ITEMDEPTNAME` varchar(35) DEFAULT NULL,
  `ITEMCURRENCY` varchar(3) DEFAULT NULL,
  `ITEMPRODUCTCATEGORYID` int(11) DEFAULT NULL,
  `ITEMPRODUCTCATEGORYNAME` varchar(50) DEFAULT NULL,
  `ITEMMASTERVENDORID` int(11) DEFAULT NULL,
  `ITEMSELLINGPRICE` double DEFAULT NULL,
  `ITEMBUYINGPRICE` double DEFAULT NULL,
  `ITEMBUYINGPRICEREAL` double DEFAULT NULL,
  `ITEMCOSTOFGOODSSOLD` double DEFAULT NULL,
  `ITEMLASTBUYINGCURRENCY` varchar(3) DEFAULT NULL,
  `ITEMTOTALVALUE` double DEFAULT NULL,
  `ITEMREORDERPOINT` double DEFAULT NULL,
  `ITEMREORDERQTY` double DEFAULT NULL,
  `ITEMQTYONHAND` double DEFAULT NULL,
  `ITEMISINVENTORY` varchar(1) DEFAULT NULL,
  `ITEMISBUY` varchar(1) DEFAULT NULL,
  `ITEMISSALE` varchar(1) DEFAULT NULL,
  `ITEMISAUTOBUILD` varchar(1) DEFAULT NULL,
  `ITEMCOGSMETHOD` int(11) DEFAULT NULL,
  `ITEMISNOTACTIVE` varchar(1) DEFAULT NULL,
  `ITEMWAREHOUSEID` int(11) DEFAULT NULL,
  `ITEMWAREHOUSECODE` varchar(15) DEFAULT NULL,
  `ITEMWAREHOUSENAME` varchar(255) DEFAULT NULL,
  `ITEMDEFAULT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMDEFAULT_UOM_CODE` varchar(15) DEFAULT NULL,
  `ITEMPURCHASETAXID1` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID2` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID3` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID4` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID5` int(11) DEFAULT NULL,
  `ITEMSALESTAXID1` int(11) DEFAULT NULL,
  `ITEMSALESTAXID2` int(11) DEFAULT NULL,
  `ITEMSALESTAXID3` int(11) DEFAULT NULL,
  `ITEMSALESTAXID4` int(11) DEFAULT NULL,
  `ITEMSALESTAXID5` int(11) DEFAULT NULL,
  `ITEMLENGTH` double DEFAULT NULL,
  `ITEMWIDTH` double DEFAULT NULL,
  `ITEMHEIGHT` double DEFAULT NULL,
  `ITEMWEIGHT` double DEFAULT NULL,
  `ITEMNOTES` mediumtext,
  `ITEMPICTURE` mediumblob,
  `ITEMISCONSIGNMENT` varchar(1) DEFAULT NULL,
  `ITEMREPORT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMGROUPID1` int(11) DEFAULT NULL,
  `ITEMGROUPID2` int(11) DEFAULT NULL,
  `ITEMGROUPID3` int(11) DEFAULT NULL,
  `ITEMGROUPID4` int(11) DEFAULT NULL,
  `ITEMGROUPCODE1` varchar(35) DEFAULT NULL,
  `ITEMGROUPCODE2` varchar(35) DEFAULT NULL,
  `ITEMGROUPCODE3` varchar(35) DEFAULT NULL,
  `ITEMGROUPCODE4` varchar(35) DEFAULT NULL,
  `ITEMGROUPNAME1` varchar(150) DEFAULT NULL,
  `ITEMGROUPNAME2` varchar(150) DEFAULT NULL,
  `ITEMGROUPNAME3` varchar(150) DEFAULT NULL,
  `ITEMGROUPNAME4` varchar(150) DEFAULT NULL,
  `ITEMISUSESERIALNO` varchar(1) DEFAULT NULL,
  `ITEMSELLINGPRICEMETHOD` smallint(6) DEFAULT NULL,
  `ITEMISUSELOTNUMBER` varchar(1) DEFAULT NULL,
  `ITEMPURCHASE_UOM_ID` int(11) DEFAULT NULL,
  `ITEMSALES_UOM_ID` int(11) DEFAULT NULL,
  `ITEMADJUSTMENT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMNEXTORDERQTY` double DEFAULT NULL,
  `ITEMTEMP` double DEFAULT NULL,
  `ITEMISSESSIONAL` varchar(1) DEFAULT NULL,
  `ITEMLEADTIME` int(11) DEFAULT NULL,
  `ITEMSTRINGFIELD1` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD2` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD3` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD4` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD5` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD6` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD7` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD8` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD9` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD10` varchar(100) DEFAULT NULL,
  `ITEMINTEGERFIELD1` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD2` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD3` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD4` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD5` int(11) DEFAULT NULL,
  `ITEMBOOLFIELD1` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD2` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD3` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD4` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD5` varchar(1) DEFAULT NULL,
  `ITEMFLOATFIELD1` double DEFAULT NULL,
  `ITEMFLOATFIELD2` double DEFAULT NULL,
  `ITEMFLOATFIELD3` double DEFAULT NULL,
  `ITEMFLOATFIELD4` double DEFAULT NULL,
  `ITEMFLOATFIELD5` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`product_master`
--

/*!40000 ALTER TABLE `product_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_master` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`purchase_complete_product`
--

DROP TABLE IF EXISTS `purchase_complete_product`;
CREATE TABLE `purchase_complete_product` (
  `PURCHASEWAREHOUSEID` int(11) DEFAULT NULL,
  `PURCHASEWAREHOUSECODE` varchar(15) DEFAULT NULL,
  `PURCHASEWAREHOUSENAME` varchar(255) DEFAULT NULL,
  `PURCHASEVENDORID` int(11) DEFAULT NULL,
  `PURCHASEVENDORCODE` varchar(25) DEFAULT NULL,
  `PURCHASEVENDORNAME` varchar(100) DEFAULT NULL,
  `PURCHASEVENDORCLASSNAME` varchar(35) DEFAULT NULL,
  `PURCHASEVENDORCLASSID` int(11) DEFAULT NULL,
  `PURCHASEVENDORGROUPID` int(11) DEFAULT NULL,
  `PURCHASEPURCHASEMANID` int(11) DEFAULT NULL,
  `PURCHASEPURCHASEMANCLASSID` int(11) DEFAULT NULL,
  `PURCHASEMANCLASSNAME` varchar(35) DEFAULT NULL,
  `PURCHASEPURCHASEMANNAME` varchar(100) DEFAULT NULL,
  `PURCHASEPURCHASEMANGROUPID` int(11) DEFAULT NULL,
  `PURCHASECURRENCYID` varchar(3) DEFAULT NULL,
  `PURCHASECURRENCYRATE` double DEFAULT NULL,
  `PURCHASETYPE` int(11) DEFAULT NULL,
  `MASTERJURNALNOINDEX` int(11) DEFAULT NULL,
  `MASTERJURNALTIPE` int(11) DEFAULT NULL,
  `MASTERJURNALDATE` datetime DEFAULT NULL,
  `MASTERJURNALNOTES` varchar(75) DEFAULT NULL,
  `MASTERJURNALREFERENCENO` varchar(35) DEFAULT NULL,
  `MASTERJURNALUSER` varchar(25) DEFAULT NULL,
  `MASTERJURNALONHOLD` varchar(1) DEFAULT NULL,
  `MASTERJURNALDELETED` varchar(1) DEFAULT NULL,
  `MASTERJURNALDEPTID` int(11) DEFAULT NULL,
  `MASTERJURNALJOBID` int(11) DEFAULT NULL,
  `MASTERJURNALMASTERINDEX` int(11) DEFAULT NULL,
  `MASTERDOCUMENTDATE` datetime DEFAULT NULL,
  `MASTERDOCUMENTNUMBER` varchar(25) DEFAULT NULL,
  `DETAILUNITPRICE` double DEFAULT NULL,
  `DETAILDISCOUNT1` double DEFAULT NULL,
  `DETAILDISCOUNT2` double DEFAULT NULL,
  `DETAILDISCOUNT3` double DEFAULT NULL,
  `DETAILDISCOUNT4` double DEFAULT NULL,
  `DETAILDISCOUNT5` double DEFAULT NULL,
  `DETAILQUANTITY` double DEFAULT NULL,
  `ITEMID` int(11) DEFAULT NULL,
  `ITEMCODE` varchar(100) DEFAULT NULL,
  `ITEMCODEALIAS` varchar(100) DEFAULT NULL,
  `ITEMNAME` varchar(250) DEFAULT NULL,
  `ITEMNAMEALIAS` varchar(250) DEFAULT NULL,
  `ITEMDEPTID` int(11) DEFAULT NULL,
  `ITEMDEPTNAME` varchar(35) DEFAULT NULL,
  `ITEMCURRENCY` varchar(3) DEFAULT NULL,
  `ITEMPRODUCTCATEGORYID` int(11) DEFAULT NULL,
  `ITEMPRODUCTCATEGORYNAME` varchar(50) DEFAULT NULL,
  `ITEMMASTERVENDORID` int(11) DEFAULT NULL,
  `ITEMSELLINGPRICE` double DEFAULT NULL,
  `ITEMBUYINGPRICE` double DEFAULT NULL,
  `ITEMBUYINGPRICEREAL` double DEFAULT NULL,
  `ITEMCOSTOFGOODSSOLD` double DEFAULT NULL,
  `ITEMLASTBUYINGCURRENCY` varchar(3) DEFAULT NULL,
  `ITEMTOTALVALUE` double DEFAULT NULL,
  `ITEMREORDERPOINT` double DEFAULT NULL,
  `ITEMREORDERQTY` double DEFAULT NULL,
  `ITEMQTYONHAND` double DEFAULT NULL,
  `ITEMISINVENTORY` varchar(1) DEFAULT NULL,
  `ITEMISBUY` varchar(1) DEFAULT NULL,
  `ITEMISSALE` varchar(1) DEFAULT NULL,
  `ITEMISAUTOBUILD` varchar(1) DEFAULT NULL,
  `ITEMCOGSMETHOD` int(11) DEFAULT NULL,
  `ITEMISNOTACTIVE` varchar(1) DEFAULT NULL,
  `ITEMWAREHOUSEID` int(11) DEFAULT NULL,
  `ITEMDEFAULT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID1` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID2` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID3` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID4` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID5` int(11) DEFAULT NULL,
  `ITEMBELITAXID1` int(11) DEFAULT NULL,
  `ITEMBELITAXID2` int(11) DEFAULT NULL,
  `ITEMBELITAXID3` int(11) DEFAULT NULL,
  `ITEMBELITAXID4` int(11) DEFAULT NULL,
  `ITEMBELITAXID5` int(11) DEFAULT NULL,
  `ITEMLENGTH` double DEFAULT NULL,
  `ITEMWIDTH` double DEFAULT NULL,
  `ITEMHEIGHT` double DEFAULT NULL,
  `ITEMWEIGHT` double DEFAULT NULL,
  `ITEMNOTES` mediumtext,
  `ITEMPICTURE` mediumblob,
  `ITEMISCONSIGNMENT` varchar(1) DEFAULT NULL,
  `ITEMREPORT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMGROUPID1` int(11) DEFAULT NULL,
  `ITEMGROUPID2` int(11) DEFAULT NULL,
  `ITEMGROUPID3` int(11) DEFAULT NULL,
  `ITEMGROUPID4` int(11) DEFAULT NULL,
  `ITEMISUSESERIALNO` varchar(1) DEFAULT NULL,
  `ITEMSELLINGPRICEMETHOD` smallint(6) DEFAULT NULL,
  `ITEMISUSELOTNUMBER` varchar(1) DEFAULT NULL,
  `ITEMPURCHASE_UOM_ID` int(11) DEFAULT NULL,
  `ITEMBELI_UOM_ID` int(11) DEFAULT NULL,
  `ITEMADJUSTMENT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMNEXTORDERQTY` double DEFAULT NULL,
  `ITEMTEMP` double DEFAULT NULL,
  `ITEMISSESSIONAL` varchar(1) DEFAULT NULL,
  `ITEMLEADTIME` int(11) DEFAULT NULL,
  `ITEMSTRINGFIELD1` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD2` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD3` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD4` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD5` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD6` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD7` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD8` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD9` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD10` varchar(100) DEFAULT NULL,
  `ITEMINTEGERFIELD1` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD2` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD3` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD4` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD5` int(11) DEFAULT NULL,
  `ITEMBOOLFIELD1` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD2` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD3` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD4` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD5` varchar(1) DEFAULT NULL,
  `ITEMFLOATFIELD1` double DEFAULT NULL,
  `ITEMFLOATFIELD2` double DEFAULT NULL,
  `ITEMFLOATFIELD3` double DEFAULT NULL,
  `ITEMFLOATFIELD4` double DEFAULT NULL,
  `ITEMFLOATFIELD5` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`purchase_complete_product`
--

/*!40000 ALTER TABLE `purchase_complete_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_complete_product` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`purchase_master`
--

DROP TABLE IF EXISTS `purchase_master`;
CREATE TABLE `purchase_master` (
  `MASTERJURNALNOINDEX` int(11) DEFAULT NULL,
  `MASTERJURNALTIPE` int(11) DEFAULT NULL,
  `MASTERJURNALDATE` datetime DEFAULT NULL,
  `MASTERJURNALNOTES` varchar(75) DEFAULT NULL,
  `MASTERJURNALREFERENCENO` varchar(35) DEFAULT NULL,
  `MASTERJURNALUSER` varchar(25) DEFAULT NULL,
  `MASTERJURNALONHOLD` varchar(1) DEFAULT NULL,
  `MASTERJURNALDELETED` varchar(1) DEFAULT NULL,
  `MASTERJURNALDEPTID` int(11) DEFAULT NULL,
  `MASTERJURNALJOBID` int(11) DEFAULT NULL,
  `MASTERJURNALMASTERINDEX` int(11) DEFAULT NULL,
  `MASTERDOCUMENTDATE` datetime DEFAULT NULL,
  `MASTERDOCUMENTNUMBER` varchar(25) DEFAULT NULL,
  `PURCHASENOINDEX` int(11) DEFAULT NULL,
  `PURCHASEJOBORDERNUMBER` varchar(15) DEFAULT NULL,
  `PURCHASEVENDORID` int(11) DEFAULT NULL,
  `PURCHASEVENDORCLASSID` int(11) DEFAULT NULL,
  `PURCHASEVENDORGROUPID` int(11) DEFAULT NULL,
  `PURCHASEPURCHASEMANID` int(11) DEFAULT NULL,
  `PURCHASEPURCHASEMANCLASSID` int(11) DEFAULT NULL,
  `PURCHASEPURCHASEMANGROUPID` int(11) DEFAULT NULL,
  `PURCHASECOMMENTID` int(11) DEFAULT NULL,
  `PURCHASEDELIVERYID` int(11) DEFAULT NULL,
  `PURCHASEDELIVERYDATE` datetime DEFAULT NULL,
  `PURCHASEPAYMENTMETHODID` int(11) DEFAULT NULL,
  `PURCHASECURRENCYID` varchar(3) DEFAULT NULL,
  `PURCHASECURRENCYRATE` double DEFAULT NULL,
  `PURCHASEDOWNPAYMENT` double DEFAULT NULL,
  `PURCHASEPURCHASEAMOUNT` double DEFAULT NULL,
  `PURCHASEENDINGBALANCE` double DEFAULT NULL,
  `PURCHASEPOSTED` varchar(1) DEFAULT NULL,
  `PURCHASEDELIVERYCOST` double DEFAULT NULL,
  `PURCHASEISSERVICE` varchar(1) DEFAULT NULL,
  `PURCHASEDISCOUNTDAYS` int(11) DEFAULT NULL,
  `PURCHASEDUEDAYS` int(11) DEFAULT NULL,
  `PURCHASEEARLYDISCOUNT` double DEFAULT NULL,
  `PURCHASELATECHARGE` double DEFAULT NULL,
  `PURCHASETERMTYPE` int(11) DEFAULT NULL,
  `PURCHASEISCASH` varchar(1) DEFAULT NULL,
  `PURCHASEWAREHOUSEID` int(11) DEFAULT NULL,
  `PURCHASEISMULTIFRACTION` varchar(1) DEFAULT NULL,
  `PURCHASETIPE` int(11) DEFAULT NULL,
  `PURCHASEDELIVERYTO` int(11) DEFAULT NULL,
  `PURCHASEPURCHASEORDERNO` int(11) DEFAULT NULL,
  `PURCHASETOS1` int(11) DEFAULT NULL,
  `PURCHASETOS2` int(11) DEFAULT NULL,
  `PURCHASETOP1` int(11) DEFAULT NULL,
  `PURCHASETOP2` int(11) DEFAULT NULL,
  `PURCHASEHEADER` int(11) DEFAULT NULL,
  `PURCHASEFOOTER` int(11) DEFAULT NULL,
  `PURCHASENOTE` mediumtext,
  `PURCHASEISBILLED` varchar(1) DEFAULT NULL,
  `PURCHASEDISCOUNT` double DEFAULT NULL,
  `PURCHASEDISCOUNTAMOUNT` double DEFAULT NULL,
  `PURCHASEJURNALMEMONO` int(11) DEFAULT NULL,
  `VENDORCODE` varchar(25) DEFAULT NULL,
  `VENDORNAME` varchar(100) DEFAULT NULL,
  `VENDORCLASSNAME` varchar(35) DEFAULT NULL,
  `PURCHASEMANCLASSNAME` varchar(35) DEFAULT NULL,
  `PURCHASEPURCHASEMANNAME` varchar(100) DEFAULT NULL,
  `iProses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`purchase_master`
--

/*!40000 ALTER TABLE `purchase_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_master` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`rek_jen`
--

DROP TABLE IF EXISTS `rek_jen`;
CREATE TABLE `rek_jen` (
  `rekjen_no` varchar(50) NOT NULL DEFAULT '',
  `rekjen_keterangan` varchar(50) DEFAULT NULL,
  `urutan_rl` int(11) DEFAULT '0',
  PRIMARY KEY (`rekjen_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`rek_jen`
--

/*!40000 ALTER TABLE `rek_jen` DISABLE KEYS */;
INSERT INTO `rek_jen` (`rekjen_no`,`rekjen_keterangan`,`urutan_rl`) VALUES 
 ('1','AKTIVA',0),
 ('10','PENJUALAN',0),
 ('2','PASSIVA',0),
 ('3','MODAL',0),
 ('4','PENDAPATAN',1),
 ('5','BIAYA',2),
 ('6','HARGA POKOK PENJUALAN',3),
 ('7','PENDAPATAN LAIN-LAIN',4),
 ('8','BIAYA LAIN-LAIN',5),
 ('9','PAJAK',0);
/*!40000 ALTER TABLE `rek_jen` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`sales_complete_product`
--

DROP TABLE IF EXISTS `sales_complete_product`;
CREATE TABLE `sales_complete_product` (
  `SALESWAREHOUSEID` int(11) DEFAULT NULL,
  `SALESWAREHOUSECODE` varchar(15) DEFAULT NULL,
  `SALESWAREHOUSENAME` varchar(255) DEFAULT NULL,
  `SALESCUSTOMERID` int(11) DEFAULT NULL,
  `SALESCUSTOMERCODE` varchar(25) DEFAULT NULL,
  `SALESCUSTOMERNAME` varchar(100) DEFAULT NULL,
  `SALESCUSTOMERCLASSNAME` varchar(35) DEFAULT NULL,
  `SALESCUSTOMERCLASSID` int(11) DEFAULT NULL,
  `SALESCUSTOMERGROUPID` int(11) DEFAULT NULL,
  `SALESSALESMANID` int(11) DEFAULT NULL,
  `SALESSALESMANCLASSID` int(11) DEFAULT NULL,
  `SALESMANCLASSNAME` varchar(35) DEFAULT NULL,
  `SALESSALESMANNAME` varchar(100) DEFAULT NULL,
  `SALESSALESMANGROUPID` int(11) DEFAULT NULL,
  `SALESCURRENCYID` varchar(3) DEFAULT NULL,
  `SALESCURRENCYRATE` double DEFAULT NULL,
  `SALESTYPE` int(11) DEFAULT NULL,
  `MASTERJURNALNOINDEX` int(11) DEFAULT NULL,
  `MASTERJURNALTIPE` int(11) DEFAULT NULL,
  `MASTERJURNALDATE` datetime DEFAULT NULL,
  `MASTERJURNALNOTES` varchar(75) DEFAULT NULL,
  `MASTERJURNALREFERENCENO` varchar(35) DEFAULT NULL,
  `MASTERJURNALUSER` varchar(25) DEFAULT NULL,
  `MASTERJURNALONHOLD` varchar(1) DEFAULT NULL,
  `MASTERJURNALDELETED` varchar(1) DEFAULT NULL,
  `MASTERJURNALDEPTID` int(11) DEFAULT NULL,
  `MASTERJURNALJOBID` int(11) DEFAULT NULL,
  `MASTERJURNALMASTERINDEX` int(11) DEFAULT NULL,
  `MASTERDOCUMENTDATE` datetime DEFAULT NULL,
  `MASTERDOCUMENTNUMBER` varchar(25) DEFAULT NULL,
  `DETAILUNITPRICE` double DEFAULT NULL,
  `DETAILDISCOUNT1` double DEFAULT NULL,
  `DETAILDISCOUNT2` double DEFAULT NULL,
  `DETAILDISCOUNT3` double DEFAULT NULL,
  `DETAILDISCOUNT4` double DEFAULT NULL,
  `DETAILDISCOUNT5` double DEFAULT NULL,
  `DETAILQUANTITY` double DEFAULT NULL,
  `ITEMID` int(11) DEFAULT NULL,
  `ITEMCODE` varchar(100) DEFAULT NULL,
  `ITEMCODEALIAS` varchar(100) DEFAULT NULL,
  `ITEMNAME` varchar(250) DEFAULT NULL,
  `ITEMNAMEALIAS` varchar(250) DEFAULT NULL,
  `ITEMDEPTID` int(11) DEFAULT NULL,
  `ITEMDEPTNAME` varchar(35) DEFAULT NULL,
  `ITEMCURRENCY` varchar(3) DEFAULT NULL,
  `ITEMPRODUCTCATEGORYID` int(11) DEFAULT NULL,
  `ITEMPRODUCTCATEGORYNAME` varchar(50) DEFAULT NULL,
  `ITEMMASTERVENDORID` int(11) DEFAULT NULL,
  `ITEMSELLINGPRICE` double DEFAULT NULL,
  `ITEMBUYINGPRICE` double DEFAULT NULL,
  `ITEMBUYINGPRICEREAL` double DEFAULT NULL,
  `ITEMCOSTOFGOODSSOLD` double DEFAULT NULL,
  `ITEMLASTBUYINGCURRENCY` varchar(3) DEFAULT NULL,
  `ITEMTOTALVALUE` double DEFAULT NULL,
  `ITEMREORDERPOINT` double DEFAULT NULL,
  `ITEMREORDERQTY` double DEFAULT NULL,
  `ITEMQTYONHAND` double DEFAULT NULL,
  `ITEMISINVENTORY` varchar(1) DEFAULT NULL,
  `ITEMISBUY` varchar(1) DEFAULT NULL,
  `ITEMISSALE` varchar(1) DEFAULT NULL,
  `ITEMISAUTOBUILD` varchar(1) DEFAULT NULL,
  `ITEMCOGSMETHOD` int(11) DEFAULT NULL,
  `ITEMISNOTACTIVE` varchar(1) DEFAULT NULL,
  `ITEMWAREHOUSEID` int(11) DEFAULT NULL,
  `ITEMDEFAULT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID1` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID2` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID3` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID4` int(11) DEFAULT NULL,
  `ITEMPURCHASETAXID5` int(11) DEFAULT NULL,
  `ITEMSALESTAXID1` int(11) DEFAULT NULL,
  `ITEMSALESTAXID2` int(11) DEFAULT NULL,
  `ITEMSALESTAXID3` int(11) DEFAULT NULL,
  `ITEMSALESTAXID4` int(11) DEFAULT NULL,
  `ITEMSALESTAXID5` int(11) DEFAULT NULL,
  `ITEMLENGTH` double DEFAULT NULL,
  `ITEMWIDTH` double DEFAULT NULL,
  `ITEMHEIGHT` double DEFAULT NULL,
  `ITEMWEIGHT` double DEFAULT NULL,
  `ITEMNOTES` mediumtext,
  `ITEMPICTURE` mediumblob,
  `ITEMISCONSIGNMENT` varchar(1) DEFAULT NULL,
  `ITEMREPORT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMGROUPID1` int(11) DEFAULT NULL,
  `ITEMGROUPID2` int(11) DEFAULT NULL,
  `ITEMGROUPID3` int(11) DEFAULT NULL,
  `ITEMGROUPID4` int(11) DEFAULT NULL,
  `ITEMISUSESERIALNO` varchar(1) DEFAULT NULL,
  `ITEMSELLINGPRICEMETHOD` smallint(6) DEFAULT NULL,
  `ITEMISUSELOTNUMBER` varchar(1) DEFAULT NULL,
  `ITEMPURCHASE_UOM_ID` int(11) DEFAULT NULL,
  `ITEMSALES_UOM_ID` int(11) DEFAULT NULL,
  `ITEMADJUSTMENT_UOM_ID` int(11) DEFAULT NULL,
  `ITEMNEXTORDERQTY` double DEFAULT NULL,
  `ITEMTEMP` double DEFAULT NULL,
  `ITEMISSESSIONAL` varchar(1) DEFAULT NULL,
  `ITEMLEADTIME` int(11) DEFAULT NULL,
  `ITEMSTRINGFIELD1` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD2` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD3` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD4` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD5` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD6` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD7` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD8` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD9` varchar(100) DEFAULT NULL,
  `ITEMSTRINGFIELD10` varchar(100) DEFAULT NULL,
  `ITEMINTEGERFIELD1` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD2` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD3` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD4` int(11) DEFAULT NULL,
  `ITEMINTEGERFIELD5` int(11) DEFAULT NULL,
  `ITEMBOOLFIELD1` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD2` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD3` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD4` varchar(1) DEFAULT NULL,
  `ITEMBOOLFIELD5` varchar(1) DEFAULT NULL,
  `ITEMFLOATFIELD1` double DEFAULT NULL,
  `ITEMFLOATFIELD2` double DEFAULT NULL,
  `ITEMFLOATFIELD3` double DEFAULT NULL,
  `ITEMFLOATFIELD4` double DEFAULT NULL,
  `ITEMFLOATFIELD5` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`sales_complete_product`
--

/*!40000 ALTER TABLE `sales_complete_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_complete_product` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`sales_master`
--

DROP TABLE IF EXISTS `sales_master`;
CREATE TABLE `sales_master` (
  `MASTERJURNALNOINDEX` int(11) DEFAULT NULL,
  `MASTERJURNALTIPE` int(11) DEFAULT NULL,
  `MASTERJURNALDATE` datetime DEFAULT NULL,
  `MASTERJURNALNOTES` varchar(75) DEFAULT NULL,
  `MASTERJURNALREFERENCENO` varchar(35) DEFAULT NULL,
  `MASTERJURNALUSER` varchar(25) DEFAULT NULL,
  `MASTERJURNALONHOLD` varchar(1) DEFAULT NULL,
  `MASTERJURNALDELETED` varchar(1) DEFAULT NULL,
  `MASTERJURNALDEPTID` int(11) DEFAULT NULL,
  `MASTERJURNALJOBID` int(11) DEFAULT NULL,
  `MASTERJURNALMASTERINDEX` int(11) DEFAULT NULL,
  `MASTERDOCUMENTDATE` datetime DEFAULT NULL,
  `MASTERDOCUMENTNUMBER` varchar(25) DEFAULT NULL,
  `SALESNOINDEX` int(11) DEFAULT NULL,
  `SALESJOBORDERNUMBER` varchar(15) DEFAULT NULL,
  `SALESCUSTOMERID` int(11) DEFAULT NULL,
  `SALESCUSTOMERCLASSID` int(11) DEFAULT NULL,
  `SALESCUSTOMERGROUPID` int(11) DEFAULT NULL,
  `SALESSALESMANID` int(11) DEFAULT NULL,
  `SALESSALESMANCLASSID` int(11) DEFAULT NULL,
  `SALESSALESMANGROUPID` int(11) DEFAULT NULL,
  `SALESCOMMENTID` int(11) DEFAULT NULL,
  `SALESDELIVERYID` int(11) DEFAULT NULL,
  `SALESDELIVERYDATE` datetime DEFAULT NULL,
  `SALESPAYMENTMETHODID` int(11) DEFAULT NULL,
  `SALESCURRENCYID` varchar(3) DEFAULT NULL,
  `SALESCURRENCYRATE` double DEFAULT NULL,
  `SALESDOWNPAYMENT` double DEFAULT NULL,
  `SALESSALESAMOUNT` double DEFAULT NULL,
  `SALESENDINGBALANCE` double DEFAULT NULL,
  `SALESPOSTED` varchar(1) DEFAULT NULL,
  `SALESDELIVERYCOST` double DEFAULT NULL,
  `SALESISSERVICE` varchar(1) DEFAULT NULL,
  `SALESDISCOUNTDAYS` int(11) DEFAULT NULL,
  `SALESDUEDAYS` int(11) DEFAULT NULL,
  `SALESEARLYDISCOUNT` double DEFAULT NULL,
  `SALESLATECHARGE` double DEFAULT NULL,
  `SALESTERMTYPE` int(11) DEFAULT NULL,
  `SALESISCASH` varchar(1) DEFAULT NULL,
  `SALESWAREHOUSEID` int(11) DEFAULT NULL,
  `SALESISMULTIFRACTION` varchar(1) DEFAULT NULL,
  `SALESTIPE` int(11) DEFAULT NULL,
  `SALESDELIVERYTO` int(11) DEFAULT NULL,
  `SALESPURCHASEORDERNO` int(11) DEFAULT NULL,
  `SALESTOS1` int(11) DEFAULT NULL,
  `SALESTOS2` int(11) DEFAULT NULL,
  `SALESTOP1` int(11) DEFAULT NULL,
  `SALESTOP2` int(11) DEFAULT NULL,
  `SALESHEADER` int(11) DEFAULT NULL,
  `SALESFOOTER` int(11) DEFAULT NULL,
  `SALESNOTE` mediumtext,
  `SALESISBILLED` varchar(1) DEFAULT NULL,
  `SALESDISCOUNT` double DEFAULT NULL,
  `SALESDISCOUNTAMOUNT` double DEFAULT NULL,
  `SALESJURNALMEMONO` int(11) DEFAULT NULL,
  `CUSTOMERCODE` varchar(25) DEFAULT NULL,
  `CUSTOMERNAME` varchar(100) DEFAULT NULL,
  `CUSTOMERCLASSNAME` varchar(35) DEFAULT NULL,
  `SALESMANCLASSNAME` varchar(35) DEFAULT NULL,
  `SALESSALESMANNAME` varchar(100) DEFAULT NULL,
  `SALESPAYCARDNUMBER` varchar(25) DEFAULT NULL,
  `iProses` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`sales_master`
--

/*!40000 ALTER TABLE `sales_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_master` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`t_stok`
--

DROP TABLE IF EXISTS `t_stok`;
CREATE TABLE `t_stok` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_code0` varchar(50) NOT NULL DEFAULT '',
  `prod_name0` varchar(145) NOT NULL DEFAULT '',
  `Qty` double NOT NULL DEFAULT '0',
  `Harga` double NOT NULL DEFAULT '0',
  `gud_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`t_stok`
--

/*!40000 ALTER TABLE `t_stok` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_stok` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tadjust`
--

DROP TABLE IF EXISTS `tadjust`;
CREATE TABLE `tadjust` (
  `adj_no` varchar(50) NOT NULL,
  `adj_date` datetime DEFAULT NULL,
  `adj_type` int(11) NOT NULL DEFAULT '0',
  `adj_desc` varchar(150) DEFAULT NULL,
  `adj_terima` varchar(50) DEFAULT NULL,
  `adj_setuju` varchar(50) DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_adjust` int(4) DEFAULT '0',
  PRIMARY KEY (`adj_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tadjust`
--

/*!40000 ALTER TABLE `tadjust` DISABLE KEYS */;
/*!40000 ALTER TABLE `tadjust` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tadjust_wh`
--

DROP TABLE IF EXISTS `tadjust_wh`;
CREATE TABLE `tadjust_wh` (
  `adj_no` varchar(50) NOT NULL,
  `adj_date` datetime DEFAULT NULL,
  `adj_type` int(11) NOT NULL DEFAULT '0',
  `adj_desc` varchar(150) DEFAULT NULL,
  `adj_terima` varchar(50) DEFAULT NULL,
  `adj_setuju` varchar(50) DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_adjust` int(4) DEFAULT '0',
  `adj_desc2` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`adj_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tadjust_wh`
--

/*!40000 ALTER TABLE `tadjust_wh` DISABLE KEYS */;
/*!40000 ALTER TABLE `tadjust_wh` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tbank`
--

DROP TABLE IF EXISTS `tbank`;
CREATE TABLE `tbank` (
  `bank_no` varchar(50) NOT NULL DEFAULT '',
  `bank_code` varchar(45) NOT NULL DEFAULT '',
  `bank_name` varchar(45) NOT NULL DEFAULT '',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `is_default` int(11) NOT NULL DEFAULT '0',
  `is_jual` int(11) NOT NULL DEFAULT '0',
  `rek_no` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `debit_charge` double DEFAULT '0',
  `credit_charge` double DEFAULT '0',
  `debit_charge_luar` double DEFAULT '0',
  `credit_charge_luar` double DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`bank_no`),
  KEY `Index_2` (`bank_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tbank`
--

/*!40000 ALTER TABLE `tbank` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbank` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tbom`
--

DROP TABLE IF EXISTS `tbom`;
CREATE TABLE `tbom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_no_root` varchar(45) DEFAULT NULL,
  `prod_no` varchar(45) DEFAULT NULL,
  `satuan` int(11) NOT NULL DEFAULT '1',
  `qty_satuan` double NOT NULL DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`prod_no_root`),
  KEY `Index_3` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tbom`
--

/*!40000 ALTER TABLE `tbom` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbom` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tcat`
--

DROP TABLE IF EXISTS `tcat`;
CREATE TABLE `tcat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `gbr` varchar(255) DEFAULT NULL,
  `is_modif` int(11) DEFAULT '0',
  `rek_jual` varchar(50) DEFAULT NULL,
  `rek_retur_jual` varchar(50) DEFAULT NULL,
  `rek_pot_jual` varchar(50) DEFAULT NULL,
  `rek_hpp` varchar(50) DEFAULT NULL,
  `rek_no` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `nhari` int(11) NOT NULL DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `div_id` int(11) DEFAULT '0',
  `rek_komisi` varchar(50) DEFAULT NULL,
  `rek_point` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tcat`
--

/*!40000 ALTER TABLE `tcat` DISABLE KEYS */;
INSERT INTO `tcat` (`cat_id`,`kode`,`nama`,`is_delete`,`gbr`,`is_modif`,`rek_jual`,`rek_retur_jual`,`rek_pot_jual`,`rek_hpp`,`rek_no`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`nhari`,`is_downloaded`,`iUpload`,`Upload_date`,`div_id`,`rek_komisi`,`rek_point`) VALUES 
 (1,'KT12','BAHAN BAKU',0,NULL,0,'00078','00078','00078','ID0602161358371','ID0602161402481',0,'2023-03-31 10:21:59',1,'2023-05-05 11:10:30',0,NULL,0,0,1,NULL,0,NULL,NULL),
 (2,'KT21','PRODUKSI',0,NULL,0,'00078','00078','00078','ID0602161358371','ID0602161402481',0,'2023-05-03 16:14:54',1,'2023-05-05 11:10:35',0,NULL,0,0,1,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `tcat` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tcat_gudang`
--

DROP TABLE IF EXISTS `tcat_gudang`;
CREATE TABLE `tcat_gudang` (
  `cat_gud_no` varchar(50) NOT NULL DEFAULT '',
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_create` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_Date` datetime DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `no_prefix` varchar(50) DEFAULT NULL,
  `isMaster` int(4) DEFAULT '0',
  `isBeli` int(4) DEFAULT '0',
  `isJual` int(4) DEFAULT '0',
  `isMutasi` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`cat_gud_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tcat_gudang`
--

/*!40000 ALTER TABLE `tcat_gudang` DISABLE KEYS */;
INSERT INTO `tcat_gudang` (`cat_gud_no`,`kode`,`nama`,`is_delete`,`user_create`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_Date`,`is_downloaded`,`no_prefix`,`isMaster`,`isBeli`,`isJual`,`isMutasi`,`iUpload`,`Upload_date`) VALUES 
 ('CG_000','PUSAT','MADURA',0,14,'2013-04-17 08:50:23',24,'2019-01-20 19:52:27',0,NULL,1,'PT',0,0,0,0,0,'2019-02-04 02:19:29');
/*!40000 ALTER TABLE `tcat_gudang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tcek_in`
--

DROP TABLE IF EXISTS `tcek_in`;
CREATE TABLE `tcek_in` (
  `nobg` varchar(50) NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `bank` varchar(45) DEFAULT NULL,
  `nominal` double NOT NULL DEFAULT '0',
  `person_no` varchar(45) DEFAULT NULL,
  `is_status` int(11) NOT NULL DEFAULT '0',
  `rek_no` varchar(45) DEFAULT NULL,
  `ter_no` varchar(45) DEFAULT NULL,
  `cek_type` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(50) DEFAULT NULL,
  `no_trx` varchar(50) DEFAULT NULL,
  `bank_no` varchar(50) DEFAULT NULL,
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `nominal_kurs` double DEFAULT '0',
  `tgl_terbit` datetime DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jur_no_cair` varchar(50) DEFAULT NULL,
  `rek_no_cair` varchar(50) DEFAULT NULL,
  `kurs_cur_cair` double DEFAULT '0',
  `ket_cair` varchar(150) DEFAULT NULL,
  `user_cair` int(11) DEFAULT '0',
  `tgl_cair` datetime DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`ter_no`),
  KEY `idx_nobg` (`nobg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tcek_in`
--

/*!40000 ALTER TABLE `tcek_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `tcek_in` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tcek_out`
--

DROP TABLE IF EXISTS `tcek_out`;
CREATE TABLE `tcek_out` (
  `nobg` varchar(45) NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `bank` varchar(45) DEFAULT NULL,
  `nominal` double NOT NULL DEFAULT '0',
  `person_no` varchar(45) DEFAULT NULL,
  `is_status` int(11) NOT NULL DEFAULT '0',
  `rek_no` varchar(45) DEFAULT NULL,
  `pay_no` varchar(45) DEFAULT NULL,
  `cek_type` int(11) NOT NULL DEFAULT '0',
  `bank_no` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_trx` varchar(50) DEFAULT NULL,
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `nominal_kurs` double DEFAULT '0',
  `tgl_terbit` datetime DEFAULT NULL,
  `jur_no_cair` varchar(50) DEFAULT NULL,
  `rek_no_cair` varchar(50) DEFAULT NULL,
  `kurs_cur_cair` double DEFAULT '0',
  `ket_cair` varchar(150) DEFAULT NULL,
  `user_cair` int(11) DEFAULT '0',
  `tgl_cair` datetime DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nobg`),
  KEY `Index_2` (`person_no`),
  KEY `Index_3` (`pay_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tcek_out`
--

/*!40000 ALTER TABLE `tcek_out` DISABLE KEYS */;
/*!40000 ALTER TABLE `tcek_out` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_adjust`
--

DROP TABLE IF EXISTS `td_adjust`;
CREATE TABLE `td_adjust` (
  `adj_det_no` varchar(50) NOT NULL DEFAULT '',
  `adj_no` varchar(50) NOT NULL DEFAULT '',
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `gud_no` varchar(50) DEFAULT NULL,
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '1',
  `konversi` double NOT NULL DEFAULT '0',
  `out_det_no` varchar(50) DEFAULT NULL,
  `det_qty_adjust` double NOT NULL DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`adj_det_no`),
  KEY `Index_2` (`adj_no`),
  KEY `Index_3` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_adjust`
--

/*!40000 ALTER TABLE `td_adjust` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_adjust` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_adjust_wh`
--

DROP TABLE IF EXISTS `td_adjust_wh`;
CREATE TABLE `td_adjust_wh` (
  `adj_det_no` varchar(50) NOT NULL DEFAULT '',
  `adj_no` varchar(50) NOT NULL DEFAULT '',
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `gud_no` varchar(50) DEFAULT NULL,
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '1',
  `konversi` double NOT NULL DEFAULT '0',
  `out_det_no` varchar(50) DEFAULT NULL,
  `det_qty_adjust` double NOT NULL DEFAULT '0',
  `det_qty_in` double DEFAULT '0',
  `det_qty_out` double DEFAULT '0',
  `det_adj_desc` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`adj_det_no`),
  KEY `Index_2` (`adj_no`),
  KEY `Index_3` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_adjust_wh`
--

/*!40000 ALTER TABLE `td_adjust_wh` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_adjust_wh` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_prod_pic`
--

DROP TABLE IF EXISTS `td_prod_pic`;
CREATE TABLE `td_prod_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_no` varchar(45) NOT NULL DEFAULT '',
  `pic_path` varchar(245) NOT NULL DEFAULT '',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_prod_pic`
--

/*!40000 ALTER TABLE `td_prod_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_prod_pic` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_product_disc`
--

DROP TABLE IF EXISTS `td_product_disc`;
CREATE TABLE `td_product_disc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` varchar(50) DEFAULT NULL,
  `group_id` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `group_cust_id` varchar(50) DEFAULT NULL,
  `disc_type` int(5) DEFAULT NULL,
  `tgl_start` datetime DEFAULT NULL,
  `tgl_end` datetime DEFAULT NULL,
  `disc_persen` double DEFAULT NULL,
  `disc2_persen` double DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `delete_date` int(11) DEFAULT NULL,
  `is_delete` int(2) DEFAULT NULL,
  `discby_type` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_product_disc`
--

/*!40000 ALTER TABLE `td_product_disc` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_product_disc` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_product_supplier`
--

DROP TABLE IF EXISTS `td_product_supplier`;
CREATE TABLE `td_product_supplier` (
  `det_id` varchar(50) NOT NULL,
  `id` varchar(50) DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`det_id`),
  KEY `Index_2` (`id`),
  KEY `Index_3` (`person_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_product_supplier`
--

/*!40000 ALTER TABLE `td_product_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_product_supplier` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_produksi`
--

DROP TABLE IF EXISTS `td_produksi`;
CREATE TABLE `td_produksi` (
  `det_pr_no` varchar(50) NOT NULL DEFAULT '',
  `gud_no` varchar(50) DEFAULT NULL,
  `pr_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `nama_brg` varchar(150) DEFAULT NULL,
  `qty_satuan` double DEFAULT '0',
  `satuan` int(11) DEFAULT '1',
  `konversi` int(11) DEFAULT '1',
  `jenis_brg` int(11) DEFAULT '0',
  `qty_default` double DEFAULT '0',
  `qty_pemakaian` double DEFAULT '0',
  `qty_dibutuhkan` double DEFAULT '0',
  `satuan_pakai` varchar(10) DEFAULT '',
  `satuan_butuh` varchar(10) DEFAULT '',
  `harga_satuan` double DEFAULT '0',
  PRIMARY KEY (`det_pr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_produksi`
--

/*!40000 ALTER TABLE `td_produksi` DISABLE KEYS */;
INSERT INTO `td_produksi` (`det_pr_no`,`gud_no`,`pr_no`,`prod_no`,`nama_brg`,`qty_satuan`,`satuan`,`konversi`,`jenis_brg`,`qty_default`,`qty_pemakaian`,`qty_dibutuhkan`,`satuan_pakai`,`satuan_butuh`,`harga_satuan`) VALUES 
 ('PT-230505-121008-0019','ID2','PT-PRD202350002','ID-230503-161704-0002','ROTI BOI',2,0,1,1,0,0,0,' ',' ',0.5),
 ('PT-230505-121008-0020','ID2','PT-PRD202350002','ID-230503-152831-0001','SEGITIGA TEPUNG',4,0,1,0,2,2000,1,'G','KG',0),
 ('PT-230505-144950-0021','ID2','PT-PRD202350003','ID-230503-152831-0001','SEGITIGA TEPUNG',0.5,0,1,0,0.5,500,1,'G','KG',0),
 ('PT-230505-144950-0022','ID2','PT-PRD202350003','ID-230503-161704-0002','ROTI BOI',1,0,1,1,1,1,1,'KG','KG',65000),
 ('PT-230509-124642-0001','ID2','PT-PRD202350001','ID-230503-152831-0001','SEGITIGA TEPUNG',0.7,0,1,0,0.7,700,1,'G','KG',0),
 ('PT-230509-124642-0002','ID2','PT-PRD202350001','ID-230503-161704-0002','ROTI BOI',1,0,1,1,1,1,1,'KG','KG',91000),
 ('PT-230509-130534-0003','ID2','PT-PRD202350004','ID-230503-152831-0001','SEGITIGA TEPUNG',0.18,0,1,0,0.3,300,1,'G','KG',0),
 ('PT-230509-130534-0004','ID2','PT-PRD202350004','ID-230503-161704-0002','ROTI BOI',0.6,0,1,1,1,600,1,'G','KG',39000);
INSERT INTO `td_produksi` (`det_pr_no`,`gud_no`,`pr_no`,`prod_no`,`nama_brg`,`qty_satuan`,`satuan`,`konversi`,`jenis_brg`,`qty_default`,`qty_pemakaian`,`qty_dibutuhkan`,`satuan_pakai`,`satuan_butuh`,`harga_satuan`) VALUES 
 ('PT-230509-134335-0005','ID2','PT-PRD202350009','ID-230503-152831-0001','SEGITIGA TEPUNG',0.18,0,1,0,0.3,300,1,'G','KG',0),
 ('PT-230509-134335-0006','ID2','PT-PRD202350009','ID-230503-161704-0002','ROTI BOI',0.6,0,1,1,1,600,1,'G','KG',39000),
 ('PT-230509-153915-0007','ID2','PT-PRD202350010','ID-230503-152831-0001','SEGITIGA TEPUNG',0.24,0,1,0,0.6,600,1,'G','KG',0),
 ('PT-230509-153915-0008','ID2','PT-PRD202350010','ID-230503-163204-0003','GULA HALUS',0.12,0,1,0,0.3,300,1,'G','KG',0),
 ('PT-230509-153915-0009','ID2','PT-PRD202350010','ID-230503-161704-0002','ROTI BOI',0.4,0,1,1,1,400,1,'G','KG',3081000),
 ('PT-230509-160304-0010','ID2','PT-PRD202350011','ID-230503-152831-0001','SEGITIGA TEPUNG',0.24,0,1,0,0.6,600,1,'G','KG',0),
 ('PT-230509-160305-0011','ID2','PT-PRD202350011','ID-230503-163204-0003','GULA HALUS',0.12,0,1,0,0.3,300,1,'G','KG',0),
 ('PT-230509-160305-0012','ID2','PT-PRD202350011','ID-230503-161704-0002','ROTI BOI',0.4,0,1,1,1,400,1,'G','KG',3081000);
INSERT INTO `td_produksi` (`det_pr_no`,`gud_no`,`pr_no`,`prod_no`,`nama_brg`,`qty_satuan`,`satuan`,`konversi`,`jenis_brg`,`qty_default`,`qty_pemakaian`,`qty_dibutuhkan`,`satuan_pakai`,`satuan_butuh`,`harga_satuan`) VALUES 
 ('PT-230509-165956-0013','ID2','PT-PRD202350014','ID-230503-152831-0001','SEGITIGA TEPUNG',0.24,0,1,0,0.6,600,1,'G','KG',0),
 ('PT-230509-165956-0014','ID2','PT-PRD202350014','ID-230503-163204-0003','GULA HALUS',0.12,0,1,0,0.3,300,1,'G','KG',0),
 ('PT-230509-165956-0015','ID2','PT-PRD202350014','ID-230503-161704-0002','ROTI BOI',0.4,0,1,1,1,400,1,'G','KG',3081000),
 ('PT-230509-170203-0016','ID2','PT-PRD202350015','ID-230503-152831-0001','SEGITIGA TEPUNG',0.24,0,1,0,0.6,600,1,'G','KG',0),
 ('PT-230509-170203-0017','ID2','PT-PRD202350015','ID-230503-163204-0003','GULA HALUS',0.12,0,1,0,0.3,300,1,'G','KG',0),
 ('PT-230509-170203-0018','ID2','PT-PRD202350015','ID-230503-161704-0002','ROTI BOI',0.4,0,1,1,1,400,1,'G','KG',3081000);
/*!40000 ALTER TABLE `td_produksi` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_produksi_trial`
--

DROP TABLE IF EXISTS `td_produksi_trial`;
CREATE TABLE `td_produksi_trial` (
  `det_pr_no` varchar(50) NOT NULL DEFAULT '',
  `gud_no` varchar(50) DEFAULT NULL,
  `pr_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `nama_brg` varchar(150) DEFAULT NULL,
  `qty_satuan` double DEFAULT '0',
  `satuan` int(11) DEFAULT '1',
  `konversi` int(11) DEFAULT '1',
  `jenis_brg` int(11) DEFAULT '0',
  `qty_default` double DEFAULT '0',
  `qty_pemakaian` double DEFAULT '0',
  `qty_dibutuhkan` double DEFAULT '0',
  `satuan_pakai` varchar(10) DEFAULT '',
  `satuan_butuh` varchar(10) DEFAULT '',
  `harga_satuan` double DEFAULT '0',
  PRIMARY KEY (`det_pr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_produksi_trial`
--

/*!40000 ALTER TABLE `td_produksi_trial` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_produksi_trial` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_purchase`
--

DROP TABLE IF EXISTS `td_purchase`;
CREATE TABLE `td_purchase` (
  `pur_det_no` varchar(50) NOT NULL DEFAULT '',
  `pur_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `pur_det_qty` double(15,3) NOT NULL DEFAULT '0.000' COMMENT 'dlm satuan terkecil',
  `pur_det_price` double(15,3) NOT NULL DEFAULT '0.000',
  `pur_det_sub_total` double(15,3) NOT NULL DEFAULT '0.000',
  `disc1_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `disc1_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `disc2_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `disc2_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `disc3_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `disc3_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `ppn_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `ppn_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `discf1_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `discf1_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `discf2_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `discf2_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `price_netto` double(15,3) NOT NULL DEFAULT '0.000' COMMENT 'dlm satuan terkecil',
  `qty_kirim` int(11) NOT NULL DEFAULT '0',
  `qty_retur` double(15,3) NOT NULL DEFAULT '0.000',
  `qty_satuan` double NOT NULL DEFAULT '0' COMMENT 'dlm satuan transaksi',
  `satuan` int(11) NOT NULL DEFAULT '1',
  `konversi` double NOT NULL DEFAULT '1',
  `nama_brg` varchar(145) DEFAULT NULL,
  `gud_no` varchar(45) DEFAULT NULL,
  `det_pur_ord` varchar(50) DEFAULT NULL,
  `price_satuan3` double DEFAULT '0',
  `pur_det_price_kurs` double NOT NULL DEFAULT '0',
  `pur_det_sub_total_kurs` double NOT NULL DEFAULT '0',
  `disc1_rp_kurs` double NOT NULL DEFAULT '0',
  `disc2_rp_kurs` double NOT NULL DEFAULT '0',
  `disc3_rp_kurs` double NOT NULL DEFAULT '0',
  `ppn_rp_kurs` double NOT NULL DEFAULT '0',
  `discf1_rp_kurs` double NOT NULL DEFAULT '0',
  `discf2_rp_kurs` double NOT NULL DEFAULT '0',
  `price_netto_kurs` double NOT NULL DEFAULT '0',
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `in_det_no` varchar(50) DEFAULT NULL,
  `is_ppn` int(11) DEFAULT '0',
  `qty_satuan2` double DEFAULT '0',
  `satuan2` varchar(50) DEFAULT NULL,
  `konversi2` double DEFAULT '0',
  `serial_no` varchar(50) DEFAULT NULL,
  `disc_global_rp` double DEFAULT '0',
  `disc_global_persen` double DEFAULT '0',
  `pur_det_no_reff` varchar(50) DEFAULT NULL,
  `pur_det_keterangan` varchar(150) DEFAULT NULL,
  `disc4_persen` double DEFAULT '0',
  `disc4_rp_kurs` double DEFAULT '0',
  PRIMARY KEY (`pur_det_no`),
  KEY `Index_2` (`pur_no`),
  KEY `Index_3` (`prod_no`),
  KEY `Index_4` (`in_det_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_purchase`
--

/*!40000 ALTER TABLE `td_purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_purchase` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_purchase_order`
--

DROP TABLE IF EXISTS `td_purchase_order`;
CREATE TABLE `td_purchase_order` (
  `det_pur_ord` varchar(50) NOT NULL DEFAULT '',
  `pur_ord` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '0',
  `konversi` double NOT NULL DEFAULT '0',
  `qty_order` double NOT NULL DEFAULT '0',
  `qty_datang` double NOT NULL DEFAULT '0',
  `harga` double NOT NULL DEFAULT '0',
  `price_netto` double NOT NULL DEFAULT '0',
  `nama_brg` varchar(145) DEFAULT NULL,
  `pur_ord_det_total` double DEFAULT '0',
  `disc1_persen` double DEFAULT '0',
  `disc1_rp` double DEFAULT '0',
  `disc2_persen` double DEFAULT '0',
  `disc2_rp` double DEFAULT '0',
  `disc3_persen` double DEFAULT '0',
  `disc3_rp` double DEFAULT '0',
  `pur_ord_det_ket` varchar(50) DEFAULT NULL,
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `harga_kurs` double NOT NULL DEFAULT '0',
  `price_netto_kurs` double NOT NULL DEFAULT '0',
  `pur_ord_det_total_kurs` double DEFAULT '0',
  `disc1_rp_kurs` double DEFAULT '0',
  `disc2_rp_kurs` double DEFAULT '0',
  `disc3_rp_kurs` double DEFAULT '0',
  `is_ppn` int(11) NOT NULL DEFAULT '0',
  `ppn_persen` double NOT NULL DEFAULT '0',
  `price_netto2` double NOT NULL DEFAULT '0',
  `disc_faktur_persen` double DEFAULT '0',
  `qty_satuan2` double DEFAULT '0',
  `satuan2` varchar(50) DEFAULT NULL,
  `konversi2` double DEFAULT '0',
  `disc4_persen` double DEFAULT '0',
  `disc4_rp_kurs` double DEFAULT '0',
  PRIMARY KEY (`det_pur_ord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_purchase_order`
--

/*!40000 ALTER TABLE `td_purchase_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_purchase_order` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_purchase_retur`
--

DROP TABLE IF EXISTS `td_purchase_retur`;
CREATE TABLE `td_purchase_retur` (
  `ret_det_no` varchar(50) NOT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `ret_det_qty` double(15,3) NOT NULL DEFAULT '0.000',
  `ret_det_price` double(15,3) NOT NULL DEFAULT '0.000',
  `ret_det_total` double(15,3) NOT NULL DEFAULT '0.000',
  `out_det_no` varchar(50) DEFAULT NULL,
  `ret_pur_no` varchar(50) DEFAULT NULL,
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '0',
  `konversi` double NOT NULL DEFAULT '1',
  `pur_det_no` varchar(45) DEFAULT NULL,
  `disc1_persen` double NOT NULL DEFAULT '0',
  `disc1_rp` double NOT NULL DEFAULT '0',
  `disc2_persen` double NOT NULL DEFAULT '0',
  `disc2_rp` double NOT NULL DEFAULT '0',
  `ppn_persen` double NOT NULL DEFAULT '0',
  `ppn_rp` double NOT NULL DEFAULT '0',
  `harga_satuan` double NOT NULL DEFAULT '0',
  `nama_brg` varchar(145) DEFAULT NULL,
  `gud_no` varchar(45) DEFAULT NULL,
  `disc3_rp` double DEFAULT '0',
  `disc3_persen` double DEFAULT '0',
  `ret_det_sub_total` double DEFAULT '0',
  `qty_satuan2` double DEFAULT '0',
  `satuan2` varchar(50) DEFAULT NULL,
  `konversi2` double DEFAULT '0',
  PRIMARY KEY (`ret_det_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_purchase_retur`
--

/*!40000 ALTER TABLE `td_purchase_retur` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_purchase_retur` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_receive_faktur`
--

DROP TABLE IF EXISTS `td_receive_faktur`;
CREATE TABLE `td_receive_faktur` (
  `rec_det_no` varchar(50) NOT NULL DEFAULT '',
  `rec_no` varchar(45) DEFAULT NULL,
  `out_no` varchar(45) DEFAULT NULL,
  `rec_piutang` double NOT NULL DEFAULT '0',
  `rec_bayar` double NOT NULL DEFAULT '0',
  `rec_saldo` double NOT NULL DEFAULT '0',
  `rec_desc` varchar(145) DEFAULT NULL,
  `is_status` int(4) DEFAULT '0',
  `rec_dpp` double DEFAULT '0',
  `rec_ppn` double DEFAULT '0',
  `rec_bulat` double DEFAULT '0',
  PRIMARY KEY (`rec_det_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_receive_faktur`
--

/*!40000 ALTER TABLE `td_receive_faktur` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_receive_faktur` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_receive_purchase`
--

DROP TABLE IF EXISTS `td_receive_purchase`;
CREATE TABLE `td_receive_purchase` (
  `rp_det_no` varchar(50) NOT NULL DEFAULT '',
  `rp_no` varchar(45) DEFAULT NULL,
  `in_no` varchar(45) DEFAULT NULL,
  `rp_bayar` double NOT NULL DEFAULT '0',
  `rp_det_ket` varchar(145) DEFAULT NULL,
  `is_status` int(4) DEFAULT '0',
  PRIMARY KEY (`rp_det_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_receive_purchase`
--

/*!40000 ALTER TABLE `td_receive_purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_receive_purchase` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_sales`
--

DROP TABLE IF EXISTS `td_sales`;
CREATE TABLE `td_sales` (
  `det_sales_no` varchar(50) NOT NULL DEFAULT '',
  `jual_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `satuan` int(11) NOT NULL DEFAULT '1',
  `konversi` double(15,3) NOT NULL DEFAULT '0.000',
  `qty_satuan` double NOT NULL DEFAULT '0',
  `harga_satuan` double(15,3) NOT NULL DEFAULT '0.000',
  `det_total` double(15,3) NOT NULL DEFAULT '0.000',
  `disc1_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `disc1_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `disc2_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `disc2_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `disc3_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `disc3_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `price_netto` double(15,3) NOT NULL DEFAULT '0.000',
  `det_sales_qty` double(15,3) NOT NULL DEFAULT '0.000',
  `gud_no` varchar(50) DEFAULT NULL,
  `qty_retur` double NOT NULL DEFAULT '0',
  `det_sal_ord` varchar(50) DEFAULT NULL,
  `nama_brg` varchar(145) DEFAULT NULL,
  `pr_no` varchar(50) DEFAULT NULL,
  `persen_komisi` double DEFAULT '0',
  `price_satuan3` double DEFAULT '0',
  `ppn_rp` double DEFAULT '0',
  `ppn_persen` double DEFAULT '0',
  `hargabeli` double DEFAULT '0',
  `totalbeli` double DEFAULT '0',
  `det_sales_desc` varchar(50) DEFAULT NULL,
  `jenis_harga` int(11) DEFAULT '1',
  `qty_satuan2` double DEFAULT '0',
  `satuan2` varchar(50) DEFAULT NULL,
  `konversi2` double DEFAULT '0',
  `serial_no` varchar(50) DEFAULT NULL,
  `det_sal_desc` varchar(255) DEFAULT NULL,
  `out_det_no` varchar(50) DEFAULT NULL,
  `harga_satuan_kurs` double NOT NULL DEFAULT '0',
  `det_total_kurs` double NOT NULL DEFAULT '0',
  `disc1_rp_kurs` double NOT NULL DEFAULT '0',
  `disc2_rp_kurs` double NOT NULL DEFAULT '0',
  `disc3_rp_kurs` double NOT NULL DEFAULT '0',
  `price_netto_kurs` double NOT NULL DEFAULT '0',
  `ppn_rp_kurs` double NOT NULL DEFAULT '0',
  `uang_id` varchar(50) NOT NULL DEFAULT 'IDR01',
  `kurs_cur` double NOT NULL DEFAULT '1',
  `det_sales_no_reff` varchar(45) NOT NULL DEFAULT '',
  `is_tax` int(11) DEFAULT '0',
  `det_sub_4tax` double DEFAULT '0',
  `is_pkp` int(11) DEFAULT '0',
  `discG_rp` double DEFAULT '0',
  `discG_persen` double DEFAULT '0',
  `jur_det_no_jual` varchar(45) DEFAULT NULL,
  `jur_det_no_pot` varchar(45) DEFAULT NULL,
  `jur_det_no_ppn` varchar(45) DEFAULT NULL,
  `disc_id` int(11) DEFAULT '0',
  `jur_det_no_komisi` varchar(45) DEFAULT NULL,
  `is_komisi` int(4) DEFAULT '0',
  `sn_number` varchar(45) DEFAULT NULL,
  `PointID` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`det_sales_no`),
  KEY `Index_2` (`jual_no`),
  KEY `Index_3` (`prod_no`),
  KEY `Index_4` (`det_sales_no_reff`),
  KEY `Index_5` (`out_det_no`),
  KEY `Index_6` (`det_sal_ord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_sales`
--

/*!40000 ALTER TABLE `td_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_sales` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_sales_detail`
--

DROP TABLE IF EXISTS `td_sales_detail`;
CREATE TABLE `td_sales_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `out_det_no` varchar(45) NOT NULL DEFAULT '',
  `in_det_no` varchar(45) NOT NULL DEFAULT '',
  `det_sales_no` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `Index_2` (`out_det_no`),
  KEY `Index_4` (`in_det_no`),
  KEY `Index_3` (`det_sales_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_sales_detail`
--

/*!40000 ALTER TABLE `td_sales_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_sales_detail` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_sales_order`
--

DROP TABLE IF EXISTS `td_sales_order`;
CREATE TABLE `td_sales_order` (
  `det_sal_ord` varchar(50) NOT NULL DEFAULT '',
  `sal_ord` varchar(45) DEFAULT NULL,
  `prod_no` varchar(45) DEFAULT NULL,
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '0',
  `konversi` double NOT NULL DEFAULT '0',
  `det_sal_price` double NOT NULL DEFAULT '0' COMMENT 'satuan terkecil',
  `det_sal_total` double NOT NULL DEFAULT '0',
  `det_sal_qty` double NOT NULL DEFAULT '0',
  `qty_kirim` double NOT NULL DEFAULT '0',
  `nama_brg` varchar(145) DEFAULT NULL,
  `disc1_persen` double DEFAULT '0',
  `disc1_rp` double DEFAULT '0',
  `disc2_persen` double DEFAULT '0',
  `disc2_rp` double DEFAULT '0',
  `disc3_persen` double DEFAULT '0',
  `disc3_rp` double DEFAULT '0',
  `sal_ord_det_ket` varchar(50) DEFAULT NULL,
  `jenis_harga` int(11) DEFAULT '1',
  `qty_stock` double DEFAULT '0',
  `prod_on_sppb_lainnya` double DEFAULT '0',
  `prod_on_sppb` double DEFAULT '0',
  `qty_satuan2` double DEFAULT '0',
  `satuan2` varchar(50) DEFAULT NULL,
  `konversi2` double DEFAULT '0',
  `uang_id` varchar(50) NOT NULL DEFAULT 'IDR01',
  `kurs_cur` double NOT NULL DEFAULT '1',
  `det_sal_price_kurs` double DEFAULT '0',
  `det_sal_total_kurs` double DEFAULT '0',
  `disc1_rp_kurs` double DEFAULT '0',
  `disc2_rp_kurs` double DEFAULT '0',
  `disc3_rp_kurs` double DEFAULT '0',
  `is_pkp` int(11) DEFAULT '0',
  `is_checked` int(4) DEFAULT '0',
  `verify_qty` double DEFAULT '0',
  `verify_user` int(11) DEFAULT '0',
  `verify_date` datetime DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`det_sal_ord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_sales_order`
--

/*!40000 ALTER TABLE `td_sales_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_sales_order` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_sales_retur`
--

DROP TABLE IF EXISTS `td_sales_retur`;
CREATE TABLE `td_sales_retur` (
  `det_sal_ret_no` varchar(50) NOT NULL DEFAULT '',
  `sal_ret_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `sal_ret_qty` double NOT NULL DEFAULT '0',
  `sal_ret_price` double NOT NULL DEFAULT '0',
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '0',
  `konversi` double NOT NULL DEFAULT '0',
  `det_sales_no` varchar(45) DEFAULT NULL,
  `price_netto` double NOT NULL DEFAULT '0',
  `in_det_no` varchar(45) DEFAULT NULL,
  `nama_brg` varchar(145) DEFAULT NULL,
  `gud_no` varchar(45) DEFAULT NULL,
  `ppn_rp` double DEFAULT '0',
  `ppn_persen` double DEFAULT '0',
  `let_no` varchar(50) DEFAULT NULL,
  `disc1_persen` double DEFAULT '0',
  `disc1_rp` double DEFAULT '0',
  `disc2_persen` double DEFAULT '0',
  `disc2_rp` double DEFAULT '0',
  `disc3_persen` double DEFAULT '0',
  `disc3_rp` double DEFAULT '0',
  `sal_ret_det_total` double DEFAULT '0',
  `qty_satuan2` double DEFAULT '0',
  `satuan2` varchar(50) DEFAULT NULL,
  `konversi2` double DEFAULT '0',
  PRIMARY KEY (`det_sal_ret_no`),
  KEY `Index_2` (`sal_ret_no`),
  KEY `Index_3` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_sales_retur`
--

/*!40000 ALTER TABLE `td_sales_retur` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_sales_retur` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_set_bb`
--

DROP TABLE IF EXISTS `td_set_bb`;
CREATE TABLE `td_set_bb` (
  `det_no` varchar(50) NOT NULL DEFAULT '',
  `bb_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `qty_satuan` double DEFAULT '0',
  `satuan` int(11) DEFAULT '0',
  `konversi` double DEFAULT '0',
  `harga_satuan` double DEFAULT '0',
  `price_netto` double DEFAULT '0',
  `keterangan` varchar(250) DEFAULT NULL,
  `qty_pemakaian` double DEFAULT '0',
  `qty_dibutuhkan` double DEFAULT '0',
  `satuan_pakai` varchar(10) DEFAULT '',
  `satuan_butuh` varchar(10) DEFAULT '',
  PRIMARY KEY (`det_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_set_bb`
--

/*!40000 ALTER TABLE `td_set_bb` DISABLE KEYS */;
INSERT INTO `td_set_bb` (`det_no`,`bb_no`,`prod_no`,`gud_no`,`qty_satuan`,`satuan`,`konversi`,`harga_satuan`,`price_netto`,`keterangan`,`qty_pemakaian`,`qty_dibutuhkan`,`satuan_pakai`,`satuan_butuh`) VALUES 
 ('PT-230503-161814-0001','BB-2353-161714-0001','ID-230503-152831-0001',NULL,2,1,1,0,0,'',2000,1,'G','KG'),
 ('PT-230509-153557-0001','BB-2359-153557-0001','ID-230503-152831-0001',NULL,0.6,1,1,0,0,'',600,1,'G','KG'),
 ('PT-230509-153557-0002','BB-2359-153557-0001','ID-230503-163204-0003',NULL,500,1,1,0,0,'',500,1,'G','G');
/*!40000 ALTER TABLE `td_set_bb` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_set_hpp`
--

DROP TABLE IF EXISTS `td_set_hpp`;
CREATE TABLE `td_set_hpp` (
  `det_no` varchar(50) NOT NULL DEFAULT '',
  `hap_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `satuan` int(11) DEFAULT '0',
  `konversi` double DEFAULT '0',
  `harga_satuan` double DEFAULT '0',
  `price_netto` double DEFAULT '0',
  `keterangan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`det_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`td_set_hpp`
--

/*!40000 ALTER TABLE `td_set_hpp` DISABLE KEYS */;
INSERT INTO `td_set_hpp` (`det_no`,`hap_no`,`prod_no`,`satuan`,`konversi`,`harga_satuan`,`price_netto`,`keterangan`) VALUES 
 ('ID-230503-162318-0001','HR-2353-162218-0001','ID-230503-152831-0001',1,0,0,0,''),
 ('ID-230503-162318-0002','HR-2353-162218-0001','ID-230331-102545-0001',1,0,0,0,''),
 ('ID-230503-163516-0003','HR-2353-163416-0002','ID-230503-163204-0003',1,0,0,0,'');
/*!40000 ALTER TABLE `td_set_hpp` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_shift_modal`
--

DROP TABLE IF EXISTS `td_shift_modal`;
CREATE TABLE `td_shift_modal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_no` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jml_modal` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `ohh_bakery`.`td_shift_modal`
--

/*!40000 ALTER TABLE `td_shift_modal` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_shift_modal` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`td_transfer_req`
--

DROP TABLE IF EXISTS `td_transfer_req`;
CREATE TABLE `td_transfer_req` (
  `det_req_no` varchar(50) NOT NULL DEFAULT '',
  `req_no` varchar(45) NOT NULL DEFAULT '',
  `prod_no` varchar(45) NOT NULL DEFAULT '',
  `gud_no1` varchar(45) NOT NULL DEFAULT '',
  `gud_no2` varchar(45) NOT NULL DEFAULT '',
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '0',
  `konversi` double NOT NULL DEFAULT '0',
  `det_req_desc` varchar(145) DEFAULT NULL,
  `qty_transfer` double NOT NULL DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_status` int(4) DEFAULT '0',
  `is_checked` int(4) DEFAULT '0',
  `verify_qty` double DEFAULT '0',
  `verify_user` int(11) DEFAULT '0',
  `verify_date` datetime DEFAULT NULL,
  `price_nett` double DEFAULT '0',
  PRIMARY KEY (`det_req_no`),
  KEY `Index_2` (`req_no`),
  KEY `Index_3` (`prod_no`),
  KEY `Index_4` (`gud_no1`),
  KEY `Index_5` (`gud_no2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`td_transfer_req`
--

/*!40000 ALTER TABLE `td_transfer_req` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_transfer_req` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdetail_in`
--

DROP TABLE IF EXISTS `tdetail_in`;
CREATE TABLE `tdetail_in` (
  `in_det_no` varchar(50) NOT NULL,
  `in_no` varchar(150) DEFAULT NULL,
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `in_det_buy_price` double NOT NULL DEFAULT '0',
  `in_det_qty` double NOT NULL DEFAULT '0',
  `in_det_total` double NOT NULL DEFAULT '0',
  `in_det_on_hand` double NOT NULL DEFAULT '0',
  `out_det_no` varchar(50) DEFAULT NULL,
  `qty_retur` double NOT NULL DEFAULT '0',
  `in_det_batch` varchar(50) DEFAULT NULL,
  `price_netto` double NOT NULL DEFAULT '0',
  `out_det_buy_price` double NOT NULL DEFAULT '0',
  `pur_det_no` varchar(50) DEFAULT NULL,
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '1',
  `konversi` double NOT NULL DEFAULT '1',
  `det_sales_no` varchar(45) DEFAULT NULL,
  `det_sal_ret_no` varchar(45) DEFAULT NULL,
  `det_pur_ord` varchar(45) DEFAULT NULL,
  `gud_no` varchar(45) DEFAULT NULL,
  `jur_det_no1` varchar(50) DEFAULT NULL,
  `jur_det_no2` varchar(50) DEFAULT NULL,
  `rek_brg` varchar(50) DEFAULT NULL,
  `rek_unbill_gr` varchar(50) DEFAULT NULL,
  `in_det_desc` varchar(250) DEFAULT NULL,
  `is_faktur` int(11) NOT NULL DEFAULT '0',
  `qty_satuan2` double DEFAULT '0',
  `satuan2` varchar(50) DEFAULT NULL,
  `konversi2` double DEFAULT '0',
  `in_det_qty2` double DEFAULT '0',
  `serial_no` varchar(50) DEFAULT NULL,
  `harga_satuan` double DEFAULT '0',
  `gud_git` varchar(50) DEFAULT NULL,
  `gud_no2` varchar(50) DEFAULT NULL,
  `qty_kirim` double NOT NULL DEFAULT '0',
  `price_netto_ppn` double DEFAULT '0',
  `out_det_no_reff` varchar(50) DEFAULT NULL,
  `det_req_no` varchar(50) DEFAULT NULL,
  `price_nett` double DEFAULT '0',
  PRIMARY KEY (`in_det_no`),
  KEY `Index_2` (`in_no`),
  KEY `Index_3` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdetail_in`
--

/*!40000 ALTER TABLE `tdetail_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdetail_in` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdetail_out`
--

DROP TABLE IF EXISTS `tdetail_out`;
CREATE TABLE `tdetail_out` (
  `out_det_no` varchar(50) NOT NULL DEFAULT '',
  `out_no` varchar(50) NOT NULL DEFAULT '',
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `out_det_sell_price` double NOT NULL DEFAULT '0',
  `out_det_buy_price` double NOT NULL DEFAULT '0',
  `out_det_qty` double NOT NULL DEFAULT '0',
  `out_det_disc` double NOT NULL DEFAULT '0',
  `in_det_no` varchar(50) DEFAULT NULL,
  `qty_retur` double NOT NULL DEFAULT '0',
  `price_netto` double NOT NULL DEFAULT '0',
  `det_sales_no` varchar(50) DEFAULT NULL,
  `ret_det_no` varchar(50) DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `qty_satuan` double NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '1',
  `konversi` double NOT NULL DEFAULT '0',
  `qty_skr` double NOT NULL DEFAULT '0',
  `gud_no2` varchar(50) DEFAULT NULL,
  `is_valid` int(11) NOT NULL DEFAULT '0',
  `user_valid` int(11) NOT NULL DEFAULT '0',
  `valid_date` datetime DEFAULT NULL,
  `pr_qty_jual` double DEFAULT '0',
  `det_sal_ord` varchar(50) DEFAULT NULL,
  `jur_det_no1` varchar(50) DEFAULT NULL,
  `jur_det_no2` varchar(50) DEFAULT NULL,
  `rek_brg` varchar(50) DEFAULT NULL,
  `rek_unbill_gr` varchar(50) DEFAULT NULL,
  `out_det_desc` varchar(250) DEFAULT NULL,
  `is_faktur` int(11) NOT NULL DEFAULT '0',
  `qty_satuan2` double DEFAULT '0',
  `satuan2` varchar(50) DEFAULT NULL,
  `konversi2` double DEFAULT '0',
  `out_det_qty2` double DEFAULT '0',
  `serial_no` varchar(50) DEFAULT NULL,
  `qty_terima` double NOT NULL DEFAULT '0',
  `gud_git` varchar(50) DEFAULT NULL,
  `prod_buy_price` double DEFAULT '0',
  `harga_beli` double DEFAULT '0',
  `out_det_no_reff` varchar(50) DEFAULT NULL,
  `det_req_no` varchar(50) DEFAULT NULL,
  `pur_det_no` varchar(50) DEFAULT NULL,
  `price_nett` double DEFAULT '0',
  `adj_det_no` varchar(50) DEFAULT NULL,
  `qty_fisik` double DEFAULT '0',
  PRIMARY KEY (`out_det_no`),
  KEY `Index_2` (`out_no`),
  KEY `Index_3` (`prod_no`),
  KEY `Index_4` (`det_sales_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdetail_out`
--

/*!40000 ALTER TABLE `tdetail_out` DISABLE KEYS */;
INSERT INTO `tdetail_out` (`out_det_no`,`out_no`,`prod_no`,`out_det_sell_price`,`out_det_buy_price`,`out_det_qty`,`out_det_disc`,`in_det_no`,`qty_retur`,`price_netto`,`det_sales_no`,`ret_det_no`,`gud_no`,`qty_satuan`,`satuan`,`konversi`,`qty_skr`,`gud_no2`,`is_valid`,`user_valid`,`valid_date`,`pr_qty_jual`,`det_sal_ord`,`jur_det_no1`,`jur_det_no2`,`rek_brg`,`rek_unbill_gr`,`out_det_desc`,`is_faktur`,`qty_satuan2`,`satuan2`,`konversi2`,`out_det_qty2`,`serial_no`,`qty_terima`,`gud_git`,`prod_buy_price`,`harga_beli`,`out_det_no_reff`,`det_req_no`,`pur_det_no`,`price_nett`,`adj_det_no`,`qty_fisik`) VALUES 
 ('PT-230509-170203-0016','PT-PRD202350015','ID-230503-152831-0001',0,0,0.24,0,NULL,0,0,'PT-230509-170203-0016',NULL,'ID2',0.24,0,1,0,NULL,0,0,NULL,0,NULL,'PT-230509-170203-0031','PT-230509-170203-0032','ID0602161402481','ID0602161402481',NULL,0,0,NULL,0,0,NULL,0,NULL,0,0,NULL,NULL,NULL,0,NULL,0),
 ('PT-230509-170203-0017','PT-PRD202350015','ID-230503-163204-0003',0,0,0.12,0,NULL,0,0,'PT-230509-170203-0017',NULL,'ID2',0.12,0,1,0,NULL,0,0,NULL,0,NULL,'PT-230509-170203-0033','PT-230509-170203-0034','ID0602161402481','ID0602161402481',NULL,0,0,NULL,0,0,NULL,0,NULL,0,0,NULL,NULL,NULL,0,NULL,0),
 ('PT-230509-170203-0018','PT-PRD202350015','ID-230503-161704-0002',0,0,-0.4,0,NULL,0,0,'PT-230509-170203-0018',NULL,'ID2',-0.4,0,1,0,NULL,0,0,NULL,0,NULL,'PT-230509-170203-0035','PT-230509-170203-0036','ID0602161402481','ID0602161402481',NULL,0,0,NULL,0,0,NULL,0,NULL,0,0,NULL,NULL,NULL,0,NULL,0);
/*!40000 ALTER TABLE `tdetail_out` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdg_rek_kurs`
--

DROP TABLE IF EXISTS `tdg_rek_kurs`;
CREATE TABLE `tdg_rek_kurs` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `rek_no` varchar(50) DEFAULT NULL,
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `total` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index1` (`rek_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdg_rek_kurs`
--

/*!40000 ALTER TABLE `tdg_rek_kurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdg_rek_kurs` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdg_rek_outlet`
--

DROP TABLE IF EXISTS `tdg_rek_outlet`;
CREATE TABLE `tdg_rek_outlet` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `let_no` varchar(50) NOT NULL DEFAULT '',
  `rek_no` varchar(50) NOT NULL DEFAULT '',
  `total` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index1` (`let_no`),
  KEY `index2` (`rek_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdg_rek_outlet`
--

/*!40000 ALTER TABLE `tdg_rek_outlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdg_rek_outlet` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdgoutlet`
--

DROP TABLE IF EXISTS `tdgoutlet`;
CREATE TABLE `tdgoutlet` (
  `id` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `prod_no` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `let_no` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `prod_on_hand` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Index_2` (`let_no`),
  KEY `Index_3` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `ohh_bakery`.`tdgoutlet`
--

/*!40000 ALTER TABLE `tdgoutlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdgoutlet` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdgproduct`
--

DROP TABLE IF EXISTS `tdgproduct`;
CREATE TABLE `tdgproduct` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `prod_no` varchar(50) DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `prod_on_hand` double NOT NULL DEFAULT '0',
  `prod_on_sell` double NOT NULL DEFAULT '0',
  `prod_on_hand2` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Index_2` (`gud_no`),
  KEY `Index_3` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdgproduct`
--

/*!40000 ALTER TABLE `tdgproduct` DISABLE KEYS */;
INSERT INTO `tdgproduct` (`id`,`prod_no`,`gud_no`,`prod_on_hand`,`prod_on_sell`,`prod_on_hand2`) VALUES 
 ('ID-230331-113643-0001','ID-230331-102545-0001','ID2',10000,0,0),
 ('PT-230503-152857-0001','ID-230503-152831-0001','ID2',9.76,0,0),
 ('PT-230503-163351-0002','ID-230503-163204-0003','ID2',4999.88,0,0),
 ('PT-230503-164608-0003','ID-230503-161704-0002','ID2',1.4,0,0);
/*!40000 ALTER TABLE `tdgproduct` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdgproduct_wh`
--

DROP TABLE IF EXISTS `tdgproduct_wh`;
CREATE TABLE `tdgproduct_wh` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `prod_no` varchar(50) DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `prod_on_hand` double NOT NULL DEFAULT '0',
  `prod_on_sell` double NOT NULL DEFAULT '0',
  `prod_on_hand2` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Index_2` (`gud_no`),
  KEY `Index_3` (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdgproduct_wh`
--

/*!40000 ALTER TABLE `tdgproduct_wh` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdgproduct_wh` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdjurnal`
--

DROP TABLE IF EXISTS `tdjurnal`;
CREATE TABLE `tdjurnal` (
  `jur_det_no` varchar(50) NOT NULL DEFAULT '',
  `jur_no` varchar(50) NOT NULL DEFAULT '',
  `rek_no` varchar(50) NOT NULL DEFAULT '',
  `keterangan` varchar(250) DEFAULT NULL,
  `debet` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0',
  `jur_no_reff` varchar(50) DEFAULT NULL,
  `is_top` int(11) NOT NULL DEFAULT '0',
  `is_hpp` int(11) NOT NULL DEFAULT '0',
  `is_brg` int(11) NOT NULL DEFAULT '0',
  `debet_kurs` double DEFAULT '0',
  `kredit_kurs` double DEFAULT '0',
  `kurs_cur` double DEFAULT '1',
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `cab_id` varchar(50) DEFAULT 'ID01',
  `id_rek` varchar(50) DEFAULT NULL,
  `is_pos` int(4) DEFAULT '0',
  `is_pkp` int(4) DEFAULT '0',
  `is_tax` int(4) DEFAULT '0',
  PRIMARY KEY (`jur_det_no`),
  KEY `Index_2` (`jur_no`),
  KEY `Index_3` (`rek_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=177;

--
-- Dumping data for table `ohh_bakery`.`tdjurnal`
--

/*!40000 ALTER TABLE `tdjurnal` DISABLE KEYS */;
INSERT INTO `tdjurnal` (`jur_det_no`,`jur_no`,`rek_no`,`keterangan`,`debet`,`kredit`,`jur_no_reff`,`is_top`,`is_hpp`,`is_brg`,`debet_kurs`,`kredit_kurs`,`kurs_cur`,`uang_id`,`cab_id`,`id_rek`,`is_pos`,`is_pkp`,`is_tax`) VALUES 
 ('PT-230509-170203-0031','PT-GL202350007','ID0602161402481','Detail Bahan Baku No. PT-PRD202350015 BRC123 - SEGITIGA TEPUNG',0,0,NULL,0,0,0,0,0,1,'IDR01','ID01',NULL,0,0,0),
 ('PT-230509-170203-0032','PT-GL202350007','ID0602161402481','Detail Bahan Baku No. PT-PRD202350015 BRC123 - SEGITIGA TEPUNG',0,0,NULL,0,0,0,0,0,1,'IDR01','ID01',NULL,0,0,0),
 ('PT-230509-170203-0033','PT-GL202350007','ID0602161402481','Detail Bahan Baku No. PT-PRD202350015 BRGN455 - GULA HALUS',0,0,NULL,0,0,0,0,0,1,'IDR01','ID01',NULL,0,0,0),
 ('PT-230509-170203-0034','PT-GL202350007','ID0602161402481','Detail Bahan Baku No. PT-PRD202350015 BRGN455 - GULA HALUS',0,0,NULL,0,0,0,0,0,1,'IDR01','ID01',NULL,0,0,0),
 ('PT-230509-170203-0035','PT-GL202350007','ID0602161402481','Detail Produksi No. PT-PRD202350015 PRD2311 - ROTI BOI',0,0,NULL,0,0,0,0,0,1,'IDR01','ID01',NULL,0,0,0),
 ('PT-230509-170203-0036','PT-GL202350007','ID0602161402481','Detail Produksi No. PT-PRD202350015 PRD2311 - ROTI BOI',0,0,NULL,0,0,0,0,0,1,'IDR01','ID01',NULL,0,0,0);
/*!40000 ALTER TABLE `tdjurnal` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdpay`
--

DROP TABLE IF EXISTS `tdpay`;
CREATE TABLE `tdpay` (
  `pay_det_no` varchar(50) NOT NULL,
  `pay_no` varchar(50) DEFAULT NULL,
  `in_no` varchar(50) DEFAULT NULL,
  `pay_bayar` double NOT NULL DEFAULT '0',
  `pay_pot` double NOT NULL DEFAULT '0',
  `pay_type` int(11) NOT NULL DEFAULT '0',
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `pay_bayar_kurs` double DEFAULT '0',
  `pay_pot_kurs` double DEFAULT '0',
  `pay_selisih_kurs` double DEFAULT '0',
  `pay_selisih` double DEFAULT '0',
  `pay_koreksi_kurs` double DEFAULT '0',
  `pay_koreksi` double DEFAULT '0',
  `pay_det_ket` varchar(150) DEFAULT NULL,
  `v_det_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pay_det_no`),
  KEY `Index_2` (`pay_no`),
  KEY `Index_3` (`in_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdpay`
--

/*!40000 ALTER TABLE `tdpay` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdpay` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdterima`
--

DROP TABLE IF EXISTS `tdterima`;
CREATE TABLE `tdterima` (
  `ter_no` varchar(50) DEFAULT NULL,
  `out_no` varchar(50) DEFAULT NULL,
  `ter_bayar` double NOT NULL DEFAULT '0',
  `ter_pot` double NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jur_no` varchar(45) DEFAULT NULL,
  `user_valid` int(11) NOT NULL DEFAULT '0',
  `tgl_valid` datetime DEFAULT NULL,
  `is_valid` int(11) NOT NULL DEFAULT '0',
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `ter_bayar_kurs` double DEFAULT '0',
  `ter_pot_kurs` double DEFAULT '0',
  `bayar_tunai` double DEFAULT '0',
  `bayar_non_tunai` double DEFAULT '0',
  `ter_koreksi` double DEFAULT '0',
  `ter_selisih` double DEFAULT '0',
  `ter_um` double DEFAULT '0',
  `ter_selisih_kurs` double DEFAULT '0',
  `ter_koreksi_kurs` double DEFAULT '0',
  `ter_det_ket` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`ter_no`),
  KEY `Index_3` (`out_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdterima`
--

/*!40000 ALTER TABLE `tdterima` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdterima` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tdvoucher_hutang`
--

DROP TABLE IF EXISTS `tdvoucher_hutang`;
CREATE TABLE `tdvoucher_hutang` (
  `v_det_no` varchar(50) NOT NULL DEFAULT '',
  `v_no` varchar(45) DEFAULT NULL,
  `in_no` varchar(45) DEFAULT NULL,
  `v_bayar` double NOT NULL DEFAULT '0',
  `v_det_ket` varchar(145) DEFAULT NULL,
  `is_status` int(4) DEFAULT '0',
  PRIMARY KEY (`v_det_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tdvoucher_hutang`
--

/*!40000 ALTER TABLE `tdvoucher_hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tdvoucher_hutang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tgroup`
--

DROP TABLE IF EXISTS `tgroup`;
CREATE TABLE `tgroup` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `old_id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(50) DEFAULT NULL,
  `id_lama` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT '0',
  `is_modif` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `rek_no` varchar(50) DEFAULT NULL,
  `nhari` int(11) NOT NULL DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `Index_2` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tgroup`
--

/*!40000 ALTER TABLE `tgroup` DISABLE KEYS */;
INSERT INTO `tgroup` (`group_id`,`kode`,`jumlah`,`is_delete`,`old_id`,`nama`,`id_lama`,`cat_id`,`is_modif`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`rek_no`,`nhari`,`is_downloaded`,`iUpload`,`Upload_date`) VALUES 
 (1,'SK123',0,0,0,'TEPUNG',NULL,0,0,0,'2023-03-31 10:24:51',0,NULL,0,NULL,NULL,0,0,1,NULL),
 (2,'SK32',0,0,0,'ROTI',NULL,0,0,0,'2023-05-03 16:15:49',0,NULL,0,NULL,NULL,0,0,1,NULL);
/*!40000 ALTER TABLE `tgroup` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tgroup_customer`
--

DROP TABLE IF EXISTS `tgroup_customer`;
CREATE TABLE `tgroup_customer` (
  `gc_no` varchar(50) NOT NULL,
  `gc_code` varchar(50) DEFAULT NULL,
  `gc_name` varchar(50) DEFAULT NULL,
  `gc_alamat` varchar(50) DEFAULT NULL,
  `gc_telp` varchar(50) DEFAULT NULL,
  `gc_hp` varchar(50) DEFAULT NULL,
  `gc_contact` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `person_limit` double DEFAULT '0',
  `is_member` int(4) DEFAULT '0',
  PRIMARY KEY (`gc_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tgroup_customer`
--

/*!40000 ALTER TABLE `tgroup_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tgroup_customer` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tgroup_users`
--

DROP TABLE IF EXISTS `tgroup_users`;
CREATE TABLE `tgroup_users` (
  `group_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_right` varchar(5000) DEFAULT NULL,
  `is_Super` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_archive` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tgroup_users`
--

/*!40000 ALTER TABLE `tgroup_users` DISABLE KEYS */;
INSERT INTO `tgroup_users` (`group_user_id`,`user_name`,`user_right`,`is_Super`,`is_delete`,`is_downloaded`,`iUpload`,`Upload_date`,`is_archive`) VALUES 
 (1,'Super User','1 2 2A 2B 3A 3 3B 3C 3D 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 16B 17B 18B 19B 16C 17C 18C 19C 16D 17D 18D 19D 20 21 22 23 20A 20B 24A 24B 24C 24D 25A 25B 25C 25D 27A 27B 27C 27D 28 29 30 31 31A 32 33 34 35 36AA 36 36A 37 38 39 40 41 42 41C 43 44 45 46 47 48 49 50 51 52 48B 49B 50B 51B 52B 53 54 53A 53C 54A 54B 54C 54D 55 56 57 58 58A 63 64 65 66 65A 66AA 66A 66B 66C 67 68 69 70 71 67A 72 73 74 75 76 77 78 79 80 81 82 83 83A 83B 83C 201A 201B 201C 201D 201E 202A 111 112 113 114 115 111A 203A 203B 203C 203D 203E 100 101 102 103 103A 96 97 98 207A 207B 207C 207D 208A 208B 208C 208D 208E 84 85 86 87 88 89 90 91 KASIR_SET KASIR PRICE 126 127 128 129 130 131 132 133 134 135 136 137 138 139 139A 140 141 141A 142 143 144 145 145A 94A 95 95B 95A 95C 95D 104 401 402 415B 403 404 405 406 407 408 409 410 411 412 413 414 415 415B 416 417 417A 417B 418 419 420 421 422 423 423A 424 425 426 427 428 429 430 431 432 433 434 435 436 436-1 437 438 439 440 441 442 443 444 445 446 447 448 449 450 451 452 453 454 455 456 457 458 459 460 461 462 463 464 465 466 467 468 469 470 471 472 160 302 304 305 305B 306 307 307B 308 308B 311 312 313 314 315 316 317 318 319 320 321 322 323 324 325 326 327 328 329 330 331 332 333 334 335 336 336A 337 338 339 342B 343 343B 340 341 344 344B 345 345B 346 347 348 349 350 351 ',1,0,1,0,NULL,NULL),
 (2,'super admin web','1 2 21 21A 21B 21C 21D 21E 21F 22 22A 22B 22C 22D 22E 22F 21G 21H 23 23A 23B 23C 23D 23E 23F 3 31 31A 31B 31C 31D 31E 31F 32 32A 32B 32C 32D 32E 32F 33 33A 33B 33C 33D 33E 33F 4 41 41A 41B 41C 41D 41E 41F 5 51 51A 51B 52 52A 52B 52C 52D 52E 52F 53 53A 53B 53C 53D',1,0,0,0,'2023-02-08 11:49:06',0);
INSERT INTO `tgroup_users` (`group_user_id`,`user_name`,`user_right`,`is_Super`,`is_delete`,`is_downloaded`,`iUpload`,`Upload_date`,`is_archive`) VALUES 
 (3,'admin resep','1 2 21 21A 21B 21C 21D 21E 21F 22 22A 22B 22C 22D 22E 22F 22G 22H 23 23A 23B 23C 23D 23E 23F',0,0,0,0,'2023-02-08 11:49:06',0),
 (4,'hr','1 5 51 51A 51B 52 52A 52B 52C 52D 52E 52F 53 53A 53B 53C 53D',0,0,0,0,'2023-02-08 11:49:06',0);
/*!40000 ALTER TABLE `tgroup_users` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tgudang`
--

DROP TABLE IF EXISTS `tgudang`;
CREATE TABLE `tgudang` (
  `gud_no` varchar(50) NOT NULL DEFAULT '',
  `gud_code` varchar(50) DEFAULT NULL,
  `gud_name` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `is_default` int(11) NOT NULL DEFAULT '0',
  `is_jual` int(11) NOT NULL DEFAULT '0',
  `is_produksi` int(11) DEFAULT '0',
  `is_default_kasir` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `cat_gud_no` varchar(50) DEFAULT NULL,
  `let_no` varchar(50) DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`gud_no`),
  KEY `Index_2` (`let_no`),
  KEY `Index_3` (`cat_gud_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tgudang`
--

/*!40000 ALTER TABLE `tgudang` DISABLE KEYS */;
INSERT INTO `tgudang` (`gud_no`,`gud_code`,`gud_name`,`is_delete`,`is_default`,`is_jual`,`is_produksi`,`is_default_kasir`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`cat_gud_no`,`let_no`,`is_downloaded`,`iUpload`,`Upload_date`) VALUES 
 ('ID2','GUDANG','MADURA',0,1,1,0,1,0,NULL,24,'2019-01-20 19:54:33',0,NULL,'CG_000',NULL,1,0,'2019-02-04 02:19:29');
/*!40000 ALTER TABLE `tgudang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`this_harga`
--

DROP TABLE IF EXISTS `this_harga`;
CREATE TABLE `this_harga` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_no` varchar(45) NOT NULL DEFAULT '',
  `harga` double NOT NULL DEFAULT '0',
  `tgl` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(4) DEFAULT '0',
  `satuan` int(4) unsigned NOT NULL DEFAULT '0',
  `harga2` double NOT NULL DEFAULT '0',
  `harga3` double NOT NULL DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`this_harga`
--

/*!40000 ALTER TABLE `this_harga` DISABLE KEYS */;
INSERT INTO `this_harga` (`id`,`prod_no`,`harga`,`tgl`,`user_id`,`satuan`,`harga2`,`harga3`,`iUpload`,`Upload_date`) VALUES 
 (1,'ID-230331-102545-0001',0,'2023-03-31 10:25:45',139,1,0,0,1,NULL),
 (2,'ID-230331-102545-0001',0,'2023-03-31 10:25:45',139,2,0,0,1,NULL),
 (3,'ID-230503-152831-0001',0,'2023-05-03 15:28:32',1,1,0,0,1,NULL),
 (4,'ID-230503-152831-0001',0,'2023-05-03 15:28:32',1,2,0,0,1,NULL),
 (5,'ID-230503-161704-0002',0,'2023-05-03 16:17:04',1,1,0,0,1,NULL),
 (6,'ID-230503-161704-0002',0,'2023-05-03 16:17:04',1,2,0,0,1,NULL),
 (7,'ID-230503-163204-0003',0,'2023-05-03 16:32:04',1,1,0,0,1,NULL),
 (8,'ID-230503-163204-0003',0,'2023-05-03 16:32:04',1,2,0,0,1,NULL),
 (9,'ID-230503-163204-0003',0,'2023-05-05 11:32:38',1,1,0,0,1,NULL),
 (10,'ID-230503-163204-0003',0,'2023-05-05 11:32:38',1,2,0,0,1,NULL),
 (11,'ID-230503-161704-0002',0,'2023-05-05 11:32:44',1,1,0,0,1,NULL),
 (12,'ID-230503-161704-0002',0,'2023-05-05 11:32:44',1,2,0,0,1,NULL),
 (13,'ID-230503-152831-0001',0,'2023-05-05 11:32:48',1,1,0,0,1,NULL),
 (14,'ID-230503-152831-0001',0,'2023-05-05 11:32:48',1,2,0,0,1,NULL);
INSERT INTO `this_harga` (`id`,`prod_no`,`harga`,`tgl`,`user_id`,`satuan`,`harga2`,`harga3`,`iUpload`,`Upload_date`) VALUES 
 (15,'ID-230331-102545-0001',0,'2023-05-05 11:32:52',1,1,0,0,1,NULL),
 (16,'ID-230331-102545-0001',0,'2023-05-05 11:32:52',1,2,0,0,1,NULL),
 (17,'ID-230503-163204-0003',10000,'2023-05-05 14:46:55',1,1,10000,10000,1,NULL),
 (18,'ID-230503-163204-0003',10000,'2023-05-05 14:46:55',1,2,10000,10000,1,NULL),
 (19,'ID-230503-152831-0001',10000,'2023-05-05 14:46:55',1,1,10000,10000,1,NULL),
 (20,'ID-230503-152831-0001',10000,'2023-05-05 14:46:55',1,2,10000,10000,1,NULL),
 (21,'ID-230331-102545-0001',10000,'2023-05-05 14:46:55',1,1,10000,10000,1,NULL),
 (22,'ID-230331-102545-0001',10000,'2023-05-05 14:46:55',1,2,10000,10000,1,NULL),
 (23,'ID-230503-163204-0003',10010000,'2023-05-05 14:47:08',1,1,10000,10000,1,NULL),
 (24,'ID-230503-163204-0003',10010000,'2023-05-05 14:47:08',1,2,10000,10000,1,NULL),
 (25,'ID-230503-152831-0001',130000,'2023-05-05 14:47:08',1,1,10000,10000,1,NULL),
 (26,'ID-230503-152831-0001',130000,'2023-05-05 14:47:08',1,2,10000,10000,1,NULL);
INSERT INTO `this_harga` (`id`,`prod_no`,`harga`,`tgl`,`user_id`,`satuan`,`harga2`,`harga3`,`iUpload`,`Upload_date`) VALUES 
 (27,'ID-230331-102545-0001',10010000,'2023-05-05 14:47:08',1,1,10000,10000,1,NULL),
 (28,'ID-230331-102545-0001',10010000,'2023-05-05 14:47:08',1,2,10000,10000,1,NULL),
 (29,'ID-230503-161704-0002',15000,'2023-05-05 14:47:27',1,1,15000,15000,1,NULL),
 (30,'ID-230503-161704-0002',15000,'2023-05-05 14:47:27',1,2,15000,15000,1,NULL);
/*!40000 ALTER TABLE `this_harga` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`this_qty_disc`
--

DROP TABLE IF EXISTS `this_qty_disc`;
CREATE TABLE `this_qty_disc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_no` varchar(45) NOT NULL DEFAULT '',
  `disc_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jual_no` varchar(50) DEFAULT NULL,
  `qty_faktur` double NOT NULL DEFAULT '0',
  `konversi` double NOT NULL DEFAULT '0',
  `satuan` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`this_qty_disc`
--

/*!40000 ALTER TABLE `this_qty_disc` DISABLE KEYS */;
/*!40000 ALTER TABLE `this_qty_disc` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`thutang`
--

DROP TABLE IF EXISTS `thutang`;
CREATE TABLE `thutang` (
  `in_no` varchar(50) NOT NULL DEFAULT '',
  `hut_tgl_jatuh` datetime DEFAULT NULL,
  `total_hutang` double NOT NULL DEFAULT '0',
  `total_potongan` double NOT NULL DEFAULT '0',
  `total_bayar` double NOT NULL DEFAULT '0',
  `total_retur` double NOT NULL DEFAULT '0',
  `is_lunas` int(11) NOT NULL DEFAULT '0',
  `total_hutang_kurs` double NOT NULL DEFAULT '0',
  `total_potongan_kurs` double NOT NULL DEFAULT '0',
  `total_bayar_kurs` double NOT NULL DEFAULT '0',
  `total_retur_kurs` double NOT NULL DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`in_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`thutang`
--

/*!40000 ALTER TABLE `thutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `thutang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`timg_product`
--

DROP TABLE IF EXISTS `timg_product`;
CREATE TABLE `timg_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `filename` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`timg_product`
--

/*!40000 ALTER TABLE `timg_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `timg_product` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tin`
--

DROP TABLE IF EXISTS `tin`;
CREATE TABLE `tin` (
  `in_no` varchar(150) NOT NULL DEFAULT '',
  `in_date` datetime DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `in_type` int(11) NOT NULL DEFAULT '0',
  `in_total` double NOT NULL DEFAULT '0',
  `in_tr_type` int(11) NOT NULL DEFAULT '0',
  `in_pot` double NOT NULL DEFAULT '0',
  `in_pay` double NOT NULL DEFAULT '0',
  `in_total_retur` double NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `person_no` varchar(50) DEFAULT NULL,
  `in_desc` varchar(150) DEFAULT NULL,
  `out_no` varchar(50) DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `in_sub_total` double NOT NULL DEFAULT '0',
  `persen_pot` double NOT NULL DEFAULT '0',
  `jur_no` varchar(50) DEFAULT NULL,
  `out_no_lain` varchar(50) DEFAULT NULL,
  `price_type` int(11) NOT NULL DEFAULT '0',
  `kas_no` varchar(50) DEFAULT NULL,
  `in_ppn_persen` double NOT NULL DEFAULT '0',
  `in_ppn_rp` double NOT NULL DEFAULT '0',
  `is_ppn` int(11) NOT NULL DEFAULT '0',
  `sal_no` varchar(50) DEFAULT NULL,
  `piutang_disc` double NOT NULL DEFAULT '0',
  `sal_ret_no` varchar(45) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `nm_supir` varchar(50) DEFAULT NULL,
  `sj_date` date DEFAULT NULL,
  `is_print` int(11) NOT NULL DEFAULT '0',
  `is_status` int(11) NOT NULL DEFAULT '0',
  `diterima` varchar(50) DEFAULT NULL,
  `disetujui` varchar(50) DEFAULT NULL,
  `is_lock_no_reff_tax` int(11) NOT NULL DEFAULT '0',
  `no_reff_tax` varchar(50) DEFAULT NULL,
  `prefix_no_tax` varchar(50) DEFAULT NULL,
  `is_lock` int(11) DEFAULT '0',
  `is_modif_in_no` int(11) DEFAULT '0',
  `pur_no` varchar(50) DEFAULT NULL,
  `client_serial` varchar(50) DEFAULT NULL,
  `req_no` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`in_no`),
  KEY `idx_client_serial` (`client_serial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tin`
--

/*!40000 ALTER TABLE `tin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tin` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tjurnal`
--

DROP TABLE IF EXISTS `tjurnal`;
CREATE TABLE `tjurnal` (
  `jur_no` varchar(50) NOT NULL DEFAULT '',
  `jur_tgl` datetime DEFAULT NULL,
  `jur_ket` varchar(150) DEFAULT NULL,
  `jur_total` double NOT NULL DEFAULT '0',
  `is_post` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `for_post` int(11) NOT NULL DEFAULT '0',
  `is_viewed` int(11) NOT NULL DEFAULT '0',
  `gud_no` varchar(50) DEFAULT NULL,
  `is_rl` int(11) NOT NULL DEFAULT '0',
  `jur_no_rl` varchar(50) DEFAULT NULL,
  `is_debet` int(11) NOT NULL DEFAULT '0',
  `is_kas2` int(11) NOT NULL DEFAULT '0',
  `rek_no_debet` varchar(45) DEFAULT NULL,
  `no_reff` varchar(50) DEFAULT NULL,
  `tgl_reff` datetime DEFAULT NULL,
  `no_voucher` varchar(50) DEFAULT NULL,
  `tgl_voucher` datetime DEFAULT NULL,
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `is_batal` int(11) DEFAULT '0',
  `jenis_trx` int(11) DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `user_batal` int(11) DEFAULT '0',
  `batal_desc` varchar(50) DEFAULT NULL,
  `batal_date` datetime DEFAULT NULL,
  `let_no` varchar(50) DEFAULT NULL,
  `jur_total_kurs` double DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '1',
  `is_pkp` int(4) DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`jur_no`),
  KEY `Index_2` (`jur_tgl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tjurnal`
--

/*!40000 ALTER TABLE `tjurnal` DISABLE KEYS */;
INSERT INTO `tjurnal` (`jur_no`,`jur_tgl`,`jur_ket`,`jur_total`,`is_post`,`user_id`,`for_post`,`is_viewed`,`gud_no`,`is_rl`,`jur_no_rl`,`is_debet`,`is_kas2`,`rek_no_debet`,`no_reff`,`tgl_reff`,`no_voucher`,`tgl_voucher`,`uang_id`,`kurs_cur`,`is_batal`,`jenis_trx`,`last_update`,`user_edit`,`user_batal`,`batal_desc`,`batal_date`,`let_no`,`jur_total_kurs`,`is_downloaded`,`is_pkp`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('PT-GL202350007','2023-05-09 17:01:03','Manufacture No. PT-PRD202350015/PRD2311 ROTI BOI',0,0,1,0,1,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL,'IDR01',1,0,0,NULL,0,0,NULL,NULL,NULL,0,1,0,'CG_000',0,NULL);
/*!40000 ALTER TABLE `tjurnal` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tkasir`
--

DROP TABLE IF EXISTS `tkasir`;
CREATE TABLE `tkasir` (
  `kasir_no` varchar(50) NOT NULL,
  `kasir_code` varchar(50) DEFAULT NULL,
  `kasir_name` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `is_status` int(11) NOT NULL DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`kasir_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tkasir`
--

/*!40000 ALTER TABLE `tkasir` DISABLE KEYS */;
/*!40000 ALTER TABLE `tkasir` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tlog_adjustment`
--

DROP TABLE IF EXISTS `tlog_adjustment`;
CREATE TABLE `tlog_adjustment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_det_no` varchar(50) DEFAULT NULL,
  `out_det_no` varchar(50) DEFAULT NULL,
  `adj_det_no` varchar(50) DEFAULT NULL,
  `qty_adjust` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Index_2` (`in_det_no`),
  KEY `Index_3` (`out_det_no`),
  KEY `Index_4` (`adj_det_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tlog_adjustment`
--

/*!40000 ALTER TABLE `tlog_adjustment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tlog_adjustment` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tlog_bank`
--

DROP TABLE IF EXISTS `tlog_bank`;
CREATE TABLE `tlog_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_no` varchar(50) DEFAULT NULL,
  `nm_bank` varchar(50) DEFAULT NULL,
  `rek_bank` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index1` (`log_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tlog_bank`
--

/*!40000 ALTER TABLE `tlog_bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `tlog_bank` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tlog_manager`
--

DROP TABLE IF EXISTS `tlog_manager`;
CREATE TABLE `tlog_manager` (
  `no_manager` varchar(50) NOT NULL DEFAULT '',
  `tgl_start` datetime DEFAULT NULL,
  `tgl_end` datetime DEFAULT NULL,
  `is_status` int(4) unsigned NOT NULL DEFAULT '0',
  `cab_no` varchar(45) NOT NULL DEFAULT '',
  `user_create` int(4) unsigned NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_close` int(4) unsigned NOT NULL DEFAULT '0',
  `close_date` datetime DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`no_manager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`tlog_manager`
--

/*!40000 ALTER TABLE `tlog_manager` DISABLE KEYS */;
/*!40000 ALTER TABLE `tlog_manager` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tlog_shift`
--

DROP TABLE IF EXISTS `tlog_shift`;
CREATE TABLE `tlog_shift` (
  `log_no` varchar(50) NOT NULL DEFAULT '',
  `tgl_start` datetime DEFAULT NULL,
  `tgl_end` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT '0',
  `user_close` int(11) DEFAULT '0',
  `is_posting` int(11) DEFAULT '0',
  `ket` varchar(50) DEFAULT NULL,
  `is_status` int(11) DEFAULT '0',
  `jur_no` varchar(50) DEFAULT NULL,
  `rek_cash` varchar(50) DEFAULT NULL,
  `rek_pot_jual` varchar(50) DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `salesman` varchar(50) DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `no_manager` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `modal_shift` double DEFAULT '0',
  PRIMARY KEY (`log_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tlog_shift`
--

/*!40000 ALTER TABLE `tlog_shift` DISABLE KEYS */;
/*!40000 ALTER TABLE `tlog_shift` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tlog_shift_temp`
--

DROP TABLE IF EXISTS `tlog_shift_temp`;
CREATE TABLE `tlog_shift_temp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_no` varchar(45) NOT NULL DEFAULT '',
  `jur_no` varchar(45) NOT NULL DEFAULT '',
  `ter_no` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`tlog_shift_temp`
--

/*!40000 ALTER TABLE `tlog_shift_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tlog_shift_temp` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tlog_tgl_trx`
--

DROP TABLE IF EXISTS `tlog_tgl_trx`;
CREATE TABLE `tlog_tgl_trx` (
  `log_no` varchar(50) NOT NULL,
  `tgl` datetime DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`log_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tlog_tgl_trx`
--

/*!40000 ALTER TABLE `tlog_tgl_trx` DISABLE KEYS */;
/*!40000 ALTER TABLE `tlog_tgl_trx` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tlog_trx`
--

DROP TABLE IF EXISTS `tlog_trx`;
CREATE TABLE `tlog_trx` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `ket` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tlog_trx`
--

/*!40000 ALTER TABLE `tlog_trx` DISABLE KEYS */;
INSERT INTO `tlog_trx` (`id`,`tgl`,`user_id`,`ket`) VALUES 
 (1,'2023-03-31 10:25:45',139,'prod_no-tproduct'),
 (2,'2023-03-31 10:25:45',139,'unit_no-unit'),
 (3,'2023-03-31 10:25:45',139,'unit_no-unit'),
 (4,'2023-05-03 15:28:31',1,'prod_no-tproduct'),
 (5,'2023-05-03 15:28:31',1,'unit_no-unit'),
 (6,'2023-05-03 15:28:31',1,'unit_no-unit'),
 (7,'2023-05-03 16:17:03',1,'prod_no-tproduct'),
 (8,'2023-05-03 16:17:04',1,'unit_no-unit'),
 (9,'2023-05-03 16:17:04',1,'unit_no-unit'),
 (10,'0000-00-00 00:00:00',1,'bb_no-tset_bb'),
 (11,'0000-00-00 00:00:00',1,'hap_no-tset_hpp'),
 (12,'0000-00-00 00:00:00',1,'det_no-td_set_hpp'),
 (13,'0000-00-00 00:00:00',1,'det_no-td_set_hpp'),
 (14,'2023-05-03 16:32:04',1,'prod_no-tproduct'),
 (15,'2023-05-03 16:32:04',1,'unit_no-unit'),
 (16,'2023-05-03 16:32:04',1,'unit_no-unit'),
 (17,'0000-00-00 00:00:00',1,'hap_no-tset_hpp'),
 (18,'0000-00-00 00:00:00',1,'det_no-td_set_hpp'),
 (19,'2023-05-05 11:32:38',1,'prod_no-tproduct'),
 (20,'2023-05-05 11:32:38',1,'unit_no-unit'),
 (21,'2023-05-05 11:32:38',1,'unit_no-unit');
INSERT INTO `tlog_trx` (`id`,`tgl`,`user_id`,`ket`) VALUES 
 (22,'2023-05-05 11:32:44',1,'prod_no-tproduct'),
 (23,'2023-05-05 11:32:44',1,'unit_no-unit'),
 (24,'2023-05-05 11:32:44',1,'unit_no-unit'),
 (25,'2023-05-05 11:32:48',1,'prod_no-tproduct'),
 (26,'2023-05-05 11:32:48',1,'unit_no-unit'),
 (27,'2023-05-05 11:32:48',1,'unit_no-unit'),
 (28,'2023-05-05 11:32:52',1,'prod_no-tproduct'),
 (29,'2023-05-05 11:32:52',1,'unit_no-unit'),
 (30,'2023-05-05 11:32:52',1,'unit_no-unit'),
 (31,'0000-00-00 00:00:00',1,'bb_no-tset_bb');
/*!40000 ALTER TABLE `tlog_trx` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_bank_tenor`
--

DROP TABLE IF EXISTS `tm_bank_tenor`;
CREATE TABLE `tm_bank_tenor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank_no` varchar(45) NOT NULL DEFAULT '',
  `tenor` double NOT NULL DEFAULT '0',
  `bunga` double NOT NULL DEFAULT '0',
  `keterangan` varchar(50) DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`tm_bank_tenor`
--

/*!40000 ALTER TABLE `tm_bank_tenor` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_bank_tenor` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_diskon`
--

DROP TABLE IF EXISTS `tm_diskon`;
CREATE TABLE `tm_diskon` (
  `disc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_no` varchar(45) NOT NULL DEFAULT '',
  `disc_tgl1` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `disc_tgl2` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `disc_type` int(11) NOT NULL DEFAULT '0',
  `disc_value` double NOT NULL DEFAULT '0',
  `status_disc` int(1) DEFAULT '0',
  `disc_type_1` int(1) DEFAULT '0',
  `disc_value_1` double DEFAULT '0',
  `disc_type_2` int(1) DEFAULT '0',
  `disc_value_2` double DEFAULT '0',
  `disc_type_3` int(1) DEFAULT '0',
  `disc_value_3` double DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '0',
  `qty_limit` double DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`disc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_diskon`
--

/*!40000 ALTER TABLE `tm_diskon` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_diskon` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_divisi`
--

DROP TABLE IF EXISTS `tm_divisi`;
CREATE TABLE `tm_divisi` (
  `div_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`div_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_divisi`
--

/*!40000 ALTER TABLE `tm_divisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_divisi` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_group_cust`
--

DROP TABLE IF EXISTS `tm_group_cust`;
CREATE TABLE `tm_group_cust` (
  `group_cust_id` varchar(50) NOT NULL,
  `group_cust_code` varchar(50) DEFAULT NULL,
  `group_cust_name` varchar(50) DEFAULT NULL,
  `group_limit_piutang` double DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`group_cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_group_cust`
--

/*!40000 ALTER TABLE `tm_group_cust` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_group_cust` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_merk`
--

DROP TABLE IF EXISTS `tm_merk`;
CREATE TABLE `tm_merk` (
  `merk_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`merk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_merk`
--

/*!40000 ALTER TABLE `tm_merk` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_merk` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_produksi`
--

DROP TABLE IF EXISTS `tm_produksi`;
CREATE TABLE `tm_produksi` (
  `pr_no` varchar(50) NOT NULL DEFAULT '',
  `pr_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `pr_ket` varchar(150) DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `out_no` varchar(50) DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `is_Delete` int(11) DEFAULT '0',
  `gud_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `satuan` int(11) DEFAULT '1',
  `konversi` double DEFAULT '1',
  `qty_satuan` double DEFAULT '1',
  `bb_no` varchar(50) DEFAULT NULL,
  `is_adjust` int(4) DEFAULT '0',
  `no_reff` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_produksi`
--

/*!40000 ALTER TABLE `tm_produksi` DISABLE KEYS */;
INSERT INTO `tm_produksi` (`pr_no`,`pr_date`,`user_id`,`pr_ket`,`user_edit`,`last_update`,`out_no`,`user_delete`,`create_date`,`edit_date`,`delete_date`,`is_Delete`,`gud_no`,`prod_no`,`satuan`,`konversi`,`qty_satuan`,`bb_no`,`is_adjust`,`no_reff`) VALUES 
 ('PT-PRD202350001','2023-05-09 12:45:42',1,'BRG123 TEPUNG TERIGU',1,NULL,NULL,1,'2023-05-09 12:46:42','2023-05-09 12:46:42','2023-05-09 15:19:17',1,'ID2','ID-230331-102545-0001',0,1,1,'BB-2353-161714-0001',0,''),
 ('PT-PRD202350002','2023-05-05 11:40:18',1,'BRG123 TEPUNG TERIGU',1,NULL,NULL,1,'2023-05-05 12:10:08','2023-05-05 12:10:08','2023-05-09 15:19:17',1,'ID2','ID-230331-102545-0001',0,1,1,'BB-2353-161714-0001',0,''),
 ('PT-PRD202350003','2023-05-05 14:48:50',1,'BRG123 TEPUNG TERIGU',1,NULL,NULL,1,'2023-05-05 14:49:50','2023-05-05 14:49:50','2023-05-09 15:19:17',1,'ID2','ID-230331-102545-0001',0,1,1,'BB-2353-161714-0001',0,''),
 ('PT-PRD202350004','2023-05-09 13:04:34',1,'BRG123 TEPUNG TERIGU',1,NULL,NULL,1,'2023-05-09 13:05:34','2023-05-09 13:05:34','2023-05-09 15:19:17',1,'ID2','ID-230331-102545-0001',0,1,1,'BB-2353-161714-0001',0,''),
 ('PT-PRD202350009','2023-05-09 13:43:35',1,'BRG123 TEPUNG TERIGU',1,NULL,NULL,1,'2023-05-09 13:43:35','2023-05-09 13:43:35','2023-05-09 15:19:16',1,'ID2','ID-230331-102545-0001',0,1,1,'BB-2353-161714-0001',0,'');
INSERT INTO `tm_produksi` (`pr_no`,`pr_date`,`user_id`,`pr_ket`,`user_edit`,`last_update`,`out_no`,`user_delete`,`create_date`,`edit_date`,`delete_date`,`is_Delete`,`gud_no`,`prod_no`,`satuan`,`konversi`,`qty_satuan`,`bb_no`,`is_adjust`,`no_reff`) VALUES 
 ('PT-PRD202350010','2023-05-09 15:36:15',1,'PRD2311 ROTI BOI',1,NULL,NULL,1,'2023-05-09 15:39:15','2023-05-09 15:39:15','2023-05-09 15:44:26',1,'ID2','ID-230503-161704-0002',0,1,1,'BB-2359-153557-0001',0,''),
 ('PT-PRD202350011','2023-05-09 16:01:04',1,'PRD2311 ROTI BOI',1,NULL,NULL,1,'2023-05-09 16:03:04','2023-05-09 16:03:04','2023-05-09 16:06:34',1,'ID2','ID-230503-161704-0002',0,1,1,'BB-2359-153557-0001',0,''),
 ('PT-PRD202350014','2023-05-09 16:59:56',1,'PRD2311 ROTI BOI',1,NULL,NULL,1,'2023-05-09 16:59:56','2023-05-09 16:59:56','2023-05-09 17:00:53',1,'ID2','ID-230503-161704-0002',0,1,1,'BB-2359-153557-0001',0,''),
 ('PT-PRD202350015','2023-05-09 17:01:03',1,'PRD2311 ROTI BOI',1,NULL,NULL,0,'2023-05-09 17:02:03','2023-05-09 17:02:03',NULL,0,'ID2','ID-230503-161704-0002',0,1,1,'BB-2359-153557-0001',0,'');
/*!40000 ALTER TABLE `tm_produksi` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_produksi_trial`
--

DROP TABLE IF EXISTS `tm_produksi_trial`;
CREATE TABLE `tm_produksi_trial` (
  `pr_no` varchar(50) NOT NULL DEFAULT '',
  `pr_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `pr_ket` varchar(150) DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `out_no` varchar(50) DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `is_Delete` int(11) DEFAULT '0',
  `gud_no` varchar(50) DEFAULT NULL,
  `prod_no` varchar(50) DEFAULT NULL,
  `satuan` int(11) DEFAULT '1',
  `konversi` double DEFAULT '1',
  `qty_satuan` double DEFAULT '1',
  `bb_no` varchar(50) DEFAULT NULL,
  `is_adjust` int(4) DEFAULT '0',
  PRIMARY KEY (`pr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_produksi_trial`
--

/*!40000 ALTER TABLE `tm_produksi_trial` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_produksi_trial` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_rak`
--

DROP TABLE IF EXISTS `tm_rak`;
CREATE TABLE `tm_rak` (
  `rak_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `is_default` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`rak_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_rak`
--

/*!40000 ALTER TABLE `tm_rak` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_rak` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_rak_gudang`
--

DROP TABLE IF EXISTS `tm_rak_gudang`;
CREATE TABLE `tm_rak_gudang` (
  `rak_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `is_default` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`rak_gudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_rak_gudang`
--

/*!40000 ALTER TABLE `tm_rak_gudang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_rak_gudang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_set_point`
--

DROP TABLE IF EXISTS `tm_set_point`;
CREATE TABLE `tm_set_point` (
  `set_no` varchar(50) NOT NULL DEFAULT '',
  `set_desc` varchar(150) DEFAULT NULL,
  `point_type` int(11) NOT NULL DEFAULT '0',
  `is_tgl` int(4) NOT NULL DEFAULT '0',
  `tgl_start` datetime DEFAULT NULL,
  `tgl_end` datetime DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `nominal` double DEFAULT '0',
  `point` double DEFAULT '0',
  `is_delete` int(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`set_no`),
  KEY `Index_2` (`person_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_set_point`
--

/*!40000 ALTER TABLE `tm_set_point` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_set_point` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tm_uang`
--

DROP TABLE IF EXISTS `tm_uang`;
CREATE TABLE `tm_uang` (
  `uang_id` varchar(50) NOT NULL DEFAULT '',
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `kurs` double DEFAULT '0',
  `is_default` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `def_kurs` double DEFAULT '1',
  `kode2` varchar(50) DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`uang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tm_uang`
--

/*!40000 ALTER TABLE `tm_uang` DISABLE KEYS */;
INSERT INTO `tm_uang` (`uang_id`,`kode`,`nama`,`is_delete`,`kurs`,`is_default`,`user_id`,`user_edit`,`user_delete`,`create_date`,`edit_date`,`delete_date`,`def_kurs`,`kode2`,`is_downloaded`,`iUpload`,`Upload_date`) VALUES 
 ('IDR01','IDR','Rupiah',0,1,1,0,14,0,NULL,'2012-09-11 16:29:46',NULL,1,NULL,1,0,NULL),
 ('MRK12-00002','Dollar','Dollar',0,0,0,14,14,0,'2012-09-07 11:42:41','2012-09-11 16:28:22',NULL,9000,NULL,1,0,NULL);
/*!40000 ALTER TABLE `tm_uang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tout`
--

DROP TABLE IF EXISTS `tout`;
CREATE TABLE `tout` (
  `out_no` varchar(50) NOT NULL,
  `out_date` datetime DEFAULT NULL,
  `out_type` int(11) NOT NULL DEFAULT '0',
  `out_tr_type` int(11) NOT NULL DEFAULT '0',
  `out_sub_total` double NOT NULL DEFAULT '0',
  `out_pot` double NOT NULL DEFAULT '0',
  `out_total` double NOT NULL DEFAULT '0',
  `out_payed` double NOT NULL DEFAULT '0',
  `out_total_retur` double NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(50) DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `is_posted` int(11) NOT NULL DEFAULT '0',
  `out_desc` varchar(150) DEFAULT NULL,
  `in_no` varchar(50) DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `persen_pot` double NOT NULL DEFAULT '0',
  `pay_later` int(11) NOT NULL DEFAULT '0',
  `price_type` int(11) NOT NULL DEFAULT '0',
  `jur_no` varchar(50) DEFAULT NULL,
  `in_no_lain` varchar(50) DEFAULT NULL,
  `kas_no` varchar(50) DEFAULT NULL,
  `is_outlet` int(11) NOT NULL DEFAULT '0',
  `sal_id` int(11) NOT NULL DEFAULT '0',
  `out_ppn_rp` double NOT NULL DEFAULT '0',
  `out_ppn_persen` double NOT NULL DEFAULT '0',
  `is_ppn` int(11) NOT NULL DEFAULT '0',
  `sal_no` varchar(50) DEFAULT NULL,
  `out_piutang` double NOT NULL DEFAULT '0',
  `ret_pur_no` varchar(50) DEFAULT NULL,
  `jual_no` varchar(50) DEFAULT NULL,
  `staff_no` varchar(50) DEFAULT NULL,
  `is_cetak_gud` int(11) NOT NULL DEFAULT '0',
  `no_reff` varchar(50) DEFAULT NULL,
  `no_pol` varchar(50) DEFAULT NULL,
  `nm_supir` varchar(50) DEFAULT NULL,
  `kirim_nama` varchar(50) DEFAULT NULL,
  `kirim_alamat` varchar(150) DEFAULT NULL,
  `kirim_telp` varchar(50) DEFAULT NULL,
  `let_no` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `diterima` varchar(50) DEFAULT NULL,
  `disetujui` varchar(50) DEFAULT NULL,
  `kirim_via` varchar(255) DEFAULT NULL,
  `is_print` int(11) DEFAULT '0',
  `doc_no` varchar(50) DEFAULT NULL,
  `rev_no` varchar(50) DEFAULT NULL,
  `tgl_efektif` datetime DEFAULT NULL,
  `statusTransfer` int(11) DEFAULT '0',
  `req_no` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `adj_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`out_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tout`
--

/*!40000 ALTER TABLE `tout` DISABLE KEYS */;
INSERT INTO `tout` (`out_no`,`out_date`,`out_type`,`out_tr_type`,`out_sub_total`,`out_pot`,`out_total`,`out_payed`,`out_total_retur`,`user_id`,`user_name`,`person_no`,`is_posted`,`out_desc`,`in_no`,`gud_no`,`persen_pot`,`pay_later`,`price_type`,`jur_no`,`in_no_lain`,`kas_no`,`is_outlet`,`sal_id`,`out_ppn_rp`,`out_ppn_persen`,`is_ppn`,`sal_no`,`out_piutang`,`ret_pur_no`,`jual_no`,`staff_no`,`is_cetak_gud`,`no_reff`,`no_pol`,`nm_supir`,`kirim_nama`,`kirim_alamat`,`kirim_telp`,`let_no`,`is_delete`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`diterima`,`disetujui`,`kirim_via`,`is_print`,`doc_no`,`rev_no`,`tgl_efektif`,`statusTransfer`,`req_no`,`cab_no`,`iUpload`,`Upload_date`,`adj_no`) VALUES 
 ('PT-PRD202350015','2023-05-09 17:01:03',7,0,0,0,0,0,0,1,NULL,NULL,0,NULL,NULL,NULL,0,0,0,'PT-GL202350007',NULL,NULL,0,0,0,0,0,NULL,0,NULL,'PT-PRD202350015',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-05-09 17:02:03',1,'2023-05-09 17:02:03',0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,NULL,'CG_000',0,NULL,NULL);
/*!40000 ALTER TABLE `tout` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`toutlet`
--

DROP TABLE IF EXISTS `toutlet`;
CREATE TABLE `toutlet` (
  `let_no` varchar(50) NOT NULL DEFAULT '',
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `is_default` int(11) DEFAULT '0',
  `is_delete` int(11) DEFAULT '0',
  `gud_no` varchar(50) DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`let_no`),
  KEY `index1` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`toutlet`
--

/*!40000 ALTER TABLE `toutlet` DISABLE KEYS */;
INSERT INTO `toutlet` (`let_no`,`kode`,`nama`,`is_default`,`is_delete`,`gud_no`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`) VALUES 
 ('T001','T001','The Outlet',1,0,'ID2',0,NULL,0,NULL,0,NULL);
/*!40000 ALTER TABLE `toutlet` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`toutlet_card`
--

DROP TABLE IF EXISTS `toutlet_card`;
CREATE TABLE `toutlet_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_no` varchar(45) NOT NULL DEFAULT '',
  `jual_no` varchar(45) NOT NULL DEFAULT '',
  `bank_no` varchar(45) NOT NULL DEFAULT '',
  `no_card` varchar(45) NOT NULL DEFAULT '',
  `nm_bank` varchar(45) NOT NULL DEFAULT '',
  `jns_bank` int(10) unsigned NOT NULL DEFAULT '0',
  `card_holder` varchar(45) DEFAULT NULL,
  `no_trx` varchar(45) DEFAULT NULL,
  `pay_card` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FOREIGN_KEYS` (`log_no`,`jual_no`,`bank_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`toutlet_card`
--

/*!40000 ALTER TABLE `toutlet_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `toutlet_card` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`toutlet_dp`
--

DROP TABLE IF EXISTS `toutlet_dp`;
CREATE TABLE `toutlet_dp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_no` varchar(45) NOT NULL DEFAULT '',
  `jual_no` varchar(45) NOT NULL DEFAULT '',
  `no_dp` varchar(45) NOT NULL DEFAULT '',
  `nominal` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FOREIGN_KEYS` (`log_no`,`jual_no`,`no_dp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`toutlet_dp`
--

/*!40000 ALTER TABLE `toutlet_dp` DISABLE KEYS */;
/*!40000 ALTER TABLE `toutlet_dp` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tpab`
--

DROP TABLE IF EXISTS `tpab`;
CREATE TABLE `tpab` (
  `pab_no` varchar(50) NOT NULL,
  `pab_code` varchar(50) DEFAULT NULL,
  `pab_name` varchar(50) DEFAULT NULL,
  `pab_alamat` varchar(50) DEFAULT NULL,
  `pab_telp` varchar(50) DEFAULT NULL,
  `pab_hp` varchar(50) DEFAULT NULL,
  `pab_contact` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`pab_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tpab`
--

/*!40000 ALTER TABLE `tpab` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpab` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tpay`
--

DROP TABLE IF EXISTS `tpay`;
CREATE TABLE `tpay` (
  `pay_no` varchar(50) NOT NULL,
  `pay_date` datetime DEFAULT NULL,
  `pay_total` decimal(19,4) DEFAULT NULL,
  `pay_ket` varchar(150) DEFAULT NULL,
  `pay_tr_type` int(11) NOT NULL DEFAULT '0',
  `person_no` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `kas_no` varchar(50) DEFAULT NULL,
  `jur_no` varchar(50) DEFAULT NULL,
  `nobg` varchar(45) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `nm_bank` varchar(45) DEFAULT NULL,
  `total_tunai` double NOT NULL DEFAULT '0',
  `total_cek` double NOT NULL DEFAULT '0',
  `is_cek` int(11) NOT NULL DEFAULT '0',
  `giro_no` varchar(45) DEFAULT NULL,
  `rek_pot` varchar(45) DEFAULT NULL,
  `pay_type` int(11) DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `pay_total_kurs` double DEFAULT '0',
  `total_tunai_kurs` double DEFAULT '0',
  `pay_total_proses` double NOT NULL DEFAULT '0',
  `pay_total_pot` double NOT NULL DEFAULT '0',
  `pay_total_bayar` double NOT NULL DEFAULT '0',
  `pay_total_proses_kurs` double NOT NULL DEFAULT '0',
  `pay_total_pot_kurs` double NOT NULL DEFAULT '0',
  `pay_total_bayar_kurs` double NOT NULL DEFAULT '0',
  `is_jenis` int(11) DEFAULT '0',
  `rek_bayar_no` varchar(50) DEFAULT NULL,
  `pay_voucher` varchar(50) DEFAULT NULL,
  `pay_pur_no_ket` varchar(2000) DEFAULT NULL,
  `is_pkp` int(11) DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '1',
  `cab_no` varchar(50) DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  PRIMARY KEY (`pay_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tpay`
--

/*!40000 ALTER TABLE `tpay` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpay` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tperson`
--

DROP TABLE IF EXISTS `tperson`;
CREATE TABLE `tperson` (
  `person_no` varchar(50) NOT NULL DEFAULT '',
  `person_code` varchar(50) DEFAULT NULL,
  `person_name` varchar(100) DEFAULT NULL,
  `person_alamat` varchar(100) DEFAULT NULL,
  `person_telp` varchar(50) DEFAULT NULL,
  `person_hp` varchar(50) DEFAULT NULL,
  `person_contact` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `person_type` int(11) NOT NULL DEFAULT '0',
  `is_save_harga` int(11) DEFAULT NULL,
  `is_palen` int(11) NOT NULL DEFAULT '0',
  `is_default` int(11) NOT NULL DEFAULT '0',
  `fax` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `propinsi` varchar(50) DEFAULT NULL,
  `person_desc` varchar(150) DEFAULT NULL,
  `exp_no` varchar(50) DEFAULT NULL,
  `ndays` int(11) NOT NULL DEFAULT '0',
  `ket_top_id` varchar(50) DEFAULT NULL,
  `salesman` varchar(50) DEFAULT NULL,
  `jenis_harga` int(11) NOT NULL DEFAULT '0',
  `top_id` int(11) NOT NULL DEFAULT '0',
  `person_day` varchar(10) DEFAULT NULL,
  `person_disc` double DEFAULT '0',
  `npwp` varchar(100) DEFAULT NULL,
  `nppkp` varchar(100) DEFAULT NULL,
  `person_fax` varchar(50) DEFAULT '',
  `person_contact2` varchar(50) DEFAULT '',
  `is_person_tax` int(11) NOT NULL DEFAULT '0',
  `rek_piutang_no` varchar(50) DEFAULT NULL,
  `person_sisa_piutang` double NOT NULL DEFAULT '0',
  `person_limit_piutang` double NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `uang_id` varchar(50) NOT NULL DEFAULT 'IDR01',
  `wilayah_no` varchar(50) DEFAULT NULL,
  `rek_hutang_no` varchar(50) DEFAULT NULL,
  `person_npwp` varchar(50) DEFAULT NULL,
  `person_alamat2` varchar(50) DEFAULT NULL,
  `is_update` int(11) DEFAULT '0',
  `group_cust_id` varchar(50) DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `person_bank` varchar(100) DEFAULT NULL,
  `person_acc` varchar(100) DEFAULT NULL,
  `person_an` varchar(100) DEFAULT NULL,
  `person_nm_wp` varchar(100) DEFAULT NULL,
  `person_alamat_wp` varchar(250) DEFAULT NULL,
  `person_tmp` varchar(50) DEFAULT NULL,
  `is_member` int(4) DEFAULT '0',
  `total_point` double DEFAULT '0',
  PRIMARY KEY (`person_no`),
  KEY `Index_2` (`person_code`),
  KEY `Index_3` (`wilayah_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tperson`
--

/*!40000 ALTER TABLE `tperson` DISABLE KEYS */;
/*!40000 ALTER TABLE `tperson` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tpiutang`
--

DROP TABLE IF EXISTS `tpiutang`;
CREATE TABLE `tpiutang` (
  `out_no` varchar(50) NOT NULL DEFAULT '',
  `total_piutang` double NOT NULL DEFAULT '0',
  `total_potongan` double NOT NULL DEFAULT '0',
  `total_bayar` double NOT NULL DEFAULT '0',
  `total_retur` double NOT NULL DEFAULT '0',
  `piut_tgl_jatuh` datetime DEFAULT NULL,
  `is_lunas` int(11) NOT NULL DEFAULT '0',
  `is_tagih` int(11) NOT NULL DEFAULT '0',
  `tag_no` varchar(45) DEFAULT NULL,
  `total_tunai` double DEFAULT '0',
  `total_non_tunai` double DEFAULT '0',
  `total_bayar_giro` double DEFAULT '0',
  `total_piutang_kurs` double NOT NULL DEFAULT '0',
  `total_potongan_kurs` double NOT NULL DEFAULT '0',
  `total_bayar_kurs` double NOT NULL DEFAULT '0',
  `total_retur_kurs` double NOT NULL DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`out_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tpiutang`
--

/*!40000 ALTER TABLE `tpiutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpiutang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tproduct`
--

DROP TABLE IF EXISTS `tproduct`;
CREATE TABLE `tproduct` (
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `prod_code0` varchar(50) NOT NULL DEFAULT '',
  `prod_name0` varchar(150) DEFAULT NULL,
  `prod_name1` varchar(150) DEFAULT NULL,
  `prod_uom` varchar(10) DEFAULT NULL,
  `prod_min_stock` double NOT NULL DEFAULT '0',
  `prod_on_hand` double NOT NULL DEFAULT '0',
  `prod_sell_price` double NOT NULL DEFAULT '0',
  `prod_sell_price2` double NOT NULL DEFAULT '0',
  `prod_sell_price3` double NOT NULL DEFAULT '0',
  `prod_min_stock2` int(11) NOT NULL DEFAULT '0',
  `prod_min_stock3` int(11) NOT NULL DEFAULT '0',
  `prod_buy_price` double NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `prod_last_buy_price` double NOT NULL DEFAULT '0',
  `prod_netto_price` double NOT NULL DEFAULT '0',
  `is_stok` int(11) NOT NULL DEFAULT '0',
  `prod_disc` double NOT NULL DEFAULT '0',
  `prod_profit` double NOT NULL DEFAULT '0',
  `prod_disc2` double NOT NULL DEFAULT '0',
  `prod_profit2` double NOT NULL DEFAULT '0',
  `prod_on_sell` double NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `person_no` varchar(50) DEFAULT NULL,
  `pab_no` varchar(50) DEFAULT NULL,
  `is_expired` int(11) NOT NULL DEFAULT '0',
  `is_default` int(11) NOT NULL DEFAULT '0',
  `prod_uom2` varchar(10) DEFAULT NULL,
  `prod_uom3` varchar(10) DEFAULT NULL,
  `konversi3` double DEFAULT '0',
  `konversi1` double DEFAULT '0',
  `konversi2` double DEFAULT '0',
  `prod_sell_price4` double DEFAULT '0',
  `satuan_jual` int(11) DEFAULT '1',
  `satuan_beli` int(11) DEFAULT '1',
  `is_reused` int(11) DEFAULT '0',
  `prod_type` int(11) DEFAULT '0',
  `posisi` int(11) DEFAULT '-1',
  `is_modif` int(11) DEFAULT '0',
  `prod_nilai_total` double DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `war_no` varchar(50) DEFAULT NULL,
  `nis_no` varchar(50) DEFAULT NULL,
  `len_no` varchar(50) DEFAULT NULL,
  `sat_no` varchar(50) DEFAULT NULL,
  `size_no` varchar(50) DEFAULT NULL,
  `prod_sell_price5` double NOT NULL DEFAULT '0',
  `prod_sell_price6` double NOT NULL DEFAULT '0',
  `prod_sell_price7` double NOT NULL DEFAULT '0',
  `prod_sell_price8` double NOT NULL DEFAULT '0',
  `default_qty_jual` double DEFAULT '1',
  `prod_on_proses` double DEFAULT '0',
  `prod_desc` varchar(1000) DEFAULT NULL,
  `is_auto_koreksi` int(11) DEFAULT '0',
  `auto_koreksi_allow` double DEFAULT '0',
  `prod_tax_included` int(11) DEFAULT '0',
  `prod_last_ppn` double DEFAULT '0',
  `prod_no_last` varchar(100) DEFAULT NULL,
  `prod_code_last` varchar(100) DEFAULT NULL,
  `nhari` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) DEFAULT '0',
  `merk_id` int(11) DEFAULT '0',
  `prod_sell_price9` double DEFAULT '0',
  `prod_sell_type` int(2) DEFAULT '0',
  `range_awal1` int(5) DEFAULT '1',
  `range_awal2` int(5) DEFAULT '1',
  `range_awal3` int(5) DEFAULT '1',
  `range_awal4` int(5) DEFAULT '1',
  `range_awal5` int(5) DEFAULT '1',
  `range_awal21` int(5) DEFAULT '0',
  `range_awal22` int(5) DEFAULT '0',
  `range_awal23` int(5) DEFAULT '0',
  `range_awal24` int(5) DEFAULT '0',
  `range_awal25` int(5) DEFAULT '0',
  `range_awal31` int(5) DEFAULT '0',
  `range_awal32` int(5) DEFAULT '0',
  `range_awal33` int(5) DEFAULT '0',
  `range_awal34` int(5) DEFAULT '0',
  `range_awal35` int(5) DEFAULT '0',
  `range_akhir1` int(5) DEFAULT '0',
  `range_akhir2` int(5) DEFAULT '0',
  `range_akhir3` int(5) DEFAULT '0',
  `range_akhir4` int(5) DEFAULT '0',
  `range_akhir5` int(5) DEFAULT '0',
  `range_akhir21` int(5) DEFAULT '0',
  `range_akhir22` int(5) DEFAULT '0',
  `range_akhir23` int(5) DEFAULT '0',
  `range_akhir24` int(5) DEFAULT '0',
  `range_akhir25` int(5) DEFAULT '0',
  `range_akhir31` int(5) DEFAULT '0',
  `range_akhir32` int(5) DEFAULT '0',
  `range_akhir33` int(5) DEFAULT '0',
  `range_akhir34` int(5) DEFAULT '0',
  `range_akhir35` int(5) DEFAULT '0',
  `prod_sell_qty1` double DEFAULT '0',
  `prod_sell_qty2` double DEFAULT '0',
  `prod_sell_qty3` double DEFAULT '0',
  `prod_sell_qty4` double DEFAULT '0',
  `prod_sell_qty5` double DEFAULT '0',
  `prod_sell_qty21` double DEFAULT '0',
  `prod_sell_qty22` double DEFAULT '0',
  `prod_sell_qty23` double DEFAULT '0',
  `prod_sell_qty24` double DEFAULT '0',
  `prod_sell_qty25` double DEFAULT '0',
  `prod_sell_qty31` double DEFAULT '0',
  `prod_sell_qty32` double DEFAULT '0',
  `prod_sell_qty33` double DEFAULT '0',
  `prod_sell_qty34` double DEFAULT '0',
  `prod_sell_qty35` double DEFAULT '0',
  `prod_code1` varchar(100) DEFAULT NULL,
  `rak_id` int(11) DEFAULT '0',
  `is_NonPkp` int(11) DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '0',
  `acc_brg` varchar(50) DEFAULT NULL,
  `acc_jual` varchar(50) DEFAULT NULL,
  `acc_retur` varchar(50) DEFAULT NULL,
  `acc_pot` varchar(50) DEFAULT NULL,
  `acc_hpp` varchar(50) DEFAULT NULL,
  `rak_gudang` int(11) DEFAULT '0',
  `varian_id` int(11) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_hide` int(4) DEFAULT '0',
  `prod_kemasan` varchar(100) DEFAULT NULL,
  `qty_kemasan` double DEFAULT '0',
  `acc_komisi` varchar(50) DEFAULT NULL,
  `komisi_type` int(4) DEFAULT '0',
  `komisi_value` double DEFAULT '0',
  `is_point` int(4) DEFAULT '0',
  `acc_point` varchar(50) DEFAULT NULL,
  `is_retur_day` int(4) DEFAULT '0',
  `is_retur_value` double DEFAULT '0',
  `desc_retur` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`prod_no`),
  KEY `Index_2` (`prod_code0`),
  KEY `Index_3` (`person_no`),
  KEY `Index_4` (`pab_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tproduct`
--

/*!40000 ALTER TABLE `tproduct` DISABLE KEYS */;
INSERT INTO `tproduct` (`prod_no`,`prod_code0`,`prod_name0`,`prod_name1`,`prod_uom`,`prod_min_stock`,`prod_on_hand`,`prod_sell_price`,`prod_sell_price2`,`prod_sell_price3`,`prod_min_stock2`,`prod_min_stock3`,`prod_buy_price`,`is_delete`,`prod_last_buy_price`,`prod_netto_price`,`is_stok`,`prod_disc`,`prod_profit`,`prod_disc2`,`prod_profit2`,`prod_on_sell`,`group_id`,`person_no`,`pab_no`,`is_expired`,`is_default`,`prod_uom2`,`prod_uom3`,`konversi3`,`konversi1`,`konversi2`,`prod_sell_price4`,`satuan_jual`,`satuan_beli`,`is_reused`,`prod_type`,`posisi`,`is_modif`,`prod_nilai_total`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`war_no`,`nis_no`,`len_no`,`sat_no`,`size_no`,`prod_sell_price5`,`prod_sell_price6`,`prod_sell_price7`,`prod_sell_price8`,`default_qty_jual`,`prod_on_proses`,`prod_desc`,`is_auto_koreksi`,`auto_koreksi_allow`,`prod_tax_included`,`prod_last_ppn`,`prod_no_last`,`prod_code_last`,`nhari`,`cat_id`,`merk_id`,`prod_sell_price9`,`prod_sell_type`,`range_awal1`,`range_awal2`,`range_awal3`,`range_awal4`,`range_awal5`,`range_awal21`,`range_awal22`,`range_awal23`,`range_awal24`,`range_awal25`,`range_awal31`,`range_awal32`,`range_awal33`,`range_awal34`,`range_awal35`,`range_akhir1`,`range_akhir2`,`range_akhir3`,`range_akhir4`,`range_akhir5`,`range_akhir21`,`range_akhir22`,`range_akhir23`,`range_akhir24`,`range_akhir25`,`range_akhir31`,`range_akhir32`,`range_akhir33`,`range_akhir34`,`range_akhir35`,`prod_sell_qty1`,`prod_sell_qty2`,`prod_sell_qty3`,`prod_sell_qty4`,`prod_sell_qty5`,`prod_sell_qty21`,`prod_sell_qty22`,`prod_sell_qty23`,`prod_sell_qty24`,`prod_sell_qty25`,`prod_sell_qty31`,`prod_sell_qty32`,`prod_sell_qty33`,`prod_sell_qty34`,`prod_sell_qty35`,`prod_code1`,`rak_id`,`is_NonPkp`,`is_downloaded`,`acc_brg`,`acc_jual`,`acc_retur`,`acc_pot`,`acc_hpp`,`rak_gudang`,`varian_id`,`iUpload`,`Upload_date`,`is_hide`,`prod_kemasan`,`qty_kemasan`,`acc_komisi`,`komisi_type`,`komisi_value`,`is_point`,`acc_point`,`is_retur_day`,`is_retur_value`,`desc_retur`) VALUES 
 ('ID-230331-102545-0001','BRG123','TEPUNG TERIGU','','gram',0,10000,10010000,10000,10000,0,0,0,0,0,0,0,0,0,0,0,0,1,NULL,NULL,0,0,'kg',NULL,0,1,1000,0,1,1,0,0,-1,0,0,0,'2023-03-31 10:25:45',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1,0,'',0,0,0,0,NULL,NULL,0,1,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,0,0,'ID0602161402481','00078','00078','00078','ID0602161358371',0,0,1,NULL,0,'KG',1,NULL,0,0,0,NULL,0,0,NULL);
INSERT INTO `tproduct` (`prod_no`,`prod_code0`,`prod_name0`,`prod_name1`,`prod_uom`,`prod_min_stock`,`prod_on_hand`,`prod_sell_price`,`prod_sell_price2`,`prod_sell_price3`,`prod_min_stock2`,`prod_min_stock3`,`prod_buy_price`,`is_delete`,`prod_last_buy_price`,`prod_netto_price`,`is_stok`,`prod_disc`,`prod_profit`,`prod_disc2`,`prod_profit2`,`prod_on_sell`,`group_id`,`person_no`,`pab_no`,`is_expired`,`is_default`,`prod_uom2`,`prod_uom3`,`konversi3`,`konversi1`,`konversi2`,`prod_sell_price4`,`satuan_jual`,`satuan_beli`,`is_reused`,`prod_type`,`posisi`,`is_modif`,`prod_nilai_total`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`war_no`,`nis_no`,`len_no`,`sat_no`,`size_no`,`prod_sell_price5`,`prod_sell_price6`,`prod_sell_price7`,`prod_sell_price8`,`default_qty_jual`,`prod_on_proses`,`prod_desc`,`is_auto_koreksi`,`auto_koreksi_allow`,`prod_tax_included`,`prod_last_ppn`,`prod_no_last`,`prod_code_last`,`nhari`,`cat_id`,`merk_id`,`prod_sell_price9`,`prod_sell_type`,`range_awal1`,`range_awal2`,`range_awal3`,`range_awal4`,`range_awal5`,`range_awal21`,`range_awal22`,`range_awal23`,`range_awal24`,`range_awal25`,`range_awal31`,`range_awal32`,`range_awal33`,`range_awal34`,`range_awal35`,`range_akhir1`,`range_akhir2`,`range_akhir3`,`range_akhir4`,`range_akhir5`,`range_akhir21`,`range_akhir22`,`range_akhir23`,`range_akhir24`,`range_akhir25`,`range_akhir31`,`range_akhir32`,`range_akhir33`,`range_akhir34`,`range_akhir35`,`prod_sell_qty1`,`prod_sell_qty2`,`prod_sell_qty3`,`prod_sell_qty4`,`prod_sell_qty5`,`prod_sell_qty21`,`prod_sell_qty22`,`prod_sell_qty23`,`prod_sell_qty24`,`prod_sell_qty25`,`prod_sell_qty31`,`prod_sell_qty32`,`prod_sell_qty33`,`prod_sell_qty34`,`prod_sell_qty35`,`prod_code1`,`rak_id`,`is_NonPkp`,`is_downloaded`,`acc_brg`,`acc_jual`,`acc_retur`,`acc_pot`,`acc_hpp`,`rak_gudang`,`varian_id`,`iUpload`,`Upload_date`,`is_hide`,`prod_kemasan`,`qty_kemasan`,`acc_komisi`,`komisi_type`,`komisi_value`,`is_point`,`acc_point`,`is_retur_day`,`is_retur_value`,`desc_retur`) VALUES 
 ('ID-230503-152831-0001','BRC123','SEGITIGA TEPUNG','','PCS',0,9.76,130000,10000,10000,0,0,0,0,0,0,0,0,0,0,0,0,1,NULL,NULL,0,0,'LSN',NULL,0,1,12,0,1,1,0,0,-1,0,0,0,'2023-05-03 15:28:31',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1,-0.24,'',0,0,0,0,NULL,NULL,0,1,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,0,0,'ID0602161402481','00078','00078','00078','ID0602161358371',0,0,1,NULL,0,'KG',1,NULL,0,0,0,NULL,0,0,NULL);
INSERT INTO `tproduct` (`prod_no`,`prod_code0`,`prod_name0`,`prod_name1`,`prod_uom`,`prod_min_stock`,`prod_on_hand`,`prod_sell_price`,`prod_sell_price2`,`prod_sell_price3`,`prod_min_stock2`,`prod_min_stock3`,`prod_buy_price`,`is_delete`,`prod_last_buy_price`,`prod_netto_price`,`is_stok`,`prod_disc`,`prod_profit`,`prod_disc2`,`prod_profit2`,`prod_on_sell`,`group_id`,`person_no`,`pab_no`,`is_expired`,`is_default`,`prod_uom2`,`prod_uom3`,`konversi3`,`konversi1`,`konversi2`,`prod_sell_price4`,`satuan_jual`,`satuan_beli`,`is_reused`,`prod_type`,`posisi`,`is_modif`,`prod_nilai_total`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`war_no`,`nis_no`,`len_no`,`sat_no`,`size_no`,`prod_sell_price5`,`prod_sell_price6`,`prod_sell_price7`,`prod_sell_price8`,`default_qty_jual`,`prod_on_proses`,`prod_desc`,`is_auto_koreksi`,`auto_koreksi_allow`,`prod_tax_included`,`prod_last_ppn`,`prod_no_last`,`prod_code_last`,`nhari`,`cat_id`,`merk_id`,`prod_sell_price9`,`prod_sell_type`,`range_awal1`,`range_awal2`,`range_awal3`,`range_awal4`,`range_awal5`,`range_awal21`,`range_awal22`,`range_awal23`,`range_awal24`,`range_awal25`,`range_awal31`,`range_awal32`,`range_awal33`,`range_awal34`,`range_awal35`,`range_akhir1`,`range_akhir2`,`range_akhir3`,`range_akhir4`,`range_akhir5`,`range_akhir21`,`range_akhir22`,`range_akhir23`,`range_akhir24`,`range_akhir25`,`range_akhir31`,`range_akhir32`,`range_akhir33`,`range_akhir34`,`range_akhir35`,`prod_sell_qty1`,`prod_sell_qty2`,`prod_sell_qty3`,`prod_sell_qty4`,`prod_sell_qty5`,`prod_sell_qty21`,`prod_sell_qty22`,`prod_sell_qty23`,`prod_sell_qty24`,`prod_sell_qty25`,`prod_sell_qty31`,`prod_sell_qty32`,`prod_sell_qty33`,`prod_sell_qty34`,`prod_sell_qty35`,`prod_code1`,`rak_id`,`is_NonPkp`,`is_downloaded`,`acc_brg`,`acc_jual`,`acc_retur`,`acc_pot`,`acc_hpp`,`rak_gudang`,`varian_id`,`iUpload`,`Upload_date`,`is_hide`,`prod_kemasan`,`qty_kemasan`,`acc_komisi`,`komisi_type`,`komisi_value`,`is_point`,`acc_point`,`is_retur_day`,`is_retur_value`,`desc_retur`) VALUES 
 ('ID-230503-161704-0002','PRD2311','ROTI BOI','','PCS',0,1.4,15000,15000,15000,0,0,0,0,0,0,1,0,0,0,0,0,2,NULL,NULL,0,0,'LSN',NULL,0,1,12,0,1,1,0,0,-1,0,0,0,'2023-05-03 16:17:04',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1,0.4,'',0,0,0,0,NULL,NULL,0,2,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,0,0,'ID0602161402481','00078','00078','00078','ID0602161358371',0,0,1,NULL,0,'KG',1,NULL,0,0,0,NULL,0,0,NULL);
INSERT INTO `tproduct` (`prod_no`,`prod_code0`,`prod_name0`,`prod_name1`,`prod_uom`,`prod_min_stock`,`prod_on_hand`,`prod_sell_price`,`prod_sell_price2`,`prod_sell_price3`,`prod_min_stock2`,`prod_min_stock3`,`prod_buy_price`,`is_delete`,`prod_last_buy_price`,`prod_netto_price`,`is_stok`,`prod_disc`,`prod_profit`,`prod_disc2`,`prod_profit2`,`prod_on_sell`,`group_id`,`person_no`,`pab_no`,`is_expired`,`is_default`,`prod_uom2`,`prod_uom3`,`konversi3`,`konversi1`,`konversi2`,`prod_sell_price4`,`satuan_jual`,`satuan_beli`,`is_reused`,`prod_type`,`posisi`,`is_modif`,`prod_nilai_total`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`war_no`,`nis_no`,`len_no`,`sat_no`,`size_no`,`prod_sell_price5`,`prod_sell_price6`,`prod_sell_price7`,`prod_sell_price8`,`default_qty_jual`,`prod_on_proses`,`prod_desc`,`is_auto_koreksi`,`auto_koreksi_allow`,`prod_tax_included`,`prod_last_ppn`,`prod_no_last`,`prod_code_last`,`nhari`,`cat_id`,`merk_id`,`prod_sell_price9`,`prod_sell_type`,`range_awal1`,`range_awal2`,`range_awal3`,`range_awal4`,`range_awal5`,`range_awal21`,`range_awal22`,`range_awal23`,`range_awal24`,`range_awal25`,`range_awal31`,`range_awal32`,`range_awal33`,`range_awal34`,`range_awal35`,`range_akhir1`,`range_akhir2`,`range_akhir3`,`range_akhir4`,`range_akhir5`,`range_akhir21`,`range_akhir22`,`range_akhir23`,`range_akhir24`,`range_akhir25`,`range_akhir31`,`range_akhir32`,`range_akhir33`,`range_akhir34`,`range_akhir35`,`prod_sell_qty1`,`prod_sell_qty2`,`prod_sell_qty3`,`prod_sell_qty4`,`prod_sell_qty5`,`prod_sell_qty21`,`prod_sell_qty22`,`prod_sell_qty23`,`prod_sell_qty24`,`prod_sell_qty25`,`prod_sell_qty31`,`prod_sell_qty32`,`prod_sell_qty33`,`prod_sell_qty34`,`prod_sell_qty35`,`prod_code1`,`rak_id`,`is_NonPkp`,`is_downloaded`,`acc_brg`,`acc_jual`,`acc_retur`,`acc_pot`,`acc_hpp`,`rak_gudang`,`varian_id`,`iUpload`,`Upload_date`,`is_hide`,`prod_kemasan`,`qty_kemasan`,`acc_komisi`,`komisi_type`,`komisi_value`,`is_point`,`acc_point`,`is_retur_day`,`is_retur_value`,`desc_retur`) VALUES 
 ('ID-230503-163204-0003','BRGN455','GULA HALUS','','GRAM',0,4999.88,10010000,10000,10000,0,0,0,0,0,0,0,0,0,0,0,0,1,NULL,NULL,0,0,'KG',NULL,0,1,1000,0,1,1,0,0,-1,0,0,0,'2023-05-03 16:32:04',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1,-0.12,'',0,0,0,0,NULL,NULL,0,1,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,0,0,'ID0602161402481','00078','00078','00078','ID0602161358371',0,0,1,NULL,0,'KG',1,NULL,0,0,0,NULL,0,0,NULL);
/*!40000 ALTER TABLE `tproduct` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tproduksi`
--

DROP TABLE IF EXISTS `tproduksi`;
CREATE TABLE `tproduksi` (
  `duk_no` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_no_root` varchar(45) NOT NULL DEFAULT '',
  `prod_no` varchar(45) NOT NULL DEFAULT '',
  `satuan` int(10) unsigned NOT NULL DEFAULT '0',
  `quantity` double NOT NULL DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`duk_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`tproduksi`
--

/*!40000 ALTER TABLE `tproduksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tproduksi` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tprofile`
--

DROP TABLE IF EXISTS `tprofile`;
CREATE TABLE `tprofile` (
  `pro_Id` int(10) unsigned NOT NULL DEFAULT '0',
  `pro_head_1` varchar(50) DEFAULT NULL,
  `pro_head_2` varchar(50) DEFAULT NULL,
  `pro_head_3` varchar(50) DEFAULT NULL,
  `pro_foot_1` varchar(50) DEFAULT NULL,
  `pro_batas_kiri` int(11) NOT NULL DEFAULT '0',
  `pro_batas_bawah` int(11) NOT NULL DEFAULT '0',
  `rek_kas_no` varchar(50) DEFAULT NULL,
  `rek_brg_no` varchar(50) DEFAULT NULL,
  `rek_hpp_no` varchar(50) DEFAULT NULL,
  `rek_jual_no` varchar(50) DEFAULT NULL,
  `rek_hutang_no` varchar(50) DEFAULT NULL,
  `rek_piutang_no` varchar(50) DEFAULT NULL,
  `rek_pot_piutang` varchar(50) DEFAULT NULL,
  `rek_modal_no` varchar(50) DEFAULT NULL,
  `rek_lr_bulan` varchar(50) DEFAULT NULL,
  `rek_lr_tahun` varchar(50) DEFAULT NULL,
  `rek_pot_beli` varchar(50) DEFAULT NULL,
  `rek_pot_jual` varchar(50) DEFAULT NULL,
  `rek_koreksi_brg` varchar(50) DEFAULT NULL,
  `rek_retur_jual` varchar(50) DEFAULT NULL,
  `rek_brg_rusak` varchar(50) DEFAULT NULL,
  `pos_beli` varchar(50) DEFAULT NULL,
  `pos_jual` varchar(50) DEFAULT NULL,
  `pos_hutang` varchar(50) DEFAULT NULL,
  `pos_piutang` varchar(50) DEFAULT NULL,
  `pos_kasir` varchar(50) DEFAULT NULL,
  `pos_modal` varchar(50) DEFAULT NULL,
  `pro_res_time` mediumint(9) DEFAULT NULL,
  `pro_wait_time` mediumint(9) DEFAULT NULL,
  `pro_foot_2` varchar(50) DEFAULT NULL,
  `last_backup_date` datetime DEFAULT NULL,
  `last_backup_file` varchar(200) DEFAULT NULL,
  `auto_update_sell_price` year(4) DEFAULT NULL,
  `pro_head_4` varchar(150) DEFAULT NULL,
  `edit_harga_jual` year(4) DEFAULT NULL,
  `is_kode_auto` mediumint(9) DEFAULT NULL,
  `is_print_pot` mediumint(9) DEFAULT NULL,
  `max_auto_price` double DEFAULT NULL,
  `pakai_no` varchar(50) DEFAULT NULL,
  `is_ppn` year(4) DEFAULT NULL,
  `is_default_type` year(4) DEFAULT NULL,
  `min_disc_item` double DEFAULT NULL,
  `is_lsg_cetak` mediumint(9) DEFAULT NULL,
  `min_cetak_nota` double DEFAULT NULL,
  `is_can_change_tgl` mediumint(9) DEFAULT NULL,
  `is_cek_sa` mediumint(9) DEFAULT NULL,
  `kas_no_so` varchar(50) DEFAULT NULL,
  `rek_piutang_disc` varchar(50) DEFAULT NULL,
  `rek_beli_no` varchar(50) DEFAULT NULL,
  `rek_terima_brg` varchar(50) DEFAULT NULL,
  `rek_retur_beli` varchar(50) DEFAULT NULL,
  `rek_cn_beli` varchar(50) DEFAULT NULL,
  `rek_biaya_retur_jual` varchar(45) DEFAULT NULL,
  `rek_pot_hutang` varchar(45) DEFAULT NULL,
  `rek_uang_muka_beli` varchar(50) DEFAULT NULL,
  `rek_cair_giro1` varchar(45) DEFAULT NULL,
  `rek_cair_giro2` varchar(45) DEFAULT NULL,
  `Kd_DT` varchar(50) DEFAULT NULL,
  `nKd_DT` int(11) DEFAULT '0',
  `nAngka_DT` int(11) DEFAULT '0',
  `nDesimal_DT` int(11) DEFAULT '0',
  `is_using_display` int(11) DEFAULT '0',
  `jml_beli` double DEFAULT '0',
  `jml_free` double DEFAULT '0',
  `prod_no_free` varchar(50) DEFAULT NULL,
  `is_disc_member1` int(11) DEFAULT '0',
  `is_disc_member2` int(11) DEFAULT '0',
  `disc2_date_start` datetime DEFAULT '0000-00-00 00:00:00',
  `disc2_date_end` datetime DEFAULT '0000-00-00 00:00:00',
  `disc2_jam_start` datetime DEFAULT NULL,
  `disc2_jam_end` datetime DEFAULT NULL,
  `disc2_disc_min` double DEFAULT '0',
  `disc2_disc_max` double DEFAULT '0',
  `disc2_disc_step` double DEFAULT '0',
  `no_portcom` int(11) DEFAULT '0',
  `pro_disc` double DEFAULT '0',
  `pro_service` double DEFAULT '0',
  `pro_tax` double DEFAULT '0',
  `bank_no` varchar(50) DEFAULT NULL,
  `jenis_printer` int(11) DEFAULT '0',
  `rek_biaya_ekspedisi_no` varchar(50) DEFAULT NULL,
  `faktur_pajak_npwp` varchar(100) DEFAULT NULL,
  `faktur_pajak_tgl_pkp` datetime DEFAULT NULL,
  `faktur_pajak_nama` varchar(100) DEFAULT NULL,
  `faktur_pajak_jabatan` varchar(100) DEFAULT NULL,
  `nm_dir_purchasing` varchar(50) DEFAULT NULL,
  `rek_koreksi_piutang` varchar(50) DEFAULT NULL,
  `rek_koreksi_hutang` varchar(50) DEFAULT NULL,
  `data_bank_no` varchar(50) DEFAULT NULL,
  `data_bank_nama` varchar(50) DEFAULT NULL,
  `data_bank_acc` varchar(50) DEFAULT NULL,
  `data_bank_no2` varchar(50) DEFAULT NULL,
  `data_bank_nama2` varchar(50) DEFAULT NULL,
  `data_bank_acc2` varchar(50) DEFAULT NULL,
  `faktur_pajak_alamat` varchar(50) DEFAULT NULL,
  `faktur_pajak_alamat2` varchar(50) DEFAULT NULL,
  `faktur_pajak_nama2` varchar(50) DEFAULT NULL,
  `rek_hutang_giro` varchar(50) DEFAULT NULL,
  `rek_piutang_giro` varchar(50) DEFAULT NULL,
  `rek_uang_muka_jual` varchar(50) DEFAULT NULL,
  `rek_unbill_gi` varchar(50) DEFAULT NULL,
  `rek_hutang_ppn` varchar(50) DEFAULT NULL,
  `pro_foot_3` varchar(50) DEFAULT NULL,
  `pro_foot_4` varchar(50) DEFAULT NULL,
  `rek_ppn_masukan` varchar(50) DEFAULT NULL,
  `rek_unbill_gr` varchar(50) NOT NULL DEFAULT '',
  `gud_in_transit` varchar(50) DEFAULT NULL,
  `prefix_no_ob` varchar(50) DEFAULT NULL,
  `prefix_no_tb` varchar(50) DEFAULT NULL,
  `prefix_no_oj` varchar(50) DEFAULT NULL,
  `prefix_no_jual` varchar(50) DEFAULT NULL,
  `rek_selisih_kurs` varchar(50) DEFAULT NULL,
  `jenis_cetak` int(11) DEFAULT '0',
  `tampilkan_jenis_harga` int(11) DEFAULT '0',
  `rek_auto_koreksi` varchar(50) DEFAULT NULL,
  `rek_modal` varchar(50) DEFAULT NULL,
  `rek_prive` varchar(50) DEFAULT NULL,
  `rek_selisih_desimal` varchar(50) DEFAULT NULL,
  `Is_Tax` double DEFAULT '0',
  `use_Tax` int(11) DEFAULT '0',
  `is_kasir_retur` int(11) DEFAULT '0',
  `is_auto_shift` int(11) DEFAULT '1',
  `tampilkan_jenis_satuan` int(11) DEFAULT '0',
  `faktur_pajak_kota` varchar(50) DEFAULT NULL,
  `def_ppn_purchase` int(11) DEFAULT '0',
  `def_ppn_sales` int(11) DEFAULT '0',
  `user_serial` varchar(50) DEFAULT NULL,
  `rek_pph23` varchar(50) DEFAULT NULL,
  `rek_pph22` varchar(50) DEFAULT NULL,
  `rek_adm_bank` varchar(50) DEFAULT NULL,
  `rek_pnpb` varchar(50) DEFAULT NULL,
  `rek_biaya_lain_local` varchar(50) DEFAULT NULL,
  `rek_biaya_lain_lain` varchar(50) DEFAULT NULL,
  `rek_biaya_kirim` varchar(50) DEFAULT NULL,
  `rek_biaya_kuli` varchar(50) DEFAULT NULL,
  `rek_biaya_klaim` varchar(50) DEFAULT NULL,
  `rek_biaya_lain` varchar(50) DEFAULT NULL,
  `is_show_dashboard` int(11) DEFAULT '0',
  `prefix_no_retur_jual` varchar(50) DEFAULT NULL,
  `faktur_pajak_nppkp` varchar(100) DEFAULT NULL,
  `is_struk_cust` int(11) DEFAULT '0',
  `is_struk_salesman` int(11) DEFAULT '0',
  `is_struk_addspace` int(11) DEFAULT '0',
  `char_empty_row` varchar(10) DEFAULT '0',
  `mode_kasir_outlet` int(2) DEFAULT '0',
  `max_qty_outlet` double NOT NULL DEFAULT '0',
  `max_harga_outlet` double NOT NULL DEFAULT '0',
  `temp_backup_table` int(2) DEFAULT '0',
  `rek_ongkos_kirim` varchar(50) DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `telp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `is_mutasi` int(4) DEFAULT '0',
  `close_date_mutasi` datetime DEFAULT NULL,
  `rek_tunai` varchar(50) DEFAULT NULL,
  `rek_komisi` varchar(50) DEFAULT NULL,
  `nominal_point` double DEFAULT '0',
  `rek_jual_service` varchar(50) DEFAULT NULL,
  `is_expired_member` int(4) DEFAULT '0',
  `expired_date` datetime DEFAULT NULL,
  `app_path1` text,
  `app_path2` text,
  `app_path3` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tprofile`
--

/*!40000 ALTER TABLE `tprofile` DISABLE KEYS */;
INSERT INTO `tprofile` (`pro_Id`,`pro_head_1`,`pro_head_2`,`pro_head_3`,`pro_foot_1`,`pro_batas_kiri`,`pro_batas_bawah`,`rek_kas_no`,`rek_brg_no`,`rek_hpp_no`,`rek_jual_no`,`rek_hutang_no`,`rek_piutang_no`,`rek_pot_piutang`,`rek_modal_no`,`rek_lr_bulan`,`rek_lr_tahun`,`rek_pot_beli`,`rek_pot_jual`,`rek_koreksi_brg`,`rek_retur_jual`,`rek_brg_rusak`,`pos_beli`,`pos_jual`,`pos_hutang`,`pos_piutang`,`pos_kasir`,`pos_modal`,`pro_res_time`,`pro_wait_time`,`pro_foot_2`,`last_backup_date`,`last_backup_file`,`auto_update_sell_price`,`pro_head_4`,`edit_harga_jual`,`is_kode_auto`,`is_print_pot`,`max_auto_price`,`pakai_no`,`is_ppn`,`is_default_type`,`min_disc_item`,`is_lsg_cetak`,`min_cetak_nota`,`is_can_change_tgl`,`is_cek_sa`,`kas_no_so`,`rek_piutang_disc`,`rek_beli_no`,`rek_terima_brg`,`rek_retur_beli`,`rek_cn_beli`,`rek_biaya_retur_jual`,`rek_pot_hutang`,`rek_uang_muka_beli`,`rek_cair_giro1`,`rek_cair_giro2`,`Kd_DT`,`nKd_DT`,`nAngka_DT`,`nDesimal_DT`,`is_using_display`,`jml_beli`,`jml_free`,`prod_no_free`,`is_disc_member1`,`is_disc_member2`,`disc2_date_start`,`disc2_date_end`,`disc2_jam_start`,`disc2_jam_end`,`disc2_disc_min`,`disc2_disc_max`,`disc2_disc_step`,`no_portcom`,`pro_disc`,`pro_service`,`pro_tax`,`bank_no`,`jenis_printer`,`rek_biaya_ekspedisi_no`,`faktur_pajak_npwp`,`faktur_pajak_tgl_pkp`,`faktur_pajak_nama`,`faktur_pajak_jabatan`,`nm_dir_purchasing`,`rek_koreksi_piutang`,`rek_koreksi_hutang`,`data_bank_no`,`data_bank_nama`,`data_bank_acc`,`data_bank_no2`,`data_bank_nama2`,`data_bank_acc2`,`faktur_pajak_alamat`,`faktur_pajak_alamat2`,`faktur_pajak_nama2`,`rek_hutang_giro`,`rek_piutang_giro`,`rek_uang_muka_jual`,`rek_unbill_gi`,`rek_hutang_ppn`,`pro_foot_3`,`pro_foot_4`,`rek_ppn_masukan`,`rek_unbill_gr`,`gud_in_transit`,`prefix_no_ob`,`prefix_no_tb`,`prefix_no_oj`,`prefix_no_jual`,`rek_selisih_kurs`,`jenis_cetak`,`tampilkan_jenis_harga`,`rek_auto_koreksi`,`rek_modal`,`rek_prive`,`rek_selisih_desimal`,`Is_Tax`,`use_Tax`,`is_kasir_retur`,`is_auto_shift`,`tampilkan_jenis_satuan`,`faktur_pajak_kota`,`def_ppn_purchase`,`def_ppn_sales`,`user_serial`,`rek_pph23`,`rek_pph22`,`rek_adm_bank`,`rek_pnpb`,`rek_biaya_lain_local`,`rek_biaya_lain_lain`,`rek_biaya_kirim`,`rek_biaya_kuli`,`rek_biaya_klaim`,`rek_biaya_lain`,`is_show_dashboard`,`prefix_no_retur_jual`,`faktur_pajak_nppkp`,`is_struk_cust`,`is_struk_salesman`,`is_struk_addspace`,`char_empty_row`,`mode_kasir_outlet`,`max_qty_outlet`,`max_harga_outlet`,`temp_backup_table`,`rek_ongkos_kirim`,`is_downloaded`,`telp`,`fax`,`cab_no`,`mail`,`is_mutasi`,`close_date_mutasi`,`rek_tunai`,`rek_komisi`,`nominal_point`,`rek_jual_service`,`is_expired_member`,`expired_date`,`app_path1`,`app_path2`,`app_path3`) VALUES 
 (1,'SUKSES JAYA','Food Service dan Household','Jl. MADURA NO 5','BARANG YANG SUDAH DIBELI',0,3,'00022','ID0602161402481','ID0602161358371','00078','00060','ID0612061259463','00078','A19050100001','000145','00075','ID0603101217301','00078','000233','00078','ID0609171756432','ID2','ID1','ID3','ID4','ID5','ID6',0,50,'TDK DPT DITUKARKAN/DIKEMBALIKAN','2009-10-05 19:30:22','-',0000,'(0341) 364562',0000,1,1,0,'000173',0000,0000,0,0,0,1,NULL,'01','0011','ID-100507-073421-1','00091','ID-100511-004640-1','ID-100510-075549-1','ID-100519-071834-1','00060','000212','ID-100903-133601-2','','21',4,2,3,0,0,0,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,0,0,0,0,0,0,0,'00024',0,'ID-100903-133532-1','','2012-10-16 12:46:08','CV. SUKSES JAYA','aaaa','DIREKTUR PURCHASING','000142','000142','','','','','','','JL. MADURA NO 5','','','ID-100331-103057-1','ID-100331-103325-2','ID-100130-205258-1','ID-130417-135652-0001','ID-130417-135652-0002','HARGA SUDAH TERMASUK PAJAK','TERIMA KASIH ATAS KUNJUNGAN ANDA','ID-130419-102712-0002','ID-130419-102819-0003','GIT','OBP','LPK','OJP','PJP','',1,0,'000233','','','000142',11,0,0,1,0,'Malang',0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A21010400002',NULL,NULL,'00087',0,'RJP',NULL,0,0,0,'0',0,1000,1000000,0,'ID-100205-124520-1',1,'0341 - 364562',NULL,'CG_000','sukses_jaya@hotmail.com',0,'2019-08-10 13:00:00',NULL,'',0,NULL,0,'2021-02-28 01:50:57','https://firebasestorage.googleapis.com/v0/b/fh-point.appspot.com/o/uploads%2Fads%2Fads_1_405220220307083821?alt=media&token=e65fa2bc-266c-414a-bb1b-3b2e5b677a95','https://firebasestorage.googleapis.com/v0/b/fh-point.appspot.com/o/uploads%2Fads%2Fads_2_197220220307083829?alt=media&token=3340bb6d-ca3c-448e-892d-0f186fc86879','https://firebasestorage.googleapis.com/v0/b/fh-point.appspot.com/o/uploads%2Fads%2Fads_3_604220220307083837?alt=media&token=20273493-5c3f-4c60-a3e7-a6a4b6531d65');
/*!40000 ALTER TABLE `tprofile` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tpromodiscountgroup`
--

DROP TABLE IF EXISTS `tpromodiscountgroup`;
CREATE TABLE `tpromodiscountgroup` (
  `id` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `person_no` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `disc1` double NOT NULL DEFAULT '0',
  `disc2` double NOT NULL DEFAULT '0',
  `disc3` double NOT NULL DEFAULT '0',
  `tgl_start` datetime DEFAULT NULL,
  `tgl_end` datetime DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pperson` (`person_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `ohh_bakery`.`tpromodiscountgroup`
--

/*!40000 ALTER TABLE `tpromodiscountgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpromodiscountgroup` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tpurchase`
--

DROP TABLE IF EXISTS `tpurchase`;
CREATE TABLE `tpurchase` (
  `pur_no` varchar(50) NOT NULL,
  `pur_date` datetime DEFAULT NULL,
  `top_id` int(11) NOT NULL DEFAULT '0',
  `ndays` int(11) NOT NULL DEFAULT '0',
  `person_no` varchar(50) DEFAULT NULL,
  `pur_due_date` datetime DEFAULT NULL,
  `pur_sub_total` double(15,3) NOT NULL DEFAULT '0.000',
  `pur_pot_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `pur_pot_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `pur_ppn_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `pur_ppn_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `pur_total` double(15,3) NOT NULL DEFAULT '0.000',
  `pur_ket` varchar(150) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `pur_inv` varchar(50) DEFAULT NULL,
  `is_ppn` int(11) NOT NULL DEFAULT '0',
  `jur_no` varchar(50) DEFAULT NULL,
  `pur_type` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `pur_inv_date` datetime DEFAULT NULL,
  `is_print` int(11) NOT NULL DEFAULT '0',
  `pur_order` varchar(50) DEFAULT NULL,
  `pur_ord` varchar(50) DEFAULT NULL,
  `pur_total_tunai` double DEFAULT '0',
  `pur_ter_no` varchar(50) DEFAULT NULL,
  `pur_pay_no` varchar(50) DEFAULT NULL,
  `jual_no` varchar(150) DEFAULT NULL,
  `biaya_ekspedisi` double DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `rek_hutang` varchar(50) DEFAULT NULL,
  `rek_unbill_gr` varchar(50) DEFAULT NULL,
  `rek_ppn` varchar(50) DEFAULT NULL,
  `pur_sub_total_kurs` double NOT NULL DEFAULT '0',
  `pur_pot_rp_kurs` double NOT NULL DEFAULT '0',
  `pur_ppn_rp_kurs` double NOT NULL DEFAULT '0',
  `pur_total_kurs` double NOT NULL DEFAULT '0',
  `pur_total_tunai_kurs` double NOT NULL DEFAULT '0',
  `uang_id` varchar(50) NOT NULL DEFAULT 'IDR01',
  `kurs_cur` double NOT NULL DEFAULT '1',
  `pur_jenis_trx` int(11) NOT NULL DEFAULT '0',
  `is_lock_terima` int(11) NOT NULL DEFAULT '0',
  `client_serial` varchar(50) DEFAULT NULL,
  `no_faktur_pajak` varchar(100) DEFAULT NULL,
  `pur_ongkir` double DEFAULT '0',
  `tgl_faktur_pajak` datetime DEFAULT NULL,
  `prefix_no_tax` varchar(50) DEFAULT NULL,
  `faktur_pajak_nama` varchar(50) DEFAULT NULL,
  `faktur_pajak_jabatan` varchar(50) DEFAULT NULL,
  `is_trx_import` int(11) DEFAULT '0',
  `is_pkp` int(11) DEFAULT '0',
  `is_SP` int(11) DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '1',
  `pur_no_old` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_fp` int(4) DEFAULT '0',
  `dpp_fp` double DEFAULT '0',
  `ppn_fp` double DEFAULT '0',
  `ket_fp` varchar(50) DEFAULT NULL,
  `is_faktur` int(4) DEFAULT '0',
  `tgl_massa` datetime DEFAULT NULL,
  `is_receive` int(4) DEFAULT '0',
  `tax_amount` int(11) DEFAULT '10',
  PRIMARY KEY (`pur_no`),
  KEY `Index_2` (`person_no`),
  KEY `idx_client_serial` (`client_serial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tpurchase`
--

/*!40000 ALTER TABLE `tpurchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpurchase` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tpurchase_order`
--

DROP TABLE IF EXISTS `tpurchase_order`;
CREATE TABLE `tpurchase_order` (
  `pur_ord` varchar(50) NOT NULL DEFAULT '',
  `pur_ord_date` datetime DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `pur_ket` varchar(145) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `pur_ord_total` double NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `statusOrder` int(11) NOT NULL DEFAULT '0',
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `no_pp` varchar(50) DEFAULT NULL,
  `pengadaan` varchar(50) DEFAULT NULL,
  `tgl_penyerahan` datetime DEFAULT NULL,
  `tmpt_penyerahan` varchar(50) DEFAULT NULL,
  `top_id` int(11) NOT NULL DEFAULT '0',
  `ndays` int(11) NOT NULL DEFAULT '0',
  `rek_no` varchar(50) NOT NULL DEFAULT '',
  `pur_ord_subtotal` double NOT NULL DEFAULT '0',
  `pur_ord_subtotal_kurs` double NOT NULL DEFAULT '0',
  `pur_ord_pot_persen` double NOT NULL DEFAULT '0',
  `pur_ord_pot_rp` double NOT NULL DEFAULT '0',
  `pur_ord_pot_rp_kurs` double NOT NULL DEFAULT '0',
  `pur_ord_ppn_persen` double NOT NULL DEFAULT '0',
  `pur_ord_ppn_rp` double NOT NULL DEFAULT '0',
  `pur_ord_ppn_rp_kurs` double NOT NULL DEFAULT '0',
  `pur_ord_total_kurs` double NOT NULL DEFAULT '0',
  `is_ppn` int(11) NOT NULL DEFAULT '0',
  `is_lock_no_reff_tax` int(11) NOT NULL DEFAULT '0',
  `no_reff_tax` varchar(50) DEFAULT NULL,
  `prefix_no_tax` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `tax_amount` int(11) DEFAULT '10',
  PRIMARY KEY (`pur_ord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tpurchase_order`
--

/*!40000 ALTER TABLE `tpurchase_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpurchase_order` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tpurchase_retur`
--

DROP TABLE IF EXISTS `tpurchase_retur`;
CREATE TABLE `tpurchase_retur` (
  `ret_pur_no` varchar(50) NOT NULL,
  `ret_pur_date` datetime DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `pur_no` varchar(50) DEFAULT NULL,
  `ret_pur_desc` varchar(100) DEFAULT NULL,
  `ret_pur_total` double(15,3) NOT NULL DEFAULT '0.000',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `jur_no` varchar(50) DEFAULT NULL,
  `ret_pur_type` int(11) NOT NULL DEFAULT '0',
  `is_print` int(11) NOT NULL DEFAULT '0',
  `ret_pur_total_tunai` double DEFAULT '0',
  `ret_pur_pay_no` varchar(50) DEFAULT NULL,
  `is_ppn` int(11) DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `ret_ppn_persen` double DEFAULT '0',
  `ret_ppn_rp` double DEFAULT '0',
  `ret_sub_total` double DEFAULT '0',
  `ret_disc_persen` double DEFAULT '0',
  `ret_disc_rp` double DEFAULT '0',
  `is_lock_retur` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ret_pur_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tpurchase_retur`
--

/*!40000 ALTER TABLE `tpurchase_retur` DISABLE KEYS */;
/*!40000 ALTER TABLE `tpurchase_retur` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`trans_hutang`
--

DROP TABLE IF EXISTS `trans_hutang`;
CREATE TABLE `trans_hutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `in_no` varchar(50) DEFAULT NULL,
  `pay_no` varchar(50) DEFAULT NULL,
  `out_no` varchar(50) DEFAULT NULL,
  `debet` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0',
  `tran_type` int(11) NOT NULL DEFAULT '0',
  `jenis` int(11) NOT NULL DEFAULT '0',
  `debet_kurs` double DEFAULT '0',
  `kredit_kurs` double DEFAULT '0',
  `uang_id` varchar(50) NOT NULL DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`in_no`),
  KEY `Index_3` (`person_no`),
  KEY `Index_4` (`in_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`trans_hutang`
--

/*!40000 ALTER TABLE `trans_hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_hutang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`trans_piutang`
--

DROP TABLE IF EXISTS `trans_piutang`;
CREATE TABLE `trans_piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `out_no` varchar(50) DEFAULT NULL,
  `ter_no` varchar(50) DEFAULT NULL,
  `in_no` varchar(50) DEFAULT NULL,
  `debet` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0',
  `tran_type` int(11) NOT NULL DEFAULT '0',
  `cair_no` varchar(50) DEFAULT NULL,
  `debet_kurs` double DEFAULT '0',
  `kredit_kurs` double DEFAULT '0',
  `debet_giro` double DEFAULT '0',
  `kredit_giro` double DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`out_no`),
  KEY `Index_3` (`person_no`),
  KEY `Index_4` (`ter_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`trans_piutang`
--

/*!40000 ALTER TABLE `trans_piutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_piutang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`trans_terima`
--

DROP TABLE IF EXISTS `trans_terima`;
CREATE TABLE `trans_terima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ter_no` varchar(50) DEFAULT NULL,
  `out_no` varchar(50) DEFAULT NULL,
  `nobg` varchar(50) DEFAULT NULL,
  `bayar` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Index_2` (`ter_no`),
  KEY `Index_4` (`out_no`),
  KEY `Index_3` (`nobg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`trans_terima`
--

/*!40000 ALTER TABLE `trans_terima` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_terima` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`treceive_faktur`
--

DROP TABLE IF EXISTS `treceive_faktur`;
CREATE TABLE `treceive_faktur` (
  `rec_no` varchar(50) NOT NULL DEFAULT '',
  `rec_tgl` datetime DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `rec_desc` varchar(145) DEFAULT NULL,
  `rec_inv` varchar(100) DEFAULT NULL,
  `is_delete` int(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `is_pkp` double DEFAULT '0',
  PRIMARY KEY (`rec_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`treceive_faktur`
--

/*!40000 ALTER TABLE `treceive_faktur` DISABLE KEYS */;
/*!40000 ALTER TABLE `treceive_faktur` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`treceive_purchase`
--

DROP TABLE IF EXISTS `treceive_purchase`;
CREATE TABLE `treceive_purchase` (
  `rp_no` varchar(50) NOT NULL DEFAULT '',
  `rp_date` datetime DEFAULT NULL,
  `rp_date_byr` datetime DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `rp_desc` varchar(145) DEFAULT NULL,
  `rp_inv` varchar(100) DEFAULT NULL,
  `rp_total` double NOT NULL DEFAULT '0',
  `is_pkp` int(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `is_status` int(11) NOT NULL DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rp_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`treceive_purchase`
--

/*!40000 ALTER TABLE `treceive_purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `treceive_purchase` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`trek`
--

DROP TABLE IF EXISTS `trek`;
CREATE TABLE `trek` (
  `rek_no` varchar(50) NOT NULL DEFAULT '',
  `rek_kode` varchar(50) DEFAULT NULL,
  `rek_nama` varchar(50) DEFAULT NULL,
  `rek_type` int(11) NOT NULL DEFAULT '0',
  `rek_gol` int(11) NOT NULL DEFAULT '0',
  `is_fix` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `saldo` double NOT NULL DEFAULT '0',
  `is_kas` int(11) NOT NULL DEFAULT '0',
  `is_check` int(11) NOT NULL DEFAULT '0',
  `ket1` varchar(150) DEFAULT NULL,
  `ket2` varchar(150) DEFAULT NULL,
  `ket3` varchar(150) DEFAULT NULL,
  `is_using_valid` int(11) DEFAULT '0',
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `jenis_rl` int(11) DEFAULT '0',
  `saldo_debet` double DEFAULT '0',
  `saldo_kredit` double DEFAULT '0',
  `saldo_kurs` double DEFAULT '0',
  `saldo_debet_kurs` double DEFAULT '0',
  `saldo_kredit_kurs` double DEFAULT '0',
  `is_rekap` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `is_jual` int(4) DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`rek_no`),
  KEY `Index_2` (`rek_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`trek`
--

/*!40000 ALTER TABLE `trek` DISABLE KEYS */;
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('000139','801000000','Biaya Lain - lain',1,8,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000140','801001000','Biaya Lain - lain',2,8,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000141','801001001','Prive',3,8,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,34,'2014-05-16 10:51:19',0,NULL,1,0,'',0,NULL),
 ('000142','801001002','Biaya Lain - lain / Selisih Hitung PPN',3,8,0,0,-22703850.232297428,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,34,'2015-06-12 14:26:19',0,NULL,1,0,'',0,NULL),
 ('000143','302000000','Laba',1,3,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000144','302001000','Laba ( Rugi ) Bersih Sebelum Pajak',2,3,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('000145','302001001','Laba (Rugi) bersih Bulan Berjalan',3,3,1,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000158','501001000','Administrasi',2,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000159','501001001','ATK Kantor',3,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000160','501001002','Listrik / PLN',3,5,1,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,34,'2014-05-10 14:56:54',0,NULL,1,0,'',0,NULL),
 ('000163','501001003','Air PDAM',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,34,'2014-05-10 14:56:33',0,NULL,1,0,'',0,NULL),
 ('000171','501015000','Biaya Pemakaian Bahan',2,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('000173','501015001','Biaya Pemakaian Bahan',3,5,1,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000189','501016000','Barang Rusak / Hilang',2,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00020','101000000','AKTIVA LANCAR',1,1,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00021','101001000','Kas',2,1,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000212','101003005','Uang Muka Pembelian',3,1,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00022','101001001','Kas',3,1,1,0,6381053413.959999,1,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,1,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('00023','101002000','Bank',2,1,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('000233','501016001','Barang Rusak / Hilang',3,5,1,0,-201644152.67912674,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00024','101002001','BANK CENTRAL ASIA',3,1,0,0,57898701841.64001,1,0,'','','',0,'',0,0,0,0,0,0,1,0,NULL,1,'2019-03-14 12:56:52',0,NULL,1,0,'Semua',1,NULL),
 ('00030','101003000','Piutang ',2,1,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00055','201000000','Hutang',1,2,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00056','201001000','Hutang Dagang',2,2,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('00060','201001001','Hutang Dagang',3,2,1,0,-35594328806.41999,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00068','301000000','Modal',1,3,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00069','301001000','Modal',2,3,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00070','301001001','Modal Dasar',3,3,1,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00075','302001002','Laba (Rugi) bersih Tahun Berjalan',3,3,1,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00076','401000000','Pendapatan',1,4,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('00078','401001001','Penjualan',3,4,1,0,-65446823999.37555,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00085','701000000','Pendapatan Lain-lain',1,7,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00086','701001000','Pendapatan lain-lain',2,7,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00087','701001001','Pendapatan Luar Usaha',3,7,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('00088','701001002','Jasa Bunga Bank',3,7,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,0,NULL,34,'2014-09-16 11:17:46',0,NULL,1,0,'',0,NULL),
 ('00091','701001003','Selisih Hitung Persediaan',3,7,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('00092','501000000','Biaya Operasional',1,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('0011','101003003','Piutang Lain - Lain',3,1,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,34,'2014-05-16 10:22:33',0,NULL,1,0,'',0,NULL),
 ('A19021200001','501007005','Pemeliharaan Mesin',3,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,21,'2019-02-12 12:15:59',0,NULL,0,NULL,0,0,'Semua',0,'2019-02-12 12:17:07'),
 ('A19043000001','101003007','REKENING PERANTARA / AYAT SILANG',3,1,0,0,-12092966266.900002,0,0,'Sebagai akun pengganti modal','','',0,'IDR01',0,0,0,0,0,0,0,1,'2019-04-30 23:50:05',0,NULL,0,NULL,0,0,'Semua',1,NULL),
 ('ID-071001-093418-1','701002000','Potongan Piutang',2,7,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-071001-093432-2','701002001','Potongan Penjualan',3,7,1,0,1748419.96,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,34,'2014-05-16 09:59:13',0,NULL,1,0,'',0,NULL),
 ('ID-080622-120613-1','401002000','Pendapatan',2,4,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-080622-120629-2','401002001','Komisi',3,4,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-080705-104047-2','501002002','Parkir',3,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-080724-114435-1','401002002','Lain-lain',3,4,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-080724-122225-8','501002001','Bensin',3,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-080724-122236-9','501003001','Gaji Karyawan',3,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-080805-145951-6','501002000','Transport',2,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-080805-150030-7','501003000','Karyawan',2,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-080805-150055-8','501003002','GAJI DIREKSI',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,0,NULL,80,'2018-01-28 09:06:42',0,NULL,1,0,'',0,NULL),
 ('ID-080820-144124-1','501001004','Telepon',3,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-080928-203447-1','501004000','Insidentil',2,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-080928-203505-2','501004001','Sumbangan',3,5,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-100130-205258-1','201001002','Uang Muka Customer',3,2,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,1,'2019-03-14 13:11:52',0,NULL,1,0,'Semua',1,NULL),
 ('ID-100205-124520-1','501002004','Biaya Pengiriman',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,34,'2014-05-16 10:32:40',0,NULL,1,0,'',0,NULL),
 ('ID-100331-103057-1','201001003','Hutang Giro',3,2,0,0,-25490515641.780003,1,1,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-100331-103325-2','101003004','Piutang Giro',3,1,0,0,0,1,1,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-100510-075549-1','101003002','Piutang Karyawan',3,1,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,34,'2014-05-16 10:22:19',0,NULL,1,0,'',0,NULL),
 ('ID-100903-133532-1','101002003','NIAGA',3,1,0,0,490493960,1,0,'','','',0,'',0,0,0,0,0,0,0,0,NULL,1,'2019-03-14 12:57:13',0,NULL,1,0,'Semua',1,NULL),
 ('ID-100903-133601-2','101002002','MANDIRI',3,1,0,0,0,1,0,'','','',0,'',0,0,0,0,0,0,0,0,NULL,1,'2019-03-14 12:57:02',0,NULL,1,0,'Semua',1,NULL),
 ('ID-110513-115956-1','501003003','Gaji Satpam',3,5,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,59,'2016-09-19 10:05:33',0,NULL,1,0,'',0,NULL),
 ('ID-110519-131703-1','101001002','Kas Kecil',3,1,0,0,33411210,1,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-120131-191322-0001','401001000','Penjualan',2,4,0,0,0,0,0,'-','-','-',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120214-141513-0001','102000000','AKTIVA TETAP',1,1,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120214-141540-0002','102001000','Bangunan',2,1,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120214-141850-0004','502000000','Biaya Penyusutan',1,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120214-142212-0005','502001000','Biaya Penyusutan ',2,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120214-142307-0006','502001001','Biaya Penyusutan Gedung',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-120214-142947-0008','502001002','Biaya Penyusutan Kendaraan',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120214-143014-0009','502001003','Biaya Penyusutan Peralatan Kantor',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120214-143047-0010','502001004','Biaya Penyusutan Rak',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120804-143720-0001','102002000','Kendaraan',2,1,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-120804-155051-0002','102003000','Perlengkapan',2,1,0,0,0,0,0,'KOMPUTER, RAK, SOUDN SYSTEM, TIMBANGAN','','',0,'',0,0,0,0,0,0,0,0,NULL,61,'2017-09-16 17:43:45',0,NULL,1,0,'',0,NULL),
 ('ID-120804-155238-0004','102003001','Mebel & Rak',3,1,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,0,NULL,43,'2014-08-21 14:46:40',0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-120804-161229-0006','102003002','Mesin & Peralatan',3,1,0,0,0,0,0,'FREZER, COLD STORAGE, CHILLER, AC, LIFT','','',0,'',0,0,0,0,0,0,0,0,NULL,43,'2014-08-21 14:47:34',0,NULL,1,0,'',0,NULL),
 ('ID-130417-135652-0001','101003006','Unbilling Goods Issue',3,1,1,0,-115404.84999999963,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,1,'2019-03-14 13:12:28',0,NULL,1,0,'Semua',1,NULL),
 ('ID-130417-135652-0002','201001111','PPN KELUARAN',3,2,1,0,-6166085514.312824,1,0,'','','',0,'IDR',0,0,0,0,0,0,0,0,NULL,80,'2017-06-21 17:05:32',0,NULL,1,0,'',0,NULL),
 ('ID-130419-102625-0001','101005000','Pajak TANGGUAN',2,1,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,14,'2013-04-19 10:26:14',26,'2016-08-13 14:53:18',0,NULL,1,0,'',0,NULL),
 ('ID-130419-102712-0002','101005001','PPN MASUKAN',3,1,0,0,5810652879.584002,1,0,'','','',0,'',0,0,0,0,0,0,0,14,'2013-04-19 10:26:50',80,'2017-06-21 17:05:17',0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-130419-102819-0003','201001112','Unbilling Goods received',3,2,0,0,-23912889730.01006,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,14,'2013-04-19 10:27:56',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-130823-142227-0001','501001005','Handphone',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,24,'2013-08-23 14:22:15',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-130909-153354-0001','501005000','Konsumsi',2,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,24,'2013-09-09 15:33:20',24,'2013-09-09 15:34:14',0,NULL,1,0,'',0,NULL),
 ('ID-130909-153445-0002','501005001','Air Minum',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,24,'2013-09-09 15:34:25',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-140510-145038-0001','501006000','Operasional',2,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-10 14:49:47',34,'2014-05-16 10:07:15',0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-140510-145220-0002','501006001','Operasional Lain',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-10 14:51:18',1,'2019-03-14 13:04:00',0,NULL,1,0,'Semua',1,NULL),
 ('ID-140510-145737-0003','801001006','Biaya Parcel',3,8,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-10 14:57:23',34,'2014-05-16 10:53:27',0,NULL,1,0,'',0,NULL),
 ('ID-140516-103413-0003','501004002','Surat / Pajak Kendaraan & Bangun',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-16 10:33:25',43,'2015-05-20 12:24:53',0,NULL,1,0,'',0,NULL),
 ('ID-140516-103952-0004','501002005','Perjalanan Dinas',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-16 10:39:30',34,'2014-05-16 10:41:18',0,NULL,1,0,'',0,NULL),
 ('ID-140516-104135-0005','501002003','Sales',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-16 10:41:27',34,'2014-05-16 10:50:05',0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-140516-104300-0006','501004003','Promosi / Iklan',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2014-05-16 10:42:34',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-140516-104740-0008','501007000','Biaya Pemeliharaan',2,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2014-05-16 10:47:20',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-140516-104821-0009','501007001','Pemeliharaan Gedung',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-16 10:48:11',43,'2014-06-09 10:03:30',0,NULL,1,0,'',0,NULL),
 ('ID-140516-104836-0010','501007002','Pemeliharaan Kendaraan',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-16 10:48:29',43,'2014-06-09 10:03:59',0,NULL,1,0,'',0,NULL),
 ('ID-140516-104859-0011','501007003','Pemeliharaan Komputer',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-16 10:48:50',59,'2016-09-19 10:04:57',0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-140516-105405-0012','801001003','Biaya Adm Bank',3,8,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2014-05-16 10:53:45',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-140516-105434-0013','801001004','Bunga Pinjaman Bank',3,8,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2014-05-16 10:54:12',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-140516-105452-0014','801001005','Pajak Bunga Bank',3,8,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2014-05-16 10:54:41',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-140516-105545-0015','501005002','Obat',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2014-05-16 10:55:29',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-140516-110330-0016','501007004','Pemeliharaan Peralatan',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,34,'2014-05-16 11:03:14',43,'2014-06-09 10:04:59',0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-140525-121132-0001','701002002','Potongan Pembelian',3,7,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2014-05-25 12:10:53',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-140607-112446-0001','501005003','Konsumsi Karyawan',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2014-06-07 11:23:54',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-141001-150807-0001','501003004','Gaji Cleaning Servis',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,43,'2014-10-01 15:08:10',59,'2016-09-19 10:05:59',0,NULL,1,0,'',0,NULL),
 ('ID-141014-090917-0001','501004004','Entertaiment',3,5,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,43,'2014-10-14 09:06:02',43,'2014-10-17 11:50:36',0,NULL,1,0,'',0,NULL),
 ('ID-141017-123721-0001','201001113','Hutang lain - lain',3,2,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,43,'2014-10-17 12:36:36',0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-141030-144323-0001','801001007','Biaya Pajak Negara',3,8,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,43,'2014-10-30 14:42:02',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-141030-144425-0002','801001008','Biaya Fee Konsultan Pajak',3,8,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,43,'2014-10-30 14:43:50',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-150612-142717-0001','801001009','Biaya Lain - Lain (Pos Biaya)',3,8,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,34,'2015-06-12 14:26:37',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-151110-104342-0001','801001010','BIAYA BPJS',3,8,0,0,0,1,0,'','','',0,'',0,0,0,0,0,0,0,26,'2015-11-10 10:42:49',1,'2019-03-14 13:15:07',0,NULL,1,0,'Semua',1,NULL),
 ('ID-160813-145647-0001','101005002','PPH PASAL 25 BADAN',3,1,0,0,0,0,0,'','','',0,'',0,0,0,0,0,0,0,26,'2016-08-13 14:55:55',61,'2017-01-16 15:38:53',0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-160813-150235-0002','201001110','HUTANG PAJAK',3,2,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,26,'2016-08-13 15:01:51',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-160919-131334-0001','501001006','Internet',3,5,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,59,'2016-09-19 13:13:39',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-161005-171536-0001','801001011','BIAYA NOTARIS',3,8,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,0,59,'2016-10-05 17:16:07',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-170116-153840-0001','101005003','PPH 21',3,1,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,0,61,'2017-01-16 15:37:29',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-170621-170409-0001','201001114','Selisih PPN Yang Akan Dibayar',3,2,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,0,80,'2017-06-21 17:04:06',0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-170916-174424-0001','102001001','Renovasi Bangunan',3,1,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,0,61,'2017-09-16 17:41:39',1,'2019-03-14 13:13:11',0,NULL,1,0,'Semua',1,NULL),
 ('ID-170918-145832-0001','801001012','Cadangan THR Karyawan',3,8,0,0,0,0,0,'','','',0,'IDR',0,0,0,0,0,0,0,61,'2017-09-18 14:56:12',1,'2019-03-14 13:07:37',0,NULL,1,0,'Semua',1,'2019-02-09 10:30:20'),
 ('ID-171226-120240-0001','801001013','Biaya Lain-lain (Karyawan)',3,8,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,1,80,'2017-12-26 12:01:08',0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID-180306-115558-0001','102002001','Angsuran Kendaraan ',3,1,0,0,0,1,0,'Uang Muka Kendaraan,angsuran kendaraan','','',0,'',0,0,0,0,0,0,1,69,'2018-03-06 11:53:37',80,'2018-10-08 10:24:02',0,NULL,1,0,'',0,NULL),
 ('ID-180331-090316-0001','801001014','Biaya lain - lain ( PAJAK )',3,8,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,1,80,'2018-03-31 09:00:37',0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID-180423-143210-0005','101002004','BNI',3,1,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,1,80,'2018-04-23 14:31:08',1,'2019-03-14 13:12:08',0,NULL,1,0,'Semua',1,NULL),
 ('ID-181201-103033-0001','501003005','BPJS KETENAGAKERJAAN',3,5,0,0,0,1,0,'','','',0,'IDR',0,0,0,0,0,0,1,80,'2018-12-01 10:29:56',0,NULL,0,NULL,0,0,'',0,NULL),
 ('ID0602161357021','601000000','Harga Pokok Penjualan',1,6,1,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID0602161357541','601001000','Harga Pokok Penjualan',2,6,1,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID0602161358371','601001001','Harga Pokok Penjualan',3,6,1,0,56446789463.937706,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
INSERT INTO `trek` (`rek_no`,`rek_kode`,`rek_nama`,`rek_type`,`rek_gol`,`is_fix`,`is_delete`,`saldo`,`is_kas`,`is_check`,`ket1`,`ket2`,`ket3`,`is_using_valid`,`uang_id`,`jenis_rl`,`saldo_debet`,`saldo_kredit`,`saldo_kurs`,`saldo_debet_kurs`,`saldo_kredit_kurs`,`is_rekap`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`is_downloaded`,`is_jual`,`cab_no`,`iUpload`,`Upload_date`) VALUES 
 ('ID0602161402281','101004000','Persediaan Barang',2,1,0,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID0602161402481','101004001','Persediaan Barang Dagangan',3,1,1,0,0,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL),
 ('ID0612061259463','101003001','Piutang Dagang',3,1,0,0,9569619003.149996,0,0,'','','',0,'IDR01',0,0,0,0,0,0,0,0,NULL,0,NULL,0,NULL,1,0,'',0,NULL);
/*!40000 ALTER TABLE `trek` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tsal`
--

DROP TABLE IF EXISTS `tsal`;
CREATE TABLE `tsal` (
  `sal_no` varchar(50) NOT NULL DEFAULT '',
  `sal_code` varchar(50) DEFAULT NULL,
  `sal_name` varchar(50) DEFAULT NULL,
  `sal_alamat` varchar(50) DEFAULT NULL,
  `sal_telp` varchar(50) DEFAULT NULL,
  `sal_hp` varchar(50) DEFAULT NULL,
  `sal_contact` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `sal_type` int(11) NOT NULL DEFAULT '0',
  `sal_persen_komisi` double DEFAULT '0',
  `is_jual` int(11) DEFAULT '0',
  `is_default_kasir` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sal_no`),
  KEY `Index_2` (`sal_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tsal`
--

/*!40000 ALTER TABLE `tsal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsal` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tsales`
--

DROP TABLE IF EXISTS `tsales`;
CREATE TABLE `tsales` (
  `jual_no` varchar(50) NOT NULL,
  `jual_date` datetime DEFAULT NULL,
  `top_id` int(11) NOT NULL DEFAULT '0',
  `person_no` varchar(50) DEFAULT NULL,
  `is_revisi` int(11) NOT NULL DEFAULT '0',
  `jual_sub_total` double(15,3) NOT NULL DEFAULT '0.000',
  `jual_disc0_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `jual_disc0_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `jual_disc1_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `jual_disc1_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `jual_ppn_persen` double(15,3) NOT NULL DEFAULT '0.000',
  `jual_ppn_rp` double(15,3) NOT NULL DEFAULT '0.000',
  `jual_biaya_kirim` double(15,3) NOT NULL DEFAULT '0.000',
  `jual_total` double(15,3) NOT NULL DEFAULT '0.000',
  `sal_no` varchar(50) DEFAULT NULL,
  `staff_no` varchar(50) DEFAULT NULL,
  `jual_desc` varchar(150) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_revisi` int(11) NOT NULL DEFAULT '0',
  `jual_last_revisi` datetime DEFAULT NULL,
  `jur_no` varchar(50) DEFAULT NULL,
  `ndays` int(11) NOT NULL DEFAULT '0',
  `sal_ord` varchar(45) DEFAULT NULL,
  `jual_type` int(11) NOT NULL DEFAULT '0',
  `siap_by` varchar(145) NOT NULL DEFAULT '',
  `is_print` int(11) NOT NULL DEFAULT '0',
  `jual_tunai` double NOT NULL DEFAULT '0',
  `is_cetak_gud` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `pay_type` int(11) NOT NULL DEFAULT '0',
  `pay_cash` double NOT NULL DEFAULT '0',
  `pay_card` double NOT NULL DEFAULT '0',
  `bank_name` varchar(45) DEFAULT NULL,
  `card_no` varchar(45) DEFAULT NULL,
  `card_username` varchar(45) DEFAULT NULL,
  `card_no_trx` varchar(45) DEFAULT NULL,
  `card_type` int(11) NOT NULL DEFAULT '0',
  `is_pos` int(11) DEFAULT '0',
  `log_no` varchar(50) DEFAULT NULL,
  `jual_nama` varchar(50) DEFAULT NULL,
  `pay_change` double DEFAULT '0',
  `pay_card_holder` varchar(50) DEFAULT NULL,
  `pay_card_no` varchar(50) DEFAULT NULL,
  `pay_card_notrx` varchar(50) DEFAULT NULL,
  `pay_notrx` varchar(50) DEFAULT NULL,
  `pay_card_type` int(11) DEFAULT '0',
  `pay_bank` varchar(50) DEFAULT '0',
  `jual_ter_no` varchar(50) DEFAULT NULL,
  `jual_total_tunai` double DEFAULT '0',
  `let_no` varchar(50) DEFAULT NULL,
  `jual_no_reff` varchar(50) DEFAULT NULL,
  `tgl_est_kirim` datetime DEFAULT NULL,
  `is_alamat_sama` int(11) DEFAULT '0',
  `jual_nama_kirim` varchar(50) DEFAULT NULL,
  `jual_alamat_kirim` varchar(150) DEFAULT NULL,
  `jual_telp_kirim` varchar(50) DEFAULT NULL,
  `is_kirim` int(11) DEFAULT '0',
  `is_ppn` int(11) DEFAULT '0',
  `sisaSebelumnya` double(15,3) DEFAULT '0.000',
  `pembayaran` double(15,3) DEFAULT '0.000',
  `jual_desc2` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `jual_charge_persen` double DEFAULT '0',
  `jual_charge_rp` double DEFAULT '0',
  `rek_piutang` varchar(50) DEFAULT NULL,
  `jual_reff` varchar(50) DEFAULT NULL,
  `alamat_kirim_no1` varchar(50) DEFAULT NULL,
  `alamat_kirim_no2` varchar(150) DEFAULT NULL,
  `alamat_kirim_no3` varchar(150) DEFAULT NULL,
  `is_lock_no_reff_tax` int(11) NOT NULL DEFAULT '0',
  `no_reff_tax` varchar(50) DEFAULT NULL,
  `prefix_no_tax` varchar(50) DEFAULT NULL,
  `rek_hutang_ppn` varchar(50) DEFAULT NULL,
  `jual_sub_total_kurs` double NOT NULL DEFAULT '0',
  `jual_disc0_rp_kurs` double NOT NULL DEFAULT '0',
  `jual_disc1_rp_kurs` double NOT NULL DEFAULT '0',
  `jual_ppn_rp_kurs` double NOT NULL DEFAULT '0',
  `jual_total_kurs` double NOT NULL DEFAULT '0',
  `jual_nopol` varchar(50) DEFAULT NULL,
  `jual_sj` varchar(50) DEFAULT NULL,
  `uang_id` varchar(50) NOT NULL DEFAULT 'IDR01',
  `kurs_cur` int(11) DEFAULT '1',
  `tgl_faktur_pajak` datetime DEFAULT NULL,
  `no_faktur_pajak` varchar(100) DEFAULT NULL,
  `faktur_pajak_nama` varchar(100) DEFAULT NULL,
  `faktur_pajak_jabatan` varchar(100) DEFAULT NULL,
  `wilayah_no` varchar(50) DEFAULT NULL,
  `is_print_sj` int(11) NOT NULL DEFAULT '0',
  `ip_create` varchar(50) DEFAULT NULL,
  `ip_edit` varchar(50) DEFAULT NULL,
  `ip_delete` varchar(50) DEFAULT NULL,
  `jual_tax_subtotal` double DEFAULT '0',
  `jual_tax_discount` double DEFAULT '0',
  `jual_tax_dpp` double DEFAULT '0',
  `jual_tax_rp` double DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '1',
  `tg_no` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `kasir_no` varchar(50) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_pkp` int(4) DEFAULT '0',
  `is_receive` int(4) DEFAULT '0',
  `jual_bulat` double DEFAULT '0',
  `is_fp` double DEFAULT '0',
  `nilai_fp` double DEFAULT '0',
  `ket_fp` varchar(100) DEFAULT NULL,
  `jual_komisi_persen` double DEFAULT '0',
  `jual_komisi_rp` double DEFAULT '0',
  `is_sn` int(4) DEFAULT '0',
  `jual_ongkir_persen` double DEFAULT '0',
  `jual_ongkir_rp` double DEFAULT '0',
  `pay_dp` double DEFAULT '0',
  `jual_point_persen` double DEFAULT '0',
  `jual_point_rp` double DEFAULT '0',
  `tax_amount` int(11) DEFAULT '10',
  PRIMARY KEY (`jual_no`),
  KEY `Index_2` (`person_no`),
  KEY `Index_3` (`sal_no`),
  KEY `Index_4` (`jur_no`),
  KEY `Index_5` (`log_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tsales`
--

/*!40000 ALTER TABLE `tsales` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsales` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tsales_order`
--

DROP TABLE IF EXISTS `tsales_order`;
CREATE TABLE `tsales_order` (
  `sal_ord` varchar(50) NOT NULL DEFAULT '',
  `sal_ord_date` datetime DEFAULT NULL,
  `person_no` varchar(45) DEFAULT NULL,
  `sal_no` varchar(45) DEFAULT NULL,
  `sal_ord_desc` varchar(145) DEFAULT NULL,
  `sal_ord_total` double NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `let_no` varchar(50) DEFAULT NULL,
  `is_pos` int(11) DEFAULT '0',
  `disc0_persen` double DEFAULT '0',
  `disc0_rp` double DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `statusOrder` int(11) NOT NULL DEFAULT '0',
  `is_ppn` int(11) NOT NULL DEFAULT '0',
  `sal_ord_ppn_persen` double DEFAULT '0',
  `sal_ord_ppn_rp` double DEFAULT '0',
  `disc1_persen` double DEFAULT '0',
  `disc1_rp` double DEFAULT '0',
  `is_lock_no_reff_tax` int(11) NOT NULL DEFAULT '0',
  `no_reff_tax` varchar(50) DEFAULT NULL,
  `prefix_no_tax` varchar(50) DEFAULT NULL,
  `uang_id` varchar(50) NOT NULL DEFAULT 'IDR01',
  `kurs_cur` double NOT NULL DEFAULT '1',
  `sal_ord_sub_total` double NOT NULL DEFAULT '0',
  `sal_ord_sub_total_kurs` double NOT NULL DEFAULT '0',
  `sal_ord_total_kurs` double NOT NULL DEFAULT '0',
  `disc0_rp_kurs` double DEFAULT '0',
  `sal_ord_ppn_rp_kurs` double DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  `jual_reff` varchar(50) DEFAULT NULL,
  `is_status` int(4) DEFAULT '0',
  `is_checker` int(4) DEFAULT '0',
  `sal_ord_desc2` varchar(150) DEFAULT NULL,
  `tax_amount` int(11) DEFAULT '10',
  `iUpload` int(4) NOT NULL DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_mobile` int(4) NOT NULL DEFAULT '0',
  `sal_ongkir` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`sal_ord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tsales_order`
--

/*!40000 ALTER TABLE `tsales_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsales_order` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tsales_retur`
--

DROP TABLE IF EXISTS `tsales_retur`;
CREATE TABLE `tsales_retur` (
  `sal_ret_no` varchar(50) NOT NULL DEFAULT '',
  `sal_ret_date` datetime DEFAULT NULL,
  `sales_no` varchar(45) DEFAULT NULL,
  `sal_ret_type` int(11) NOT NULL DEFAULT '0',
  `person_no` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `sal_ret_ket` varchar(145) DEFAULT NULL,
  `gud_no` varchar(45) DEFAULT NULL,
  `sal_ret_total` double NOT NULL DEFAULT '0',
  `jur_no` varchar(45) DEFAULT NULL,
  `biaya_kirim` double NOT NULL DEFAULT '0',
  `sal_ret_subtotal` double NOT NULL DEFAULT '0',
  `is_print` int(11) NOT NULL DEFAULT '0',
  `sal_no` varchar(45) DEFAULT NULL,
  `sal_ret_potong` double NOT NULL DEFAULT '0',
  `sal_ret_potong_persen` double NOT NULL DEFAULT '0',
  `log_no` varchar(50) DEFAULT NULL,
  `sal_ret_total_tunai` double DEFAULT '0',
  `sal_ret_ter_no` varchar(50) DEFAULT NULL,
  `let_no` varchar(50) DEFAULT NULL,
  `is_ppn` int(11) DEFAULT '0',
  `disc0_persen` double DEFAULT '0',
  `disc0_rp` double DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `sal_ret_ppn_persen` double DEFAULT '0',
  `sal_ret_ppn_rp` double DEFAULT '0',
  `sal_ret_disc1_persen` double DEFAULT '0',
  `sal_ret_disc1_rp` double DEFAULT '0',
  `wilayah_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sal_ret_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tsales_retur`
--

/*!40000 ALTER TABLE `tsales_retur` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsales_retur` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tset_bb`
--

DROP TABLE IF EXISTS `tset_bb`;
CREATE TABLE `tset_bb` (
  `bb_no` varchar(50) NOT NULL DEFAULT '',
  `tgl` datetime DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `is_status` int(4) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  `is_pakai` int(11) DEFAULT '0',
  `prod_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bb_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tset_bb`
--

/*!40000 ALTER TABLE `tset_bb` DISABLE KEYS */;
INSERT INTO `tset_bb` (`bb_no`,`tgl`,`keterangan`,`is_delete`,`user_id`,`is_status`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`,`cab_no`,`is_pakai`,`prod_no`) VALUES 
 ('BB-2353-161714-0001','2023-05-03 16:17:00','BRG123 TEPUNG TERIGU',1,1,0,'2023-05-03 16:18:14',1,'2023-05-03 16:42:46',1,'2023-05-09 15:36:09','CG_000',0,'ID-230331-102545-0001'),
 ('BB-2359-153557-0001','2023-05-09 15:35:00','PRD2311 ROTI BOI',0,1,0,'2023-05-09 15:35:57',1,'2023-05-09 15:35:57',0,NULL,'CG_000',0,'ID-230503-161704-0002');
/*!40000 ALTER TABLE `tset_bb` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tset_hpp`
--

DROP TABLE IF EXISTS `tset_hpp`;
CREATE TABLE `tset_hpp` (
  `hap_no` varchar(50) NOT NULL DEFAULT '',
  `tgl` datetime DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `is_delete` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`hap_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tset_hpp`
--

/*!40000 ALTER TABLE `tset_hpp` DISABLE KEYS */;
INSERT INTO `tset_hpp` (`hap_no`,`tgl`,`keterangan`,`is_delete`,`user_id`,`create_date`,`user_edit`,`edit_date`,`user_delete`,`delete_date`) VALUES 
 ('HR-2353-162218-0001','2023-05-03 16:22:00','',1,1,'2023-05-03 16:23:18',0,NULL,1,'2023-05-09 15:19:30'),
 ('HR-2353-163416-0002','2023-05-03 16:34:00','',1,1,'2023-05-03 16:35:16',0,NULL,1,'2023-05-09 15:19:30');
/*!40000 ALTER TABLE `tset_hpp` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tsyntax`
--

DROP TABLE IF EXISTS `tsyntax`;
CREATE TABLE `tsyntax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pur_no` varchar(45) NOT NULL DEFAULT '',
  `is_downloaded` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`tsyntax`
--

/*!40000 ALTER TABLE `tsyntax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsyntax` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tterima`
--

DROP TABLE IF EXISTS `tterima`;
CREATE TABLE `tterima` (
  `ter_no` varchar(50) NOT NULL DEFAULT '',
  `ter_tgl` datetime DEFAULT NULL,
  `ter_tgl_entry` datetime DEFAULT NULL,
  `ter_desc` varchar(150) DEFAULT NULL,
  `ter_total` double NOT NULL DEFAULT '0',
  `person_no` varchar(50) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `kas_no` varchar(50) DEFAULT NULL,
  `jur_no` varchar(50) NOT NULL DEFAULT '',
  `ter_type` int(11) NOT NULL DEFAULT '0',
  `rek_pot` varchar(50) DEFAULT NULL,
  `nobg` varchar(45) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `nm_bank` varchar(45) DEFAULT NULL,
  `total_tunai` double NOT NULL DEFAULT '0',
  `total_cek` double NOT NULL DEFAULT '0',
  `is_cek` int(11) NOT NULL DEFAULT '0',
  `giro_no` varchar(45) DEFAULT NULL,
  `sal_no` varchar(45) DEFAULT NULL,
  `is_tutup` int(11) NOT NULL DEFAULT '0',
  `is_pos` int(11) DEFAULT '0',
  `let_no` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `uang_id` varchar(50) DEFAULT 'IDR01',
  `kurs_cur` double DEFAULT '1',
  `ter_total_kurs` double DEFAULT '0',
  `total_tunai_kurs` double DEFAULT '0',
  `ter_total_pot` double NOT NULL DEFAULT '0',
  `ter_total_bayar` double NOT NULL DEFAULT '0',
  `ter_total_pot_kurs` double NOT NULL DEFAULT '0',
  `ter_total_bayar_kurs` double NOT NULL DEFAULT '0',
  `is_jenis` int(11) DEFAULT '0',
  `rek_terima_no` varchar(50) DEFAULT NULL,
  `ter_voucher` varchar(50) DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '1',
  `cab_no` varchar(50) DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_pkp` int(4) DEFAULT '0',
  PRIMARY KEY (`ter_no`),
  KEY `Index_2` (`sal_no`),
  KEY `Index_3` (`person_no`),
  KEY `Index_4` (`jur_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tterima`
--

/*!40000 ALTER TABLE `tterima` DISABLE KEYS */;
/*!40000 ALTER TABLE `tterima` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ttop`
--

DROP TABLE IF EXISTS `ttop`;
CREATE TABLE `ttop` (
  `top_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) DEFAULT NULL,
  `ndays` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `is_default` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`top_id`),
  KEY `Index_2` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`ttop`
--

/*!40000 ALTER TABLE `ttop` DISABLE KEYS */;
/*!40000 ALTER TABLE `ttop` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ttotal_id`
--

DROP TABLE IF EXISTS `ttotal_id`;
CREATE TABLE `ttotal_id` (
  `nama` varchar(100) DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `bulan` int(11) NOT NULL DEFAULT '0',
  `tahun` int(11) NOT NULL DEFAULT '0',
  `hari` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`ttotal_id`
--

/*!40000 ALTER TABLE `ttotal_id` DISABLE KEYS */;
INSERT INTO `ttotal_id` (`nama`,`total`,`bulan`,`tahun`,`hari`,`id`) VALUES 
 ('tproduct_',1,3,2023,31,1),
 ('unit_',2,3,2023,31,2),
 ('tdgproduct_',1,3,2023,31,3),
 ('tproduct_',3,5,2023,3,4),
 ('unit_',6,5,2023,3,5),
 ('tdgproduct_PT',3,5,2023,3,6),
 ('tset_bb_',1,5,2023,3,7),
 ('td_set_bb_PT',1,5,2023,3,8),
 ('tset_hpp_',2,5,2023,3,9),
 ('td_set_hpp_',3,5,2023,3,10),
 ('tsales_produksi_ID2_CG_000',2,5,2023,3,11),
 ('tsales_produksi_ID2_CG_000',3,5,2023,5,14),
 ('tproduct_',4,5,2023,5,16),
 ('unit_',8,5,2023,5,17),
 ('tjurnal_CG_000',11,5,2023,5,18),
 ('td_produksi_PT',22,5,2023,5,19),
 ('tdetail_out_PT',22,5,2023,5,20),
 ('tdjurnal_PT',44,5,2023,5,21),
 ('ttrans_PT',22,5,2023,5,22),
 ('tsales_produksi_ID2_CG_000',15,5,2023,9,23),
 ('tjurnal_CG_000',7,5,2023,9,24),
 ('td_produksi_PT',18,5,2023,9,25),
 ('tdetail_out_PT',18,5,2023,9,26),
 ('tdjurnal_PT',36,5,2023,9,27),
 ('ttrans_PT',18,5,2023,9,28),
 ('tset_bb_',1,5,2023,9,29),
 ('td_set_bb_PT',2,5,2023,9,30);
/*!40000 ALTER TABLE `ttotal_id` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ttrans`
--

DROP TABLE IF EXISTS `ttrans`;
CREATE TABLE `ttrans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `in_deT_no` varchar(50) DEFAULT NULL,
  `out_det_no` varchar(50) DEFAULT NULL,
  `debet` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0',
  `tran_type` int(11) NOT NULL DEFAULT '0',
  `gud_no` varchar(50) NOT NULL DEFAULT '',
  `entry_date` datetime DEFAULT NULL,
  `prod_netto_price` double NOT NULL DEFAULT '0',
  `debet2` double DEFAULT '0',
  `kredit2` double DEFAULT '0',
  `id_hpp` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`in_deT_no`),
  KEY `Index_3` (`out_det_no`),
  KEY `Index_4` (`prod_no`),
  KEY `Index_5` (`gud_no`),
  KEY `Index 6` (`tgl`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`ttrans`
--

/*!40000 ALTER TABLE `ttrans` DISABLE KEYS */;
INSERT INTO `ttrans` (`id`,`tgl`,`prod_no`,`in_deT_no`,`out_det_no`,`debet`,`kredit`,`tran_type`,`gud_no`,`entry_date`,`prod_netto_price`,`debet2`,`kredit2`,`id_hpp`,`cab_no`) VALUES 
 (46,'2023-05-09 16:59:56','ID-230503-152831-0001','','PT-230509-165956-0013',0,0.24,7,'ID2',NULL,0,0,0,'PT-230509-165956-0013','CG_000'),
 (47,'2023-05-09 16:59:56','ID-230503-163204-0003','','PT-230509-165956-0014',0,0.12,7,'ID2',NULL,0,0,0,'PT-230509-165956-0014','CG_000'),
 (48,'2023-05-09 16:59:56','ID-230503-161704-0002','','PT-230509-165956-0015',0,-0.4,7,'ID2',NULL,0,0,0,'PT-230509-165956-0015','CG_000'),
 (49,'2023-05-09 17:01:03','ID-230503-152831-0001','','PT-230509-170203-0016',0,0.24,7,'ID2',NULL,0,0,0,'PT-230509-170203-0016','CG_000'),
 (50,'2023-05-09 17:01:03','ID-230503-163204-0003','','PT-230509-170203-0017',0,0.12,7,'ID2',NULL,0,0,0,'PT-230509-170203-0017','CG_000'),
 (51,'2023-05-09 17:01:03','ID-230503-161704-0002','','PT-230509-170203-0018',0,-0.4,7,'ID2',NULL,0,0,0,'PT-230509-170203-0018','CG_000');
/*!40000 ALTER TABLE `ttrans` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ttrans_hpp`
--

DROP TABLE IF EXISTS `ttrans_hpp`;
CREATE TABLE `ttrans_hpp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `in_deT_no` varchar(50) DEFAULT NULL,
  `out_det_no` varchar(50) DEFAULT NULL,
  `debet` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0',
  `tran_type` int(11) NOT NULL DEFAULT '0',
  `gud_no` varchar(50) NOT NULL DEFAULT '',
  `entry_date` datetime DEFAULT NULL,
  `prod_netto_price` double NOT NULL DEFAULT '0',
  `id_hpp` varchar(50) NOT NULL DEFAULT '',
  `saldo` double DEFAULT '0',
  `last_prod_rata_price` double DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`in_deT_no`),
  KEY `Index_3` (`out_det_no`),
  KEY `Index_4` (`prod_no`),
  KEY `Index_5` (`gud_no`),
  KEY `Index 6` (`prod_no`,`tgl`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=164;

--
-- Dumping data for table `ohh_bakery`.`ttrans_hpp`
--

/*!40000 ALTER TABLE `ttrans_hpp` DISABLE KEYS */;
INSERT INTO `ttrans_hpp` (`id`,`tgl`,`prod_no`,`in_deT_no`,`out_det_no`,`debet`,`kredit`,`tran_type`,`gud_no`,`entry_date`,`prod_netto_price`,`id_hpp`,`saldo`,`last_prod_rata_price`,`cab_no`) VALUES 
 (49,'2023-05-09 17:01:03','ID-230503-152831-0001','','PT-230509-170203-0016',0,0.24,7,'ID2','2023-05-09 17:02:03',0,'PT-230509-170203-0016',-0.24,-0,'CG_000'),
 (50,'2023-05-09 17:01:03','ID-230503-163204-0003','','PT-230509-170203-0017',0,0.12,7,'ID2','2023-05-09 17:02:03',0,'PT-230509-170203-0017',-0.12,-0,'CG_000'),
 (51,'2023-05-09 17:01:03','ID-230503-161704-0002','','PT-230509-170203-0018',0,-0.4,7,'ID2','2023-05-09 17:02:03',0,'PT-230509-170203-0018',0.4,0,'CG_000');
/*!40000 ALTER TABLE `ttrans_hpp` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ttrans_point`
--

DROP TABLE IF EXISTS `ttrans_point`;
CREATE TABLE `ttrans_point` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `person_no` varchar(45) DEFAULT NULL,
  `out_no` varchar(45) DEFAULT NULL,
  `in_no` varchar(45) DEFAULT NULL,
  `debet` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0',
  `tran_type` int(11) NOT NULL DEFAULT '0' COMMENT '1 : POINT, 2: TUKAR, 3:CLOSE',
  `cab_no` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`person_no`),
  KEY `Index_3` (`out_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`ttrans_point`
--

/*!40000 ALTER TABLE `ttrans_point` DISABLE KEYS */;
/*!40000 ALTER TABLE `ttrans_point` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ttrans_wh`
--

DROP TABLE IF EXISTS `ttrans_wh`;
CREATE TABLE `ttrans_wh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `in_det_no` varchar(50) DEFAULT NULL,
  `out_det_no` varchar(50) DEFAULT NULL,
  `debet` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0',
  `tran_type` int(11) NOT NULL DEFAULT '0',
  `gud_no` varchar(50) NOT NULL DEFAULT '',
  `entry_date` datetime DEFAULT NULL,
  `prod_netto_price` double NOT NULL DEFAULT '0',
  `debet2` double DEFAULT '0',
  `kredit2` double DEFAULT '0',
  `id_hpp` varchar(50) DEFAULT NULL,
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`in_det_no`),
  KEY `Index_3` (`out_det_no`),
  KEY `Index_4` (`prod_no`),
  KEY `Index_5` (`gud_no`),
  KEY `Index 6` (`tgl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`ttrans_wh`
--

/*!40000 ALTER TABLE `ttrans_wh` DISABLE KEYS */;
/*!40000 ALTER TABLE `ttrans_wh` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ttransfer`
--

DROP TABLE IF EXISTS `ttransfer`;
CREATE TABLE `ttransfer` (
  `fer_no` varchar(50) NOT NULL DEFAULT '',
  `fer_tgl` datetime DEFAULT NULL,
  `fer_type` int(10) unsigned NOT NULL DEFAULT '0',
  `gud_no1` varchar(45) NOT NULL DEFAULT '',
  `gud_no2` varchar(45) NOT NULL DEFAULT '',
  `fer_desc` varchar(145) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(10) unsigned NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `is_delete` int(10) unsigned NOT NULL DEFAULT '0',
  `nopol` varchar(45) DEFAULT NULL,
  `nm_supir` varchar(45) DEFAULT NULL,
  `nm_setuju` varchar(45) DEFAULT NULL,
  `nm_terima` varchar(45) DEFAULT NULL,
  `fer_no_reff` varchar(45) DEFAULT NULL,
  `is_ready_upload` int(4) DEFAULT '0',
  `is_ready_download` int(4) DEFAULT '0',
  `no_reff2` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`fer_no`),
  KEY `Index_2` (`gud_no1`),
  KEY `Index_3` (`gud_no2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`ttransfer`
--

/*!40000 ALTER TABLE `ttransfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `ttransfer` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`ttransfer_req`
--

DROP TABLE IF EXISTS `ttransfer_req`;
CREATE TABLE `ttransfer_req` (
  `req_no` varchar(50) NOT NULL DEFAULT '',
  `req_tgl` datetime DEFAULT NULL,
  `gud_no1` varchar(45) NOT NULL DEFAULT '',
  `gud_no2` varchar(45) NOT NULL DEFAULT '',
  `req_type` int(4) unsigned NOT NULL DEFAULT '0',
  `req_desc` varchar(145) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(10) unsigned NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `is_delete` int(10) unsigned NOT NULL DEFAULT '0',
  `nopol` varchar(45) DEFAULT NULL,
  `nm_supir` varchar(45) DEFAULT NULL,
  `nm_setuju` varchar(45) DEFAULT NULL,
  `nm_terima` varchar(45) DEFAULT NULL,
  `req_no_reff` varchar(45) DEFAULT NULL,
  `is_ready_upload` int(4) DEFAULT '0',
  `is_ready_download` int(4) DEFAULT '0',
  `no_reff2` varchar(50) DEFAULT NULL,
  `statusReq` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `is_print` int(4) DEFAULT '0',
  PRIMARY KEY (`req_no`),
  KEY `Index_2` (`gud_no1`),
  KEY `Index_3` (`gud_no2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`ttransfer_req`
--

/*!40000 ALTER TABLE `ttransfer_req` DISABLE KEYS */;
/*!40000 ALTER TABLE `ttransfer_req` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tuser_gudang`
--

DROP TABLE IF EXISTS `tuser_gudang`;
CREATE TABLE `tuser_gudang` (
  `tg_no` varchar(50) NOT NULL DEFAULT '',
  `tg_code` varchar(50) DEFAULT NULL,
  `tg_name` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `is_default` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `gud_no` varchar(50) DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  PRIMARY KEY (`tg_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tuser_gudang`
--

/*!40000 ALTER TABLE `tuser_gudang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tuser_gudang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tusers`
--

DROP TABLE IF EXISTS `tusers`;
CREATE TABLE `tusers` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_pass` varchar(50) DEFAULT NULL,
  `user_right` varchar(5000) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `pass_diskon` varchar(50) DEFAULT NULL,
  `is_Super` int(11) NOT NULL DEFAULT '0',
  `is_kasir` int(11) DEFAULT '0',
  `gud_no` varchar(50) DEFAULT NULL,
  `user_delete` int(11) DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `group_user_id` int(11) DEFAULT '0',
  `let_no` varchar(50) DEFAULT NULL,
  `is_show_dashboard` int(11) DEFAULT '0',
  `is_downloaded` int(4) DEFAULT '0',
  `cat_gud_no` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`User_id`),
  KEY `Index_2` (`group_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tusers`
--

/*!40000 ALTER TABLE `tusers` DISABLE KEYS */;
INSERT INTO `tusers` (`User_id`,`user_name`,`user_pass`,`user_right`,`is_delete`,`pass_diskon`,`is_Super`,`is_kasir`,`gud_no`,`user_delete`,`delete_date`,`user_edit`,`edit_date`,`group_user_id`,`let_no`,`is_show_dashboard`,`is_downloaded`,`cat_gud_no`,`create_date`,`iUpload`,`Upload_date`) VALUES 
 (1,'admin_web','1234','1 2 21 21A 21B 21C 21D 21E 21F 22 22A 22B 22C 22D 22E 22F 21G 21H 23 23A 23B 23C 23D 23E 23F 3 31 31A 31B 31C 31D 31E 31F 32 32A 32B 32C 32D 32E 32F 33 33A 33B 33C 33D 33E 33F 4 41 41A 41B 41C 41D 41E 41F 5 51 51A 51B 52 52A 52B 52C 52D 52E 52F 53 53A 53B 53C 53D',0,'1234',0,0,'ID2',0,NULL,0,NULL,2,NULL,0,0,'CG_000',NULL,0,NULL),
 (139,'admin','admin','1 2 21 21A 21B 21C 21D 21E 21F 21G 21H 22 22A 22B 22C 22D 22E 22F 23 23A 23B 23C 23D 23E 23F 3 31 31A 31B 31C 31D 31E 31F 32 32A 32B 32C 32D 32E 32F 33 33A 33B 33C 33D 33E 33F 4 41 41A 41B 41C 41D 41E 41F 5 51 51A 51B 52 52A 52B 52C 52D 52E 52F 53 53A 53B 53C 53D',0,'admin',0,0,NULL,0,NULL,0,NULL,2,NULL,0,0,NULL,'2023-03-31 10:06:20',1,NULL);
/*!40000 ALTER TABLE `tusers` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tusers_point`
--

DROP TABLE IF EXISTS `tusers_point`;
CREATE TABLE `tusers_point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_pass` varchar(50) DEFAULT NULL,
  `person_no` varchar(100) DEFAULT NULL,
  `cat_gud_no` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT '0',
  `user_id` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `user_type` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`tusers_point`
--

/*!40000 ALTER TABLE `tusers_point` DISABLE KEYS */;
/*!40000 ALTER TABLE `tusers_point` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tusers_supplier`
--

DROP TABLE IF EXISTS `tusers_supplier`;
CREATE TABLE `tusers_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_pass` varchar(50) DEFAULT NULL,
  `person_no` varchar(100) DEFAULT NULL,
  `cat_gud_no` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `user_edit` int(11) DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT '0',
  `user_id` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`tusers_supplier`
--

/*!40000 ALTER TABLE `tusers_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `tusers_supplier` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tvarian`
--

DROP TABLE IF EXISTS `tvarian`;
CREATE TABLE `tvarian` (
  `varian_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `is_downloaded` int(4) DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`varian_id`),
  KEY `Index_2` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tvarian`
--

/*!40000 ALTER TABLE `tvarian` DISABLE KEYS */;
/*!40000 ALTER TABLE `tvarian` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`tvoucher_hutang`
--

DROP TABLE IF EXISTS `tvoucher_hutang`;
CREATE TABLE `tvoucher_hutang` (
  `v_no` varchar(50) NOT NULL DEFAULT '',
  `v_date` datetime DEFAULT NULL,
  `v_date_byr` datetime DEFAULT NULL,
  `person_no` varchar(50) DEFAULT NULL,
  `v_desc` varchar(145) DEFAULT NULL,
  `v_inv` varchar(100) DEFAULT NULL,
  `v_total` double NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `is_status` int(11) NOT NULL DEFAULT '0',
  `cab_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`v_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`tvoucher_hutang`
--

/*!40000 ALTER TABLE `tvoucher_hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tvoucher_hutang` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`twilayah`
--

DROP TABLE IF EXISTS `twilayah`;
CREATE TABLE `twilayah` (
  `wilayah_no` varchar(50) NOT NULL,
  `wilayah_code` varchar(50) DEFAULT NULL,
  `wilayah_name` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `delete_date` datetime DEFAULT NULL,
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`wilayah_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`twilayah`
--

/*!40000 ALTER TABLE `twilayah` DISABLE KEYS */;
/*!40000 ALTER TABLE `twilayah` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit` (
  `unit_no` varchar(50) NOT NULL DEFAULT '',
  `prod_no` varchar(50) NOT NULL DEFAULT '',
  `satuan` int(10) unsigned NOT NULL DEFAULT '0',
  `konversi` double NOT NULL DEFAULT '0',
  `catatan` varchar(50) DEFAULT NULL,
  `nm_satuan` varchar(10) NOT NULL DEFAULT '',
  `hj_satu` double NOT NULL DEFAULT '0',
  `hj_dua` double NOT NULL DEFAULT '0',
  `hj_tiga` double NOT NULL DEFAULT '0',
  `iUpload` int(4) DEFAULT '0',
  `Upload_date` datetime DEFAULT NULL,
  `hb_ppn` double NOT NULL DEFAULT '0',
  `hb` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`unit_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ohh_bakery`.`unit`
--

/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` (`unit_no`,`prod_no`,`satuan`,`konversi`,`catatan`,`nm_satuan`,`hj_satu`,`hj_dua`,`hj_tiga`,`iUpload`,`Upload_date`,`hb_ppn`,`hb`) VALUES 
 ('ID-230505-113238-0001','ID-230503-163204-0003',1,1,NULL,'GRAM',10010000000,0,0,0,'2023-05-05 11:32:38',0,0),
 ('ID-230505-113238-0002','ID-230503-163204-0003',2,1000,NULL,'KG',10010000000,0,0,0,'2023-05-05 11:32:38',0,0),
 ('ID-230505-113244-0003','ID-230503-161704-0002',1,1,NULL,'PCS',180000,0,0,0,'2023-05-05 11:32:44',0,0),
 ('ID-230505-113244-0004','ID-230503-161704-0002',2,12,NULL,'LSN',180000,0,0,0,'2023-05-05 11:32:44',0,0),
 ('ID-230505-113248-0005','ID-230503-152831-0001',1,1,NULL,'PCS',1560000,0,0,0,'2023-05-05 11:32:48',0,0),
 ('ID-230505-113248-0006','ID-230503-152831-0001',2,12,NULL,'LSN',1560000,0,0,0,'2023-05-05 11:32:48',0,0),
 ('ID-230505-113252-0007','ID-230331-102545-0001',1,1,NULL,'gram',10010000000,0,0,0,'2023-05-05 11:32:52',0,0),
 ('ID-230505-113252-0008','ID-230331-102545-0001',2,1000,NULL,'kg',10010000000,0,0,0,'2023-05-05 11:32:52',0,0);
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;


--
-- Table structure for table `ohh_bakery`.`unit_zahir`
--

DROP TABLE IF EXISTS `unit_zahir`;
CREATE TABLE `unit_zahir` (
  `NOINDEX` int(11) DEFAULT NULL,
  `KODEUNIT` varchar(15) DEFAULT NULL,
  `NAMAUNIT` varchar(25) DEFAULT NULL,
  `DESKRIPSIUNIT` varchar(255) DEFAULT NULL,
  `ISBASE` varchar(1) DEFAULT NULL,
  `TANGGALEDIT` datetime DEFAULT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ohh_bakery`.`unit_zahir`
--

/*!40000 ALTER TABLE `unit_zahir` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_zahir` ENABLE KEYS */;


--
-- View structure for view `ohh_bakery`.`v_rek`
--

DROP VIEW IF EXISTS `v_rek`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_rek` AS select `trek`.`rek_no` AS `rek_no`,`trek`.`rek_nama` AS `rek_nama`,`trek`.`rek_type` AS `rek_type`,`trek`.`rek_gol` AS `rek_gol`,`trek`.`is_delete` AS `is_delete`,`trek`.`is_fix` AS `is_fix`,`trek`.`rek_kode` AS `rek_kode`,concat(substr(`trek`.`rek_kode`,1,3),_latin1'.',substr(`trek`.`rek_kode`,4,3),_latin1'.',substr(`trek`.`rek_kode`,7,3)) AS `kode`,if((`trek`.`rek_gol` = 1),1,2) AS `posisi`,`trek`.`is_kas` AS `is_kas`,`trek`.`saldo` AS `saldo` from `trek` where (`trek`.`is_delete` = 0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
