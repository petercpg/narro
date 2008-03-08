<?php
/**
 * Narro is an application that allows online software translation and maintenance.
 * Copyright (C) 2008 Alexandru Szasz <alexxed@gmail.com>
 * http://code.google.com/p/narro/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write to the
 * Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php _p(QApplication::$EncodingType); ?>" />
        <?php if (isset($strPageTitle)) { ?>
            <title><?php _p($strPageTitle); ?></title>
        <?php } ?>
        <link rel="stylesheet" type="text/css" href="<?php _p(__VIRTUAL_DIRECTORY__ . __CSS_ASSETS__); ?>/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php _p(__VIRTUAL_DIRECTORY__ . __CSS_ASSETS__); ?>/font-<?php echo QApplication::$objUser->getPreferenceValueByName('Font size') ?>.css" />
    </head>
    <body>
        <div id="header">
            <?php if (QApplication::$objUser->UserId > 0) {
                echo
                    sprintf(
                        QApplication::Translate('<i>Logged in as <a href="%s" style="color:green;font-weight:bold">%s</span></i>'),
                        'narro_user_profile.php',
                        QApplication::$objUser->Username
                    ) . ' | ';
            } else { ?>
                <a href="narro_register.php"><?php _t('Register') ?></a> |
                <a href="narro_login.php"><?php _t('Login') ?></a> |
            <?php } ?>
            <a href="narro_user_preferences.php"><?php _t('Preferences') ?></a> |
            <a href="narro_project_list.php"><?php _t('Project list') ?></a>
            <?php if (QApplication::$objUser->hasPermission('Can manage users')) { ?>
            | <a href="narro_user_list.php"><?php _t('Manage users') ?></a>
            <?php } ?>
            <?php if (QApplication::$objUser->UserId > 0) { ?>
                | <a href="narro_logout.php"><?php _t('Logout') ?></a>
            <?php } ?>

        </div>
        <div id="main">