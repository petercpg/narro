<?php
    /**
     * Narro is an application that allows online software translation and maintenance.
     * Copyright (C) 2008-2011 Alexandru Szasz <alexxed@gmail.com>
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

    class NarroMozillaIniFileImporter extends NarroMozillaFileImporter {
        const ENTITY_REGEX = '/(^\s*)([^\s]+)(\s*)(=)(\s*)(.*)$/m';
        const COMMENT_REGEX = '/^#.*$/m';
        /**
         * Preprocesses the whole file, e.g. removing trailing spaces
         * @param string $strFile file content
         * @return string
         */
        protected function PreProcessFile($strFile) {
            return $strFile;
        }

        /**
         * Preprocesses the line if needed
         * e.g. in the source file there's a comment like '# #define MOZ_LANGPACK_CONTRIBUTORS that should be uncommented
         * @param string $strLine
         * @return string
         */
        protected function PreProcessLine($strLine) {

            if (strstr($strLine, 'MOZ_LANGPACK_CONTRIBUTORS'))
                $strLine = str_replace('# #define MOZ_LANGPACK_CONTRIBUTORS', '#define MOZ_LANGPACK_CONTRIBUTORS', $strLine);

            return $strLine;
        }

        /**
         * Process the line by splitting the $strLine in key=>value
         * array(array('key' => $strKey, 'value' => $strValue), $arrComment, $arrLinesBefore)
         * or
         * array(false, $arrComment, $arrLinesBefore)
         * @param string $strLine
         * @return NarroFileEntity
         */
        protected function ProcessLine($strLine) {
            if (preg_match(self::ENTITY_REGEX, $strLine, $arrMatches)) {
                $objEntity = new NarroFileEntity();

                $objEntity->Key = $arrMatches[2];
                $objEntity->Value = trim($arrMatches[6]);

                $strBeforeEntity = str_replace($arrMatches[0], '', $strLine);

                if (preg_match_all(self::COMMENT_REGEX, $strBeforeEntity, $arrCommentMatches))
                    $objEntity->Comment = join("\n", $arrCommentMatches[0]);
                else
                    $objEntity->Comment = '';

                $objEntity->BeforeValue = $strBeforeEntity . $arrMatches[1] . $arrMatches[2] . $arrMatches[3] . $arrMatches[4] . $arrMatches[5];
                $objEntity->AfterValue = '';

                return $objEntity;
            }
            else {
                return false;
            }
        }

        public function ExportFile($strTemplateFile, $strTranslatedFile) {
            $intTime = time();

            $arrSourceKey = $this->FileAsArray($strTemplateFile);

            if (basename($strTemplateFile) == 'brand.properties')
            QApplication::LogDebug(var_export($arrSourceKey, true));

            $intElapsedTime = time() - $intTime;
            if ($intElapsedTime > 0)
                QApplication::LogDebug(sprintf('Preprocessing %s took %d seconds.', $this->objFile->FileName, $intElapsedTime));

            QApplication::LogDebug(sprintf('Found %d contexts in file %s.', count($arrSourceKey), $this->objFile->FileName));

            if (is_array($arrSourceKey)) {
                $arrSourceKey = $this->GetAccessKeys($arrSourceKey);
                $arrTranslation = $this->GetTranslations($arrSourceKey);

                $hndTranslationFile = fopen($strTranslatedFile, 'w');

                if ($this->objFile->Header)
                    fwrite($hndTranslationFile, $this->objFile->Header);

                $arrUsers = array();
                foreach($this->objFile->GetTranslatorArray($this->objTargetLanguage->LanguageId) as $objUser) {
                    $arrUsers[] = sprintf("# %s <%s>", $objUser->Username, $objUser->Email);
                }

                if (count($arrUsers))
                    fwrite($hndTranslationFile, sprintf("# Translator(s):\n#\n%s\n#\n", join("\n", $arrUsers)));

                $arrUsers = array();
                foreach($this->objFile->GetReviewerArray($this->objTargetLanguage->LanguageId) as $objUser) {
                    $arrUsers[] = sprintf("# %s <%s>", $objUser->Username, $objUser->Email);
                }

                if (count($arrUsers))
                    fwrite($hndTranslationFile, sprintf("# Reviewer(s):\n#\n%s\n#\n", join("\n", $arrUsers)));

                foreach($arrSourceKey as $strContext=>$objEntity) {
                    if (isset($arrTranslation[$strContext]))
                        fwrite($hndTranslationFile, $objEntity->BeforeValue . $arrTranslation[$strContext] . $objEntity->AfterValue . "\n");
                    else
                        fwrite($hndTranslationFile, $objEntity->BeforeValue . $objEntity->Value . $objEntity->AfterValue . "\n");
                }

                fclose($hndTranslationFile);
                NarroUtils::Chmod($strTranslatedFile, 0666);
                return true;
            }
            else {
                QApplication::LogWarn(sprintf('Found a empty template (%s), copying the original', $strTemplateFile));
                copy($strTemplateFile, $strTranslatedFile);
                NarroUtils::Chmod($strTranslatedFile, 0666);
                return false;
            }
        }

        /**
         * This function does the opposite of GetAccessKeys
         * @param array $arrTemplate an array with context as keys and original texts as values
         * @return array $arrTranslation an array with context as keys and translations as values
         */
        public function GetTranslations($arrTemplate) {
            $arrTranslation = array();

            $arrTranslationObjects =
                NarroContextInfo::QueryArray(
                    QQ::AndCondition(
                        QQ::Equal(QQN::NarroContextInfo()->Context->FileId, $this->objFile->FileId),
                        QQ::Equal(QQN::NarroContextInfo()->LanguageId, $this->objTargetLanguage->LanguageId),
                        QQ::Equal(QQN::NarroContextInfo()->Context->Active, 1)
                    ),
                    QQ::Expand(QQN::NarroContextInfo()->Context)
                );

            foreach($arrTranslationObjects as $objNarroContextInfo) {
                $arrTranslation[$objNarroContextInfo->Context->Context] = $this->GetExportedSuggestion($objNarroContextInfo);
                if ($arrTranslation[$objNarroContextInfo->Context->Context] === false) {
                    if ($this->blnSkipUntranslated == false)
                        $arrTranslation[$objNarroContextInfo->Context->Context] = $objNarroContextInfo->Context->Text->TextValue;
                    else
                        unset($arrTranslation[$objNarroContextInfo->Context->Context]);
                }

                if ($objNarroContextInfo->TextAccessKey) {
                    if ($objNarroContextInfo->SuggestionAccessKey) {
                        $arrTranslation[$objNarroContextInfo->Context->Context] = NarroString::Replace($objNarroContextInfo->SuggestionAccessKey, '&' . $objNarroContextInfo->SuggestionAccessKey, $arrTranslation[$objNarroContextInfo->Context->Context], 1);
                    }
                    else
                        $arrTranslation[$objNarroContextInfo->Context->Context] = NarroString::Replace(mb_substr($arrTranslation[$objNarroContextInfo->Context->Context], 0, 1), '&' . mb_substr($arrTranslation[$objNarroContextInfo->Context->Context], 0, 1), $arrTranslation[$objNarroContextInfo->Context->Context], 1);
                }
            }

            return $arrTranslation;
        }

        /**
         * This function looks for accesskey entries and creates po style texts, e.g. &File
         * @param array $arrTexts an array with context as keys and texts as values
         */
        public function GetAccessKeys($arrTexts) {
            foreach($arrTexts as $strContext=>$objEntity) {
                if (preg_match('/&([^\s])/', $objEntity->Value, $arrMatches)) {
                    $objEntity->AccessKey = $arrMatches[1];
                    $arrTexts[$strContext]->Value = str_replace($arrMatches[0], $arrMatches[1], $objEntity->Value);
                }
            }

            return $arrTexts;
        }
    }
?>
