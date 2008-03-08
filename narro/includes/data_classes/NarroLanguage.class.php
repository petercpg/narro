<?php
	require(__DATAGEN_CLASSES__ . '/NarroLanguageGen.class.php');

	/**
	 * The NarroLanguage class defined here contains any
	 * customized code for the NarroLanguage class in the
	 * Object Relational Model.  It represents the "narro_language" table 
	 * in the database, and extends from the code generated abstract NarroLanguageGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package Narro
	 * @subpackage DataObjects
	 * 
	 */
	class NarroLanguage extends NarroLanguageGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objNarroLanguage->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('NarroLanguage Object %s',  $this->intLanguageId);
		}



		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of NarroLanguage objects
			return NarroLanguage::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::NarroLanguage()->Param1, $strParam1),
					QQ::GreaterThan(QQN::NarroLanguage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single NarroLanguage object
			return NarroLanguage::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::NarroLanguage()->Param1, $strParam1),
					QQ::GreaterThan(QQN::NarroLanguage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of NarroLanguage objects
			return NarroLanguage::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::NarroLanguage()->Param1, $strParam1),
					QQ::Equal(QQN::NarroLanguage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = NarroLanguage::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`narro_language`.*
				FROM
					`narro_language` AS `narro_language`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return NarroLanguage::InstantiateDbResult($objDbResult);
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