--
-- テーブルの構造 `users2`
--

CREATE TABLE `users2` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users2`
--

INSERT INTO `users2` (`id`, `username`, `password`) VALUES (0, 'dummy', 'dummy'); -- ダミーのユーザー
