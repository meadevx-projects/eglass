ALTER TABLE `settingsconfig` ADD `sc_glass_lat` VARCHAR( 20 ) NULL AFTER `sc_site_title` ,
ADD `sc_glass_long` VARCHAR( 20 ) NULL AFTER `sc_glass_lat` ;

UPDATE `eglass`.`settingsconfig` SET `sc_glass_lat` = '41.850033',
`sc_glass_long` = '-87.6500523' WHERE `settingsconfig`.`sc_id` =1;