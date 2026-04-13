SET SQL_MODE = "NO_AUTO_VALUE_ON ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `Usuario` (
    `id` int NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `Usuario`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;
