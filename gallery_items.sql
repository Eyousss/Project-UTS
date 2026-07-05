CREATE TABLE IF NOT EXISTS `gallery_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `section` INT(11) NOT NULL DEFAULT 1,
  `section_name` VARCHAR(255) DEFAULT NULL,
  `position` VARCHAR(20) NOT NULL DEFAULT 'right',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gallery_items` (`title`, `image`, `section`, `section_name`, `position`) VALUES
('Daily Activity at Noma', 'assets/images/DIT08383.jpg', 1, NULL, 'right'),
('Daily Activity at Noma', 'assets/images/DIT08283.jpg', 1, NULL, 'right'),
('Human Touch Brand', 'assets/images/DIT08293.jpg', 2, NULL, 'left'),
('Human Touch Brand', 'assets/images/DIT08305.jpg', 2, NULL, 'left'),
('Human Touch Brand', 'assets/images/DIT08316.jpg', 2, NULL, 'left'),
('Human Touch Brand', 'assets/images/DIT08319.jpg', 2, NULL, 'left'),
('Human Touch Brand', 'assets/images/DIT08339.jpg', 2, NULL, 'left'),
('Take A Break With Noma', 'assets/images/DIT08004.jpg', 3, NULL, 'right'),
('Take A Break With Noma', 'assets/images/DIT01161.jpg', 3, NULL, 'right');
