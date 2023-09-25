<?php

/**
 * File containing Clearbit specific interface.
 *
 * @package AndbrandWpPluginBlockFormsBase\Integrations\Clearbit
 */

namespace AndbrandWpPluginBlockFormsBase\Integrations\Clearbit;

/**
 * Interface for a Client
 */
interface ClearbitClientInterface
{
	/**
	 * Get mapped params.
	 *
	 * @return array<int, string>
	 */
	public function getParams(): array;

	/**
	 * API request to get application.
	 *
	 * @param string $emailKey Email key to map in params.
	 * @param array<string, mixed> $params Params array.
	 * @param array<string, string> $mapData Map data from settings.
	 *
	 * @return array<string, mixed>
	 */
	public function getApplication(string $emailKey, array $params, array $mapData): array;
}
