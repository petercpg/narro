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
    $strPageTitle = t('Recover password');
?>
    <p><?php echo t('If you remember your username or email address, we can send you a link at the email address you registered with to change your password.'); ?></p>
    <br />
    <?php $_CONTROL->lblMessage->Render() ?>
    <table>
        <tr>
            <td><?php echo t('Username')?>:</td>
            <td><?php $_CONTROL->txtUsername->Render() ?></td>
        </tr>
        <tr>
            <td><?php echo t('Email')?>:</td>
            <td><?php $_CONTROL->txtEmail->Render() ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:right"><?php $_CONTROL->btnRecoverPassword->Render() ?></td>
        </tr>
    </table>