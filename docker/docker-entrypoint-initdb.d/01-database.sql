CREATE DATABASE IF NOT EXISTS `loop-returns` DEFAULT CHARACTER SET = `utf8mb4` DEFAULT COLLATE = `utf8mb4_unicode_ci`;
CREATE DATABASE IF NOT EXISTS `loop-testing` DEFAULT CHARACTER SET = `utf8mb4` DEFAULT COLLATE = `utf8mb4_unicode_ci`;
CREATE DATABASE IF NOT EXISTS `loop-commerce-data` DEFAULT CHARACTER SET = `utf8mb4` DEFAULT COLLATE = `utf8mb4_unicode_ci`;
CREATE DATABASE IF NOT EXISTS `loop-commerce-data-testing` DEFAULT CHARACTER SET = `utf8mb4` DEFAULT COLLATE = `utf8mb4_unicode_ci`;

GRANT ALL ON *.* TO 'laravel'@'%';
