<?php

/**
 * Class that holds data for admin forms global settings.
 *
 * @package AndbrandWpPluginBlockFormsBase\Settings\Settings
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Settings\GlobalSettings;

/**
 * Interface for SettingsGlobalInterface
 */
interface SettingsGlobalInterface
{
	/**
	 * Get all settings sidebar array for building settings page.
	 *
	 * @param string $type Form Type to show.
	 *
	 * @return array<string, mixed>
	 */
	public function getSettingsSidebar(string $type): array;

	/**
	 * Get all settings array for building settings page.
	 *
	 * @param string $type Form Type to show.
	 *
	 * @return string
	 */
	public function getSettingsForm(string $type): string;
}
