<?php

namespace Trafo2\T2Captcha\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Configuration;
use TYPO3\CMS\Core\Page\PageRenderer;

abstract class CaptchaViewHelperAbstract extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
	/**
	 * Initialize ViewHelper arguments
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerUniversalTagAttributes();
		$this->registerArgument('sitekey', 'string', 'Your sitekey.', false);
		$this->registerArgument('theme', 'string', 'The color theme of the widget.', false, 'light');
		$this->registerArgument('size', 'string', 'The size of the widget.', false, 'normal');
		$this->overrideArgument('tabindex', 'integer', 'The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.', false, 0);
	}

	protected function getTypoScript(): array {
		/* @var ObjectManager $objectManager */
		/* @var Configuration\ConfigurationManager $configurationManager */
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$configurationManager = $objectManager->get(Configuration\ConfigurationManagerInterface::class);
		$fullTypoScript = $configurationManager->getConfiguration(Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		if (empty($fullTypoScript['plugin.']['tx_t2captcha.'])) {
			throw new \Exception('No CAPTCHA configuration in typoscript definition found [plugin.tx_t2captcha].');
		}
		return $fullTypoScript['plugin.']['tx_t2captcha.'];
	}

	protected function includeJavaScript(string $url): void {
		/* @var PageRenderer $pageRenderer */
		$pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
		$pageRenderer->addJsFooterFile($url, 'text/javascript', false, false, '', true, '|', true, '', true);
	}
}
