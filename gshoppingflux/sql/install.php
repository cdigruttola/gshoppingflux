<?php
/**
 * Copyright since 2007 Carmine Di Gruttola
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    cdigruttola <c.digruttola@hotmail.it>
 * @copyright Copyright since 2007 Carmine Di Gruttola
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

$sql = [];

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gshoppingflux` (
				`id_gcategory` INT(11) UNSIGNED NOT NULL,
				`export` INT(11) UNSIGNED NOT NULL,
				`condition` VARCHAR( 12 ) NOT NULL,
				`availability` VARCHAR( 12 ) NOT NULL,
				`gender` VARCHAR( 8 ) NOT NULL,
				`age_group` VARCHAR( 8 ) NOT NULL,
				`color` VARCHAR( 64 ) NOT NULL,
				`material` VARCHAR( 64 ) NOT NULL,
				`pattern` VARCHAR( 64 ) NOT NULL,
				`size` VARCHAR( 64 ) NOT NULL,
				`id_shop` INT(11) UNSIGNED NOT NULL,
		  	INDEX (`id_gcategory`, `id_shop`)
		  	) ENGINE = ' . _MYSQL_ENGINE_ . ' CHARACTER SET utf8 COLLATE utf8_general_ci;';
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gshoppingflux_lc` (
					`id_glang` INT(11) UNSIGNED NOT NULL,
					`id_currency` VARCHAR(255) NOT NULL,
					`tax_included` TINYINT(1) NOT NULL,
					`id_shop` INT(11) UNSIGNED NOT NULL,
			  INDEX (`id_glang`, `id_shop`)
			) ENGINE = ' . _MYSQL_ENGINE_ . ' CHARACTER SET utf8 COLLATE utf8_general_ci;';
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'gshoppingflux_lang` (
					`id_gcategory` INT(11) UNSIGNED NOT NULL,
					`id_lang` INT(11) UNSIGNED NOT NULL,
					`id_shop` INT(11) UNSIGNED NOT NULL,
					`gcategory` VARCHAR( 255 ) NOT NULL,
			  INDEX (`id_gcategory`, `id_lang`, `id_shop`)
			) ENGINE = ' . _MYSQL_ENGINE_ . ' CHARACTER SET utf8 COLLATE utf8_general_ci;';
foreach ($sql as $query) {
    if (!Db::getInstance()->execute($query)) {
        return false;
    }
}

return true;
