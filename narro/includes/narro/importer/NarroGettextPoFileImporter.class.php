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

    class NarroGettextPoFileImporter extends NarroFileImporter {

        public function ExportFile($strTemplate, $strTranslatedFile = null) {
            $hndExportFile = fopen($strTranslatedFile, 'w');
            if (!$hndExportFile) {
                NarroLog::LogMessage(3, sprintf(t('Cannot create or write to "%s".'), $strTranslatedFile));
                return false;
            }

            $hndTemplate = fopen($strTemplate, 'r');
            if ($hndTemplate) {
                $strCurrentGroup = 1;
                while (!feof($hndTemplate)) {
                    $strLine = fgets($hndTemplate, 8192);

                    NarroLog::LogMessage(1, 'Processing ' . $strLine );

                    if (strpos($strLine, '# ') === 0) {
                        NarroLog::LogMessage(1, 'Found translator comment.');
                        $strTranslatorComment = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '# ') === 0)
                                $strTranslatorComment .= $strLine;
                            else
                                break;

                        }
                    }

                    if (strpos($strLine, '#.') === 0) {
                        NarroLog::LogMessage(1, 'Found extracted comment.');
                        $strExtractedComment = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#.') === 0)
                                $strExtractedComment .= $strLine;
                            else
                                break;

                        }
                    }

                    if (strpos($strLine, '#:') === 0) {
                        NarroLog::LogMessage(1, 'Found reference.');
                        $strReference = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#:') === 0)
                                $strReference .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, '#,') === 0) {
                        NarroLog::LogMessage(1, 'Found flag.');
                        $strFlag = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#,') === 0)
                                $strFlag .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, '#| msgctxt') === 0) {
                        NarroLog::LogMessage(1, 'Found previous context.');
                        $strPreviousContext = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#| msgctxt') === 0)
                                $strPreviousContext .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, '#| msgid') === 0) {
                        NarroLog::LogMessage(1, 'Found previous translated string.');
                        $strPreviousUntranslated = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#| msgid') === 0)
                                $strPreviousUntranslated .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, '#| msgid_plural') === 0) {
                        NarroLog::LogMessage(1, 'Found previous translated plural string.');
                        $strPreviousUntranslatedPlural = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#| msgid_plural') === 0)
                                $strPreviousUntranslatedPlural .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgctxt ') === 0) {
                        NarroLog::LogMessage(1, 'Found context.');
                        preg_match('/msgctxt\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgContext = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgContext .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgid ') === 0) {
                        preg_match('/msgid\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgId = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgId .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgid_plural') === 0) {
                        NarroLog::LogMessage(1, 'Found plural string.');
                        preg_match('/msgid_plural\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgPluralId = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgPluralId .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgstr ') === 0) {
                        NarroLog::LogMessage(1, 'Found translation.');
                        preg_match('/msgstr\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgStr = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgStr .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgstr[0]') === 0) {
                        NarroLog::LogMessage(1, 'Found translation plural 1.');
                        preg_match('/msgstr\[0\]\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgStr0 = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgStr0 .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgstr[1]') === 0) {
                        NarroLog::LogMessage(1, 'Found translation plural 2.');
                        preg_match('/msgstr\[1\]\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgStr1 = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgStr1 .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgstr[2]') === 0) {
                        NarroLog::LogMessage(1, 'Found translation plural 3.');
                        preg_match('/msgstr\[2\]\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgStr2 = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgStr2 .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if(isset($strMsgId) && $strMsgId != '') {
                        /**
                        echo '$strTranslatorComment: ' . $strTranslatorComment . "<br />";
                        echo '$strExtractedComment: ' . $strExtractedComment . "<br />";
                        echo '$strReference: ' . $strReference . "<br />";
                        echo '$strFlag: ' . $strFlag . "<br />";
                        echo '$strPreviousContext: ' . $strPreviousContext . "<br />";
                        echo '$strPreviousUntranslated: ' . $strPreviousUntranslated . "<br />";
                        echo '$strPreviousUntranslatedPlural: ' . $strPreviousUntranslatedPlural . "<br />";
                        echo '$strMsgContext: ' . $strMsgContext . "<br />";
                        echo '$strMsgId: ' . $strMsgId . "<br />";
                        echo '$strMsgPluralId: ' . $strMsgPluralId . "<br />";
                        echo '$strMsgStr: ' . $strMsgStr . "<br />";
                        echo '$strMsgStr0: ' . $strMsgStr0 . "<br />";
                        echo '$strMsgStr1: ' . $strMsgStr1 . "<br />";
                        echo '$strMsgStr2: ' . $strMsgStr2 . "<br />";
                        echo '<hr />';
                        */

                        /**
                         * if the string is marked fuzzy, don't import the translation and delete fuzzy flag
                         */
                        if (strstr($strFlag, ', fuzzy')) {
                            if (!is_null($strMsgStr)) $strMsgStr = '';

                            if (!is_null($strMsgStr0)) $strMsgStr0 = '';
                            if (!is_null($strMsgStr1)) $strMsgStr1 = '';
                            if (!is_null($strMsgStr2)) $strMsgStr2 = '';

                            $strFlag = str_replace(', fuzzy', '', $strFlag);
                            /**
                             * if no other flags are found, just empty the variable
                             */
                            if (strlen(trim($strFlag)) < 4) $strFlag = null;
                        }

                        $strContext = trim($strTranslatorComment . $strExtractedComment . $strReference . $strFlag . $strPreviousContext . $strPreviousUntranslated . $strPreviousUntranslatedPlural . $strMsgContext);
                        NarroLog::LogMessage(1, 'Context is: ' . $strContext);

                        if (!is_null($strMsgId)) $strMsgId = str_replace('\"', '"', $strMsgId);
                        if (!is_null($strMsgStr)) $strMsgStr = str_replace('\"', '"', $strMsgStr);

                        if (!is_null($strMsgPluralId)) $strMsgPluralId = str_replace('\"', '"', $strMsgPluralId);
                        if (!is_null($strMsgStr0)) $strMsgStr0 = str_replace('\"', '"', $strMsgStr0);
                        if (!is_null($strMsgStr1)) $strMsgStr1 = str_replace('\"', '"', $strMsgStr1);
                        if (!is_null($strMsgStr2)) $strMsgStr2 = str_replace('\"', '"', $strMsgStr2);

                        if (trim($strContext) == '') {
                            $strContext = sprintf('This text has no context info. The text is used in %s. Position in file: %d', $this->objFile->FileName, $strCurrentGroup);
                        }

                        /**
                         * if it's not a plural, just add msgid and msgstr
                         */
                        if (is_null($strMsgPluralId)) {
                            $strMsgStr = $this->GetTranslation($this->stripAccessKey($strMsgId), $this->getAccessKey($strMsgId), $this->getAccessKeyPrefix($strMsgId), $this->stripAccessKey($strMsgStr), $this->getAccessKey($strMsgStr), $strContext);
                        }
                        else {
                            /**
                             * if it's a plural, add the pluralid with all the msgstr's available
                             * currently limited to 3 (so 3 plural forms)
                             * the first one is added with msgid/msgstr[0] (this is the singular)
                             * the next ones (currently 2) are added with plural id, so in fact they will be tied to the same text
                             */
                            if (!is_null($strMsgStr0))
                                $strMsgStr0 = $this->GetTranslation($this->stripAccessKey($strMsgId), $this->getAccessKey($strMsgId), $this->getAccessKeyPrefix($strMsgId), $this->stripAccessKey($strMsgStr0), $this->getAccessKey($strMsgStr0), $strContext . "\nThis text has plurals.", 0);
                            if (!is_null($strMsgStr1))
                                $strMsgStr1 = $this->GetTranslation($this->stripAccessKey($strMsgPluralId), $this->getAccessKey($strMsgPluralId), $this->getAccessKeyPrefix($strMsgPluralId), $this->stripAccessKey($strMsgStr1), $this->getAccessKey($strMsgStr1), $strContext . "\nThis is plural form 1 for the text \"$strMsgId\".", 1);
                            if (!is_null($strMsgStr2))
                                $strMsgStr2 = $this->GetTranslation($this->stripAccessKey($strMsgPluralId), $this->getAccessKey($strMsgPluralId), $this->getAccessKeyPrefix($strMsgPluralId), $this->stripAccessKey($strMsgStr2), $this->getAccessKey($strMsgStr2), $strContext . "\nThis is plural form 2 for the text \"$strMsgId\".", 2);
                        }
                    }

                    if (!is_null($strTranslatorComment))
                        fputs($hndExportFile, $strTranslatorComment);
                    if (!is_null($strExtractedComment))
                        fputs($hndExportFile, $strExtractedComment);
                    if (!is_null($strReference))
                        fputs($hndExportFile, $strReference);
                    if (!is_null($strFlag))
                        fputs($hndExportFile, $strFlag);
                    if (!is_null($strPreviousContext))
                        fputs($hndExportFile, $strPreviousContext);
                    if (!is_null($strPreviousUntranslated))
                        fputs($hndExportFile, $strPreviousUntranslated);
                    if (!is_null($strPreviousUntranslatedPlural))
                        fputs($hndExportFile, $strPreviousUntranslatedPlural);
                    if (!is_null($strMsgContext))
                        fputs($hndExportFile, sprintf('msgctxt "%s"' . "\n", str_replace('"', '\"', $strMsgContext)));
                    if (!is_null($strMsgId))
                        fputs($hndExportFile, sprintf('msgid "%s"' . "\n", str_replace('"', '\"', $strMsgId)));
                    if (!is_null($strMsgPluralId))
                        fputs($hndExportFile, sprintf('msgid_plural "%s"' . "\n", str_replace('"', '\"', $strMsgPluralId)));

                    if (!is_null($strMsgStr))
                        if ($strMsgId == '') {
                            /**
                             * this must be the po header
                             */
                            $strPoHeader = sprintf("msgstr \"\"\n\"%s\"\n", str_replace('\n', "\\n\"\n\"", $strMsgStr));
                            $strPoHeader = preg_replace('/\n""/', '', $strPoHeader);
                            fputs($hndExportFile, $strPoHeader);
                        }
                        else
                            fputs($hndExportFile, sprintf('msgstr "%s"' . "\n", str_replace('"', '\"', $strMsgStr)));
                    if (!is_null($strMsgStr0))
                        fputs($hndExportFile, sprintf('msgstr[0] "%s"' . "\n", str_replace('"', '\"', $strMsgStr0)));
                    if (!is_null($strMsgStr1))
                        fputs($hndExportFile, sprintf('msgstr[1] "%s"' . "\n", str_replace('"', '\"', $strMsgStr1)));
                    if (!is_null($strMsgStr2))
                        fputs($hndExportFile, sprintf('msgstr[2] "%s"' . "\n", str_replace('"', '\"', $strMsgStr2)));

                    fputs($hndExportFile, "\n");

                    if ($strMsgId == '') {
                        fputs($hndExportFile, $strLine);
                    }

                    $strTranslatorComment = null;
                    $strExtractedComment = null;
                    $strReference = null;
                    $strFlag = null;
                    $strPreviousUntranslated = null;
                    $strPreviousContext = null;
                    $strPreviousUntranslatedPlural = null;
                    $strMsgContext = null;
                    $strMsgId = null;
                    $strMsgPluralId = null;
                    $strMsgStr = null;
                    $strMsgStr0 = null;
                    $strMsgStr1 = null;
                    $strMsgStr2 = null;
                    $strCurrentGroup++;
                }

                fclose($hndExportFile);
                chmod($strTranslatedFile, 0666);
//              exec('msgcat ' . $strTranslatedFile . ' -o ' . $strTranslatedFile . '.1');
//              exec('mv -f ' . $strTranslatedFile . '.1 ' . $strTranslatedFile);
            }
            else {
                NarroLog::LogMessage(3, sprintf(t('Cannot open file "%s".'), $strFileToImport));
            }
        }

        public function ImportFile($strFileToImport, $strTranslatedFile = null) {
            $hndTemplate = fopen($strFileToImport, 'r');
            if ($hndTemplate) {
                $strCurrentGroup = 1;
                while (!feof($hndTemplate)) {
                    $strLine = fgets($hndTemplate, 8192);
                    // echo "Processing " . $strLine . "<br />";
                    if (strpos($strLine, '# ') === 0) {
                        // echo 'Found translator comment. <br />';
                        $strTranslatorComment = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '# ') === 0)
                                $strTranslatorComment .= $strLine;
                            else
                                break;

                        }
                    }

                    if (strpos($strLine, '#.') === 0) {
                        // echo 'Found extracted comment. <br />';
                        $strExtractedComment = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#.') === 0)
                                $strExtractedComment .= $strLine;
                            else
                                break;

                        }
                    }

                    if (strpos($strLine, '#:') === 0) {
                        // echo 'Found reference. <br />';
                        $strReference = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#:') === 0)
                                $strReference .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, '#,') === 0) {
                        // echo 'Found flag. <br />';
                        $strFlag = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#,') === 0)
                                $strFlag .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, '#| msgctxt') === 0) {
                        // echo 'Found previous context. <br />';
                        $strPreviousContext = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#| msgctxt') === 0)
                                $strPreviousContext .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, '#| msgid') === 0) {
                        // echo 'Found previous translated string. <br />';
                        $strPreviousUntranslated = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#| msgid') === 0)
                                $strPreviousUntranslated .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, '#| msgid_plural') === 0) {
                        // echo 'Found previous translated plural string. <br />';
                        $strPreviousUntranslatedPlural = $strLine;
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '#| msgid_plural') === 0)
                                $strPreviousUntranslatedPlural .= $strLine;
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgctxt ') === 0) {
                        // echo 'Found string. <br />';
                        preg_match('/msgctxt\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgContext = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgContext .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgid ') === 0) {
                        preg_match('/msgid\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgId = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgId .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgid_plural') === 0) {
                        // echo 'Found plural string. <br />';
                        preg_match('/msgid_plural\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgPluralId = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgPluralId .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgstr ') === 0) {
                        // echo 'Found translation. <br />';
                        preg_match('/msgstr\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgStr = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgStr .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgstr[0]') === 0) {
                        // echo 'Found translation plural 1. <br />';
                        preg_match('/msgstr\[0\]\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgStr0 = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgStr0 .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgstr[1]') === 0) {
                        // echo 'Found translation plural 2. <br />';
                        preg_match('/msgstr\[1\]\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgStr1 = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgStr1 .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if (strpos($strLine, 'msgstr[2]') === 0) {
                        // echo 'Found translation plural 3. <br />';
                        preg_match('/msgstr\[2\]\s+\"(.*)\"/', $strLine, $arrMatches);
                        $strMsgStr2 = str_replace('\"', '"', $arrMatches[1]);
                        while (!feof($hndTemplate)) {
                            $strLine = fgets($hndTemplate, 8192);
                            if (strpos($strLine, '"') === 0) {
                                $strMsgStr2 .= str_replace('\"', '"', substr(trim($strLine), 1, strlen(trim($strLine)) - 2));
                            }
                            else
                                break;
                        }
                    }

                    if($strMsgId) {
                        /**
                        echo '$strTranslatorComment: ' . $strTranslatorComment . "<br />";
                        echo '$strExtractedComment: ' . $strExtractedComment . "<br />";
                        echo '$strReference: ' . $strReference . "<br />";
                        echo '$strFlag: ' . $strFlag . "<br />";
                        echo '$strPreviousContext: ' . $strPreviousContext . "<br />";
                        echo '$strPreviousUntranslated: ' . $strPreviousUntranslated . "<br />";
                        echo '$strPreviousUntranslatedPlural: ' . $strPreviousUntranslatedPlural . "<br />";
                        echo '$strMsgContext: ' . $strMsgContext . "<br />";
                        echo '$strMsgId: ' . $strMsgId . "<br />";
                        echo '$strMsgPluralId: ' . $strMsgPluralId . "<br />";
                        echo '$strMsgStr: ' . $strMsgStr . "<br />";
                        echo '$strMsgStr0: ' . $strMsgStr0 . "<br />";
                        echo '$strMsgStr1: ' . $strMsgStr1 . "<br />";
                        echo '$strMsgStr2: ' . $strMsgStr2 . "<br />";
                        echo '<hr />';
                        */

                        /**
                         * if the string is marked fuzzy, don't import the translation and delete fuzzy flag
                         */
                        if (strstr($strFlag, ', fuzzy')) {
                            if (!is_null($strMsgStr)) $strMsgStr = '';

                            if (!is_null($strMsgStr0)) $strMsgStr0 = '';
                            if (!is_null($strMsgStr1)) $strMsgStr1 = '';
                            if (!is_null($strMsgStr2)) $strMsgStr2 = '';

                            $strFlag = str_replace(', fuzzy', '', $strFlag);
                            /**
                             * if no other flags are found, just empty the variable
                             */
                            if (strlen(trim($strFlag)) < 4) $strFlag = null;
                        }

                        $strContext = $strTranslatorComment . $strExtractedComment . $strReference . $strFlag . $strPreviousContext . $strPreviousUntranslated . $strPreviousUntranslatedPlural . $strMsgContext;

                        if (!is_null($strMsgId)) $strMsgId = str_replace('\"', '"', $strMsgId);
                        if (!is_null($strMsgStr)) $strMsgStr = str_replace('\"', '"', $strMsgStr);

                        if (!is_null($strMsgPluralId)) $strMsgPluralId = str_replace('\"', '"', $strMsgPluralId);
                        if (!is_null($strMsgStr0)) $strMsgStr0 = str_replace('\"', '"', $strMsgStr0);
                        if (!is_null($strMsgStr1)) $strMsgStr1 = str_replace('\"', '"', $strMsgStr1);
                        if (!is_null($strMsgStr2)) $strMsgStr2 = str_replace('\"', '"', $strMsgStr2);

                        if (trim($strContext) == '') {
                            $strContext = sprintf('This text has no context info. The text is used in %s. Position in file: %d', $this->objFile->FileName, $strCurrentGroup);
                        }

                        /**
                         * if it's not a plural, just add msgid and msgstr
                         */
                        if (is_null($strMsgPluralId)) {
                                $this->AddTranslation($this->stripAccessKey($strMsgId), $this->getAccessKey($strMsgId), $this->stripAccessKey($strMsgStr), $this->getAccessKey($strMsgStr), $strContext);
                        }
                        else {
                            /**
                             * if it's a plural, add the pluralid with all the msgstr's available
                             * currently limited to 3 (so 3 plural forms)
                             * the first one is added with msgid/msgstr[0] (this is the singular)
                             * the next ones (currently 2) are added with plural id, so in fact they will be tied to the same text
                             * @todo add unlimited plurals support
                             */
                            if (!is_null($strMsgStr0)) {
                                $this->AddTranslation($this->stripAccessKey($strMsgId), $this->getAccessKey($strMsgPluralId), $this->stripAccessKey($strMsgStr0), $this->getAccessKey($strMsgStr0), $strContext . "\nThis text has plurals.");
                            }

                            if (!is_null($strMsgStr1)) {
                                $this->AddTranslation($this->stripAccessKey($strMsgPluralId), $this->getAccessKey($strMsgPluralId), $this->stripAccessKey($strMsgStr1), $this->getAccessKey($strMsgStr1), $strContext . "\nThis is plural form 1 for the text \"$strMsgId\".");
                            }

                            if (!is_null($strMsgStr2)) {
                                $this->AddTranslation($this->stripAccessKey($strMsgPluralId), $this->getAccessKey($strMsgPluralId), $this->stripAccessKey($strMsgStr2), $this->getAccessKey($strMsgStr2), $strContext . "\nThis is plural form 2 for the text \"$strMsgId\".");
                            }
                        }
                    }

                    $strTranslatorComment = null;
                    $strExtractedComment = null;
                    $strReference = null;
                    $strFlag = null;
                    $strPreviousUntranslated = null;
                    $strPreviousContext = null;
                    $strPreviousUntranslatedPlural = null;
                    $strMsgContext = null;
                    $strMsgId = null;
                    $strMsgPluralId = null;
                    $strMsgStr = null;
                    $strMsgStr0 = null;
                    $strMsgStr1 = null;
                    $strMsgStr2 = null;

                    $strCurrentGroup++;
                }
            }
            else {
                NarroLog::LogMessage(3, sprintf(t('Cannot open file "%s".'), $strFileToImport));
            }
        }

        private function getAccessKeyAndStrippedText($strText) {
            $strCleanText = preg_replace('/<literal>.*<\/literal>/', '', $strText);
            $strCleanText = strip_tags($strCleanText);
            $strCleanText = html_entity_decode($strCleanText);
            $strCleanText = preg_replace('/\$[a-z0-9A-Z_\-]+/', '', $strCleanText);

            if (preg_match('/_(\w)/', $strCleanText, $arrMatches)) {
                return array(NarroString::Replace('_' . $arrMatches[1], $arrMatches[1], $strText), '_', $arrMatches[1]);
            }
            else {
                if (preg_match('/&(\w)/', $strCleanText, $arrMatches)) {
                    return array(NarroString::Replace('&' . $arrMatches[1], $arrMatches[1], $strText), '&', $arrMatches[1]);
                }
                else
                    return array($strText, null);
            }
        }

        protected function getAccessKey($strText) {
            list($strStrippedText, $strAccKeyPrefix, $strAccKey) = $this->getAccessKeyAndStrippedText($strText);
            return $strAccKey;
        }

        protected function stripAccessKey($strText) {
            list($strStrippedText, $strAccKeyPrefix, $strAccKey) = $this->getAccessKeyAndStrippedText($strText);
            return $strStrippedText;
        }

        protected function getAccessKeyPrefix($strText) {
            list($strStrippedText, $strAccKeyPrefix, $strAccKey) = $this->getAccessKeyAndStrippedText($strText);
            return $strAccKeyPrefix;
        }

        /**
         * A translation here consists of the project, file, text, translation, context, plurals, validation, ignore equals
         *
         * @param string $strOriginal the original text
         * @param string $strOriginalAccKey access key for the original text
         * @param string $strTranslation the translated text from the import file (can be empty)
         * @param string $strOriginalAccKey access key for the translated text
         * @param string $strContext the context where the text/translation appears in the file
         * @param string $intPluralForm if this is a plural, what plural form is it (0 singular, 1 plural form 1, and so on)
         * @param string $strComment a comment from the imported file
         *
         * @return string valid suggestion
         */
        protected function GetTranslation($strOriginal, $strOriginalAccKey = null, $strOriginalAccKeyPrefix = null, $strTranslation, $strTranslationAccKey = null, $strContext, $intPluralForm = null, $strComment = null) {
            $objNarroContextInfo = NarroContextInfo::QuerySingle(
                QQ::AndCondition(
                    QQ::Equal(QQN::NarroContextInfo()->Context->ProjectId, $this->objProject->ProjectId),
                    QQ::Equal(QQN::NarroContextInfo()->Context->FileId, $this->objFile->FileId),
                    QQ::Equal(QQN::NarroContextInfo()->Context->ContextMd5, md5($strContext)),
                    QQ::Equal(QQN::NarroContextInfo()->Context->Text->TextValueMd5, md5($strOriginal)),
                    QQ::Equal(QQN::NarroContextInfo()->LanguageId, $this->objTargetLanguage->LanguageId),
                    QQ::IsNotNull(QQN::NarroContextInfo()->ValidSuggestionId)
                )
            );

            if ( $objNarroContextInfo instanceof NarroContextInfo ) {
                $arrResult = QApplication::$objPluginHandler->ExportSuggestion($strOriginal, $objNarroContextInfo->ValidSuggestion->SuggestionValue, $strContext, $this->objFile, $this->objProject);
                if
                (
                    trim($arrResult[1]) != '' &&
                    $arrResult[0] == $strOriginal &&
                    $arrResult[2] == $strContext &&
                    $arrResult[3] == $this->objFile &&
                    $arrResult[4] == $this->objProject
                ) {
                $objNarroContextInfo->ValidSuggestion->SuggestionValue = $arrResult[1];
                }
            else
            NarroLog::LogMessage(2, sprintf(t('A plugin returned an unexpected result while processing the suggestion "%s": %s'), $strTranslation, $strTranslation));

                if (!is_null($strOriginalAccKey) && !is_null($strOriginalAccKeyPrefix)) {
                    /**
                     * @todo don't export if there's no valid access key
                     */
                    $strTextWithAccKey = NarroString::Replace($objNarroContextInfo->SuggestionAccessKey, $strOriginalAccKeyPrefix . $objNarroContextInfo->SuggestionAccessKey, $objNarroContextInfo->ValidSuggestion->SuggestionValue, 1);
                    return $strTextWithAccKey;
                }
                else
                    return $objNarroContextInfo->ValidSuggestion->SuggestionValue;
            }
            else {
                /**
                 * leave it untranslated
                 */
                return "";
            }
        }
    }
?>