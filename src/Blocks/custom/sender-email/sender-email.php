<?php

/**
 * Template for the Sender Email Block view.
 *
 * @package AndbrandWpPluginBlockFormsBase
 */

use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Helpers\Components;

$unique = Components::getUnique();

$inputName = $attributes['senderEmailInputName'] ?? '';

echo Components::render(
	'input',
	Components::props('input', $attributes)
);
