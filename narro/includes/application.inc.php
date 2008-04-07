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

    class QApplication extends QApplicationBase {
        public static $blnUseAjax = true;
        public static $objUser;
        public static $objPluginHandler;
        public static $arrPreferences;
        public static $arrFormats;
        public static $Cache;

        /**
        * This is called by the PHP5 Autoloader.  This method overrides the
        * one in ApplicationBase.
        *
        * @return void
        */
        public static function Autoload($strClassName) {
            // First use the Qcodo Autoloader
            parent::Autoload($strClassName);

            if (file_exists(dirname(__FILE__) . '/narro/' . $strClassName . '.class.php'))
                require_once(dirname(__FILE__) . '/narro/' . $strClassName . '.class.php');

            // TODO: Run any custom autoloading functionality (if any) here...
        }

        public static $EncodingType = 'UTF-8';

        ////////////////////////////
        // Additional Static Methods
        ////////////////////////////

        public static function RegisterPreference($strName, $strType = 'text', $strDescription = '', $strDefaultValue = '', $arrValues = array()) {
            self::$arrPreferences[$strName] = array('type'=> $strType, 'description'=>$strDescription, 'default'=>$strDefaultValue, 'values'=>$arrValues);
        }

        public static function RegisterFormat($strName, $strPluginName) {
            self::$arrFileFormats[$strName] = $strPluginName;
        }

        public static function Translate($strText) {
            if (class_exists('NarroSelfTranslate'))
                return NarroSelfTranslate::Translate($strText);
            else
                return $strText;
        }
    }

    function t($strText) {
        return QApplication::Translate($strText);
    }

    ///////////////////////
    // Setup Error Handling
    ///////////////////////
    /*
    * Set Error/Exception Handling to the default
    * Qcodo HandleError and HandlException functions
    * (Only in non CLI mode)
    *
    * Feel free to change, if needed, to your own
    * custom error handling script(s).
    */
    if (array_key_exists('SERVER_PROTOCOL', $_SERVER)) {
        set_error_handler('QcodoHandleError');
        set_exception_handler('QcodoHandleException');
    }


    ////////////////////////////////////////////////
    // Initialize the Application and DB Connections
    ////////////////////////////////////////////////
    QApplication::Initialize();
    QApplication::InitializeDatabaseConnections();


    /////////////////////////////
    // Start Session Handler (if required)
    /////////////////////////////
    session_start();

    QApplication::RegisterPreference('Items per page', 'number', 'How many items are displayed per page', 10);
    QApplication::RegisterPreference('Font size', 'option', 'The application font size', 'medium', array('x-small', 'small', 'medium', 'large', 'x-large'));
    QApplication::RegisterPreference('Language', 'option', 'The language you are translating to.', 'en_US', array('en_US'));
    QApplication::RegisterPreference('Special characters', 'text', 'Paste here the characters that you can not type in with your keyboard', '');

    if (isset($_SESSION['objUser']) && $_SESSION['objUser'] instanceof NarroUser)
        QApplication::$objUser = $_SESSION['objUser'];
    else
        QApplication::$objUser = NarroUser::LoadAnonymousUser();

    if (!QApplication::$objUser instanceof NarroUser)
        // @todo add handling here
        throw Exception('Could not create an instance of NarroUser');

    QApplication::$LanguageCode = QApplication::$objUser->Language->LanguageCode;

    QCache::$CachePath = __DOCROOT__ . __SUBDIRECTORY__ . '/data/cache';
    QForm::$FormStateHandler = 'QFileFormStateHandler';
    QFileFormStateHandler::$StatePath = __TMP_PATH__ . '/qform_states/';

    require_once __INCLUDES__ . '/Zend/Cache.php';

    $frontendOptions = array(
        'lifetime' => null, // cache forever
        'automatic_serialization' => true
    );

    $backendOptions = array(
        'cache_dir' => QCache::$CachePath . '/zend'
    );

    QApplication::$Cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);

    QApplication::$objPluginHandler = new NarroPluginHandler(dirname(__FILE__) . '/narro/plugins');
?>