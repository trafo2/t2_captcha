<?php

namespace Trafo2\T2Captcha\ViewHelpers\ReCaptcha;

class ViewHelperAbstract extends \Trafo2\T2Captcha\ViewHelpers\CaptchaViewHelperAbstract {
	const RECAPTCHA_JAVASCRIPT_LIBRARY_URL = 'https://www.google.com/recaptcha/api.js';

	protected function getPublicKeyFromTypoScript(): string {
		$typoScript = $this->getTypoScript();
		if (empty($typoScript['recaptcha.']['publicKey'])) {
			throw new \Exception('No public key in typoscript definition found [plugin.tx_t2captcha.recaptcha.publicKey].');
		}
		return $typoScript['recaptcha.']['publicKey'];
	}
}
