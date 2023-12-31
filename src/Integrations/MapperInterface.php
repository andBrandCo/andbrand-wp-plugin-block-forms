<?php

/**
 * The class for Mapper interface.
 *
 * @package AndbrandWpPluginBlockFormsBase\Integrations
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Integrations;

/**
 * Class Mapper
 */
interface MapperInterface
{
	/**
	 * Map form to our components.
	 *
	 * @param string $formId Form ID.
	 * @param array<string, mixed> $formAdditionalProps Additional props.
	 *
	 * @return string
	 */
	public function getForm(string $formId, array $formAdditionalProps = []): string;

	/**
	 * Get mapped form fields.
	 *
	 * @param string $formId Form Id.
	 * @param bool $ssr Does form load using ssr.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getFormFields(string $formId, bool $ssr = false): array;
}
