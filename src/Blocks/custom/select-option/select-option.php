<?php

/**
 * Template for the Select Option Block view.
 *
 * @package AndbrandWpPluginBlockFormsBase
 */

use AndbrandWpPluginBlockFormsBase\Blocks\Blocks;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Helpers\Components;

$unique = Components::getUnique();

$selectOptionLabel = $attributes['selectOptionSelectOptionLabel'] ?? '';
$selectOptionValue = $attributes['selectOptionSelectOptionValue'] ?? '';
$props = [];

if (empty($selectOptionValue)) {
	$props['selectOptionValue'] = apply_filters(Blocks::BLOCKS_STRING_TO_VALUE_FILTER_NAME, $selectOptionLabel);
}

echo Components::render(
	'select-option',
	Components::props('selectOption', $attributes, $props)
);
