<?php

namespace Trafo2\T2Captcha\ViewHelpers\ReCaptcha;

class ButtonViewHelper extends ViewHelperAbstract {
	/**
	 * @var string
	 */
	protected $tagName = 'button';

	/**
	 * Initialize ViewHelper arguments
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('value', 'string', 'Button label', false);
		$this->registerArgument('callback', 'string', 'Called when the user submits a successful response. The h-captcha-response token is passed to your callback.', false);
	}

	/**
	 * @return string
	 */
	public function render() {
		$siteKey = $this->arguments['sitekey'] ?? null;
		if (empty($siteKey)) {
			try {
				$siteKey = $this->getPublicKeyFromTypoScript();
			} catch (\Exception $e) {
				return $e->getMessage();
			}
		}
		$this->tag->addAttribute('type', 'submit');
		$value = empty($this->arguments['value']) ? $this->renderChildren() : $this->arguments['value'];
		$this->tag->setContent($value);
		$id = empty($this->arguments['id']) ? uniqid() : $this->arguments['id'];
		$this->tag->addAttribute('id', $id);
		$js = '';
		if (empty($this->arguments['callback'])) {
			$callbackName = 'onSubmit_' . str_replace('-', '_', $id);
			$js = <<<EOL
<script>
document.getElementById("$id").closest("form").addEventListener("submit", function(event) {
	if (!grecaptcha.getResponse()) {
		event.preventDefault();
		grecaptcha.execute();
	}
});
function $callbackName() {
	document.getElementById("$id").closest("form").submit();
}
</script>
EOL;
		} else {
			$callbackName = $this->arguments['callback'];
		}
		$html = '<div class="g-recaptcha" data-sitekey="' . $siteKey . '" data-callback="' . $callbackName . '" data-size="invisible"></div>' . $js;
		$this->tag->forceClosingTag(true);
		$this->includeJavaScript(self::RECAPTCHA_JAVASCRIPT_LIBRARY_URL);
		return $this->tag->render() . PHP_EOL . $html;
	}
}
