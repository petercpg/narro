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

    $strPageTitle = sprintf(QApplication::Translate('Texts from the project "%s"'), $this->objNarroProject->ProjectName);

    require('includes/header.inc.php')
?>

    <?php $this->RenderBegin() ?>
        <div>
        <?php echo
        '<a href="narro_project_list.php">'.QApplication::Translate('Projects').'</a>' .
        ' -> <a href="narro_project_text_list.php?p=' . $this->objNarroProject->ProjectId . '">' . $this->objNarroProject->ProjectName.'</a>' .
        ' -> <a href="narro_project_file_list.php?p=' . $this->objNarroProject->ProjectId . '">'.QApplication::Translate('Files').'</a>';
        ?>
        </div>
        <br />
        <?php $this->lblMessage->Render(); ?>
        <br />
        <div style="text-align:right">
            <?php _t('Show') ?>: <?php $this->lstTextFilter->Render() ?>
            &nbsp;&nbsp;&nbsp;
            <?php _t('Search') ?>: <?php $this->txtSearch->Render();?>&nbsp;
            <?php $this->lstSearchType->Render();?>&nbsp;
            <?php $this->btnSearch->Render(); ?>
        </div>
        <br />
        <?php $this->dtgNarroTextContext->Render() ?>
        <?php QApplication::ExecuteJavaScript("if (location.hash) qc.pA('NarroProjectTextListForm', '" . $this->dtgNarroTextContext->Paginator->ControlId . "', 'QClickEvent', location.hash.replace('#', ''), '');"); ?>
    <?php $this->RenderEnd() ?>

<?php require('includes/footer.inc.php'); ?>