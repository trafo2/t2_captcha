<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'CAPTCHAs for Extbase forms',
	'description' => 'reCAPTCHA + hCAPTCHA for Extbase forms',
	'category' => 'misc',
	'version' => '1.0.1',
	'state' => 'stable',
	'uploadfolder' => 0,
	'clearCacheOnLoad' => 1,
	'author' => 'Sebastian Noll',
	'author_email' => 'info@trafo2.de',
	'author_company' => 'Trafo2 GmbH',
	'constraints' => [
		'depends' => [
			'typo3' => '9.5.0-10.4.99',
		],
		'conflicts' => [],
		'suggests' => [],
	],
];
