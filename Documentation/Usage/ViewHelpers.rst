.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt

.. _usageViewHelpers:

View Helpers
------------

For using the view helpers, you need to add the fluid namespace to the template:

.. code-block:: html

    <html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
          xmlns:c="http://typo3.org/ns/Trafo2/T2Captcha/ViewHelpers"
          data-namespace-typo3-fluid="true">
        <!-- template code -->
    </html>

Now you can simply place the CAPTCHA view helper at the right location. Here are some examples:

reCAPTCHAv2 checkbox
^^^^^^^^^^^^^^^^^^^^

.. code-block:: html

    <html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
          xmlns:c="http://typo3.org/ns/Trafo2/T2Captcha/ViewHelpers"
          data-namespace-typo3-fluid="true">
        <f:form action="submit">
            <c:reCaptcha.checkbox size="compact"/>
            <button type="submit">Go!</button>
        </f:form>
    </html>

========================= ========================================================================================================================================================================================================================================================================= ===============
Attribute                 Description                                                                                                                                                                                                                                                               Type
========================= ========================================================================================================================================================================================================================================================================= ===============
sitekey                   Your sitekey.                                                                                                                                                                                                                                                             string
theme                     The color theme of the widget.                                                                                                                                                                                                                                            string
size                      The size of the widget.                                                                                                                                                                                                                                                   string
tabindex                  The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.                                                                                                                                   integer
callback                  The name of your callback function, executed when the user submits a successful response. The g-recaptcha-response token is passed to your callback.                                                                                                                      string
expired-callback          The name of your callback function, executed when the reCAPTCHA response expires and the user needs to re-verify.                                                                                                                                                         string
error-callback            The name of your callback function, executed when reCAPTCHA encounters an error (usually network connectivity) and cannot continue until connectivity is restored. If you specify a function here, you are responsible for informing the user that they should retry.     string
========================= ========================================================================================================================================================================================================================================================================= ===============

reCAPTCHA button (invisible V2 / V3)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: html

    <html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
          xmlns:c="http://typo3.org/ns/Trafo2/T2Captcha/ViewHelpers"
          data-namespace-typo3-fluid="true">
        <f:form action="submit">
            <c:reCaptcha.button>
                Go!
            </c:reCaptcha.button>
        </f:form>
    </html>

========================= ========================================================================================================================================================= ===============
Attribute                 Description                                                                                                                                               Type
========================= ========================================================================================================================================================= ===============
sitekey                   Your sitekey.                                                                                                                                             string
badge                     Reposition the reCAPTCHA badge. 'inline' lets you position it with CSS.                                                                                   string
theme                     The color theme of the widget.                                                                                                                            string
size                      The size of the widget.                                                                                                                                   string
tabindex                  The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.                   integer
callback                  The name of your callback function, executed when the user submits a successful response. The g-recaptcha-response token is passed to your callback.      string
standard HTML attributes  Supports all standard attributes like id, class, title, etc.                                                                                              mixed
========================= ========================================================================================================================================================= ===============

hCAPTCHA checkbox
^^^^^^^^^^^^^^^^^

.. code-block:: html

    <html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
          xmlns:c="http://typo3.org/ns/Trafo2/T2Captcha/ViewHelpers"
          data-namespace-typo3-fluid="true">
        <f:form action="submit">
            <c:hCaptcha.checkbox/>
            <button type="submit">Go!</button>
        </f:form>
    </html>

========================= ===================================================================================================================================================== ===============
Attribute                 Description                                                                                                                                           Type
========================= ===================================================================================================================================================== ===============
sitekey                   Your sitekey.                                                                                                                                         string
theme                     The color theme of the widget.                                                                                                                        string
size                      The size of the widget.                                                                                                                               string
tabindex                  The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.               integer
callback                  Called when the user submits a successful response. The h-captcha-response token is passed to your callback.                                          string
expired-callback          Called when the passcode response expires and the user must re-verify.                                                                                string
chalexpired-callback      Called when the user display of a challenge times out with no answer.                                                                                 string
open-callback             Called when the user display of a challenge starts.                                                                                                   string
close-callback            Called when the user dismisses a challenge.                                                                                                           string
error-callback            Called when hCaptcha encounters an error and cannot continue. If you specify an error callback, you must inform the user that they should retry.      string
========================= ===================================================================================================================================================== ===============

hCAPTCHA button
^^^^^^^^^^^^^^^

.. code-block:: html

    <html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
          xmlns:c="http://typo3.org/ns/Trafo2/T2Captcha/ViewHelpers"
          data-namespace-typo3-fluid="true">
        <f:form action="submit">
            <c:hCaptcha.button>
                Go!
            </c:hCaptcha.button>
        </f:form>
    </html>

========================= ===================================================================================================================================================== ===============
Attribute                 Description                                                                                                                                           Type
========================= ===================================================================================================================================================== ===============
sitekey                   Your sitekey.                                                                                                                                         string
badge                     Reposition the reCAPTCHA badge. 'inline' lets you position it with CSS.                                                                               string
theme                     The color theme of the widget.                                                                                                                        string
size                      The size of the widget.                                                                                                                               string
tabindex                  The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.               integer
callback                  Called when the user submits a successful response. The h-captcha-response token is passed to your callback.                                          string
standard HTML attributes  Supports all standard attributes like id, class, title, etc.                                                                                          mixed
========================= ===================================================================================================================================================== ===============

Please be aware that using the view helper will automatically include the external JavaScript library of either reCAPTCHA or hCATPCHA into the html footer.
