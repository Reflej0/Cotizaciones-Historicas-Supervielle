USE `cotizacion_supervielle`;
DELIMITER $$
CREATE TRIGGER `default_date` BEFORE INSERT ON `cotizaciones` FOR EACH ROW
set new.fecha=curdate();
$$
delimiter ;