<?php

/**
 * Template for the Input Block view.
 *
 * @package AndbrandWpPluginBlockFormsBase
 */

use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Helpers\Components;

$unique = Components::getUnique();

$inputName = $attributes['inputInputName'] ?? '';
$inputId = $attributes['inputInputId'] ?? '';
$props = [];

if (empty($inputName)) {
	$props['inputName'] = $inputId;
}

echo Components::render(
	'input',
	Components::props('input', $attributes, $props)
);
