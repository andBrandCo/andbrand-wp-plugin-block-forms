<?php

/**
 * Template for the radios Block view.
 *
 * @package AndbrandWpPluginBlockFormsBase
 */

use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Helpers\Components;

$unique = Components::getUnique();

$radiosName = $attributes['radiosRadiosName'] ?? '';
$radiosId = $attributes['radiosRadiosId'] ?? '';
$props = [];

if (empty($radiosName)) {
	$props['radiosName'] = $radiosId;
}

$props['radiosContent'] = $innerBlockContent;

echo Components::render(
	'radios',
	Components::props('radios', $attributes, $props)
);
