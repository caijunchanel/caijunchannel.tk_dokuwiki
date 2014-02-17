-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-6
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Waktu pembuatan: 27. Maret 2008 jam 10:50
-- Versi Server: 5.0.32
-- Versi PHP: 5.2.0-8+etch10
-- 
-- Database: `radius`
-- 

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `nas`
-- 

CREATE TABLE `nas` (
  `id` int(10) NOT NULL auto_increment,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) default NULL,
  `type` varchar(30) default 'other',
  `ports` int(5) default NULL,
  `secret` varchar(60) NOT NULL default 'secret',
  `community` varchar(50) default NULL,
  `description` varchar(200) default 'RADIUS Client',
  PRIMARY KEY  (`id`),
  KEY `nasname` (`nasname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data untuk tabel `nas`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `radacct`
-- 

CREATE TABLE `radacct` (
  `RadAcctId` bigint(21) NOT NULL auto_increment,
  `AcctSessionId` varchar(32) NOT NULL default '',
  `AcctUniqueId` varchar(32) NOT NULL default '',
  `UserName` varchar(64) NOT NULL default '',
  `Realm` varchar(64) default '',
  `NASIPAddress` varchar(15) NOT NULL default '',
  `NASPortId` varchar(15) default NULL,
  `NASPortType` varchar(32) default NULL,
  `AcctStartTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AcctStopTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AcctSessionTime` int(12) default NULL,
  `AcctAuthentic` varchar(32) default NULL,
  `ConnectInfo_start` varchar(50) default NULL,
  `ConnectInfo_stop` varchar(50) default NULL,
  `AcctInputOctets` bigint(12) default NULL,
  `AcctOutputOctets` bigint(12) default NULL,
  `CalledStationId` varchar(50) NOT NULL default '',
  `CallingStationId` varchar(50) NOT NULL default '',
  `AcctTerminateCause` varchar(32) NOT NULL default '',
  `ServiceType` varchar(32) default NULL,
  `FramedProtocol` varchar(32) default NULL,
  `FramedIPAddress` varchar(15) NOT NULL default '',
  `AcctStartDelay` int(12) default NULL,
  `AcctStopDelay` int(12) default NULL,
  PRIMARY KEY  (`RadAcctId`),
  KEY `UserName` (`UserName`),
  KEY `FramedIPAddress` (`FramedIPAddress`),
  KEY `AcctSessionId` (`AcctSessionId`),
  KEY `AcctUniqueId` (`AcctUniqueId`),
  KEY `AcctStartTime` (`AcctStartTime`),
  KEY `AcctStopTime` (`AcctStopTime`),
  KEY `NASIPAddress` (`NASIPAddress`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data untuk tabel `radacct`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `radcheck`
-- 

CREATE TABLE `radcheck` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `UserName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '==',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2281 ;

-- 
-- Dumping data untuk tabel `radcheck`
-- 

INSERT INTO `radcheck` (`id`, `UserName`, `Attribute`, `op`, `Value`) VALUES 
(1, 'achmad', 'User-Password', ':=', 'f7f92a580b8e9bfc74ac4a087e4bd24c'),
(2, '2601', 'User-Password', ':=', 'e02e27e04fdff967ba7d76fb24b8069d');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `radgroupcheck`
-- 

CREATE TABLE `radgroupcheck` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `GroupName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '==',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `GroupName` (`GroupName`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `radgroupcheck`
-- 

INSERT INTO `radgroupcheck` (`id`, `GroupName`, `Attribute`, `op`, `Value`) VALUES 
(1, 'mhs', 'Auth-Type', ':=', 'PAP'),
(2, 'mhs', 'Simultaneous-Use', ':=', '1');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `radgroupreply`
-- 

CREATE TABLE `radgroupreply` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `GroupName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '=',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `GroupName` (`GroupName`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `radgroupreply`
-- 

INSERT INTO `radgroupreply` (`id`, `GroupName`, `Attribute`, `op`, `Value`) VALUES 
(1, 'mhs', 'Acct-Interim-Interval', ':=', '60'),
(2, 'mhs', 'Idle-Timeout', ':=', '300');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `radpostauth`
-- 

CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(64) NOT NULL default '',
  `pass` varchar(64) NOT NULL default '',
  `reply` varchar(32) NOT NULL default '',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data untuk tabel `radpostauth`
-- 

INSERT INTO `radpostauth` (`id`, `user`, `pass`, `reply`, `date`) VALUES 
(1, '2601', '2601', 'Access-Accept', '2008-03-25 18:54:14'),
(2, '2601', '2601', 'Access-Accept', '2008-03-25 18:54:45');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `radreply`
-- 

CREATE TABLE `radreply` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `UserName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '=',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data untuk tabel `radreply`
-- 


-- --------------------------------------------------------

-- 
-- Struktur dari tabel `usergroup`
-- 

CREATE TABLE `usergroup` (
  `UserName` varchar(64) NOT NULL default '',
  `GroupName` varchar(64) NOT NULL default '',
  `priority` int(11) NOT NULL default '1',
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `usergroup`
-- 

INSERT INTO `usergroup` (`UserName`, `GroupName`, `priority`) VALUES 
('achmad', 'mhs', 1),
('2601', 'mhs', 1);
