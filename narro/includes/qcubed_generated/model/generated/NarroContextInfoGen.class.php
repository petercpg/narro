<?php
	/**
	 * The abstract NarroContextInfoGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the NarroContextInfo subclass which
	 * extends this NarroContextInfoGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the NarroContextInfo class.
	 *
	 * @package Narro
	 * @subpackage GeneratedDataObjects
	 * @property-read integer $ContextInfoId the value for intContextInfoId (Read-Only PK)
	 * @property integer $ContextId the value for intContextId (Not Null)
	 * @property integer $LanguageId the value for intLanguageId (Not Null)
	 * @property integer $ValidatorUserId the value for intValidatorUserId 
	 * @property integer $ValidSuggestionId the value for intValidSuggestionId 
	 * @property boolean $HasSuggestions the value for blnHasSuggestions 
	 * @property string $SuggestionAccessKey the value for strSuggestionAccessKey 
	 * @property string $SuggestionCommandKey the value for strSuggestionCommandKey 
	 * @property QDateTime $Created the value for dttCreated (Not Null)
	 * @property QDateTime $Modified the value for dttModified 
	 * @property NarroContext $Context the value for the NarroContext object referenced by intContextId (Not Null)
	 * @property NarroLanguage $Language the value for the NarroLanguage object referenced by intLanguageId (Not Null)
	 * @property NarroUser $ValidatorUser the value for the NarroUser object referenced by intValidatorUserId 
	 * @property NarroSuggestion $ValidSuggestion the value for the NarroSuggestion object referenced by intValidSuggestionId 
	 * @property-read boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class NarroContextInfoGen extends QBaseClass implements IteratorAggregate {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////

		/**
		 * Protected member variable that maps to the database PK Identity column narro_context_info.context_info_id
		 * @var integer intContextInfoId
		 */
		protected $intContextInfoId;
		const ContextInfoIdDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.context_id
		 * @var integer intContextId
		 */
		protected $intContextId;
		const ContextIdDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.language_id
		 * @var integer intLanguageId
		 */
		protected $intLanguageId;
		const LanguageIdDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.validator_user_id
		 * @var integer intValidatorUserId
		 */
		protected $intValidatorUserId;
		const ValidatorUserIdDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.valid_suggestion_id
		 * @var integer intValidSuggestionId
		 */
		protected $intValidSuggestionId;
		const ValidSuggestionIdDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.has_suggestions
		 * @var boolean blnHasSuggestions
		 */
		protected $blnHasSuggestions;
		const HasSuggestionsDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.suggestion_access_key
		 * @var string strSuggestionAccessKey
		 */
		protected $strSuggestionAccessKey;
		const SuggestionAccessKeyMaxLength = 1;
		const SuggestionAccessKeyDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.suggestion_command_key
		 * @var string strSuggestionCommandKey
		 */
		protected $strSuggestionCommandKey;
		const SuggestionCommandKeyMaxLength = 1;
		const SuggestionCommandKeyDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.created
		 * @var QDateTime dttCreated
		 */
		protected $dttCreated;
		const CreatedDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_context_info.modified
		 * @var QDateTime dttModified
		 */
		protected $dttModified;
		const ModifiedDefault = null;


		/**
		 * Protected array of virtual attributes for this object (e.g. extra/other calculated and/or non-object bound
		 * columns from the run-time database query result for this object).  Used by InstantiateDbRow and
		 * GetVirtualAttribute.
		 * @var string[] $__strVirtualAttributeArray
		 */
		protected $__strVirtualAttributeArray = array();

		/**
		 * Protected internal member variable that specifies whether or not this object is Restored from the database.
		 * Used by Save() to determine if Save() should perform a db UPDATE or INSERT.
		 * @var bool __blnRestored;
		 */
		protected $__blnRestored;




		///////////////////////////////
		// PROTECTED MEMBER OBJECTS
		///////////////////////////////

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column narro_context_info.context_id.
		 *
		 * NOTE: Always use the Context property getter to correctly retrieve this NarroContext object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var NarroContext objContext
		 */
		protected $objContext;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column narro_context_info.language_id.
		 *
		 * NOTE: Always use the Language property getter to correctly retrieve this NarroLanguage object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var NarroLanguage objLanguage
		 */
		protected $objLanguage;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column narro_context_info.validator_user_id.
		 *
		 * NOTE: Always use the ValidatorUser property getter to correctly retrieve this NarroUser object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var NarroUser objValidatorUser
		 */
		protected $objValidatorUser;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column narro_context_info.valid_suggestion_id.
		 *
		 * NOTE: Always use the ValidSuggestion property getter to correctly retrieve this NarroSuggestion object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var NarroSuggestion objValidSuggestion
		 */
		protected $objValidSuggestion;



		/**
		 * Initialize each property with default values from database definition
		 */
		public function Initialize()
		{
			$this->intContextInfoId = NarroContextInfo::ContextInfoIdDefault;
			$this->intContextId = NarroContextInfo::ContextIdDefault;
			$this->intLanguageId = NarroContextInfo::LanguageIdDefault;
			$this->intValidatorUserId = NarroContextInfo::ValidatorUserIdDefault;
			$this->intValidSuggestionId = NarroContextInfo::ValidSuggestionIdDefault;
			$this->blnHasSuggestions = NarroContextInfo::HasSuggestionsDefault;
			$this->strSuggestionAccessKey = NarroContextInfo::SuggestionAccessKeyDefault;
			$this->strSuggestionCommandKey = NarroContextInfo::SuggestionCommandKeyDefault;
			$this->dttCreated = (NarroContextInfo::CreatedDefault === null)?null:new QDateTime(NarroContextInfo::CreatedDefault);
			$this->dttModified = (NarroContextInfo::ModifiedDefault === null)?null:new QDateTime(NarroContextInfo::ModifiedDefault);
		}


		///////////////////////////////
		// CLASS-WIDE LOAD AND COUNT METHODS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return QDatabaseBase reference to the Database object that can query this class
		 */
		public static function GetDatabase() {
			return QApplication::$Database[1];
		}

		/**
		 * Load a NarroContextInfo from PK Info
		 * @param integer $intContextInfoId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo
		 */
		public static function Load($intContextInfoId, $objOptionalClauses = null) {
			// Use QuerySingle to Perform the Query
			return NarroContextInfo::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::NarroContextInfo()->ContextInfoId, $intContextInfoId)
				),
				$objOptionalClauses
			);
		}

		/**
		 * Load all NarroContextInfos
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			if (func_num_args() > 1) {
				throw new QCallerException("LoadAll must be called with an array of optional clauses as a single argument");
			}
			// Call NarroContextInfo::QueryArray to perform the LoadAll query
			try {
				return NarroContextInfo::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all NarroContextInfos
		 * @return int
		 */
		public static function CountAll() {
			// Call NarroContextInfo::QueryCount to perform the CountAll query
			return NarroContextInfo::QueryCount(QQ::All());
		}




		///////////////////////////////
		// QCUBED QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Internally called method to assist with calling Qcubed Query for this class
		 * on load methods.
		 * @param QQueryBuilder &$objQueryBuilder the QueryBuilder object that will be created
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause object or array of QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with (sending in null will skip the PrepareStatement step)
		 * @param boolean $blnCountOnly only select a rowcount
		 * @return string the query statement
		 */
		protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
			// Get the Database Object for this Class
			$objDatabase = NarroContextInfo::GetDatabase();

			// Create/Build out the QueryBuilder object with NarroContextInfo-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'narro_context_info');
			NarroContextInfo::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('narro_context_info');

			// Set "CountOnly" option (if applicable)
			if ($blnCountOnly)
				$objQueryBuilder->SetCountOnlyFlag();

			// Apply Any Conditions
			if ($objConditions)
				try {
					$objConditions->UpdateQueryBuilder($objQueryBuilder);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			// Iterate through all the Optional Clauses (if any) and perform accordingly
			if ($objOptionalClauses) {
				if ($objOptionalClauses instanceof QQClause)
					$objOptionalClauses->UpdateQueryBuilder($objQueryBuilder);
				else if (is_array($objOptionalClauses))
					foreach ($objOptionalClauses as $objClause)
						$objClause->UpdateQueryBuilder($objQueryBuilder);
				else
					throw new QCallerException('Optional Clauses must be a QQClause object or an array of QQClause objects');
			}

			// Get the SQL Statement
			$strQuery = $objQueryBuilder->GetStatement();

			// Prepare the Statement with the Query Parameters (if applicable)
			if ($mixParameterArray) {
				if (is_array($mixParameterArray)) {
					if (count($mixParameterArray))
						$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

					// Ensure that there are no other Unresolved Named Parameters
					if (strpos($strQuery, chr(QQNamedValue::DelimiterCode) . '{') !== false)
						throw new QCallerException('Unresolved named parameters in the query');
				} else
					throw new QCallerException('Parameter Array must be an array of name-value parameter pairs');
			}

			// Return the Objects
			return $strQuery;
		}

		/**
		 * Static Qcubed Query method to query for a single NarroContextInfo object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return NarroContextInfo the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NarroContextInfo::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new NarroContextInfo object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNodes) {
				$objToReturn = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = NarroContextInfo::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNodes, $objToReturn, $objQueryBuilder->ColumnAliasArray);
					if ($objItem)
						$objToReturn[] = $objItem;
				}
				if (count($objToReturn)) {
					// Since we only want the object to return, lets return the object and not the array.
					return $objToReturn[0];
				} else {
					return null;
				}
			} else {
				// No expands just return the first row
				$objDbRow = $objDbResult->GetNextRow();
				if(null === $objDbRow)
					return null;
				return NarroContextInfo::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcubed Query method to query for an array of NarroContextInfo objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return NarroContextInfo[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NarroContextInfo::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return NarroContextInfo::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes, $objQueryBuilder->ColumnAliasArray);
		}

		/**
		 * Static Qcubed Query method to query for a count of NarroContextInfo objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NarroContextInfo::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and return the row_count
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Figure out if the query is using GroupBy
			$blnGrouped = false;

			if ($objOptionalClauses) foreach ($objOptionalClauses as $objClause) {
				if ($objClause instanceof QQGroupBy) {
					$blnGrouped = true;
					break;
				}
			}

			if ($blnGrouped)
				// Groups in this query - return the count of Groups (which is the count of all rows)
				return $objDbResult->CountRows();
			else {
				// No Groups - return the sql-calculated count(*) value
				$strDbRow = $objDbResult->FetchRow();
				return QType::Cast($strDbRow[0], QType::Integer);
			}
		}

		public static function QueryArrayCached(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = NarroContextInfo::GetDatabase();

			$strQuery = NarroContextInfo::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);

			$objCache = new QCache('qquery/narrocontextinfo', $strQuery);
			$cacheData = $objCache->GetData();

			if (!$cacheData || $blnForceUpdate) {
				$objDbResult = $objQueryBuilder->Database->Query($strQuery);
				$arrResult = NarroContextInfo::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes, $objQueryBuilder->ColumnAliasArray);
				$objCache->SaveData(serialize($arrResult));
			} else {
				$arrResult = unserialize($cacheData);
			}

			return $arrResult;
		}

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this NarroContextInfo
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'narro_context_info';
				$strAliasPrefix = '';
			}

			$objBuilder->AddSelectItem($strTableName, 'context_info_id', $strAliasPrefix . 'context_info_id');
			$objBuilder->AddSelectItem($strTableName, 'context_id', $strAliasPrefix . 'context_id');
			$objBuilder->AddSelectItem($strTableName, 'language_id', $strAliasPrefix . 'language_id');
			$objBuilder->AddSelectItem($strTableName, 'validator_user_id', $strAliasPrefix . 'validator_user_id');
			$objBuilder->AddSelectItem($strTableName, 'valid_suggestion_id', $strAliasPrefix . 'valid_suggestion_id');
			$objBuilder->AddSelectItem($strTableName, 'has_suggestions', $strAliasPrefix . 'has_suggestions');
			$objBuilder->AddSelectItem($strTableName, 'suggestion_access_key', $strAliasPrefix . 'suggestion_access_key');
			$objBuilder->AddSelectItem($strTableName, 'suggestion_command_key', $strAliasPrefix . 'suggestion_command_key');
			$objBuilder->AddSelectItem($strTableName, 'created', $strAliasPrefix . 'created');
			$objBuilder->AddSelectItem($strTableName, 'modified', $strAliasPrefix . 'modified');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a NarroContextInfo from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this NarroContextInfo::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param string $strExpandAsArrayNodes
		 * @param QBaseClass $arrPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return NarroContextInfo
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $arrPreviousItems = null, $strColumnAliasArray = array()) {
			// If blank row, return null
			if (!$objDbRow) {
				return null;
			}

			// Create a new instance of the NarroContextInfo object
			$objToReturn = new NarroContextInfo();
			$objToReturn->__blnRestored = true;

			$strAliasName = array_key_exists($strAliasPrefix . 'context_info_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'context_info_id'] : $strAliasPrefix . 'context_info_id';
			$objToReturn->intContextInfoId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'context_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'context_id'] : $strAliasPrefix . 'context_id';
			$objToReturn->intContextId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'language_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'language_id'] : $strAliasPrefix . 'language_id';
			$objToReturn->intLanguageId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'validator_user_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'validator_user_id'] : $strAliasPrefix . 'validator_user_id';
			$objToReturn->intValidatorUserId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'valid_suggestion_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'valid_suggestion_id'] : $strAliasPrefix . 'valid_suggestion_id';
			$objToReturn->intValidSuggestionId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'has_suggestions', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'has_suggestions'] : $strAliasPrefix . 'has_suggestions';
			$objToReturn->blnHasSuggestions = $objDbRow->GetColumn($strAliasName, 'Bit');
			$strAliasName = array_key_exists($strAliasPrefix . 'suggestion_access_key', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'suggestion_access_key'] : $strAliasPrefix . 'suggestion_access_key';
			$objToReturn->strSuggestionAccessKey = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'suggestion_command_key', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'suggestion_command_key'] : $strAliasPrefix . 'suggestion_command_key';
			$objToReturn->strSuggestionCommandKey = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'created', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'created'] : $strAliasPrefix . 'created';
			$objToReturn->dttCreated = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAliasName = array_key_exists($strAliasPrefix . 'modified', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'modified'] : $strAliasPrefix . 'modified';
			$objToReturn->dttModified = $objDbRow->GetColumn($strAliasName, 'DateTime');

			if (isset($arrPreviousItems) && is_array($arrPreviousItems)) {
				foreach ($arrPreviousItems as $objPreviousItem) {
					if ($objToReturn->ContextInfoId != $objPreviousItem->ContextInfoId) {
						continue;
					}

					// complete match - all primary key columns are the same
					return null;
				}
			}

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'narro_context_info__';

			// Check for Context Early Binding
			$strAlias = $strAliasPrefix . 'context_id__context_id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objContext = NarroContext::InstantiateDbRow($objDbRow, $strAliasPrefix . 'context_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);

			// Check for Language Early Binding
			$strAlias = $strAliasPrefix . 'language_id__language_id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objLanguage = NarroLanguage::InstantiateDbRow($objDbRow, $strAliasPrefix . 'language_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);

			// Check for ValidatorUser Early Binding
			$strAlias = $strAliasPrefix . 'validator_user_id__user_id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objValidatorUser = NarroUser::InstantiateDbRow($objDbRow, $strAliasPrefix . 'validator_user_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);

			// Check for ValidSuggestion Early Binding
			$strAlias = $strAliasPrefix . 'valid_suggestion_id__suggestion_id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objValidSuggestion = NarroSuggestion::InstantiateDbRow($objDbRow, $strAliasPrefix . 'valid_suggestion_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of NarroContextInfos from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param string $strExpandAsArrayNodes
		 * @param string[] $strColumnAliasArray
		 * @return NarroContextInfo[]
		 */
		public static function InstantiateDbResult(QDatabaseResultBase $objDbResult, $strExpandAsArrayNodes = null, $strColumnAliasArray = null) {
			$objToReturn = array();

			if (!$strColumnAliasArray)
				$strColumnAliasArray = array();

			// If blank resultset, then return empty array
			if (!$objDbResult)
				return $objToReturn;

			// Load up the return array with each row
			if ($strExpandAsArrayNodes) {
				$objToReturn = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = NarroContextInfo::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objToReturn, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = NarroContextInfo::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single NarroContextInfo object,
		 * by ContextInfoId Index(es)
		 * @param integer $intContextInfoId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo
		*/
		public static function LoadByContextInfoId($intContextInfoId, $objOptionalClauses = null) {
			return NarroContextInfo::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::NarroContextInfo()->ContextInfoId, $intContextInfoId)
				),
				$objOptionalClauses
			);
		}
			
		/**
		 * Load a single NarroContextInfo object,
		 * by ContextId, LanguageId Index(es)
		 * @param integer $intContextId
		 * @param integer $intLanguageId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo
		*/
		public static function LoadByContextIdLanguageId($intContextId, $intLanguageId, $objOptionalClauses = null) {
			return NarroContextInfo::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::NarroContextInfo()->ContextId, $intContextId),
					QQ::Equal(QQN::NarroContextInfo()->LanguageId, $intLanguageId)
				),
				$objOptionalClauses
			);
		}
			
		/**
		 * Load an array of NarroContextInfo objects,
		 * by ContextId Index(es)
		 * @param integer $intContextId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo[]
		*/
		public static function LoadArrayByContextId($intContextId, $objOptionalClauses = null) {
			// Call NarroContextInfo::QueryArray to perform the LoadArrayByContextId query
			try {
				return NarroContextInfo::QueryArray(
					QQ::Equal(QQN::NarroContextInfo()->ContextId, $intContextId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count NarroContextInfos
		 * by ContextId Index(es)
		 * @param integer $intContextId
		 * @return int
		*/
		public static function CountByContextId($intContextId) {
			// Call NarroContextInfo::QueryCount to perform the CountByContextId query
			return NarroContextInfo::QueryCount(
				QQ::Equal(QQN::NarroContextInfo()->ContextId, $intContextId)
			);
		}
			
		/**
		 * Load an array of NarroContextInfo objects,
		 * by LanguageId Index(es)
		 * @param integer $intLanguageId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo[]
		*/
		public static function LoadArrayByLanguageId($intLanguageId, $objOptionalClauses = null) {
			// Call NarroContextInfo::QueryArray to perform the LoadArrayByLanguageId query
			try {
				return NarroContextInfo::QueryArray(
					QQ::Equal(QQN::NarroContextInfo()->LanguageId, $intLanguageId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count NarroContextInfos
		 * by LanguageId Index(es)
		 * @param integer $intLanguageId
		 * @return int
		*/
		public static function CountByLanguageId($intLanguageId) {
			// Call NarroContextInfo::QueryCount to perform the CountByLanguageId query
			return NarroContextInfo::QueryCount(
				QQ::Equal(QQN::NarroContextInfo()->LanguageId, $intLanguageId)
			);
		}
			
		/**
		 * Load an array of NarroContextInfo objects,
		 * by ValidSuggestionId Index(es)
		 * @param integer $intValidSuggestionId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo[]
		*/
		public static function LoadArrayByValidSuggestionId($intValidSuggestionId, $objOptionalClauses = null) {
			// Call NarroContextInfo::QueryArray to perform the LoadArrayByValidSuggestionId query
			try {
				return NarroContextInfo::QueryArray(
					QQ::Equal(QQN::NarroContextInfo()->ValidSuggestionId, $intValidSuggestionId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count NarroContextInfos
		 * by ValidSuggestionId Index(es)
		 * @param integer $intValidSuggestionId
		 * @return int
		*/
		public static function CountByValidSuggestionId($intValidSuggestionId) {
			// Call NarroContextInfo::QueryCount to perform the CountByValidSuggestionId query
			return NarroContextInfo::QueryCount(
				QQ::Equal(QQN::NarroContextInfo()->ValidSuggestionId, $intValidSuggestionId)
			);
		}
			
		/**
		 * Load an array of NarroContextInfo objects,
		 * by ValidatorUserId Index(es)
		 * @param integer $intValidatorUserId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo[]
		*/
		public static function LoadArrayByValidatorUserId($intValidatorUserId, $objOptionalClauses = null) {
			// Call NarroContextInfo::QueryArray to perform the LoadArrayByValidatorUserId query
			try {
				return NarroContextInfo::QueryArray(
					QQ::Equal(QQN::NarroContextInfo()->ValidatorUserId, $intValidatorUserId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count NarroContextInfos
		 * by ValidatorUserId Index(es)
		 * @param integer $intValidatorUserId
		 * @return int
		*/
		public static function CountByValidatorUserId($intValidatorUserId) {
			// Call NarroContextInfo::QueryCount to perform the CountByValidatorUserId query
			return NarroContextInfo::QueryCount(
				QQ::Equal(QQN::NarroContextInfo()->ValidatorUserId, $intValidatorUserId)
			);
		}
			
		/**
		 * Load an array of NarroContextInfo objects,
		 * by HasSuggestions Index(es)
		 * @param boolean $blnHasSuggestions
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroContextInfo[]
		*/
		public static function LoadArrayByHasSuggestions($blnHasSuggestions, $objOptionalClauses = null) {
			// Call NarroContextInfo::QueryArray to perform the LoadArrayByHasSuggestions query
			try {
				return NarroContextInfo::QueryArray(
					QQ::Equal(QQN::NarroContextInfo()->HasSuggestions, $blnHasSuggestions),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count NarroContextInfos
		 * by HasSuggestions Index(es)
		 * @param boolean $blnHasSuggestions
		 * @return int
		*/
		public static function CountByHasSuggestions($blnHasSuggestions) {
			// Call NarroContextInfo::QueryCount to perform the CountByHasSuggestions query
			return NarroContextInfo::QueryCount(
				QQ::Equal(QQN::NarroContextInfo()->HasSuggestions, $blnHasSuggestions)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////




		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
		 * Save this NarroContextInfo
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = NarroContextInfo::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `narro_context_info` (
							`context_id`,
							`language_id`,
							`validator_user_id`,
							`valid_suggestion_id`,
							`has_suggestions`,
							`suggestion_access_key`,
							`suggestion_command_key`,
							`created`,
							`modified`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intContextId) . ',
							' . $objDatabase->SqlVariable($this->intLanguageId) . ',
							' . $objDatabase->SqlVariable($this->intValidatorUserId) . ',
							' . $objDatabase->SqlVariable($this->intValidSuggestionId) . ',
							' . $objDatabase->SqlVariable($this->blnHasSuggestions) . ',
							' . $objDatabase->SqlVariable($this->strSuggestionAccessKey) . ',
							' . $objDatabase->SqlVariable($this->strSuggestionCommandKey) . ',
							' . $objDatabase->SqlVariable($this->dttCreated) . ',
							' . $objDatabase->SqlVariable($this->dttModified) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intContextInfoId = $objDatabase->InsertId('narro_context_info', 'context_info_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`narro_context_info`
						SET
							`context_id` = ' . $objDatabase->SqlVariable($this->intContextId) . ',
							`language_id` = ' . $objDatabase->SqlVariable($this->intLanguageId) . ',
							`validator_user_id` = ' . $objDatabase->SqlVariable($this->intValidatorUserId) . ',
							`valid_suggestion_id` = ' . $objDatabase->SqlVariable($this->intValidSuggestionId) . ',
							`has_suggestions` = ' . $objDatabase->SqlVariable($this->blnHasSuggestions) . ',
							`suggestion_access_key` = ' . $objDatabase->SqlVariable($this->strSuggestionAccessKey) . ',
							`suggestion_command_key` = ' . $objDatabase->SqlVariable($this->strSuggestionCommandKey) . ',
							`created` = ' . $objDatabase->SqlVariable($this->dttCreated) . ',
							`modified` = ' . $objDatabase->SqlVariable($this->dttModified) . '
						WHERE
							`context_info_id` = ' . $objDatabase->SqlVariable($this->intContextInfoId) . '
					');
				}

			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Update __blnRestored and any Non-Identity PK Columns (if applicable)
			$this->__blnRestored = true;


			// Return
			return $mixToReturn;
		}

		/**
		 * Delete this NarroContextInfo
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intContextInfoId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this NarroContextInfo with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = NarroContextInfo::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_context_info`
				WHERE
					`context_info_id` = ' . $objDatabase->SqlVariable($this->intContextInfoId) . '');
		}

		/**
		 * Delete all NarroContextInfos
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = NarroContextInfo::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_context_info`');
		}

		/**
		 * Truncate narro_context_info table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = NarroContextInfo::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `narro_context_info`');
		}

		/**
		 * Reload this NarroContextInfo from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved NarroContextInfo object.');

			// Reload the Object
			$objReloaded = NarroContextInfo::Load($this->intContextInfoId);

			// Update $this's local variables to match
			$this->ContextId = $objReloaded->ContextId;
			$this->LanguageId = $objReloaded->LanguageId;
			$this->ValidatorUserId = $objReloaded->ValidatorUserId;
			$this->ValidSuggestionId = $objReloaded->ValidSuggestionId;
			$this->blnHasSuggestions = $objReloaded->blnHasSuggestions;
			$this->strSuggestionAccessKey = $objReloaded->strSuggestionAccessKey;
			$this->strSuggestionCommandKey = $objReloaded->strSuggestionCommandKey;
			$this->dttCreated = $objReloaded->dttCreated;
			$this->dttModified = $objReloaded->dttModified;
		}



		////////////////////
		// PUBLIC OVERRIDERS
		////////////////////

				/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'ContextInfoId':
					/**
					 * Gets the value for intContextInfoId (Read-Only PK)
					 * @return integer
					 */
					return $this->intContextInfoId;

				case 'ContextId':
					/**
					 * Gets the value for intContextId (Not Null)
					 * @return integer
					 */
					return $this->intContextId;

				case 'LanguageId':
					/**
					 * Gets the value for intLanguageId (Not Null)
					 * @return integer
					 */
					return $this->intLanguageId;

				case 'ValidatorUserId':
					/**
					 * Gets the value for intValidatorUserId 
					 * @return integer
					 */
					return $this->intValidatorUserId;

				case 'ValidSuggestionId':
					/**
					 * Gets the value for intValidSuggestionId 
					 * @return integer
					 */
					return $this->intValidSuggestionId;

				case 'HasSuggestions':
					/**
					 * Gets the value for blnHasSuggestions 
					 * @return boolean
					 */
					return $this->blnHasSuggestions;

				case 'SuggestionAccessKey':
					/**
					 * Gets the value for strSuggestionAccessKey 
					 * @return string
					 */
					return $this->strSuggestionAccessKey;

				case 'SuggestionCommandKey':
					/**
					 * Gets the value for strSuggestionCommandKey 
					 * @return string
					 */
					return $this->strSuggestionCommandKey;

				case 'Created':
					/**
					 * Gets the value for dttCreated (Not Null)
					 * @return QDateTime
					 */
					return $this->dttCreated;

				case 'Modified':
					/**
					 * Gets the value for dttModified 
					 * @return QDateTime
					 */
					return $this->dttModified;


				///////////////////
				// Member Objects
				///////////////////
				case 'Context':
					/**
					 * Gets the value for the NarroContext object referenced by intContextId (Not Null)
					 * @return NarroContext
					 */
					try {
						if ((!$this->objContext) && (!is_null($this->intContextId)))
							$this->objContext = NarroContext::Load($this->intContextId);
						return $this->objContext;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Language':
					/**
					 * Gets the value for the NarroLanguage object referenced by intLanguageId (Not Null)
					 * @return NarroLanguage
					 */
					try {
						if ((!$this->objLanguage) && (!is_null($this->intLanguageId)))
							$this->objLanguage = NarroLanguage::Load($this->intLanguageId);
						return $this->objLanguage;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ValidatorUser':
					/**
					 * Gets the value for the NarroUser object referenced by intValidatorUserId 
					 * @return NarroUser
					 */
					try {
						if ((!$this->objValidatorUser) && (!is_null($this->intValidatorUserId)))
							$this->objValidatorUser = NarroUser::Load($this->intValidatorUserId);
						return $this->objValidatorUser;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ValidSuggestion':
					/**
					 * Gets the value for the NarroSuggestion object referenced by intValidSuggestionId 
					 * @return NarroSuggestion
					 */
					try {
						if ((!$this->objValidSuggestion) && (!is_null($this->intValidSuggestionId)))
							$this->objValidSuggestion = NarroSuggestion::Load($this->intValidSuggestionId);
						return $this->objValidSuggestion;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////


				case '__Restored':
					return $this->__blnRestored;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

				/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'ContextId':
					/**
					 * Sets the value for intContextId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objContext = null;
						return ($this->intContextId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LanguageId':
					/**
					 * Sets the value for intLanguageId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objLanguage = null;
						return ($this->intLanguageId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ValidatorUserId':
					/**
					 * Sets the value for intValidatorUserId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objValidatorUser = null;
						return ($this->intValidatorUserId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ValidSuggestionId':
					/**
					 * Sets the value for intValidSuggestionId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objValidSuggestion = null;
						return ($this->intValidSuggestionId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HasSuggestions':
					/**
					 * Sets the value for blnHasSuggestions 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnHasSuggestions = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SuggestionAccessKey':
					/**
					 * Sets the value for strSuggestionAccessKey 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strSuggestionAccessKey = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SuggestionCommandKey':
					/**
					 * Sets the value for strSuggestionCommandKey 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strSuggestionCommandKey = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Created':
					/**
					 * Sets the value for dttCreated (Not Null)
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttCreated = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Modified':
					/**
					 * Sets the value for dttModified 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttModified = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Context':
					/**
					 * Sets the value for the NarroContext object referenced by intContextId (Not Null)
					 * @param NarroContext $mixValue
					 * @return NarroContext
					 */
					if (is_null($mixValue)) {
						$this->intContextId = null;
						$this->objContext = null;
						return null;
					} else {
						// Make sure $mixValue actually is a NarroContext object
						try {
							$mixValue = QType::Cast($mixValue, 'NarroContext');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED NarroContext object
						if (is_null($mixValue->ContextId))
							throw new QCallerException('Unable to set an unsaved Context for this NarroContextInfo');

						// Update Local Member Variables
						$this->objContext = $mixValue;
						$this->intContextId = $mixValue->ContextId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Language':
					/**
					 * Sets the value for the NarroLanguage object referenced by intLanguageId (Not Null)
					 * @param NarroLanguage $mixValue
					 * @return NarroLanguage
					 */
					if (is_null($mixValue)) {
						$this->intLanguageId = null;
						$this->objLanguage = null;
						return null;
					} else {
						// Make sure $mixValue actually is a NarroLanguage object
						try {
							$mixValue = QType::Cast($mixValue, 'NarroLanguage');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED NarroLanguage object
						if (is_null($mixValue->LanguageId))
							throw new QCallerException('Unable to set an unsaved Language for this NarroContextInfo');

						// Update Local Member Variables
						$this->objLanguage = $mixValue;
						$this->intLanguageId = $mixValue->LanguageId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ValidatorUser':
					/**
					 * Sets the value for the NarroUser object referenced by intValidatorUserId 
					 * @param NarroUser $mixValue
					 * @return NarroUser
					 */
					if (is_null($mixValue)) {
						$this->intValidatorUserId = null;
						$this->objValidatorUser = null;
						return null;
					} else {
						// Make sure $mixValue actually is a NarroUser object
						try {
							$mixValue = QType::Cast($mixValue, 'NarroUser');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED NarroUser object
						if (is_null($mixValue->UserId))
							throw new QCallerException('Unable to set an unsaved ValidatorUser for this NarroContextInfo');

						// Update Local Member Variables
						$this->objValidatorUser = $mixValue;
						$this->intValidatorUserId = $mixValue->UserId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ValidSuggestion':
					/**
					 * Sets the value for the NarroSuggestion object referenced by intValidSuggestionId 
					 * @param NarroSuggestion $mixValue
					 * @return NarroSuggestion
					 */
					if (is_null($mixValue)) {
						$this->intValidSuggestionId = null;
						$this->objValidSuggestion = null;
						return null;
					} else {
						// Make sure $mixValue actually is a NarroSuggestion object
						try {
							$mixValue = QType::Cast($mixValue, 'NarroSuggestion');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED NarroSuggestion object
						if (is_null($mixValue->SuggestionId))
							throw new QCallerException('Unable to set an unsaved ValidSuggestion for this NarroContextInfo');

						// Update Local Member Variables
						$this->objValidSuggestion = $mixValue;
						$this->intValidSuggestionId = $mixValue->SuggestionId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Lookup a VirtualAttribute value (if applicable).  Returns NULL if none found.
		 * @param string $strName
		 * @return string
		 */
		public function GetVirtualAttribute($strName) {
			if (array_key_exists($strName, $this->__strVirtualAttributeArray))
				return $this->__strVirtualAttributeArray[$strName];
			return null;
		}



		///////////////////////////////
		// ASSOCIATED OBJECTS' METHODS
		///////////////////////////////





		////////////////////////////////////////
		// METHODS for SOAP-BASED WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="NarroContextInfo"><sequence>';
			$strToReturn .= '<element name="ContextInfoId" type="xsd:int"/>';
			$strToReturn .= '<element name="Context" type="xsd1:NarroContext"/>';
			$strToReturn .= '<element name="Language" type="xsd1:NarroLanguage"/>';
			$strToReturn .= '<element name="ValidatorUser" type="xsd1:NarroUser"/>';
			$strToReturn .= '<element name="ValidSuggestion" type="xsd1:NarroSuggestion"/>';
			$strToReturn .= '<element name="HasSuggestions" type="xsd:boolean"/>';
			$strToReturn .= '<element name="SuggestionAccessKey" type="xsd:string"/>';
			$strToReturn .= '<element name="SuggestionCommandKey" type="xsd:string"/>';
			$strToReturn .= '<element name="Created" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="Modified" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('NarroContextInfo', $strComplexTypeArray)) {
				$strComplexTypeArray['NarroContextInfo'] = NarroContextInfo::GetSoapComplexTypeXml();
				NarroContext::AlterSoapComplexTypeArray($strComplexTypeArray);
				NarroLanguage::AlterSoapComplexTypeArray($strComplexTypeArray);
				NarroUser::AlterSoapComplexTypeArray($strComplexTypeArray);
				NarroSuggestion::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, NarroContextInfo::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new NarroContextInfo();
			if (property_exists($objSoapObject, 'ContextInfoId'))
				$objToReturn->intContextInfoId = $objSoapObject->ContextInfoId;
			if ((property_exists($objSoapObject, 'Context')) &&
				($objSoapObject->Context))
				$objToReturn->Context = NarroContext::GetObjectFromSoapObject($objSoapObject->Context);
			if ((property_exists($objSoapObject, 'Language')) &&
				($objSoapObject->Language))
				$objToReturn->Language = NarroLanguage::GetObjectFromSoapObject($objSoapObject->Language);
			if ((property_exists($objSoapObject, 'ValidatorUser')) &&
				($objSoapObject->ValidatorUser))
				$objToReturn->ValidatorUser = NarroUser::GetObjectFromSoapObject($objSoapObject->ValidatorUser);
			if ((property_exists($objSoapObject, 'ValidSuggestion')) &&
				($objSoapObject->ValidSuggestion))
				$objToReturn->ValidSuggestion = NarroSuggestion::GetObjectFromSoapObject($objSoapObject->ValidSuggestion);
			if (property_exists($objSoapObject, 'HasSuggestions'))
				$objToReturn->blnHasSuggestions = $objSoapObject->HasSuggestions;
			if (property_exists($objSoapObject, 'SuggestionAccessKey'))
				$objToReturn->strSuggestionAccessKey = $objSoapObject->SuggestionAccessKey;
			if (property_exists($objSoapObject, 'SuggestionCommandKey'))
				$objToReturn->strSuggestionCommandKey = $objSoapObject->SuggestionCommandKey;
			if (property_exists($objSoapObject, 'Created'))
				$objToReturn->dttCreated = new QDateTime($objSoapObject->Created);
			if (property_exists($objSoapObject, 'Modified'))
				$objToReturn->dttModified = new QDateTime($objSoapObject->Modified);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, NarroContextInfo::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objContext)
				$objObject->objContext = NarroContext::GetSoapObjectFromObject($objObject->objContext, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intContextId = null;
			if ($objObject->objLanguage)
				$objObject->objLanguage = NarroLanguage::GetSoapObjectFromObject($objObject->objLanguage, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intLanguageId = null;
			if ($objObject->objValidatorUser)
				$objObject->objValidatorUser = NarroUser::GetSoapObjectFromObject($objObject->objValidatorUser, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intValidatorUserId = null;
			if ($objObject->objValidSuggestion)
				$objObject->objValidSuggestion = NarroSuggestion::GetSoapObjectFromObject($objObject->objValidSuggestion, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intValidSuggestionId = null;
			if ($objObject->dttCreated)
				$objObject->dttCreated = $objObject->dttCreated->qFormat(QDateTime::FormatSoap);
			if ($objObject->dttModified)
				$objObject->dttModified = $objObject->dttModified->qFormat(QDateTime::FormatSoap);
			return $objObject;
		}


		////////////////////////////////////////
		// METHODS for JSON Object Translation
		////////////////////////////////////////

		// this function is required for objects that implement the
		// IteratorAggregate interface
		public function getIterator() {
			///////////////////
			// Member Variables
			///////////////////
			$iArray['ContextInfoId'] = $this->intContextInfoId;
			$iArray['ContextId'] = $this->intContextId;
			$iArray['LanguageId'] = $this->intLanguageId;
			$iArray['ValidatorUserId'] = $this->intValidatorUserId;
			$iArray['ValidSuggestionId'] = $this->intValidSuggestionId;
			$iArray['HasSuggestions'] = $this->blnHasSuggestions;
			$iArray['SuggestionAccessKey'] = $this->strSuggestionAccessKey;
			$iArray['SuggestionCommandKey'] = $this->strSuggestionCommandKey;
			$iArray['Created'] = $this->dttCreated;
			$iArray['Modified'] = $this->dttModified;
			return new ArrayIterator($iArray);
		}

		// this function returns a Json formatted string using the
		// IteratorAggregate interface
		public function getJson() {
			return json_encode($this->getIterator());
		}


	}



	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCubed QUERY
	/////////////////////////////////////

    /**
     * @uses QQNode
     *
     * @property-read QQNode $ContextInfoId
     * @property-read QQNode $ContextId
     * @property-read QQNodeNarroContext $Context
     * @property-read QQNode $LanguageId
     * @property-read QQNodeNarroLanguage $Language
     * @property-read QQNode $ValidatorUserId
     * @property-read QQNodeNarroUser $ValidatorUser
     * @property-read QQNode $ValidSuggestionId
     * @property-read QQNodeNarroSuggestion $ValidSuggestion
     * @property-read QQNode $HasSuggestions
     * @property-read QQNode $SuggestionAccessKey
     * @property-read QQNode $SuggestionCommandKey
     * @property-read QQNode $Created
     * @property-read QQNode $Modified
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQNodeNarroContextInfo extends QQNode {
		protected $strTableName = 'narro_context_info';
		protected $strPrimaryKey = 'context_info_id';
		protected $strClassName = 'NarroContextInfo';
		public function __get($strName) {
			switch ($strName) {
				case 'ContextInfoId':
					return new QQNode('context_info_id', 'ContextInfoId', 'Integer', $this);
				case 'ContextId':
					return new QQNode('context_id', 'ContextId', 'Integer', $this);
				case 'Context':
					return new QQNodeNarroContext('context_id', 'Context', 'Integer', $this);
				case 'LanguageId':
					return new QQNode('language_id', 'LanguageId', 'Integer', $this);
				case 'Language':
					return new QQNodeNarroLanguage('language_id', 'Language', 'Integer', $this);
				case 'ValidatorUserId':
					return new QQNode('validator_user_id', 'ValidatorUserId', 'Integer', $this);
				case 'ValidatorUser':
					return new QQNodeNarroUser('validator_user_id', 'ValidatorUser', 'Integer', $this);
				case 'ValidSuggestionId':
					return new QQNode('valid_suggestion_id', 'ValidSuggestionId', 'Integer', $this);
				case 'ValidSuggestion':
					return new QQNodeNarroSuggestion('valid_suggestion_id', 'ValidSuggestion', 'Integer', $this);
				case 'HasSuggestions':
					return new QQNode('has_suggestions', 'HasSuggestions', 'Bit', $this);
				case 'SuggestionAccessKey':
					return new QQNode('suggestion_access_key', 'SuggestionAccessKey', 'VarChar', $this);
				case 'SuggestionCommandKey':
					return new QQNode('suggestion_command_key', 'SuggestionCommandKey', 'VarChar', $this);
				case 'Created':
					return new QQNode('created', 'Created', 'DateTime', $this);
				case 'Modified':
					return new QQNode('modified', 'Modified', 'DateTime', $this);

				case '_PrimaryKeyNode':
					return new QQNode('context_info_id', 'ContextInfoId', 'Integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

    /**
     * @property-read QQNode $ContextInfoId
     * @property-read QQNode $ContextId
     * @property-read QQNodeNarroContext $Context
     * @property-read QQNode $LanguageId
     * @property-read QQNodeNarroLanguage $Language
     * @property-read QQNode $ValidatorUserId
     * @property-read QQNodeNarroUser $ValidatorUser
     * @property-read QQNode $ValidSuggestionId
     * @property-read QQNodeNarroSuggestion $ValidSuggestion
     * @property-read QQNode $HasSuggestions
     * @property-read QQNode $SuggestionAccessKey
     * @property-read QQNode $SuggestionCommandKey
     * @property-read QQNode $Created
     * @property-read QQNode $Modified
     *
     *

     * @property-read QQNode $_PrimaryKeyNode
     **/
	class QQReverseReferenceNodeNarroContextInfo extends QQReverseReferenceNode {
		protected $strTableName = 'narro_context_info';
		protected $strPrimaryKey = 'context_info_id';
		protected $strClassName = 'NarroContextInfo';
		public function __get($strName) {
			switch ($strName) {
				case 'ContextInfoId':
					return new QQNode('context_info_id', 'ContextInfoId', 'integer', $this);
				case 'ContextId':
					return new QQNode('context_id', 'ContextId', 'integer', $this);
				case 'Context':
					return new QQNodeNarroContext('context_id', 'Context', 'integer', $this);
				case 'LanguageId':
					return new QQNode('language_id', 'LanguageId', 'integer', $this);
				case 'Language':
					return new QQNodeNarroLanguage('language_id', 'Language', 'integer', $this);
				case 'ValidatorUserId':
					return new QQNode('validator_user_id', 'ValidatorUserId', 'integer', $this);
				case 'ValidatorUser':
					return new QQNodeNarroUser('validator_user_id', 'ValidatorUser', 'integer', $this);
				case 'ValidSuggestionId':
					return new QQNode('valid_suggestion_id', 'ValidSuggestionId', 'integer', $this);
				case 'ValidSuggestion':
					return new QQNodeNarroSuggestion('valid_suggestion_id', 'ValidSuggestion', 'integer', $this);
				case 'HasSuggestions':
					return new QQNode('has_suggestions', 'HasSuggestions', 'boolean', $this);
				case 'SuggestionAccessKey':
					return new QQNode('suggestion_access_key', 'SuggestionAccessKey', 'string', $this);
				case 'SuggestionCommandKey':
					return new QQNode('suggestion_command_key', 'SuggestionCommandKey', 'string', $this);
				case 'Created':
					return new QQNode('created', 'Created', 'QDateTime', $this);
				case 'Modified':
					return new QQNode('modified', 'Modified', 'QDateTime', $this);

				case '_PrimaryKeyNode':
					return new QQNode('context_info_id', 'ContextInfoId', 'integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

?>
