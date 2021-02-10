.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt

.. _usageValidators:

Validators
----------

For the CAPTCHA validation to be processed, you need to implement the respective validator provided by this extension. Simply add the validate annotation to your submit action:

.. code-block:: php

    <?php

    namespace Vendor\MyExtension\Controller;

    use Vendor\MyExtension\Domain\Model\Form;

    class MyController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
    {
        /**
         * @var Form $form
         * @TYPO3\CMS\Extbase\Annotation\Validate(param="form", validator="Trafo2\T2Captcha\Validation\Validator\ReCaptchaValidator")
         */
        public function submitReCaptchaAction(Form $form) {
            // processing the form
        }

        /**
         * @var Form $form
         * @TYPO3\CMS\Extbase\Annotation\Validate\Validate(param="form", validator="Trafo2\T2Captcha\Validation\Validator\HCaptchaValidator")
         */
        public function submitHCaptchaAction() {
            // processing the form
        }
    }
