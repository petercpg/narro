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

    require(__DATAGEN_CLASSES__ . '/NarroContextPluralGen.class.php');

    /**
    * The NarroContextPlural class defined here contains any
    * customized code for the NarroContextPlural class in the
    * Object Relational Model.  It represents the "narro_context_plural" table
    * in the database, and extends from the code generated abstract NarroContextPluralGen
    * class, which contains all the basic CRUD-type functionality as well as
    * basic methods to handle relationships and index-based loading.
    *
    * @package Narro
    * @subpackage DataObjects
    *
    */
    class NarroContextPlural extends NarroContextPluralGen {
        /**
        * Default "to string" handler
        * Allows pages to _p()/echo()/print() this object, and to define the default
        * way this object would be outputted.
        *
        * Can also be called directly via $objNarroContextPlural->__toString().
        *
        * @return string a nicely formatted string representation of this object
        */
        public function __toString() {
            return sprintf('NarroContextPlural Object %s',  $this->intPluralId);
        }



        // Override or Create New Load/Count methods
        // (For obvious reasons, these methods are commented out...
        // but feel free to use these as a starting point)
/*
        public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
            // This will return an array of NarroContextPlural objects
            return NarroContextPlural::QueryArray(
                QQ::AndCondition(
                    QQ::Equal(QQN::NarroContextPlural()->Param1, $strParam1),
                    QQ::GreaterThan(QQN::NarroContextPlural()->Param2, $intParam2)
                ),
                $objOptionalClauses
            );
        }

        public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
            // This will return a single NarroContextPlural object
            return NarroContextPlural::QuerySingle(
                QQ::AndCondition(
                    QQ::Equal(QQN::NarroContextPlural()->Param1, $strParam1),
                    QQ::GreaterThan(QQN::NarroContextPlural()->Param2, $intParam2)
                ),
                $objOptionalClauses
            );
        }

        public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
            // This will return a count of NarroContextPlural objects
            return NarroContextPlural::QueryCount(
                QQ::AndCondition(
                    QQ::Equal(QQN::NarroContextPlural()->Param1, $strParam1),
                    QQ::Equal(QQN::NarroContextPlural()->Param2, $intParam2)
                ),
                $objOptionalClauses
            );
        }

        public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
            // Performing the load manually (instead of using Qcodo Query)

            // Get the Database Object for this Class
            $objDatabase = NarroContextPlural::GetDatabase();

            // Properly Escape All Input Parameters using Database->SqlVariable()
            $strParam1 = $objDatabase->SqlVariable($strParam1);
            $intParam2 = $objDatabase->SqlVariable($intParam2);

            // Setup the SQL Query
            $strQuery = sprintf('
                SELECT
                    `narro_context_plural`.*
                FROM
                    `narro_context_plural` AS `narro_context_plural`
                WHERE
                    param_1 = %s AND
                    param_2 < %s',
                $strParam1, $intParam2);

            // Perform the Query and Instantiate the Result
            $objDbResult = $objDatabase->Query($strQuery);
            return NarroContextPlural::InstantiateDbResult($objDbResult);
        }
*/



        // Override or Create New Properties and Variables
        // For performance reasons, these variables and __set and __get override methods
        // are commented out.  But if you wish to implement or override any
        // of the data generated properties, please feel free to uncomment them.
/*
        protected $strSomeNewProperty;

        public function __get($strName) {
            switch ($strName) {
                case 'SomeNewProperty': return $this->strSomeNewProperty;

                default:
                    try {
                        return parent::__get($strName);
                    } catch (QCallerException $objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }
            }
        }

        public function __set($strName, $mixValue) {
            switch ($strName) {
                case 'SomeNewProperty':
                    try {
                        return ($this->strSomeNewProperty = QType::Cast($mixValue, QType::String));
                    } catch (QInvalidCastException $objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }

                default:
                    try {
                        return (parent::__set($strName, $mixValue));
                    } catch (QCallerException $objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }
            }
        }
*/
    }
?>