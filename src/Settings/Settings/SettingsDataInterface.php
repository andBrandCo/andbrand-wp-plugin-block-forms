<?php

/**
 * Interface that holds all methods for building single form settings form.
 *
 * @package AndbrandWpPluginBlockFormsBase\Settings\Settings
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Settings\Settings;

/**
 * Interface for SettingsDataInterface
 */
interface SettingsDataInterface
{
	/**
	 * Get Settings sidebar data.
	 *
	 * @return array<string, mixed>
	 */
	public function getSettingsSidebar(): array;

	/**
	 * Get Form settings data array
	 *
	 * @param string $formId Form Id.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getSettingsData(string $formId): array;
}
