<?php

/**
 * Class that holds data for admin forms settings.
 *
 * @package AndbrandWpPluginBlockFormsBase\Settings\Settings
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Settings\Settings;

/**
 * Interface for SettingsAllInterface
 */
interface SettingsAllInterface
{
	/**
	 * Get all settings sidebar array for building settings page.
	 *
	 * @param string $formId Form ID.
	 * @param string $type Form Type to show.
	 *
	 * @return array<string, mixed>
	 */
	public function getSettingsSidebar(string $formId, string $type): array;

	/**
	 * Get all settings array for building settings page.
	 *
	 * @param string $formId Form ID.
	 * @param string $type Form Type to show.
	 *
	 * @return string
	 */
	public function getSettingsForm(string $formId, string $type): string;
}
