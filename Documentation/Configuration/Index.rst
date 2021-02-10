.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt

General Usage
-------------

Before you can start using the view helpers or validators, you need to obtain valid API keys from either [reCAPTCHA](https://developers.google.com/recaptcha) or [hCAPTCHA](https://www.hcaptcha.com/).
Define the keys somewhere in your typoscript for the website:

.. code-block:: typoscript
    plugin.tx_t2captcha {
        recaptcha {
            publicKey = <the obtained site key>
            privateKey = <the obtained secret key>
        }
        hcaptcha {
            publicKey = <the obtained site key>
            privateKey = <the obtained secret key>
        }
    }

Please note that defining the keys in typoscript is not required. The keys can be specified in the view helper and validation definition, too. Using typoscript is a more global way if you have multiple forms to be secured by a CAPTCHA.

reCAPTCHA and hCAPTCHA can be used parallel in the same setup.
