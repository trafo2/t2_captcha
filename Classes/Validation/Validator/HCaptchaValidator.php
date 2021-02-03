<?php

namespace Trafo2\T2Captcha\Validation\Validator;

class HCaptchaValidator extends \Trafo2\T2Captcha\Validation\AbstractValidator {
	const VERIFY_URL = 'https://hcaptcha.com/siteverify';

	/**
	 * @var array
	 */
	protected $supportedOptions = [
		'privateKey' => ['', 'Your account secret key.', 'string', false]
	];

	/**
	 * @param mixed $value
	 * @return bool
	 */
	public function isValid($value) {
		$this->checkExtensionInstallation();
		if(!empty($_POST['h-captcha-response'])) {
			try {
				$secret = $this->options['privateKey'] ?? null;
				if (empty($secret)) {
					$secret = $this->getPrivateKeyFromTypoScript();
				}
				$data = [
					'secret' => $secret,
					'response' => $_POST['h-captcha-response'],
					'remoteip' => $_SERVER['REMOTE_ADDR'],
				];
				$response = $this->verifyHttpRequest(self::VERIFY_URL, $data);
				if ($response['success']) {
					return true;
				}
				foreach ($response['error-codes'] as $code => $error) {
					$this->addError($this->translate($error), $code, [], 'hCAPTCHA');
				}
			} catch (\Exception $e) {
				$this->addError($e->getMessage(), $e->getCode(), [], 'hCAPTCHA');
			}
		} else {
			$this->addError($this->translate('missing-response'), 0, [], 'hCAPTCHA');
		}
		return false;
	}

	protected function getPrivateKeyFromTypoScript(): string {
		$typoScript = $this->getTypoScript();
		if (empty($typoScript['hcaptcha.']['privateKey'])) {
			throw new \Exception($this->translate('missing-private-key'));
		}
		return $typoScript['hcaptcha.']['privateKey'];
	}
}
