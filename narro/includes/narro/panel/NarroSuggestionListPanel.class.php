<?php
    /**
     * Narro is an application that allows online software translation and maintenance.
     * Copyright (C) 2008-2010 Alexandru Szasz <alexxed@gmail.com>
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

    class NarroSuggestionListPanel extends QPanel {
        // General Panel Variables
        protected $objNarroContextInfo;

        public $lblMessage;

        protected $dtgSuggestions;

        protected $colSuggestion;
        protected $colAuthor;
        protected $colVote;
        protected $colActions;

        protected $txtAccessKey;
        protected $btnSaveAccessKey;
        protected $blnShowOtherLanguages;

        protected $intEditSuggestionId;

        public function __construct($objParentObject, $strControlId = null) {
            // Call the Parent
            try {
                parent::__construct($objParentObject, $strControlId);
            } catch (QCallerException $objExc) {
                $objExc->IncrementOffset();
                throw $objExc;
            }

            $this->lblMessage_Create();
            $this->txtAccessKey_Create();
            $this->btnSaveAccessKey_Create();

            // Setup DataGrid Columns
            $this->colSuggestion = new QDataGridColumn(t('Translation'), '<?= $_CONTROL->ParentControl->dtgSuggestions_colSuggestion_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::NarroSuggestion()->SuggestionValue), 'ReverseOrderByClause' => QQ::OrderBy(QQN::NarroSuggestion()->SuggestionValue, false)));
            $this->colSuggestion->HtmlEntities = false;
            $this->colSuggestion->CssClass = QApplication::$Language->TextDirection;
            $this->colSuggestion->Width = '100%';

            $this->colAuthor = new QDataGridColumn(t('Author'), '<?= $_CONTROL->ParentControl->dtgSuggestions_colAuthor_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::NarroSuggestion()->UserId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::NarroSuggestion()->UserId, false)));
            $this->colAuthor->HtmlEntities = false;
            $this->colAuthor->Wrap = false;

            $this->colVote = new QDataGridColumn(t('Votes'), '<?= $_CONTROL->ParentControl->dtgSuggestions_colVote_Render($_ITEM); ?>');
            $this->colVote->HtmlEntities = false;
            $this->colVote->Wrap = false;

            $this->colActions = new QDataGridColumn(t('Actions'), '<?= $_CONTROL->ParentControl->dtgSuggestions_colActions_Render($_ITEM); ?>');
            $this->colActions->HtmlEntities = false;
            $this->colActions->Wrap = false;

            // Setup DataGrid
            $this->dtgSuggestions = new NarroDataGrid($this);
            $this->dtgSuggestions->ShowHeader = true;
            $this->dtgSuggestions->AlwaysShowPaginator = true;
            $this->dtgSuggestions->Title = t('Translations for this text');

            // Datagrid Paginator
            $this->dtgSuggestions->Paginator = new QPaginator($this->dtgSuggestions);
            $this->dtgSuggestions->ItemsPerPage = round(QApplication::$User->getPreferenceValueByName('Items per page')/2);

            $this->dtgSuggestions->PaginatorAlternate = new QPaginator($this->dtgSuggestions);

            // Specify Whether or Not to Refresh using Ajax
            $this->dtgSuggestions->UseAjax = true;

            // Specify the local databind method this datagrid will use
            $this->dtgSuggestions->SetDataBinder('dtgSuggestions_Bind', $this);

            $this->dtgSuggestions->AddColumn($this->colSuggestion);
            $this->dtgSuggestions->AddColumn($this->colAuthor);
            $this->dtgSuggestions->AddColumn($this->colVote);
            $this->dtgSuggestions->AddColumn($this->colActions);
        }

        private function txtAccessKey_Create() {
            $this->txtAccessKey = new QTextBox($this);
            $this->txtAccessKey->MaxLength = 1;
            $this->txtAccessKey->MinLength = 1;
            $this->txtAccessKey->Columns = 1;
        }

        private function btnSaveAccessKey_Create() {
            $this->btnSaveAccessKey = new QButton($this);
            $this->btnSaveAccessKey->Text = t('Save');
            $this->btnSaveAccessKey->ActionParameter = $this->txtAccessKey->ControlId;
            if (QApplication::$UseAjax)
                $this->btnSaveAccessKey->AddAction(new QClickEvent(), new QAjaxControlAction($this->ParentControl, 'btnSaveAccessKey_Click'));
            else
                $this->btnSaveAccessKey->AddAction(new QClickEvent(), new QServerControlAction($this->ParentControl, 'btnSaveAccessKey_Click')
            );
        }

        private function lblMessage_Create() {
            $this->lblMessage = new QLabel($this);
            $this->lblMessage->ForeColor = 'green';
            $this->lblMessage->HtmlEntities = false;
            $this->lblMessage->DisplayStyle = QDisplayStyle::Block;
        }

        public function GetControlHtml() {
            $this->strText = '';
            if ($this->objNarroContextInfo->ValidSuggestionId) {
                $strControlId = 'btnEditSuggestion';
                $btnEdit = $this->objForm->GetControl($strControlId);
                if (!$btnEdit) {
                    $btnEdit = new QButton($this, $strControlId);
                    $btnEdit->SetCustomStyle('float', 'right');
                    $btnEdit->Text = t('Copy');
                    if (QApplication::$UseAjax)
                        $btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
                    else
                        $btnEdit->AddAction(new QClickEvent(), new QServerControlAction($this, 'btnEdit_Click'));
                }

                $btnEdit->ActionParameter = $this->objNarroContextInfo->ValidSuggestionId;

                $strControlId = 'btnVoteValidSuggestion';

                $btnVote = $this->objForm->GetControl($strControlId);
                if (!$btnVote) {
                    $btnVote = new QButton($this, $strControlId);
                    $btnVote->Text = t('Vote');
                    $btnVote->Display = QApplication::HasPermissionForThisLang('Can vote', $this->objNarroContextInfo->Context->ProjectId);
                    $btnVote->SetCustomStyle('float', 'right');
                    if (QApplication::$UseAjax)
                        $btnVote->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnVote_Click'));
                    else
                        $btnVote->AddAction(new QClickEvent(), new QServerControlAction($this, 'btnVote_Click')
                    );


                }

                $btnVote->ActionParameter = $this->objNarroContextInfo->ValidSuggestionId;

                $strControlId = 'btnCancelApproval';

                $btnApprove = $this->objForm->GetControl($strControlId);
                if (!$btnApprove) {
                    $btnApprove = new QButton($this, $strControlId);
                    $btnApprove->SetCustomStyle('float', 'right');
                    $btnApprove->AddAction(new QClickEvent(), new QJavaScriptAction(sprintf('this.disabled=\'disabled\'')));
                    if (QApplication::$UseAjax)
                        $btnApprove->AddAction(new QClickEvent(), new QAjaxControlAction($this->ParentControl, 'btnApprove_Click'));
                    else
                        $btnApprove->AddAction(new QClickEvent(), new QServerControlAction($this->ParentControl, 'btnApprove_Click')
                    );
                }

                $btnApprove->Text = t('Disapprove');

                $btnApprove->ActionParameter = $this->objNarroContextInfo->ValidSuggestionId;

                $this->strText .= sprintf('<br /><div style="color:gray;float:right;">%s, %s %s</div>%s<div class="green3dbg" style="border:1px dotted #DDDDDD;padding: 5px"><div style="float:right;">%s%s%s</div>%s</div>',
                    sprintf(($this->objNarroContextInfo->ValidSuggestion->IsImported)?'%s':t('translated by %s'), $this->dtgSuggestions_colAuthor_Render($this->objNarroContextInfo->ValidSuggestion)),
                    $this->dtgSuggestions_colVote_Render($this->objNarroContextInfo->ValidSuggestion),
                    t('votes'),
                    t('Approved translation') . ':',
                    $btnEdit->Render(false),
                    $btnVote->Render(false),
                    ((QApplication::HasPermissionForThisLang('Can approve', $this->objNarroContextInfo->Context->ProjectId))?$btnApprove->Render(false):'' ),
                    $this->dtgSuggestions_colSuggestion_Render($this->objNarroContextInfo->ValidSuggestion)
                );

                if ($this->objNarroContextInfo->TextAccessKey && QApplication::HasPermissionForThisLang('Can approve', $this->objNarroContextInfo->Context->ProjectId)) {
                    $this->txtAccessKey->Text = $this->objNarroContextInfo->SuggestionAccessKey;
                    $this->strText .= sprintf('<br />%s<div class="green3dbg" style="border:1px dotted #DDDDDD;padding: 5px"><div style="float:right;">%s</div>%s</div>',
                        t('Access key') . ':',
                        $this->btnSaveAccessKey->Render(false),
                        $this->txtAccessKey->Render(false)
                    );
                }
            }

            $this->dtgSuggestions->Visible = true;

            if ($this->dtgSuggestions->TotalItemCount == 0 && !$this->objNarroContextInfo->ValidSuggestionId) {
                $this->dtgSuggestions->Visible = false;
            }
            elseif ($this->dtgSuggestions->TotalItemCount == 0 && $this->objNarroContextInfo->ValidSuggestionId) {
                $this->dtgSuggestions->Visible = false;
            }

            $this->strText .= (($this->dtgSuggestions->Visible)?'<br />':'') .
                $this->dtgSuggestions->Render(false) .
                $this->lblMessage->Render(false);

            return parent::GetControlHtml();
        }

        public function dtgSuggestions_colProject_Render(NarroSuggestion $objNarroSuggestion) {
            if ($strProjectName = $this->objNarroContextInfo->Context->File->Project->ProjectName)
                return NarroLink::ProjectFileList($this->objNarroContextInfo->Context->ProjectId, null, null, $strProjectName);
        }


        public function dtgSuggestions_colSuggestion_Render(NarroSuggestion $objNarroSuggestion) {

            $strSuggestionValue = QApplication::$PluginHandler->DisplaySuggestion($objNarroSuggestion->SuggestionValue);
            if (!$strSuggestionValue)
                $strSuggestionValue = $objNarroSuggestion->SuggestionValue;

            $strSuggestionValue = NarroString::ShowLeadingAndTrailingSpaces(NarroString::HtmlEntities($strSuggestionValue));

            if ($objNarroSuggestion->SuggestionId == $this->objNarroContextInfo->ValidSuggestionId && $this->objNarroContextInfo->TextAccessKey && QApplication::HasPermissionForThisLang('Can approve', $this->objNarroContextInfo->Context->ProjectId)) {
                if ($this->objNarroContextInfo->SuggestionAccessKey != '') {
                    $intAccPos = mb_strpos($strSuggestionValue, $this->objNarroContextInfo->SuggestionAccessKey);

                    if (QApplication::$Language->TextDirection == 'rtl' && $intAccPos == 0)
                        $strDirControlChar = "\xE2\x80\x8E"; //ltr = \xE2\x80\x8F"
                    else
                        $strDirControlChar = '';

                    if ($this->objNarroContextInfo->SuggestionAccessKey && mb_stristr($strSuggestionValue, $this->objNarroContextInfo->SuggestionAccessKey))
                        $strSuggestionValue = mb_substr($strSuggestionValue, 0, $intAccPos) . $strDirControlChar . '<u>' . mb_substr($strSuggestionValue, $intAccPos, 1) . '</u>' . mb_substr($strSuggestionValue, $intAccPos + 1);
                    else
                        $strSuggestionValue .= sprintf(' (%s)', $this->objNarroContextInfo->SuggestionAccessKey);
                }
            }

            if ($objNarroSuggestion->SuggestionId == $this->objNarroContextInfo->ValidSuggestionId)
                $strCellValue = '<b>' . $strSuggestionValue . '</b>';
            else
                $strCellValue = $strSuggestionValue;

            if
            (
                QApplication::$User->hasPermission(
                    'Can suggest',
                    $this->objNarroContextInfo->Context->ProjectId,
                    QApplication::GetLanguageId()
                )
                &&
                $this->intEditSuggestionId == $objNarroSuggestion->SuggestionId
            ) {
                $strControlId = 'txtEditSuggestion' . $objNarroSuggestion->SuggestionId;
                $txtEditSuggestion = $this->objForm->GetControl($strControlId);
                if (!$txtEditSuggestion) {
                    $txtEditSuggestion = new QTextBox($this->dtgSuggestions, $strControlId);
                    $txtEditSuggestion->CssClass = QApplication::$Language->TextDirection . ' green3dbg';
                    $txtEditSuggestion->Width = '100%';
                    $txtEditSuggestion->Height = 85;
                    $txtEditSuggestion->Required = true;
                    $txtEditSuggestion->TextMode = QTextMode::MultiLine;
                    $txtEditSuggestion->CrossScripting = QCrossScripting::Allow;
                    $txtEditSuggestion->Text = $objNarroSuggestion->SuggestionValue;
                }
                $strCellValue = $txtEditSuggestion->Render(false);

            }

            if ($this->blnShowOtherLanguages)
                return '<div style="color:gray;font-size:70%">' . t($objNarroSuggestion->Language->LanguageName) . '</div>' . $strCellValue;
            else
                return $strCellValue;

        }

        public function dtgSuggestions_colComment_Render(NarroSuggestion $objNarroSuggestion) {
            $arrComments = NarroSuggestionComment::LoadArrayBySuggestionId($objNarroSuggestion->SuggestionId);
            if (count($arrComments)) {
            foreach($arrComments as $objComment) {
                $arrCommentTexts[] = $objComment->CommentText;
            }
            return join('<hr />', $arrCommentTexts);
            }
            else
                return '';
        }

        public function dtgSuggestions_colVote_Render(NarroSuggestion $objNarroSuggestion) {
            $intVoteCount = NarroSuggestionVote::QueryCount(QQ::AndCondition(QQ::Equal(QQN::NarroSuggestionVote()->ContextId, $this->objNarroContextInfo->ContextId), QQ::Equal(QQN::NarroSuggestionVote()->SuggestionId, $objNarroSuggestion->SuggestionId)));
            return $intVoteCount;
        }

        public function dtgSuggestions_colAuthor_Render( NarroSuggestion $objNarroSuggestion ) {
            $objDateSpan = new QDateTimeSpan(time() - strtotime($objNarroSuggestion->Created));
            $strModifiedWhen = $objDateSpan->SimpleDisplay();

            if (strtotime($objNarroSuggestion->Modified) > 0 && $strModifiedWhen && $objNarroSuggestion->User->Username)
                $strAuthorInfo = sprintf(
                    ($objNarroSuggestion->IsImported)?t('imported by %s, %s ago'):t('%s, %s ago'),
                    NarroLink::UserProfile($objNarroSuggestion->User->UserId, $objNarroSuggestion->User->Username),
                    $strModifiedWhen
                );
            elseif (strtotime($objNarroSuggestion->Modified) > 0 && $strModifiedWhen && !$objNarroSuggestion->User->Username)
                $strAuthorInfo = sprintf(t('%s ago'), $strModifiedWhen);
            elseif ($objNarroSuggestion->User->Username)
                $strAuthorInfo = sprintf(($objNarroSuggestion->IsImported)?t('imported by %s'):'%s', NarroLink::UserProfile($objNarroSuggestion->User->UserId, $objNarroSuggestion->User->Username));
            else
                $strAuthorInfo = t('Unknown');

            if ($objNarroSuggestion->SuggestionId == $this->objNarroContextInfo->ValidSuggestionId && $this->objNarroContextInfo->ValidatorUserId != NarroUser::ANONYMOUS_USER_ID) {
                $objDateSpan = new QDateTimeSpan(time() - strtotime($this->objNarroContextInfo->Modified));
                $strModifiedWhen = $objDateSpan->SimpleDisplay();
                $strAuthorInfo .= ', ' . sprintf(sprintf(t('approved by %s'), NarroLink::UserProfile($this->objNarroContextInfo->ValidatorUser->UserId, $this->objNarroContextInfo->ValidatorUser->Username) . ' %s'), (($objDateSpan->SimpleDisplay())?sprintf(t('%s ago'), $objDateSpan->SimpleDisplay()):''));
            }

            if
            (
                QApplication::$User->hasPermission(
                    'Can suggest',
                    $this->objNarroContextInfo->Context->ProjectId,
                    QApplication::GetLanguageId()
                )
                &&
                $this->intEditSuggestionId == $objNarroSuggestion->SuggestionId
                &&
                $objNarroSuggestion->UserId != QApplication::GetUserId()
            ) {
                $strControlId = 'lstEditSuggestion' . $objNarroSuggestion->SuggestionId;
                $lstEditSuggestion = $this->objForm->GetControl($strControlId);
                if (!$lstEditSuggestion) {
                    $lstEditSuggestion = new QListBox($this->dtgSuggestions, $strControlId);
                    $lstEditSuggestion->AddItem(strip_tags($strAuthorInfo), $objNarroSuggestion->UserId);
                    $lstEditSuggestion->AddItem(QApplication::$User->Username, QApplication::GetUserId());
                }
                return $lstEditSuggestion->Render(false);
            }
            else
                return $strAuthorInfo;
        }


        public function dtgSuggestions_colActions_Render(NarroSuggestion $objNarroSuggestion) {

            $strControlId = 'btnEditSuggestion' . $objNarroSuggestion->SuggestionId;
            $btnEdit = $this->objForm->GetControl($strControlId);
            if (!$btnEdit) {
                $btnEdit = new QButton($this->dtgSuggestions, $strControlId);
                if (QApplication::$UseAjax)
                    $btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
                else
                    $btnEdit->AddAction(new QClickEvent(), new QServerControlAction($this, 'btnEdit_Click'));
            }

            $blnCanEdit = QApplication::$User->hasPermission(
                                'Can edit any suggestion',
                                $this->objNarroContextInfo->Context->ProjectId,
                                QApplication::GetLanguageId()
                          )
                          ||
                          (
                                $objNarroSuggestion->UserId == QApplication::GetUserId()
                                &&
                                QApplication::GetUserId() != NarroUser::ANONYMOUS_USER_ID
                          );

            if ($blnCanEdit) {
                $strControlId = 'btnSaveIgnoreSuggestion' . $objNarroSuggestion->SuggestionId;
                $btnSaveIgnoreSuggestion = $this->objForm->GetControl($strControlId);
                if (!$btnSaveIgnoreSuggestion) {
                    $btnSaveIgnoreSuggestion = new QButton($this->dtgSuggestions, $strControlId);
                    $btnSaveIgnoreSuggestion->Text = t('Ignore and save');
                    $btnSaveIgnoreSuggestion->Visible = false;
                    $btnSaveIgnoreSuggestion->AddAction(new QClickEvent(), new QJavaScriptAction(sprintf('this.disabled=\'disabled\'')));
                    if (QApplication::$UseAjax)
                        $btnSaveIgnoreSuggestion->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
                    else
                        $btnSaveIgnoreSuggestion->AddAction(new QClickEvent(), new QServerControlAction($this, 'btnEdit_Click'));
                }
                $btnSaveIgnoreSuggestion->ActionParameter = $objNarroSuggestion->SuggestionId;

                $strControlId = 'btnCancelEditSuggestion' . $objNarroSuggestion->SuggestionId;
                $btnCancelEditSuggestion = $this->objForm->GetControl($strControlId);
                if (!$btnCancelEditSuggestion) {
                    $btnCancelEditSuggestion = new QButton($this->dtgSuggestions, $strControlId);
                    $btnCancelEditSuggestion->Text = t('Cancel');
                    if (QApplication::$UseAjax)
                        $btnCancelEditSuggestion->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancelEditSuggestion_Click'));
                    else
                        $btnCancelEditSuggestion->AddAction(new QClickEvent(), new QServerControlAction($this, 'btnCancelEditSuggestion_Click'));
                }
                $btnCancelEditSuggestion->Visible = ($objNarroSuggestion->SuggestionId == $this->intEditSuggestionId);
                $btnCancelEditSuggestion->ActionParameter = $objNarroSuggestion->SuggestionId;
            }

            if ($objNarroSuggestion->SuggestionId != $this->intEditSuggestionId)
                $btnEdit->Text = ($blnCanEdit)?t('Edit'):t('Copy');

            $btnEdit->ActionParameter = $objNarroSuggestion->SuggestionId;

            $strControlId = 'btnDelete' . $objNarroSuggestion->SuggestionId;

            $btnDelete = $this->objForm->GetControl($strControlId);
            if (!$btnDelete) {
                $btnDelete = new QButton($this->dtgSuggestions, $strControlId);
                $btnDelete->Text = t('Delete');
                $btnDelete->AddAction(new QClickEvent(), new QJavaScriptAction(sprintf('this.disabled=\'disabled\'')));
                $btnDelete->AddAction(new QClickEvent(), new QConfirmAction(t('Are you sure you want to delete this suggestion?')));
                if (QApplication::$UseAjax)
                    $btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
                else
                    $btnDelete->AddAction(new QClickEvent(), new QServerControlAction($this, 'btnDelete_Click')
                );

            }

            $btnDelete->ActionParameter = $objNarroSuggestion->SuggestionId;

            $strControlId = 'btnVote' . $objNarroSuggestion->SuggestionId;

            $btnVote = $this->objForm->GetControl($strControlId);
            if (!$btnVote) {
                $btnVote = new QButton($this->dtgSuggestions, $strControlId);
                $btnVote->Display = QApplication::HasPermissionForThisLang('Can vote', $this->objNarroContextInfo->Context->ProjectId);
                $btnVote->Text = t('Vote');
                $btnVote->AddAction(new QClickEvent(), new QJavaScriptAction(sprintf('this.disabled=\'disabled\'')));
                if (QApplication::$UseAjax)
                    $btnVote->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnVote_Click'));
                else
                    $btnVote->AddAction(new QClickEvent(), new QServerControlAction($this, 'btnVote_Click')
                );

            }

            $btnVote->Enabled = ($objNarroSuggestion->UserId <> QApplication::GetUserId());
            $btnVote->ActionParameter = $objNarroSuggestion->SuggestionId;

            $strControlId = 'btnApprove' . $objNarroSuggestion->SuggestionId;

            $btnApprove = $this->objForm->GetControl($strControlId);
            if (!$btnApprove) {
                $btnApprove = new QButton($this->dtgSuggestions, $strControlId);
                $btnApprove->AddAction(new QClickEvent(), new QJavaScriptAction(sprintf('this.disabled=\'disabled\'')));
                if (QApplication::$UseAjax)
                    $btnApprove->AddAction(new QClickEvent(), new QAjaxControlAction($this->ParentControl, 'btnApprove_Click'));
                else
                    $btnApprove->AddAction(new QClickEvent(), new QServerControlAction($this->ParentControl, 'btnApprove_Click')
                );
            }

            $btnApprove->Text = ($objNarroSuggestion->SuggestionId == $this->intEditSuggestionId)?t('Save and approve'):t('Approve');

            $btnApprove->ActionParameter = $objNarroSuggestion->SuggestionId;

            $strText = '';

            if (QApplication::GetLanguageId() == $objNarroSuggestion->LanguageId) {
                if (QApplication::HasPermissionForThisLang('Can approve', $this->objNarroContextInfo->Context->ProjectId))
                    $strText .= '&nbsp;' . $btnApprove->Render(false);

                if (QApplication::HasPermissionForThisLang('Can vote', $this->objNarroContextInfo->Context->ProjectId))
                    $strText .= '&nbsp;' . $btnVote->Render(false);

                if (QApplication::HasPermissionForThisLang('Can suggest', $this->objNarroContextInfo->Context->ProjectId) || ($objNarroSuggestion->UserId == QApplication::GetUserId() && QApplication::GetUserId() != NarroUser::ANONYMOUS_USER_ID )) {
                    $strText .= '&nbsp;' . $btnEdit->Render(false);
                    if ($blnCanEdit) $strText .= '&nbsp;' . $btnSaveIgnoreSuggestion->Render(false) . $btnCancelEditSuggestion->Render(false);
                }

                if (QApplication::HasPermissionForThisLang('Can delete any suggestion', $this->objNarroContextInfo->Context->ProjectId) || ($objNarroSuggestion->UserId == QApplication::GetUserId() && QApplication::GetUserId() != NarroUser::ANONYMOUS_USER_ID ))
                    $strText .= '&nbsp;' . $btnDelete->Render(false);

                return '<div style="float:right">' . $strText . '</div>';
            }
            else {
                return '';
            }
        }

        public function dtgSuggestions_Bind() {
            $objLangCondition = QQ::All();
            if (QApplication::$User->getPreferenceValueByName('Other languages')) {
                foreach(explode(' ', QApplication::$User->getPreferenceValueByName('Other languages')) as $strLangCode) {
                    $arrConditions[] = QQ::Equal(QQN::NarroSuggestion()->Language->LanguageCode, $strLangCode);
                }

                if (isset($arrConditions))
                    $objLangCondition = QQ::OrCondition($arrConditions);
            }

            // Get Total Count b/c of Pagination
            if ($this->blnShowOtherLanguages)
                $this->dtgSuggestions->TotalItemCount = NarroSuggestion::QueryCount(
                        QQ::AndCondition(
                            QQ::Equal(QQN::NarroSuggestion()->TextId, $this->objNarroContextInfo->Context->TextId),
                            QQ::NotEqual(QQN::NarroSuggestion()->SuggestionId, $this->objNarroContextInfo->ValidSuggestionId),
                            $objLangCondition
                        )
                );
            else
                $this->dtgSuggestions->TotalItemCount = NarroSuggestion::QueryCount(
                        QQ::AndCondition(
                            QQ::Equal(QQN::NarroSuggestion()->TextId, $this->objNarroContextInfo->Context->TextId),
                            QQ::Equal(QQN::NarroSuggestion()->LanguageId, QApplication::GetLanguageId()),
                            QQ::NotEqual(QQN::NarroSuggestion()->SuggestionId, $this->objNarroContextInfo->ValidSuggestionId)
                        )
                );

            $this->dtgSuggestions->ShowFooter = ($this->dtgSuggestions->TotalItemCount > $this->dtgSuggestions->ItemsPerPage);

            $objClauses = QQ::Clause(QQ::OrderBy(QQN::NarroSuggestion()->LanguageId));
            if ($objClause = $this->dtgSuggestions->OrderByClause)
                array_push($objClauses, $objClause);
            if ($objClause = $this->dtgSuggestions->LimitClause)
                array_push($objClauses, $objClause);

            if ($this->blnShowOtherLanguages)
                $this->dtgSuggestions->DataSource =
                    NarroSuggestion::QueryArray(
                            QQ::AndCondition(
                                QQ::Equal(QQN::NarroSuggestion()->TextId, $this->objNarroContextInfo->Context->TextId),
                                QQ::NotEqual(QQN::NarroSuggestion()->SuggestionId, $this->objNarroContextInfo->ValidSuggestionId),
                                $objLangCondition
                            ),
                            $objClauses
                    );
            else
                $this->dtgSuggestions->DataSource =
                    NarroSuggestion::QueryArray(
                        QQ::AndCondition(
                            QQ::Equal(QQN::NarroSuggestion()->TextId, $this->objNarroContextInfo->Context->TextId),
                            QQ::Equal(QQN::NarroSuggestion()->LanguageId, QApplication::GetLanguageId()),
                            QQ::NotEqual(QQN::NarroSuggestion()->SuggestionId, $this->objNarroContextInfo->ValidSuggestionId)
                        ),
                        $objClauses
                    );
            $this->blnModified = true;
            QApplication::ExecuteJavaScript('highlight_datagrid();');
        }

        // Control ServerActions
        public function btnDelete_Click($strFormId, $strControlId, $strParameter) {
            if (!$this->IsSuggestionUsed($strParameter)) {

                $objSuggestion = NarroSuggestion::Load($strParameter);

                QApplication::$PluginHandler->DeleteSuggestion($this->objNarroContextInfo->Context->Text->TextValue, $objSuggestion->SuggestionValue, $this->objNarroContextInfo->Context->Context, $this->objNarroContextInfo->Context->File, $this->objNarroContextInfo->Context->Project);

                if (!QApplication::HasPermissionForThisLang('Can delete any suggestion', $this->objNarroContextInfo->Context->ProjectId) && ($objSuggestion->UserId != QApplication::GetUserId() || QApplication::GetUserId() == NarroUser::ANONYMOUS_USER_ID ))
                  return false;

                $objSuggestion->Delete();

                if (NarroSuggestion::QueryCount(QQ::Equal(QQN::NarroSuggestion()->TextId, $this->objNarroContextInfo->Context->TextId)) == 0) {
                    $arrCtx = NarroContextInfo::QueryArray(QQ::Equal(QQN::NarroContextInfo()->Context->TextId, $this->objNarroContextInfo->Context->TextId));

                    foreach($arrCtx as $objContextInfo) {
                        $objContextInfo->HasSuggestions = 0;
                        $objContextInfo->Modified = QDateTime::Now();
                        $objContextInfo->Save();
                    }

                    $this->objNarroContextInfo->HasSuggestions = 0;
                }

                $this->lblMessage->Text = t('Suggestion succesfully deleted.');
                $this->blnModified = true;
            }

        }

        public function btnVote_Click($strFormId, $strControlId, $strParameter) {
            if (!QApplication::HasPermissionForThisLang('Can vote', $this->objNarroContextInfo->Context->ProjectId))
                return false;

            $objSuggestion = NarroSuggestion::Load($strParameter);
            if ($objSuggestion->UserId == QApplication::GetUserId())
                return false;

            QApplication::$PluginHandler->VoteSuggestion($this->objNarroContextInfo->Context->Text->TextValue, $objSuggestion->SuggestionValue, $this->objNarroContextInfo->Context->Context, $this->objNarroContextInfo->Context->File, $this->objNarroContextInfo->Context->Project);

            $arrSuggestion = NarroSuggestionVote::QueryArray(
                QQ::AndCondition(
                    QQ::Equal(QQN::NarroSuggestionVote()->ContextId, $this->objNarroContextInfo->ContextId),
                    QQ::Equal(QQN::NarroSuggestionVote()->UserId, QApplication::GetUserId())
                )
            );

            if (count($arrSuggestion)) {
                $objNarroSuggestionVote = $arrSuggestion[0];
                if ($objNarroSuggestionVote->SuggestionId == $strParameter)
                    return true;
                    $objNarroSuggestionVote->SuggestionId = $strParameter;
            }
            else {

                $objNarroSuggestionVote = new NarroSuggestionVote();
                $objNarroSuggestionVote->SuggestionId = $strParameter;
                $objNarroSuggestionVote->ContextId = $this->objNarroContextInfo->ContextId;
                $objNarroSuggestionVote->UserId = QApplication::GetUserId();
                $objNarroSuggestionVote->Created = QDateTime::Now();;
                $objNarroSuggestionVote->VoteValue = 1;
            }

            $objNarroSuggestionVote->Modified = QDateTime::Now();;
            $objNarroSuggestionVote->Save();

            $this->lblMessage->Text = t('Thank you for your vote. You can change it anytime by voting another suggestion.');
            $this->MarkAsModified();

        }

        public function btnCancelEditSuggestion_Click($strFormId, $strControlId, $strParameter) {
            $this->intEditSuggestionId = null;
            $btnSaveIgnoreSuggestion = $this->Form->GetControl('btnSaveIgnoreSuggestion' . $strParameter);
            $btnSaveIgnoreSuggestion->Visible = false;
            $this->lblMessage->Text = '';
            $this->ParentControl->HidePluginErrors();
            $this->MarkAsModified();
        }

        public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
            if (!QApplication::HasPermissionForThisLang('Can suggest', $this->objNarroContextInfo->Context->ProjectId))
                return false;

            $blnResult = true;

            $objSuggestion = NarroSuggestion::Load($strParameter);

            $blnCanEdit = QApplication::$User->hasPermission(
                                'Can edit any suggestion',
                                $this->objNarroContextInfo->Context->ProjectId,
                                QApplication::GetLanguageId()
                          )
                          ||
                          (
                                $objSuggestion->UserId == QApplication::GetUserId()
                                &&
                                QApplication::GetUserId() != NarroUser::ANONYMOUS_USER_ID
                          );
            if (!$blnCanEdit || $this->objNarroContextInfo->ValidSuggestionId == $strParameter) {
                $this->Form->txtSuggestionValue->Text = $objSuggestion->SuggestionValue;
                $this->Form->txtSuggestionValue->Focus();
                return false;
            }

            $btnEdit = $this->objForm->GetControl('btnEditSuggestion' . $objSuggestion->SuggestionId);
            if ($btnEdit->Text != t('Save')) {
                $btnEdit->Text = t('Save');
                $this->intEditSuggestionId = $strParameter;
            }
            else {
                // save
                if (!$this->IsSuggestionUsed($strParameter)) {
                    $txtControl = $this->objForm->GetControl('txtEditSuggestion' . $objSuggestion->SuggestionId);

                    if (trim($txtControl->Text) == '')
                        return true;

                    if ($txtControl) {
                        $arrResult = QApplication::$PluginHandler->SaveSuggestion($this->objNarroContextInfo->Context->Text->TextValue, $txtControl->Text, $this->objNarroContextInfo->Context->Context, $this->objNarroContextInfo->Context->File, $this->objNarroContextInfo->Context->Project);
                        if (is_array($arrResult) && isset($arrResult[1]))
                            $strSuggestionValue = $arrResult[1];
                        else
                            $strSuggestionValue = $txtControl->Text;

                        $btnSaveIgnoreSuggestion = $this->objForm->GetControl('btnSaveIgnoreSuggestion' . $objSuggestion->SuggestionId);

                        if ($strControlId != 'btnSaveIgnoreSuggestion' . $objSuggestion->SuggestionId && QApplication::$PluginHandler->Error) {
                            if ($btnSaveIgnoreSuggestion instanceof QButton)
                                $btnSaveIgnoreSuggestion->Visible = true;
                            $this->ParentControl->ShowPluginErrors();
                            return false;
                        }
                        else {
                            if ($btnSaveIgnoreSuggestion instanceof QButton)
                                $btnSaveIgnoreSuggestion->Visible = false;
                            $this->ParentControl->HidePluginErrors();
                        }


                        $objSuggestion->SuggestionValue = $strSuggestionValue;
                        $lstEditSuggestion = $this->Form->GetControl('lstEditSuggestion' . $objSuggestion->SuggestionId);
                        if ($lstEditSuggestion instanceof QListBox && $lstEditSuggestion->SelectedValue == QApplication::GetUserId() && $objSuggestion->UserId != $lstEditSuggestion->SelectedValue) {
                            $objSuggestion->UserId = $lstEditSuggestion->SelectedValue;
                            $objSuggestion->Created = QDateTime::Now();;
                        }

                        try {
                            $objSuggestion->Save();
                            $this->lblMessage->Text = t('Your changes were saved succesfully.');
                            $btnEdit->Text = ($blnCanEdit)?t('Edit'):t('Copy');
                            $this->btnCancelEditSuggestion_Click($strFormId, $strControlId, $strParameter);
                            $blnResult = true;
                        } catch (QMySqliDatabaseException $objExc) {
                            $this->lblMessage->Text = t('The text you are trying to save already exists.');
                        }
                    }
                }
                else
                    $blnResult = false;
            }
            //$this->dtgSuggestions_Bind();
            $this->MarkAsModified();

            return $blnResult;
        }

        protected function IsSuggestionUsed($strSuggestionId) {
            if ( $arrCtx = NarroContextInfo::LoadArrayByValidSuggestionId($strSuggestionId) ) {
                if (count($arrCtx) == 1 && $arrCtx[0]->ValidSuggestionId == $this->objNarroContextInfo->ValidSuggestionId)
                    return false;
                else {

                    foreach($arrCtx as $objContextInfo) {
                        if ($objContextInfo->ContextId != $this->objNarroContextInfo->ContextId)
                            $arrTexts[
                                sprintf('<a target="_blank" href="%s">%s</a>',
                                    NarroLink::ContextSuggest(
                                        $objContextInfo->Context->ProjectId,
                                        $objContextInfo->Context->FileId,
                                        $objContextInfo->ContextId,
                                        QApplication::QueryString('tf'),
                                        QApplication::QueryString('st'),
                                        QApplication::QueryString('s')
                                    ),
                                    $objContextInfo->ContextId
                                )
                            ] = 1;
                    }
                    if (isset($arrTexts) && count(array_keys($arrTexts))) {
                        $this->lblMessage->ForeColor = 'red';
                        $this->lblMessage->Text = sprintf(t('You cannot alter this suggestion because it is approved for the following contexts: %s. <br />You can cancel the approval for all these contexts and try again. Click on the contexts to open them in new tabs or windows.'), join(', ', array_keys($arrTexts)));
                        $this->MarkAsModified();
                        return true;
                    }
                }
            }
            elseif ($intVoteCount = NarroSuggestionVote::QueryCount(QQ::AndCondition(QQ::Equal(QQN::NarroSuggestionVote()->SuggestionId, $strSuggestionId), QQ::NotEqual(QQN::NarroSuggestionVote()->UserId, QApplication::GetUserId())))) {
                $this->lblMessage->ForeColor = 'red';
                $this->lblMessage->Text = sprintf(t('You cannot alter this suggestion because it has %d vote(s).'), $intVoteCount);
                $this->MarkAsModified();
                return true;
            }
            elseif ($intCommentsCount = NarroSuggestionComment::QueryCount(QQ::AndCondition(QQ::Equal(QQN::NarroSuggestionComment()->SuggestionId, $strSuggestionId), QQ::NotEqual(QQN::NarroSuggestionComment()->UserId, QApplication::GetUserId())))) {
                $this->lblMessage->ForeColor = 'red';
                $this->lblMessage->Text = sprintf(t('You cannot alter this suggestion because it has %d comment(s).'), $intVoteCount);
                $this->MarkAsModified();
                return true;
            }

            return false;
        }

        /////////////////////////
        // Public Properties: SET
        /////////////////////////
        public function __set($strName, $mixValue) {
            $this->blnModified = true;

            switch ($strName) {
                // APPEARANCE
                case "NarroContextInfo":
                    try {
                        $this->objNarroContextInfo = $mixValue;
                        $this->lblMessage->Text = '';
                        $this->dtgSuggestions_Bind();
                        $this->MarkAsModified();
                    } catch (QInvalidCastException $objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }
                    break;
                case "ShowOtherLanguages":
                    try {
                        $this->blnShowOtherLanguages = $mixValue;
                        $this->lblMessage->Text = '';
                        $this->dtgSuggestions_Bind();
                        $this->MarkAsModified();
                    } catch (QInvalidCastException $objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }
                    break;
                default:
                    try {
                        parent::__set($strName, $mixValue);
                    } catch (QCallerException $objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }
                    break;
            }
        }

    }
?>