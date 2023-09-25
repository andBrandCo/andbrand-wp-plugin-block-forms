<?php

/**
 * Template for the Checkboxes Block view.
 *
 * @package AndbrandWpPluginBlockFormsBase
 */

use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Helpers\Components;

$checkboxesName = $attributes['checkboxesCheckboxesName'] ?? '';
$checkboxesId = $attributes['checkboxesCheckboxesId'] ?? '';

if (empty($checkboxesName)) {
	$props['checkboxesName'] = $checkboxesId;
}

$props['checkboxesContent'] = $innerBlockContent;

echo Components::render(
	'checkboxes',
	Components::props('checkboxes', $attributes, $props)
);
