<?php
	/* Custom event classes for this control */
	/**
	 * This event is triggered at the start of a resize operation.
	 */
	class QResizable_StartEvent extends QEvent {
		const EventName = 'QResizable_Start';
	}

	/**
	 * This event is triggered during the resize, on the drag of the resize
	 * 		handler.
	 */
	class QResizable_ResizeEvent extends QEvent {
		const EventName = 'QResizable_Resize';
	}

	/**
	 * This event is triggered at the end of a resize operation.
	 */
	class QResizable_StopEvent extends QEvent {
		const EventName = 'QResizable_Stop';
	}


	/**
	 * @property boolean $Disabled Disables (true) or enables (false) the resizable. Can be set when
	 * 		initialising (first creating) the resizable.
	 * @property mixed $AlsoResize Resize these elements synchronous when resizing.
	 * @property boolean $Animate Animates to the final size after resizing.
	 * @property mixed $AnimateDuration Duration time for animating, in milliseconds. Other possible values:
	 * 		'slow', 'normal', 'fast'.
	 * @property string $AnimateEasing Easing effect for animating.
	 * @property mixed $AspectRatio If set to true, resizing is constrained by the original aspect ratio.
	 * 		Otherwise a custom aspect ratio can be specified, such as 9 / 16, or 0.5.
	 * @property boolean $AutoHide If set to true, automatically hides the handles except when the mouse
	 * 		hovers over the element.
	 * @property mixed $Cancel Prevents resizing if you start on elements matching the selector.
	 * @property mixed $Containment Constrains resizing to within the bounds of the specified element. Possible
	 * 		values: 'parent', 'document', a DOMElement, or a Selector.
	 * @property integer $Delay Tolerance, in milliseconds, for when resizing should start. If specified,
	 * 		resizing will not start until after mouse is moved beyond duration. This
	 * 		can help prevent unintended resizing when clicking on an element.
	 * @property integer $Distance Tolerance, in pixels, for when resizing should start. If specified,
	 * 		resizing will not start until after mouse is moved beyond distance. This
	 * 		can help prevent unintended resizing when clicking on an element.
	 * @property boolean $Ghost If set to true, a semi-transparent helper element is shown for resizing.
	 * @property array $Grid Snaps the resizing element to a grid, every x and y pixels. Array values:
	 * 		[x, y]
	 * @property mixed $Handles If specified as a string, should be a comma-split list of any of the
	 * 		following: 'n, e, s, w, ne, se, sw, nw, all'. The necessary handles will be
	 * 		auto-generated by the plugin.
	 * If specified as an object, the following keys
	 * 		are supported: { n, e, s, w, ne, se, sw, nw }. The value of any specified
	 * 		should be a jQuery selector matching the child element of the resizable to
	 * 		use as that handle. If the handle is not a child of the resizable, you can
	 * 		pass in the DOMElement or a valid jQuery object directly.
	 * @property string $Helper This is the css class that will be added to a proxy element to outline the
	 * 		resize during the drag of the resize handle. Once the resize is complete,
	 * 		the original element is sized.
	 * @property integer $MaxHeight This is the maximum height the resizable should be allowed to resize to.
	 * @property integer $MaxWidth This is the maximum width the resizable should be allowed to resize to.
	 * @property integer $MinHeight This is the minimum height the resizable should be allowed to resize to.
	 * @property integer $MinWidth This is the minimum width the resizable should be allowed to resize to.
	 * @property QJsClosure $OnStart This event is triggered at the start of a resize operation.
	 * @property QJsClosure $OnResize This event is triggered during the resize, on the drag of the resize
	 * 		handler.
	 * @property QJsClosure $OnStop This event is triggered at the end of a resize operation.
	 */

	class QResizableBase extends QPanel	{
		protected $strJavaScripts = __JQUERY_EFFECTS__;
		protected $strStyleSheets = __JQUERY_CSS__;
		/** @var boolean */
		protected $blnDisabled = null;
		/** @var mixed */
		protected $mixAlsoResize = null;
		/** @var boolean */
		protected $blnAnimate = null;
		/** @var mixed */
		protected $mixAnimateDuration = null;
		/** @var string */
		protected $strAnimateEasing = null;
		/** @var mixed */
		protected $mixAspectRatio = null;
		/** @var boolean */
		protected $blnAutoHide = null;
		/** @var mixed */
		protected $mixCancel = null;
		/** @var mixed */
		protected $mixContainment = null;
		/** @var integer */
		protected $intDelay;
		/** @var integer */
		protected $intDistance = null;
		/** @var boolean */
		protected $blnGhost = null;
		/** @var array */
		protected $arrGrid = null;
		/** @var mixed */
		protected $mixHandles = null;
		/** @var string */
		protected $strHelper = null;
		/** @var integer */
		protected $intMaxHeight = null;
		/** @var integer */
		protected $intMaxWidth = null;
		/** @var integer */
		protected $intMinHeight = null;
		/** @var integer */
		protected $intMinWidth = null;
		/** @var QJsClosure */
		protected $mixOnStart = null;
		/** @var QJsClosure */
		protected $mixOnResize = null;
		/** @var QJsClosure */
		protected $mixOnStop = null;

		/** @var array $custom_events Event Class Name => Event Property Name */
		protected static $custom_events = array(
			'QResizable_StartEvent' => 'OnStart',
			'QResizable_ResizeEvent' => 'OnResize',
			'QResizable_StopEvent' => 'OnStop',
		);
		
		protected function makeJsProperty($strProp, $strKey) {
			$objValue = $this->$strProp;
			if (null === $objValue) {
				return '';
			}

			return $strKey . ': ' . JavaScriptHelper::toJsObject($objValue) . ', ';
		}

		protected function makeJqOptions() {
			$strJqOptions = '';
			$strJqOptions .= $this->makeJsProperty('Disabled', 'disabled');
			$strJqOptions .= $this->makeJsProperty('AlsoResize', 'alsoResize');
			$strJqOptions .= $this->makeJsProperty('Animate', 'animate');
			$strJqOptions .= $this->makeJsProperty('AnimateDuration', 'animateDuration');
			$strJqOptions .= $this->makeJsProperty('AnimateEasing', 'animateEasing');
			$strJqOptions .= $this->makeJsProperty('AspectRatio', 'aspectRatio');
			$strJqOptions .= $this->makeJsProperty('AutoHide', 'autoHide');
			$strJqOptions .= $this->makeJsProperty('Cancel', 'cancel');
			$strJqOptions .= $this->makeJsProperty('Containment', 'containment');
			$strJqOptions .= $this->makeJsProperty('Delay', 'delay');
			$strJqOptions .= $this->makeJsProperty('Distance', 'distance');
			$strJqOptions .= $this->makeJsProperty('Ghost', 'ghost');
			$strJqOptions .= $this->makeJsProperty('Grid', 'grid');
			$strJqOptions .= $this->makeJsProperty('Handles', 'handles');
			$strJqOptions .= $this->makeJsProperty('Helper', 'helper');
			$strJqOptions .= $this->makeJsProperty('MaxHeight', 'maxHeight');
			$strJqOptions .= $this->makeJsProperty('MaxWidth', 'maxWidth');
			$strJqOptions .= $this->makeJsProperty('MinHeight', 'minHeight');
			$strJqOptions .= $this->makeJsProperty('MinWidth', 'minWidth');
			$strJqOptions .= $this->makeJsProperty('OnStart', 'start');
			$strJqOptions .= $this->makeJsProperty('OnResize', 'resize');
			$strJqOptions .= $this->makeJsProperty('OnStop', 'stop');
			if ($strJqOptions) $strJqOptions = substr($strJqOptions, 0, -2);
			return $strJqOptions;
		}

		protected function getJqControlId() {
			return $this->ControlId;
		}

		protected function getJqSetupFunction() {
			return 'resizable';
		}

		public function GetControlJavaScript() {
			return sprintf('jQuery("#%s").%s({%s})', $this->getJqControlId(), $this->getJqSetupFunction(), $this->makeJqOptions());
		}

		public function GetEndScript() {
			return  $this->GetControlJavaScript() . '; ' . parent::GetEndScript();
		}

		/**
		 * Remove the resizable functionality completely. This will return the element
		 * back to its pre-init state.
		 */
		public function Destroy() {
			$args = array();
			$args[] = "destroy";

			$strArgs = JavaScriptHelper::toJsObject($args);
			$strJs = sprintf('jQuery("#%s").resizable(%s)', 
				$this->getJqControlId(),
				substr($strArgs, 1, strlen($strArgs)-2));
			QApplication::ExecuteJavaScript($strJs);
		}

		/**
		 * Disable the resizable.
		 */
		public function Disable() {
			$args = array();
			$args[] = "disable";

			$strArgs = JavaScriptHelper::toJsObject($args);
			$strJs = sprintf('jQuery("#%s").resizable(%s)', 
				$this->getJqControlId(),
				substr($strArgs, 1, strlen($strArgs)-2));
			QApplication::ExecuteJavaScript($strJs);
		}

		/**
		 * Enable the resizable.
		 */
		public function Enable() {
			$args = array();
			$args[] = "enable";

			$strArgs = JavaScriptHelper::toJsObject($args);
			$strJs = sprintf('jQuery("#%s").resizable(%s)', 
				$this->getJqControlId(),
				substr($strArgs, 1, strlen($strArgs)-2));
			QApplication::ExecuteJavaScript($strJs);
		}

		/**
		 * Get or set any resizable option. If no value is specified, will act as a
		 * getter.
		 * @param $optionName
		 * @param $value
		 */
		public function Option($optionName, $value = null) {
			$args = array();
			$args[] = "option";
			$args[] = $optionName;
			if ($value !== null) {
				$args[] = $value;
			}

			$strArgs = JavaScriptHelper::toJsObject($args);
			$strJs = sprintf('jQuery("#%s").resizable(%s)', 
				$this->getJqControlId(),
				substr($strArgs, 1, strlen($strArgs)-2));
			QApplication::ExecuteJavaScript($strJs);
		}

		/**
		 * Set multiple resizable options at once by providing an options object.
		 * @param $options
		 */
		public function Option1($options) {
			$args = array();
			$args[] = "option";
			$args[] = $options;

			$strArgs = JavaScriptHelper::toJsObject($args);
			$strJs = sprintf('jQuery("#%s").resizable(%s)', 
				$this->getJqControlId(),
				substr($strArgs, 1, strlen($strArgs)-2));
			QApplication::ExecuteJavaScript($strJs);
		}

		/**
		 * returns the property name corresponding to the given custom event
		 * @param QEvent $objEvent the custom event
		 * @return the property name corresponding to $objEvent
		 */
		protected function getCustomEventPropertyName(QEvent $objEvent) {
			$strEventClass = get_class($objEvent);
			if (array_key_exists($strEventClass, QResizable::$custom_events))
				return QResizable::$custom_events[$strEventClass];
			return null;
		}

		/**
		 * Wraps $objAction into an object (typically a QJsClosure) that can be assigned to the corresponding Event
		 * property (e.g. OnFocus)
		 * @param QEvent $objEvent
		 * @param QAction $objAction
		 * @return mixed the wrapped object
		 */
		protected function createEventWrapper(QEvent $objEvent, QAction $objAction) {
			$objAction->Event = $objEvent;
			return new QJsClosure($objAction->RenderScript($this));
		}

		/**
		 * If $objEvent is one of the custom events (as determined by getCustomEventPropertyName() method)
		 * the corresponding JQuery event is used and if needed a no-script action is added. Otherwise the normal
		 * QCubed AddAction is performed.
		 * @param QEvent  $objEvent
		 * @param QAction $objAction
		 */
		public function AddAction($objEvent, $objAction) {
			$strEventName = $this->getCustomEventPropertyName($objEvent);
			if ($strEventName) {
				$this->$strEventName = $this->createEventWrapper($objEvent, $objAction);
				if ($objAction instanceof QAjaxAction) {
					$objAction = new QNoScriptAjaxAction($objAction);
					parent::AddAction($objEvent, $objAction);
				} else if (!($objAction instanceof QJavaScriptAction)) {
					throw new Exception('handling of "' . get_class($objAction) . '" actions with "' . get_class($objEvent) . '" events not yet implemented');
				}
			} else {
				parent::AddAction($objEvent, $objAction);
			}
		}

		public function __get($strName) {
			switch ($strName) {
				case 'Disabled': return $this->blnDisabled;
				case 'AlsoResize': return $this->mixAlsoResize;
				case 'Animate': return $this->blnAnimate;
				case 'AnimateDuration': return $this->mixAnimateDuration;
				case 'AnimateEasing': return $this->strAnimateEasing;
				case 'AspectRatio': return $this->mixAspectRatio;
				case 'AutoHide': return $this->blnAutoHide;
				case 'Cancel': return $this->mixCancel;
				case 'Containment': return $this->mixContainment;
				case 'Delay': return $this->intDelay;
				case 'Distance': return $this->intDistance;
				case 'Ghost': return $this->blnGhost;
				case 'Grid': return $this->arrGrid;
				case 'Handles': return $this->mixHandles;
				case 'Helper': return $this->strHelper;
				case 'MaxHeight': return $this->intMaxHeight;
				case 'MaxWidth': return $this->intMaxWidth;
				case 'MinHeight': return $this->intMinHeight;
				case 'MinWidth': return $this->intMinWidth;
				case 'OnStart': return $this->mixOnStart;
				case 'OnResize': return $this->mixOnResize;
				case 'OnStop': return $this->mixOnStop;
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
			$this->blnModified = true;

			switch ($strName) {
				case 'Disabled':
					try {
						$this->blnDisabled = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AlsoResize':
					$this->mixAlsoResize = $mixValue;
					break;

				case 'Animate':
					try {
						$this->blnAnimate = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AnimateDuration':
					$this->mixAnimateDuration = $mixValue;
					break;

				case 'AnimateEasing':
					try {
						$this->strAnimateEasing = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AspectRatio':
					$this->mixAspectRatio = $mixValue;
					break;

				case 'AutoHide':
					try {
						$this->blnAutoHide = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Cancel':
					$this->mixCancel = $mixValue;
					break;

				case 'Containment':
					$this->mixContainment = $mixValue;
					break;

				case 'Delay':
					try {
						$this->intDelay = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Distance':
					try {
						$this->intDistance = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Ghost':
					try {
						$this->blnGhost = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Grid':
					try {
						$this->arrGrid = QType::Cast($mixValue, QType::ArrayType);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Handles':
					$this->mixHandles = $mixValue;
					break;

				case 'Helper':
					try {
						$this->strHelper = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MaxHeight':
					try {
						$this->intMaxHeight = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MaxWidth':
					try {
						$this->intMaxWidth = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MinHeight':
					try {
						$this->intMinHeight = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MinWidth':
					try {
						$this->intMinWidth = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'OnStart':
					try {
						if ($mixValue instanceof QJavaScriptAction) {
						    /** @var QJavaScriptAction $mixValue */
						    $mixValue = new QJsClosure($mixValue->RenderScript($this));
						}
						$this->mixOnStart = QType::Cast($mixValue, 'QJsClosure');
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'OnResize':
					try {
						if ($mixValue instanceof QJavaScriptAction) {
						    /** @var QJavaScriptAction $mixValue */
						    $mixValue = new QJsClosure($mixValue->RenderScript($this));
						}
						$this->mixOnResize = QType::Cast($mixValue, 'QJsClosure');
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'OnStop':
					try {
						if ($mixValue instanceof QJavaScriptAction) {
						    /** @var QJavaScriptAction $mixValue */
						    $mixValue = new QJsClosure($mixValue->RenderScript($this));
						}
						$this->mixOnStop = QType::Cast($mixValue, 'QJsClosure');
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						parent::__set($strName, $mixValue);
						break;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

?>
