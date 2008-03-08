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

    require_once('includes/prepend.inc.php');
    require_once('includes/narro/narro_progress_bar.class.php');

    class NarroProjectListForm extends QForm {
        protected $dtgNarroProject;

        // DataGrid Columns
        protected $colProjectName;
        protected $colPercentTranslated;
        protected $colActions;


        protected function Form_Create() {
            // Setup DataGrid Columns
            $this->colProjectName = new QDataGridColumn(QApplication::Translate('Project name'), '<?= $_FORM->dtgNarroProject_ProjectNameColumn_Render($_ITEM) ?>', array('OrderByClause' => QQ::OrderBy(QQN::NarroProject()->ProjectName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::NarroProject()->ProjectName, false)));
            $this->colProjectName->HtmlEntities = false;

            $this->colPercentTranslated = new QDataGridColumn(QApplication::Translate('Progress'), '<?= $_FORM->dtgNarroProject_PercentTranslated_Render($_ITEM) ?>');
            $this->colPercentTranslated->HtmlEntities = false;
            $this->colPercentTranslated->Width = 160;

            $this->colActions = new QDataGridColumn(QApplication::Translate('Actions'), '<?= $_FORM->dtgNarroProject_Actions_Render($_ITEM) ?>');
            $this->colActions->HtmlEntities = false;
            $this->colActions->Width = 160;

            // Setup DataGrid
            $this->dtgNarroProject = new QDataGrid($this);

            // Datagrid Paginator
            $this->dtgNarroProject->Paginator = new QPaginator($this->dtgNarroProject);
            $this->dtgNarroProject->ItemsPerPage = 20;

            // Specify Whether or Not to Refresh using Ajax
            $this->dtgNarroProject->UseAjax = false;

            // Specify the local databind method this datagrid will use
            $this->dtgNarroProject->SetDataBinder('dtgNarroProject_Bind');

            $this->dtgNarroProject->AddColumn($this->colProjectName);
            $this->dtgNarroProject->AddColumn($this->colPercentTranslated);

            if (QApplication::$objUser->hasPermission('Can import') || QApplication::$objUser->hasPermission('Can export') ) {
                $this->dtgNarroProject->AddColumn($this->colActions);
            }

        }

        public function dtgNarroProject_PercentTranslated_Render(NarroProject $objNarroProject) {
            $sOutput = '';

            $objDatabase = QApplication::$Database[1];

            $strQuery = sprintf('SELECT COUNT(c.context_id) AS cnt FROM `narro_text_context` c WHERE c.project_id=%d AND c.active=1', $objNarroProject->ProjectId);

            // Perform the Query
            $objDbResult = $objDatabase->Query($strQuery);

            if ($objDbResult) {
                $mixRow = $objDbResult->FetchArray();
                $intTotalTexts = $mixRow['cnt'];

                $strQuery = sprintf('SELECT COUNT(c.context_id) AS cnt FROM `narro_text_context` c WHERE c.project_id = %d AND c.valid_suggestion_id IS NULL AND c.has_suggestion=1 AND c.active=1', $objNarroProject->ProjectId);

                // Perform the Query
                $objDbResult = $objDatabase->Query($strQuery);

                if ($objDbResult) {
                    $mixRow = $objDbResult->FetchArray();
                    $intTranslatedTexts = $mixRow['cnt'];
                }

                $strQuery = sprintf('SELECT COUNT(c.context_id) AS cnt FROM `narro_text_context` c WHERE c.project_id = %d AND c.valid_suggestion_id IS NOT NULL AND c.active=1', $objNarroProject->ProjectId);
                // Perform the Query
                $objDbResult = $objDatabase->Query($strQuery);

                if ($objDbResult) {
                    $mixRow = $objDbResult->FetchArray();
                    $intValidatedTexts = $mixRow['cnt'];
                }

                $objProgressBar = $this->GetControl('progressbar' . $objNarroProject->ProjectId);
                if (!$objProgressBar instanceof NarroTranslationProgressBar)
                    $objProgressBar = new NarroTranslationProgressBar($this->dtgNarroProject, 'progressbar' . $objNarroProject->ProjectId);
                $objProgressBar->Total = $intTotalTexts;
                $objProgressBar->Translated = $intValidatedTexts;
                $objProgressBar->Fuzzy = $intTranslatedTexts;

                $sOutput .= $objProgressBar->Render(false);
            }
            return $sOutput;

        }

        public function dtgNarroProject_ProjectNameColumn_Render(NarroProject $objNarroProject) {
            return sprintf('<a href="narro_text_context_suggest.php?p=%s&tf=2&st=1&s=">%s</a>',
                $objNarroProject->ProjectId,
                $objNarroProject->ProjectName
            );
        }

        public function dtgNarroProject_Actions_Render(NarroProject $objNarroProject) {
            $strOutput = '';
            if (QApplication::$objUser->hasPermission('Can import')) {
                $strOutput .= sprintf(' <a href="narro_project_import.php?p=%d&pn=%s">%s</a>', $objNarroProject->ProjectId, $objNarroProject->ProjectName, QApplication::Translate('Import'));
            }

            if (QApplication::$objUser->hasPermission('Can export')) {
                $strOutput .= sprintf(' <a href="narro_project_export.php?p=%d&pn=%s">%s</a>', $objNarroProject->ProjectId, $objNarroProject->ProjectName, QApplication::Translate('Export'));
            }

            return $strOutput;
        }

        protected function dtgNarroProject_Bind() {
            // Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

            // Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
            $this->dtgNarroProject->TotalItemCount = NarroProject::CountAll();

            // Setup the $objClauses Array
            $objClauses = array();

            // If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
            // the OrderByClause to the $objClauses array
            if ($objClause = $this->dtgNarroProject->OrderByClause)
                array_push($objClauses, $objClause);

            // Add the LimitClause information, as well
            if ($objClause = $this->dtgNarroProject->LimitClause)
                array_push($objClauses, $objClause);

            // Set the DataSource to be the array of all NarroProject objects, given the clauses above
            $this->dtgNarroProject->DataSource = NarroProject::LoadAll($objClauses);
        }

    }

    NarroProjectListForm::Run('NarroProjectListForm', 'templates/narro_project_list.tpl.php');
?>