<?php

namespace Trafo2\T2Captcha\Validation;

use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Configuration;

abstract class AbstractValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {
	protected function getTypoScript(): array {
		/* @var ObjectManager $objectManager */
		/* @var Configuration\ConfigurationManager $configurationManager */
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ObjectManager::class);
		$configurationManager = $objectManager->get(Configuration\ConfigurationManagerInterface::class);
		$fullTypoScript = $configurationManager->getConfiguration(Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		if (empty($fullTypoScript['plugin.']['tx_t2captcha.']) ) {
			throw new \Exception($this->translate('missing-typoscript'));
		}
		return $fullTypoScript['plugin.']['tx_t2captcha.'];
	}

	protected function translate(string $key, ?array $arguments = []): string {
		return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, 'T2Captcha', $arguments) ?? $key;
	}

	protected function verifyHttpRequest(string $url, array $data): array {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$response = curl_exec($ch);
		if (curl_errno($ch)) {
			throw new \Exception($this->translate('curl-error', [curl_error($ch)]), curl_errno($ch));
		}
		if (empty($response)) {
			throw new \Exception($this->translate('empty-response'));
		}
		$json = @json_decode($response, true);
		if (empty($json)) {
			throw new \Exception($this->translate('invalid-json'));
		}
		return $json;
	}

	protected function checkExtensionInstallation(): void {
		if (!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('t2_captcha')) {
			throw new \Exception('Extension t2_captcha is not loaded. Please enable t2_captcha in your Extension Manager.');
		}
	}
}
