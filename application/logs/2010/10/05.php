<?php defined('SYSPATH') or die('No direct script access.'); ?>

2010-10-05 09:45:28 --- ERROR: Datei konnte nicht geladen werden, 
2010-10-05 09:51:52 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'page' in 'where clause' [ SELECT COUNT(*) AS `records_found` FROM `campaigns` WHERE `page` = '3' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 178 ]
2010-10-05 10:19:28 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH/views/theme/default/campaigns/list.php [ 67 ]
2010-10-05 10:22:47 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH/views/theme/default/campaigns/list.php [ 70 ]
2010-10-05 10:29:54 --- ERROR: Kohana_Exception [ 0 ]: Die Operation 'edit' ist in diesem Kontext leider nicht erlaubt! ~ APPPATH/classes/controller/main.php [ 129 ]