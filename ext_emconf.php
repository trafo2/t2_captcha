<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'CAPTCHAs for Extbase forms',
	'description' => 'reCAPTCHAv2 + hCAPTCHA for Extbase forms',
	'category' => 'misc',
	'version' => '1.0.0',
	'state' => 'stable',
	'uploadfolder' => 0,
	'clearCacheOnLoad' => 1,
	'author' => 'Sebastian Noll',
	'author_email' => 'info@trafo2.de',
	'author_company' => 'Trafo2 GmbH',
	'constraints' => [
		'depends' => [
			'typo3' => '9.4.99-0.0.0',
		],
		'conflicts' => [],
		'suggests' => [],
	],
];
