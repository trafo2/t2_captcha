<?php

namespace Trafo2\T2Captcha\ViewHelpers\ReCaptcha;

class CheckboxViewHelper extends ViewHelperAbstract {
	/**
	 * @var string
	 */
	protected $tagName = 'div';

	/**
	 * Initialize ViewHelper arguments
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('callback', 'string', 'The name of your callback function, executed when the user submits a successful response. The g-recaptcha-response token is passed to your callback.', false);
		$this->registerArgument('expired-callback', 'string', 'The name of your callback function, executed when the reCAPTCHA response expires and the user needs to re-verify.', false);
		$this->registerArgument('error-callback', 'string', 'The name of your callback function, executed when reCAPTCHA encounters an error (usually network connectivity) and cannot continue until connectivity is restored. If you specify a function here, you are responsible for informing the user that they should retry.', false);
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
		$this->tag->addAttribute('class', 'g-recaptcha');
		$this->tag->addAttribute('data-sitekey', $siteKey);
		$this->tag->addAttribute('data-theme', $this->arguments['theme']);
		$this->tag->addAttribute('data-size', $this->arguments['size']);
		$this->tag->addAttribute('data-tabindex', $this->arguments['tabindex']);
		if (!empty($this->arguments['callback'])) {
			$this->tag->addAttribute('data-callback', $this->arguments['callback']);
		}
		if (!empty($this->arguments['expired-callback'])) {
			$this->tag->addAttribute('data-expired-callback', $this->arguments['expired-callback']);
		}
		if (!empty($this->arguments['error-callback'])) {
			$this->tag->addAttribute('data-error-callback', $this->arguments['error-callback']);
		}
		$this->tag->forceClosingTag(true);
		$this->includeJavaScript(self::RECAPTCHA_JAVASCRIPT_LIBRARY_URL);
		return $this->tag->render();
	}
}
