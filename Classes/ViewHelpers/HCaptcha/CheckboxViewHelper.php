<?php

namespace Trafo2\T2Captcha\ViewHelpers\HCaptcha;

class CheckboxViewHelper extends \Trafo2\T2Captcha\ViewHelpers\CaptchaViewHelperAbstract {
	const HCAPTCHA_JAVASCRIPT_LIBRARY_URL = 'https://hcaptcha.com/1/api.js';

	/**
	 * @var string
	 */
	protected $tagName = 'div';

	/**
	 * Initialize ViewHelper arguments
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('callback', 'string', 'Called when the user submits a successful response. The h-captcha-response token is passed to your callback.', false);
		$this->registerArgument('expired-callback', 'string', 'Called when the passcode response expires and the user must re-verify.', false);
		$this->registerArgument('error-callback', 'string', 'Called when hCaptcha encounters an error and cannot continue. If you specify an error callback, you must inform the user that they should retry.', false);
		$this->registerArgument('chalexpired-callback', 'string', 'Called when the user display of a challenge times out with no answer.', false);
		$this->registerArgument('open-callback', 'string', 'Called when the user display of a challenge starts.', false);
		$this->registerArgument('close-callback', 'string', 'Called when the user dismisses a challenge.', false);
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
		$this->tag->addAttribute('class', 'h-captcha');
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
		if (!empty($this->arguments['chalexpired-callback'])) {
			$this->tag->addAttribute('data-chalexpired-callback', $this->arguments['chalexpired-callback']);
		}
		if (!empty($this->arguments['open-callback'])) {
			$this->tag->addAttribute('data-open-callback', $this->arguments['open-callback']);
		}
		if (!empty($this->arguments['close-callback'])) {
			$this->tag->addAttribute('data-close-callback', $this->arguments['close-callback']);
		}
		$this->tag->forceClosingTag(true);
		$this->includeJavaScript(self::HCAPTCHA_JAVASCRIPT_LIBRARY_URL);
		return $this->tag->render();
	}

	protected function getPublicKeyFromTypoScript(): string {
		$typoScript = $this->getTypoScript();
		if (empty($typoScript['hcaptcha.']['publicKey'])) {
			throw new \Exception('No public key in typoscript definition found [plugin.tx_t2captcha.hcaptcha.publicKey].');
		}
		return $typoScript['hcaptcha.']['publicKey'];
	}
}
