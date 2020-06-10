-- reportsテーブルの定義
--

CREATE TABLE `reports` (
  `reportid` varchar(16) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `filename` varchar(32) NOT NULL,
  PRIMARY KEY (`reportid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `reports` (`reportid`, `userid`, `filename`) VALUES
('R1000000101', 'U10000001', 'r1000000101.pdf'),
('R1000000102', 'U10000001', 'r1000000102.pdf'),
('R1000000201', 'U10000002', 'r1000000201.pdf'),
('R1000000301', 'U10000003', 'r1000000301.pdf');
