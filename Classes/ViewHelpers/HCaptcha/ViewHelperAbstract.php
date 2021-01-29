<?php

namespace Trafo2\T2Captcha\ViewHelpers\HCaptcha;

abstract class ViewHelperAbstract extends \Trafo2\T2Captcha\ViewHelpers\CaptchaViewHelperAbstract {
	const HCAPTCHA_JAVASCRIPT_LIBRARY_URL = 'https://hcaptcha.com/1/api.js';

	protected function getPublicKeyFromTypoScript(): string {
		$typoScript = $this->getTypoScript();
		if (empty($typoScript['hcaptcha.']['publicKey'])) {
			throw new \Exception('No public key in typoscript definition found [plugin.tx_t2captcha.hcaptcha.publicKey].');
		}
		return $typoScript['hcaptcha.']['publicKey'];
	}
}
