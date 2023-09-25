<?php

/**
 * Geolocation interface.
 *
 * @package AndbrandWpPluginBlockFormsBase\Geolocation;
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Geolocation;

/**
 * GeolocationInterface interface.
 */
interface GeolocationInterface
{
	/**
	 * Get all country lists from the manifest.json.
	 *
	 * @return array<string>
	 */
	public function getCountries(): array;
}
