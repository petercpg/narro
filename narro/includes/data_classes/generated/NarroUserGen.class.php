<?php
	/**
	 * The abstract NarroUserGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the NarroUser subclass which
	 * extends this NarroUserGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the NarroUser class.
	 * 
	 * @package Narro
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class NarroUserGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a NarroUser from PK Info
		 * @param integer $intUserId
		 * @return NarroUser
		 */
		public static function Load($intUserId) {
			// Use QuerySingle to Perform the Query
			return NarroUser::QuerySingle(
				QQ::Equal(QQN::NarroUser()->UserId, $intUserId)
			);
		}

		/**
		 * Load all NarroUsers
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroUser[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call NarroUser::QueryArray to perform the LoadAll query
			try {
				return NarroUser::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all NarroUsers
		 * @return int
		 */
		public static function CountAll() {
			// Call NarroUser::QueryCount to perform the CountAll query
			return NarroUser::QueryCount(QQ::All());
		}



		///////////////////////////////
		// QCODO QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return QDatabaseBase reference to the Database object that can query this class
		 */
		public static function GetDatabase() {
			return QApplication::$Database[1];
		}

		/**
		 * Internally called method to assist with calling Qcodo Query for this class
		 * on load methods.
		 * @param QQueryBuilder &$objQueryBuilder the QueryBuilder object that will be created
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with (sending in null will skip the PrepareStatement step)
		 * @param boolean $blnCountOnly only select a rowcount
		 * @return string the query statement
		 */
		protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Create/Build out the QueryBuilder object with NarroUser-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'narro_user');
			NarroUser::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`narro_user` AS `narro_user`');

			// Set "CountOnly" option (if applicable)
			if ($blnCountOnly)
				$objQueryBuilder->SetCountOnlyFlag();

			// Apply Any Conditions
			if ($objConditions)
				$objConditions->UpdateQueryBuilder($objQueryBuilder);

			// Iterate through all the Optional Clauses (if any) and perform accordingly
			if ($objOptionalClauses) {
				if (!is_array($objOptionalClauses))
					throw new QCallerException('Optional Clauses must be a QQ::Clause() or an array of QQClause objects');
				foreach ($objOptionalClauses as $objClause)
					$objClause->UpdateQueryBuilder($objQueryBuilder);
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
		 * Static Qcodo Query method to query for a single NarroUser object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return NarroUser the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NarroUser::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new NarroUser object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return NarroUser::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of NarroUser objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return NarroUser[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NarroUser::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return NarroUser::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of NarroUser objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NarroUser::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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

/*		public static function QueryArrayCached($strConditions, $mixParameterArray = null) {
			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'narro_user_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with NarroUser-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				NarroUser::GetSelectFields($objQueryBuilder);
				NarroUser::GetFromFields($objQueryBuilder);

				// Ensure the Passed-in Conditions is a string
				try {
					$strConditions = QType::Cast($strConditions, QType::String);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				// Create the Conditions object, and apply it
				$objConditions = eval('return ' . $strConditions . ';');

				// Apply Any Conditions
				if ($objConditions)
					$objConditions->UpdateQueryBuilder($objQueryBuilder);

				// Get the SQL Statement
				$strQuery = $objQueryBuilder->GetStatement();

				// Save the SQL Statement in the Cache
				$objCache->SaveData($strQuery);
			}

			// Prepare the Statement with the Parameters
			if ($mixParameterArray)
				$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objDatabase->Query($strQuery);
			return NarroUser::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this NarroUser
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`narro_user`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`user_id` AS ' . $strAliasPrefix . 'user_id`');
			$objBuilder->AddSelectItem($strTableName . '.`username` AS ' . $strAliasPrefix . 'username`');
			$objBuilder->AddSelectItem($strTableName . '.`password` AS ' . $strAliasPrefix . 'password`');
			$objBuilder->AddSelectItem($strTableName . '.`email` AS ' . $strAliasPrefix . 'email`');
			$objBuilder->AddSelectItem($strTableName . '.`data` AS ' . $strAliasPrefix . 'data`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a NarroUser from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this NarroUser::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return NarroUser
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intUserId == $objDbRow->GetColumn($strAliasPrefix . 'user_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'narro_user__';


				if ((array_key_exists($strAliasPrefix . 'narrosuggestioncommentasuser__comment_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrosuggestioncommentasuser__comment_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objNarroSuggestionCommentAsUserArray)) {
						$objPreviousChildItem = $objPreviousItem->_objNarroSuggestionCommentAsUserArray[$intPreviousChildItemCount - 1];
						$objChildItem = NarroSuggestionComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrosuggestioncommentasuser__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objNarroSuggestionCommentAsUserArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objNarroSuggestionCommentAsUserArray, NarroSuggestionComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrosuggestioncommentasuser__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'narrosuggestionvoteasuser__suggestion_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrosuggestionvoteasuser__suggestion_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objNarroSuggestionVoteAsUserArray)) {
						$objPreviousChildItem = $objPreviousItem->_objNarroSuggestionVoteAsUserArray[$intPreviousChildItemCount - 1];
						$objChildItem = NarroSuggestionVote::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrosuggestionvoteasuser__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objNarroSuggestionVoteAsUserArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objNarroSuggestionVoteAsUserArray, NarroSuggestionVote::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrosuggestionvoteasuser__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'narrotextcontextcommentasuser__comment_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrotextcontextcommentasuser__comment_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objNarroTextContextCommentAsUserArray)) {
						$objPreviousChildItem = $objPreviousItem->_objNarroTextContextCommentAsUserArray[$intPreviousChildItemCount - 1];
						$objChildItem = NarroTextContextComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrotextcontextcommentasuser__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objNarroTextContextCommentAsUserArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objNarroTextContextCommentAsUserArray, NarroTextContextComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrotextcontextcommentasuser__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'narrotextsuggestionasuser__suggestion_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrotextsuggestionasuser__suggestion_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objNarroTextSuggestionAsUserArray)) {
						$objPreviousChildItem = $objPreviousItem->_objNarroTextSuggestionAsUserArray[$intPreviousChildItemCount - 1];
						$objChildItem = NarroTextSuggestion::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrotextsuggestionasuser__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objNarroTextSuggestionAsUserArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objNarroTextSuggestionAsUserArray, NarroTextSuggestion::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrotextsuggestionasuser__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'narrouserpermissionasuser__user_permission_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrouserpermissionasuser__user_permission_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objNarroUserPermissionAsUserArray)) {
						$objPreviousChildItem = $objPreviousItem->_objNarroUserPermissionAsUserArray[$intPreviousChildItemCount - 1];
						$objChildItem = NarroUserPermission::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrouserpermissionasuser__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objNarroUserPermissionAsUserArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objNarroUserPermissionAsUserArray, NarroUserPermission::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrouserpermissionasuser__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'narro_user__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the NarroUser object
			$objToReturn = new NarroUser();
			$objToReturn->__blnRestored = true;

			$objToReturn->intUserId = $objDbRow->GetColumn($strAliasPrefix . 'user_id', 'Integer');
			$objToReturn->__intUserId = $objDbRow->GetColumn($strAliasPrefix . 'user_id', 'Integer');
			$objToReturn->strUsername = $objDbRow->GetColumn($strAliasPrefix . 'username', 'VarChar');
			$objToReturn->strPassword = $objDbRow->GetColumn($strAliasPrefix . 'password', 'VarChar');
			$objToReturn->strEmail = $objDbRow->GetColumn($strAliasPrefix . 'email', 'VarChar');
			$objToReturn->strData = $objDbRow->GetColumn($strAliasPrefix . 'data', 'Blob');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'narro_user__';




			// Check for NarroSuggestionCommentAsUser Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrosuggestioncommentasuser__comment_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'narrosuggestioncommentasuser__comment_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objNarroSuggestionCommentAsUserArray, NarroSuggestionComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrosuggestioncommentasuser__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objNarroSuggestionCommentAsUser = NarroSuggestionComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrosuggestioncommentasuser__', $strExpandAsArrayNodes);
			}

			// Check for NarroSuggestionVoteAsUser Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrosuggestionvoteasuser__suggestion_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'narrosuggestionvoteasuser__suggestion_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objNarroSuggestionVoteAsUserArray, NarroSuggestionVote::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrosuggestionvoteasuser__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objNarroSuggestionVoteAsUser = NarroSuggestionVote::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrosuggestionvoteasuser__', $strExpandAsArrayNodes);
			}

			// Check for NarroTextContextCommentAsUser Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrotextcontextcommentasuser__comment_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'narrotextcontextcommentasuser__comment_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objNarroTextContextCommentAsUserArray, NarroTextContextComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrotextcontextcommentasuser__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objNarroTextContextCommentAsUser = NarroTextContextComment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrotextcontextcommentasuser__', $strExpandAsArrayNodes);
			}

			// Check for NarroTextSuggestionAsUser Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrotextsuggestionasuser__suggestion_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'narrotextsuggestionasuser__suggestion_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objNarroTextSuggestionAsUserArray, NarroTextSuggestion::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrotextsuggestionasuser__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objNarroTextSuggestionAsUser = NarroTextSuggestion::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrotextsuggestionasuser__', $strExpandAsArrayNodes);
			}

			// Check for NarroUserPermissionAsUser Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'narrouserpermissionasuser__user_permission_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'narrouserpermissionasuser__user_permission_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objNarroUserPermissionAsUserArray, NarroUserPermission::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrouserpermissionasuser__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objNarroUserPermissionAsUser = NarroUserPermission::InstantiateDbRow($objDbRow, $strAliasPrefix . 'narrouserpermissionasuser__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of NarroUsers from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return NarroUser[]
		 */
		public static function InstantiateDbResult(QDatabaseResultBase $objDbResult, $strExpandAsArrayNodes = null) {
			$objToReturn = array();

			// If blank resultset, then return empty array
			if (!$objDbResult)
				return $objToReturn;

			// Load up the return array with each row
			if ($strExpandAsArrayNodes) {
				$objLastRowItem = null;
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = NarroUser::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, NarroUser::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single NarroUser object,
		 * by UserId Index(es)
		 * @param integer $intUserId
		 * @return NarroUser
		*/
		public static function LoadByUserId($intUserId) {
			return NarroUser::QuerySingle(
				QQ::Equal(QQN::NarroUser()->UserId, $intUserId)
			);
		}
			
		/**
		 * Load a single NarroUser object,
		 * by Username Index(es)
		 * @param string $strUsername
		 * @return NarroUser
		*/
		public static function LoadByUsername($strUsername) {
			return NarroUser::QuerySingle(
				QQ::Equal(QQN::NarroUser()->Username, $strUsername)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this NarroUser
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return void
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `narro_user` (
							`user_id`,
							`username`,
							`password`,
							`email`,
							`data`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intUserId) . ',
							' . $objDatabase->SqlVariable($this->strUsername) . ',
							' . $objDatabase->SqlVariable($this->strPassword) . ',
							' . $objDatabase->SqlVariable($this->strEmail) . ',
							' . $objDatabase->SqlVariable($this->strData) . '
						)
					');


				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`narro_user`
						SET
							`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . ',
							`username` = ' . $objDatabase->SqlVariable($this->strUsername) . ',
							`password` = ' . $objDatabase->SqlVariable($this->strPassword) . ',
							`email` = ' . $objDatabase->SqlVariable($this->strEmail) . ',
							`data` = ' . $objDatabase->SqlVariable($this->strData) . '
						WHERE
							`user_id` = ' . $objDatabase->SqlVariable($this->__intUserId) . '
					');
				}

			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Update __blnRestored and any Non-Identity PK Columns (if applicable)
			$this->__blnRestored = true;
			$this->__intUserId = $this->intUserId;


			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this NarroUser
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this NarroUser with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_user`
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '');
		}

		/**
		 * Delete all NarroUsers
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_user`');
		}

		/**
		 * Truncate narro_user table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `narro_user`');
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
				case 'UserId':
					/**
					 * Gets the value for intUserId (PK)
					 * @return integer
					 */
					return $this->intUserId;

				case 'Username':
					/**
					 * Gets the value for strUsername (Unique)
					 * @return string
					 */
					return $this->strUsername;

				case 'Password':
					/**
					 * Gets the value for strPassword (Not Null)
					 * @return string
					 */
					return $this->strPassword;

				case 'Email':
					/**
					 * Gets the value for strEmail (Not Null)
					 * @return string
					 */
					return $this->strEmail;

				case 'Data':
					/**
					 * Gets the value for strData 
					 * @return string
					 */
					return $this->strData;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_NarroSuggestionCommentAsUser':
					/**
					 * Gets the value for the private _objNarroSuggestionCommentAsUser (Read-Only)
					 * if set due to an expansion on the narro_suggestion_comment.user_id reverse relationship
					 * @return NarroSuggestionComment
					 */
					return $this->_objNarroSuggestionCommentAsUser;

				case '_NarroSuggestionCommentAsUserArray':
					/**
					 * Gets the value for the private _objNarroSuggestionCommentAsUserArray (Read-Only)
					 * if set due to an ExpandAsArray on the narro_suggestion_comment.user_id reverse relationship
					 * @return NarroSuggestionComment[]
					 */
					return (array) $this->_objNarroSuggestionCommentAsUserArray;

				case '_NarroSuggestionVoteAsUser':
					/**
					 * Gets the value for the private _objNarroSuggestionVoteAsUser (Read-Only)
					 * if set due to an expansion on the narro_suggestion_vote.user_id reverse relationship
					 * @return NarroSuggestionVote
					 */
					return $this->_objNarroSuggestionVoteAsUser;

				case '_NarroSuggestionVoteAsUserArray':
					/**
					 * Gets the value for the private _objNarroSuggestionVoteAsUserArray (Read-Only)
					 * if set due to an ExpandAsArray on the narro_suggestion_vote.user_id reverse relationship
					 * @return NarroSuggestionVote[]
					 */
					return (array) $this->_objNarroSuggestionVoteAsUserArray;

				case '_NarroTextContextCommentAsUser':
					/**
					 * Gets the value for the private _objNarroTextContextCommentAsUser (Read-Only)
					 * if set due to an expansion on the narro_text_context_comment.user_id reverse relationship
					 * @return NarroTextContextComment
					 */
					return $this->_objNarroTextContextCommentAsUser;

				case '_NarroTextContextCommentAsUserArray':
					/**
					 * Gets the value for the private _objNarroTextContextCommentAsUserArray (Read-Only)
					 * if set due to an ExpandAsArray on the narro_text_context_comment.user_id reverse relationship
					 * @return NarroTextContextComment[]
					 */
					return (array) $this->_objNarroTextContextCommentAsUserArray;

				case '_NarroTextSuggestionAsUser':
					/**
					 * Gets the value for the private _objNarroTextSuggestionAsUser (Read-Only)
					 * if set due to an expansion on the narro_text_suggestion.user_id reverse relationship
					 * @return NarroTextSuggestion
					 */
					return $this->_objNarroTextSuggestionAsUser;

				case '_NarroTextSuggestionAsUserArray':
					/**
					 * Gets the value for the private _objNarroTextSuggestionAsUserArray (Read-Only)
					 * if set due to an ExpandAsArray on the narro_text_suggestion.user_id reverse relationship
					 * @return NarroTextSuggestion[]
					 */
					return (array) $this->_objNarroTextSuggestionAsUserArray;

				case '_NarroUserPermissionAsUser':
					/**
					 * Gets the value for the private _objNarroUserPermissionAsUser (Read-Only)
					 * if set due to an expansion on the narro_user_permission.user_id reverse relationship
					 * @return NarroUserPermission
					 */
					return $this->_objNarroUserPermissionAsUser;

				case '_NarroUserPermissionAsUserArray':
					/**
					 * Gets the value for the private _objNarroUserPermissionAsUserArray (Read-Only)
					 * if set due to an ExpandAsArray on the narro_user_permission.user_id reverse relationship
					 * @return NarroUserPermission[]
					 */
					return (array) $this->_objNarroUserPermissionAsUserArray;

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
				case 'UserId':
					/**
					 * Sets the value for intUserId (PK)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intUserId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Username':
					/**
					 * Sets the value for strUsername (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strUsername = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Password':
					/**
					 * Sets the value for strPassword (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPassword = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Email':
					/**
					 * Sets the value for strEmail (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Data':
					/**
					 * Sets the value for strData 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strData = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
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
		// ASSOCIATED OBJECTS
		///////////////////////////////

			
		
		// Related Objects' Methods for NarroSuggestionCommentAsUser
		//-------------------------------------------------------------------

		/**
		 * Gets all associated NarroSuggestionCommentsAsUser as an array of NarroSuggestionComment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroSuggestionComment[]
		*/ 
		public function GetNarroSuggestionCommentAsUserArray($objOptionalClauses = null) {
			if ((is_null($this->intUserId)))
				return array();

			try {
				return NarroSuggestionComment::LoadArrayByUserId($this->intUserId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated NarroSuggestionCommentsAsUser
		 * @return int
		*/ 
		public function CountNarroSuggestionCommentsAsUser() {
			if ((is_null($this->intUserId)))
				return 0;

			return NarroSuggestionComment::CountByUserId($this->intUserId);
		}

		/**
		 * Associates a NarroSuggestionCommentAsUser
		 * @param NarroSuggestionComment $objNarroSuggestionComment
		 * @return void
		*/ 
		public function AssociateNarroSuggestionCommentAsUser(NarroSuggestionComment $objNarroSuggestionComment) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroSuggestionCommentAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroSuggestionComment->CommentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroSuggestionCommentAsUser on this NarroUser with an unsaved NarroSuggestionComment.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_suggestion_comment`
				SET
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
				WHERE
					`comment_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionComment->CommentId) . '
			');
		}

		/**
		 * Unassociates a NarroSuggestionCommentAsUser
		 * @param NarroSuggestionComment $objNarroSuggestionComment
		 * @return void
		*/ 
		public function UnassociateNarroSuggestionCommentAsUser(NarroSuggestionComment $objNarroSuggestionComment) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionCommentAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroSuggestionComment->CommentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionCommentAsUser on this NarroUser with an unsaved NarroSuggestionComment.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_suggestion_comment`
				SET
					`user_id` = null
				WHERE
					`comment_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionComment->CommentId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Unassociates all NarroSuggestionCommentsAsUser
		 * @return void
		*/ 
		public function UnassociateAllNarroSuggestionCommentsAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionCommentAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_suggestion_comment`
				SET
					`user_id` = null
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes an associated NarroSuggestionCommentAsUser
		 * @param NarroSuggestionComment $objNarroSuggestionComment
		 * @return void
		*/ 
		public function DeleteAssociatedNarroSuggestionCommentAsUser(NarroSuggestionComment $objNarroSuggestionComment) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionCommentAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroSuggestionComment->CommentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionCommentAsUser on this NarroUser with an unsaved NarroSuggestionComment.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_suggestion_comment`
				WHERE
					`comment_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionComment->CommentId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes all associated NarroSuggestionCommentsAsUser
		 * @return void
		*/ 
		public function DeleteAllNarroSuggestionCommentsAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionCommentAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_suggestion_comment`
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

			
		
		// Related Objects' Methods for NarroSuggestionVoteAsUser
		//-------------------------------------------------------------------

		/**
		 * Gets all associated NarroSuggestionVotesAsUser as an array of NarroSuggestionVote objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroSuggestionVote[]
		*/ 
		public function GetNarroSuggestionVoteAsUserArray($objOptionalClauses = null) {
			if ((is_null($this->intUserId)))
				return array();

			try {
				return NarroSuggestionVote::LoadArrayByUserId($this->intUserId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated NarroSuggestionVotesAsUser
		 * @return int
		*/ 
		public function CountNarroSuggestionVotesAsUser() {
			if ((is_null($this->intUserId)))
				return 0;

			return NarroSuggestionVote::CountByUserId($this->intUserId);
		}

		/**
		 * Associates a NarroSuggestionVoteAsUser
		 * @param NarroSuggestionVote $objNarroSuggestionVote
		 * @return void
		*/ 
		public function AssociateNarroSuggestionVoteAsUser(NarroSuggestionVote $objNarroSuggestionVote) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroSuggestionVoteAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroSuggestionVote->SuggestionId)) || (is_null($objNarroSuggestionVote->TextId)) || (is_null($objNarroSuggestionVote->UserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroSuggestionVoteAsUser on this NarroUser with an unsaved NarroSuggestionVote.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_suggestion_vote`
				SET
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
				WHERE
					`suggestion_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->SuggestionId) . ' AND
					`text_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->TextId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->UserId) . '
			');
		}

		/**
		 * Unassociates a NarroSuggestionVoteAsUser
		 * @param NarroSuggestionVote $objNarroSuggestionVote
		 * @return void
		*/ 
		public function UnassociateNarroSuggestionVoteAsUser(NarroSuggestionVote $objNarroSuggestionVote) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionVoteAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroSuggestionVote->SuggestionId)) || (is_null($objNarroSuggestionVote->TextId)) || (is_null($objNarroSuggestionVote->UserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionVoteAsUser on this NarroUser with an unsaved NarroSuggestionVote.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_suggestion_vote`
				SET
					`user_id` = null
				WHERE
					`suggestion_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->SuggestionId) . ' AND
					`text_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->TextId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->UserId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Unassociates all NarroSuggestionVotesAsUser
		 * @return void
		*/ 
		public function UnassociateAllNarroSuggestionVotesAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionVoteAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_suggestion_vote`
				SET
					`user_id` = null
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes an associated NarroSuggestionVoteAsUser
		 * @param NarroSuggestionVote $objNarroSuggestionVote
		 * @return void
		*/ 
		public function DeleteAssociatedNarroSuggestionVoteAsUser(NarroSuggestionVote $objNarroSuggestionVote) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionVoteAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroSuggestionVote->SuggestionId)) || (is_null($objNarroSuggestionVote->TextId)) || (is_null($objNarroSuggestionVote->UserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionVoteAsUser on this NarroUser with an unsaved NarroSuggestionVote.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_suggestion_vote`
				WHERE
					`suggestion_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->SuggestionId) . ' AND
					`text_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->TextId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($objNarroSuggestionVote->UserId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes all associated NarroSuggestionVotesAsUser
		 * @return void
		*/ 
		public function DeleteAllNarroSuggestionVotesAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroSuggestionVoteAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_suggestion_vote`
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

			
		
		// Related Objects' Methods for NarroTextContextCommentAsUser
		//-------------------------------------------------------------------

		/**
		 * Gets all associated NarroTextContextCommentsAsUser as an array of NarroTextContextComment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroTextContextComment[]
		*/ 
		public function GetNarroTextContextCommentAsUserArray($objOptionalClauses = null) {
			if ((is_null($this->intUserId)))
				return array();

			try {
				return NarroTextContextComment::LoadArrayByUserId($this->intUserId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated NarroTextContextCommentsAsUser
		 * @return int
		*/ 
		public function CountNarroTextContextCommentsAsUser() {
			if ((is_null($this->intUserId)))
				return 0;

			return NarroTextContextComment::CountByUserId($this->intUserId);
		}

		/**
		 * Associates a NarroTextContextCommentAsUser
		 * @param NarroTextContextComment $objNarroTextContextComment
		 * @return void
		*/ 
		public function AssociateNarroTextContextCommentAsUser(NarroTextContextComment $objNarroTextContextComment) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroTextContextCommentAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroTextContextComment->CommentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroTextContextCommentAsUser on this NarroUser with an unsaved NarroTextContextComment.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_text_context_comment`
				SET
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
				WHERE
					`comment_id` = ' . $objDatabase->SqlVariable($objNarroTextContextComment->CommentId) . '
			');
		}

		/**
		 * Unassociates a NarroTextContextCommentAsUser
		 * @param NarroTextContextComment $objNarroTextContextComment
		 * @return void
		*/ 
		public function UnassociateNarroTextContextCommentAsUser(NarroTextContextComment $objNarroTextContextComment) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextContextCommentAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroTextContextComment->CommentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextContextCommentAsUser on this NarroUser with an unsaved NarroTextContextComment.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_text_context_comment`
				SET
					`user_id` = null
				WHERE
					`comment_id` = ' . $objDatabase->SqlVariable($objNarroTextContextComment->CommentId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Unassociates all NarroTextContextCommentsAsUser
		 * @return void
		*/ 
		public function UnassociateAllNarroTextContextCommentsAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextContextCommentAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_text_context_comment`
				SET
					`user_id` = null
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes an associated NarroTextContextCommentAsUser
		 * @param NarroTextContextComment $objNarroTextContextComment
		 * @return void
		*/ 
		public function DeleteAssociatedNarroTextContextCommentAsUser(NarroTextContextComment $objNarroTextContextComment) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextContextCommentAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroTextContextComment->CommentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextContextCommentAsUser on this NarroUser with an unsaved NarroTextContextComment.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_text_context_comment`
				WHERE
					`comment_id` = ' . $objDatabase->SqlVariable($objNarroTextContextComment->CommentId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes all associated NarroTextContextCommentsAsUser
		 * @return void
		*/ 
		public function DeleteAllNarroTextContextCommentsAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextContextCommentAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_text_context_comment`
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

			
		
		// Related Objects' Methods for NarroTextSuggestionAsUser
		//-------------------------------------------------------------------

		/**
		 * Gets all associated NarroTextSuggestionsAsUser as an array of NarroTextSuggestion objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroTextSuggestion[]
		*/ 
		public function GetNarroTextSuggestionAsUserArray($objOptionalClauses = null) {
			if ((is_null($this->intUserId)))
				return array();

			try {
				return NarroTextSuggestion::LoadArrayByUserId($this->intUserId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated NarroTextSuggestionsAsUser
		 * @return int
		*/ 
		public function CountNarroTextSuggestionsAsUser() {
			if ((is_null($this->intUserId)))
				return 0;

			return NarroTextSuggestion::CountByUserId($this->intUserId);
		}

		/**
		 * Associates a NarroTextSuggestionAsUser
		 * @param NarroTextSuggestion $objNarroTextSuggestion
		 * @return void
		*/ 
		public function AssociateNarroTextSuggestionAsUser(NarroTextSuggestion $objNarroTextSuggestion) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroTextSuggestionAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroTextSuggestion->SuggestionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroTextSuggestionAsUser on this NarroUser with an unsaved NarroTextSuggestion.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_text_suggestion`
				SET
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
				WHERE
					`suggestion_id` = ' . $objDatabase->SqlVariable($objNarroTextSuggestion->SuggestionId) . '
			');
		}

		/**
		 * Unassociates a NarroTextSuggestionAsUser
		 * @param NarroTextSuggestion $objNarroTextSuggestion
		 * @return void
		*/ 
		public function UnassociateNarroTextSuggestionAsUser(NarroTextSuggestion $objNarroTextSuggestion) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextSuggestionAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroTextSuggestion->SuggestionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextSuggestionAsUser on this NarroUser with an unsaved NarroTextSuggestion.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_text_suggestion`
				SET
					`user_id` = null
				WHERE
					`suggestion_id` = ' . $objDatabase->SqlVariable($objNarroTextSuggestion->SuggestionId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Unassociates all NarroTextSuggestionsAsUser
		 * @return void
		*/ 
		public function UnassociateAllNarroTextSuggestionsAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextSuggestionAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_text_suggestion`
				SET
					`user_id` = null
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes an associated NarroTextSuggestionAsUser
		 * @param NarroTextSuggestion $objNarroTextSuggestion
		 * @return void
		*/ 
		public function DeleteAssociatedNarroTextSuggestionAsUser(NarroTextSuggestion $objNarroTextSuggestion) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextSuggestionAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroTextSuggestion->SuggestionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextSuggestionAsUser on this NarroUser with an unsaved NarroTextSuggestion.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_text_suggestion`
				WHERE
					`suggestion_id` = ' . $objDatabase->SqlVariable($objNarroTextSuggestion->SuggestionId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes all associated NarroTextSuggestionsAsUser
		 * @return void
		*/ 
		public function DeleteAllNarroTextSuggestionsAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroTextSuggestionAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_text_suggestion`
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

			
		
		// Related Objects' Methods for NarroUserPermissionAsUser
		//-------------------------------------------------------------------

		/**
		 * Gets all associated NarroUserPermissionsAsUser as an array of NarroUserPermission objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NarroUserPermission[]
		*/ 
		public function GetNarroUserPermissionAsUserArray($objOptionalClauses = null) {
			if ((is_null($this->intUserId)))
				return array();

			try {
				return NarroUserPermission::LoadArrayByUserId($this->intUserId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated NarroUserPermissionsAsUser
		 * @return int
		*/ 
		public function CountNarroUserPermissionsAsUser() {
			if ((is_null($this->intUserId)))
				return 0;

			return NarroUserPermission::CountByUserId($this->intUserId);
		}

		/**
		 * Associates a NarroUserPermissionAsUser
		 * @param NarroUserPermission $objNarroUserPermission
		 * @return void
		*/ 
		public function AssociateNarroUserPermissionAsUser(NarroUserPermission $objNarroUserPermission) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroUserPermissionAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroUserPermission->UserPermissionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNarroUserPermissionAsUser on this NarroUser with an unsaved NarroUserPermission.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_user_permission`
				SET
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
				WHERE
					`user_permission_id` = ' . $objDatabase->SqlVariable($objNarroUserPermission->UserPermissionId) . '
			');
		}

		/**
		 * Unassociates a NarroUserPermissionAsUser
		 * @param NarroUserPermission $objNarroUserPermission
		 * @return void
		*/ 
		public function UnassociateNarroUserPermissionAsUser(NarroUserPermission $objNarroUserPermission) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroUserPermissionAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroUserPermission->UserPermissionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroUserPermissionAsUser on this NarroUser with an unsaved NarroUserPermission.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_user_permission`
				SET
					`user_id` = null
				WHERE
					`user_permission_id` = ' . $objDatabase->SqlVariable($objNarroUserPermission->UserPermissionId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Unassociates all NarroUserPermissionsAsUser
		 * @return void
		*/ 
		public function UnassociateAllNarroUserPermissionsAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroUserPermissionAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`narro_user_permission`
				SET
					`user_id` = null
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes an associated NarroUserPermissionAsUser
		 * @param NarroUserPermission $objNarroUserPermission
		 * @return void
		*/ 
		public function DeleteAssociatedNarroUserPermissionAsUser(NarroUserPermission $objNarroUserPermission) {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroUserPermissionAsUser on this unsaved NarroUser.');
			if ((is_null($objNarroUserPermission->UserPermissionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroUserPermissionAsUser on this NarroUser with an unsaved NarroUserPermission.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_user_permission`
				WHERE
					`user_permission_id` = ' . $objDatabase->SqlVariable($objNarroUserPermission->UserPermissionId) . ' AND
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}

		/**
		 * Deletes all associated NarroUserPermissionsAsUser
		 * @return void
		*/ 
		public function DeleteAllNarroUserPermissionsAsUser() {
			if ((is_null($this->intUserId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNarroUserPermissionAsUser on this unsaved NarroUser.');

			// Get the Database Object for this Class
			$objDatabase = NarroUser::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`narro_user_permission`
				WHERE
					`user_id` = ' . $objDatabase->SqlVariable($this->intUserId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK column narro_user.user_id
		 * @var integer intUserId
		 */
		protected $intUserId;
		const UserIdDefault = null;


		/**
		 * Protected internal member variable that stores the original version of the PK column value (if restored)
		 * Used by Save() to update a PK column during UPDATE
		 * @var integer __intUserId;
		 */
		protected $__intUserId;

		/**
		 * Protected member variable that maps to the database column narro_user.username
		 * @var string strUsername
		 */
		protected $strUsername;
		const UsernameMaxLength = 128;
		const UsernameDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_user.password
		 * @var string strPassword
		 */
		protected $strPassword;
		const PasswordMaxLength = 64;
		const PasswordDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_user.email
		 * @var string strEmail
		 */
		protected $strEmail;
		const EmailMaxLength = 128;
		const EmailDefault = null;


		/**
		 * Protected member variable that maps to the database column narro_user.data
		 * @var string strData
		 */
		protected $strData;
		const DataDefault = null;


		/**
		 * Private member variable that stores a reference to a single NarroSuggestionCommentAsUser object
		 * (of type NarroSuggestionComment), if this NarroUser object was restored with
		 * an expansion on the narro_suggestion_comment association table.
		 * @var NarroSuggestionComment _objNarroSuggestionCommentAsUser;
		 */
		private $_objNarroSuggestionCommentAsUser;

		/**
		 * Private member variable that stores a reference to an array of NarroSuggestionCommentAsUser objects
		 * (of type NarroSuggestionComment[]), if this NarroUser object was restored with
		 * an ExpandAsArray on the narro_suggestion_comment association table.
		 * @var NarroSuggestionComment[] _objNarroSuggestionCommentAsUserArray;
		 */
		private $_objNarroSuggestionCommentAsUserArray = array();

		/**
		 * Private member variable that stores a reference to a single NarroSuggestionVoteAsUser object
		 * (of type NarroSuggestionVote), if this NarroUser object was restored with
		 * an expansion on the narro_suggestion_vote association table.
		 * @var NarroSuggestionVote _objNarroSuggestionVoteAsUser;
		 */
		private $_objNarroSuggestionVoteAsUser;

		/**
		 * Private member variable that stores a reference to an array of NarroSuggestionVoteAsUser objects
		 * (of type NarroSuggestionVote[]), if this NarroUser object was restored with
		 * an ExpandAsArray on the narro_suggestion_vote association table.
		 * @var NarroSuggestionVote[] _objNarroSuggestionVoteAsUserArray;
		 */
		private $_objNarroSuggestionVoteAsUserArray = array();

		/**
		 * Private member variable that stores a reference to a single NarroTextContextCommentAsUser object
		 * (of type NarroTextContextComment), if this NarroUser object was restored with
		 * an expansion on the narro_text_context_comment association table.
		 * @var NarroTextContextComment _objNarroTextContextCommentAsUser;
		 */
		private $_objNarroTextContextCommentAsUser;

		/**
		 * Private member variable that stores a reference to an array of NarroTextContextCommentAsUser objects
		 * (of type NarroTextContextComment[]), if this NarroUser object was restored with
		 * an ExpandAsArray on the narro_text_context_comment association table.
		 * @var NarroTextContextComment[] _objNarroTextContextCommentAsUserArray;
		 */
		private $_objNarroTextContextCommentAsUserArray = array();

		/**
		 * Private member variable that stores a reference to a single NarroTextSuggestionAsUser object
		 * (of type NarroTextSuggestion), if this NarroUser object was restored with
		 * an expansion on the narro_text_suggestion association table.
		 * @var NarroTextSuggestion _objNarroTextSuggestionAsUser;
		 */
		private $_objNarroTextSuggestionAsUser;

		/**
		 * Private member variable that stores a reference to an array of NarroTextSuggestionAsUser objects
		 * (of type NarroTextSuggestion[]), if this NarroUser object was restored with
		 * an ExpandAsArray on the narro_text_suggestion association table.
		 * @var NarroTextSuggestion[] _objNarroTextSuggestionAsUserArray;
		 */
		private $_objNarroTextSuggestionAsUserArray = array();

		/**
		 * Private member variable that stores a reference to a single NarroUserPermissionAsUser object
		 * (of type NarroUserPermission), if this NarroUser object was restored with
		 * an expansion on the narro_user_permission association table.
		 * @var NarroUserPermission _objNarroUserPermissionAsUser;
		 */
		private $_objNarroUserPermissionAsUser;

		/**
		 * Private member variable that stores a reference to an array of NarroUserPermissionAsUser objects
		 * (of type NarroUserPermission[]), if this NarroUser object was restored with
		 * an ExpandAsArray on the narro_user_permission association table.
		 * @var NarroUserPermission[] _objNarroUserPermissionAsUserArray;
		 */
		private $_objNarroUserPermissionAsUserArray = array();

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






		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="NarroUser"><sequence>';
			$strToReturn .= '<element name="UserId" type="xsd:int"/>';
			$strToReturn .= '<element name="Username" type="xsd:string"/>';
			$strToReturn .= '<element name="Password" type="xsd:string"/>';
			$strToReturn .= '<element name="Email" type="xsd:string"/>';
			$strToReturn .= '<element name="Data" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('NarroUser', $strComplexTypeArray)) {
				$strComplexTypeArray['NarroUser'] = NarroUser::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, NarroUser::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new NarroUser();
			if (property_exists($objSoapObject, 'UserId'))
				$objToReturn->intUserId = $objSoapObject->UserId;
			if (property_exists($objSoapObject, 'Username'))
				$objToReturn->strUsername = $objSoapObject->Username;
			if (property_exists($objSoapObject, 'Password'))
				$objToReturn->strPassword = $objSoapObject->Password;
			if (property_exists($objSoapObject, 'Email'))
				$objToReturn->strEmail = $objSoapObject->Email;
			if (property_exists($objSoapObject, 'Data'))
				$objToReturn->strData = $objSoapObject->Data;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, NarroUser::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeNarroUser extends QQNode {
		protected $strTableName = 'narro_user';
		protected $strPrimaryKey = 'user_id';
		protected $strClassName = 'NarroUser';
		public function __get($strName) {
			switch ($strName) {
				case 'UserId':
					return new QQNode('user_id', 'integer', $this);
				case 'Username':
					return new QQNode('username', 'string', $this);
				case 'Password':
					return new QQNode('password', 'string', $this);
				case 'Email':
					return new QQNode('email', 'string', $this);
				case 'Data':
					return new QQNode('data', 'string', $this);
				case 'NarroSuggestionCommentAsUser':
					return new QQReverseReferenceNodeNarroSuggestionComment($this, 'narrosuggestioncommentasuser', 'reverse_reference', 'user_id');
				case 'NarroSuggestionVoteAsUser':
					return new QQReverseReferenceNodeNarroSuggestionVote($this, 'narrosuggestionvoteasuser', 'reverse_reference', 'user_id');
				case 'NarroTextContextCommentAsUser':
					return new QQReverseReferenceNodeNarroTextContextComment($this, 'narrotextcontextcommentasuser', 'reverse_reference', 'user_id');
				case 'NarroTextSuggestionAsUser':
					return new QQReverseReferenceNodeNarroTextSuggestion($this, 'narrotextsuggestionasuser', 'reverse_reference', 'user_id');
				case 'NarroUserPermissionAsUser':
					return new QQReverseReferenceNodeNarroUserPermission($this, 'narrouserpermissionasuser', 'reverse_reference', 'user_id');

				case '_PrimaryKeyNode':
					return new QQNode('user_id', 'integer', $this);
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

	class QQReverseReferenceNodeNarroUser extends QQReverseReferenceNode {
		protected $strTableName = 'narro_user';
		protected $strPrimaryKey = 'user_id';
		protected $strClassName = 'NarroUser';
		public function __get($strName) {
			switch ($strName) {
				case 'UserId':
					return new QQNode('user_id', 'integer', $this);
				case 'Username':
					return new QQNode('username', 'string', $this);
				case 'Password':
					return new QQNode('password', 'string', $this);
				case 'Email':
					return new QQNode('email', 'string', $this);
				case 'Data':
					return new QQNode('data', 'string', $this);
				case 'NarroSuggestionCommentAsUser':
					return new QQReverseReferenceNodeNarroSuggestionComment($this, 'narrosuggestioncommentasuser', 'reverse_reference', 'user_id');
				case 'NarroSuggestionVoteAsUser':
					return new QQReverseReferenceNodeNarroSuggestionVote($this, 'narrosuggestionvoteasuser', 'reverse_reference', 'user_id');
				case 'NarroTextContextCommentAsUser':
					return new QQReverseReferenceNodeNarroTextContextComment($this, 'narrotextcontextcommentasuser', 'reverse_reference', 'user_id');
				case 'NarroTextSuggestionAsUser':
					return new QQReverseReferenceNodeNarroTextSuggestion($this, 'narrotextsuggestionasuser', 'reverse_reference', 'user_id');
				case 'NarroUserPermissionAsUser':
					return new QQReverseReferenceNodeNarroUserPermission($this, 'narrouserpermissionasuser', 'reverse_reference', 'user_id');

				case '_PrimaryKeyNode':
					return new QQNode('user_id', 'integer', $this);
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