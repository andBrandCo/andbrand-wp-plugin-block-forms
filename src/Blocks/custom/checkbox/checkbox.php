<?php

/**
 * Template for the checkbox item Block view.
 *
 * @package AndbrandWpPluginBlockFormsBase
 */

use AndbrandWpPluginBlockFormsBase\Blocks\Blocks;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Helpers\Components;

$unique = Components::getUnique();

$checkboxLabel = $attributes['checkboxCheckboxLabel'] ?? '';
$checkboxName = $attributes['checkboxCheckboxName'] ?? '';
$checkboxId = $attributes['checkboxCheckboxId'] ?? '';
$checkboxValue = $attributes['checkboxCheckboxValue'] ?? '';
$props = [];

if (empty($checkboxName)) {
	$props['checkboxName'] = $checkboxId;
}

if (empty($checkboxValue)) {
	$props['checkboxValue'] = apply_filters(Blocks::BLOCKS_STRING_TO_VALUE_FILTER_NAME, $checkboxLabel);
}

echo Components::render(
	'checkbox',
	Components::props('checkbox', $attributes, $props)
);
