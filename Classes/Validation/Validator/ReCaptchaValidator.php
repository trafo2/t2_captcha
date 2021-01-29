<?php

namespace Trafo2\T2Captcha\Validation\Validator;

class ReCaptchaValidator extends \Trafo2\T2Captcha\Validation\AbstractValidator {
	const VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

	/**
	 * @var array
	 */
	protected $supportedOptions = [
		'privateKey' => ['', 'The shared key between your site and reCAPTCHA.', 'string', false],
		'verifyHostname' => [false, 'This will verify the hostname given from reCAPTCHA response with the real hostname.', 'bool', false],
		'minScore' => [0, 'Required minimum score to pass CAPTCHA.', 'double', false],
	];

	/**
	 * @param mixed $value
	 * @return bool
	 */
	public function isValid($value) {
		$this->checkExtensionInstallation();
		if(!empty($_POST['g-recaptcha-response'])) {
			try {
				$secret = $this->options['privateKey'] ?? null;
				if (empty($secret)) {
					$secret = $this->getPrivateKeyFromTypoScript();
				}
				$data = [
					'secret' => $secret,
					'response' => $_POST['g-recaptcha-response'],
					'remoteip' => $_SERVER['REMOTE_ADDR'],
				];
				$response = $this->verifyHttpRequest(self::VERIFY_URL, $data);
				if ($response['success']) {
					if ($this->options['verifyHostname'] && $response['hostname'] != $_SERVER['SERVER_NAME']) {
						$this->addError($this->translate('invalid-hostname'), 0, [], 'reCAPTCHA');
						return false;
					}
					if ($this->options['minScore'] > 0 && $this->options['minScore'] > $response['score']) {
						$this->addError($this->translate('score-mismatch'), 0, [], 'reCAPTCHA');
						return false;
					}
					return true;
				}
				foreach ($response['error-codes'] as $code => $error) {
					$this->addError($this->translate($error), $code, [], 'reCAPTCHA');
				}
			} catch (\Exception $e) {
				$this->addError($e->getMessage(), $e->getCode(), [], 'reCAPTCHA');
			}
		} else {
			$this->addError($this->translate('missing-response'), 0, [], 'reCAPTCHA');
		}
		return false;
	}

	protected function getPrivateKeyFromTypoScript(): string {
		$typoScript = $this->getTypoScript();
		if (empty($typoScript['recaptcha.']['privateKey'])) {
			throw new \Exception($this->translate('missing-private-key'));
		}
		return $typoScript['recaptcha.']['privateKey'];
	}
}
