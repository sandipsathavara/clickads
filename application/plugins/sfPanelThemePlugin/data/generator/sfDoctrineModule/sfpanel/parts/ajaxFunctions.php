	protected $__isAJAXCache = null;

	protected function isAJAXRequest() {
		if ($this->__isAJAXCache === null) {
			$request = $this->getRequest();
			if (($request->isXmlHttpRequest()) &&
				($request->hasParameter('ajaxPartial')) &&
				($request->getParameter('ajaxPartial') == 'true')) {
				$this->__isAJAXCache = true;
			} else {
				$this->__isAJAXCache = false;
			}
		}
		return $this->__isAJAXCache;
	}

	protected function emitJSONParts($mode, $sections, $isNew = true) {
		sfConfig::set('sf_web_debug', false);
		$this->setLayout(false);
		sfProjectConfiguration::getActive()->loadHelpers(array('I18N', 'Date'));

		$obj = array(
			'mode'=>$mode,
			// Always transfer the flashes back.
			'flashes'=>$this->getPartial('<?php echo $this->getModuleName() ?>/flashes'),
		);
		foreach ($sections as $section) {
			switch ($section) {
			case 'title':
				$obj['title'] = $this->getPartial('<?php echo $this->getModuleName() ?>/'.
					($isNew ? 'new_title' : 'edit_title'));
				break;
			case 'header':
				$obj['header'] =
					$this->getPartial('<?php echo $this->getModuleName() ?>/edit_header');
				break;
			case 'content':
				$obj['content'] =
					$this->getPartial('<?php echo $this->getModuleName() ?>/edit_content');
				break;
			case 'list':
				$obj['list'] = $this->getPartial('<?php echo $this->getModuleName() ?>/list');
				break;
			case 'footer':
				$obj['footer'] =
					$this->getPartial('<?php echo $this->getModuleName() ?>/edit_footer');
				break;
			default:
				throw new Exception("Unexpected section $section in returnJSON()");
				break;
			}
		}

//		$this->getUser()->setFlash('notice', null, false);
//		$this->getUser()->setFlash('error', null, false);

		$this->getResponse()->setContentType('application/json');
		return $this->renderText(json_encode($obj));
	}

	public function redirect($url, $statusCode = 302) {
		if (is_array($url)) {
			$url = $this->getController()->genUrl($url);
		}
		if ($this->isAJAXRequest()) {
			$url .= (strpos($url, '?') !== false) ? '&ajaxPartial=true' : '?ajaxPartial=true';
		}
		parent::redirect($url, $statusCode);
	}
