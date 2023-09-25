<?php

/**
 * Validation Settings class.
 *
 * @package AndbrandWpPluginBlockFormsBase\Validation
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Validation;

use AndbrandWpPluginBlockFormsBase\Hooks\Filters;
use AndbrandWpPluginBlockFormsBase\Labels\Labels;
use AndbrandWpPluginBlockFormsBase\Settings\SettingsHelper;
use AndbrandWpPluginBlockFormsBase\Labels\LabelsInterface;
use AndbrandWpPluginBlockFormsBase\Helpers\Helper;
use AndbrandWpPluginBlockFormsBase\Settings\Settings\SettingsDataInterface;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Services\ServiceInterface;

/**
 * SettingsValidation class.
 */
class SettingsValidation implements SettingsDataInterface, ServiceInterface
{
	/**
	 * Use general helper trait.
	 */
	use SettingsHelper;

	/**
	 * Custom validation patterns.
	 */
	public const VALIDATION_PATTERNS = [
		'MM/DD' => '^(1[0-2]|0[1-9])\/(3[01]|[12][0-9]|0[1-9])$',
		'DD/MM' => '^(3[01]|[12][0-9]|0[1-9])\/(1[0-2]|0[1-9])$'
	];

	/**
	 * Filter settings sidebar key.
	 */
	public const FILTER_SETTINGS_SIDEBAR_NAME = 'es_forms_settings_sidebar_validation';

	/**
	 * Filter settings key.
	 */
	public const FILTER_SETTINGS_NAME = 'es_forms_settings_validation';

	/**
	 * Filter global settings key.
	 */
	public const FILTER_SETTINGS_GLOBAL_NAME = 'es_forms_settings_global_validation';

	/**
	 * Settings key.
	 */
	public const SETTINGS_TYPE_KEY = 'validation';

	/**
	 * Validation Patterns key.
	 */
	public const SETTINGS_VALIDATION_PATTERNS_KEY = 'validation-patterns';

	/**
	 * Instance variable for labels data.
	 *
	 * @var LabelsInterface
	 */
	protected $labels;

	/**
	 * Create a new instance.
	 *
	 * @param LabelsInterface $labels Inject documentsData which holds labels data.
	 */
	public function __construct(LabelsInterface $labels)
	{
		$this->labels = $labels;
	}

	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_filter(self::FILTER_SETTINGS_SIDEBAR_NAME, [$this, 'getSettingsSidebar']);
		\add_filter(self::FILTER_SETTINGS_NAME, [$this, 'getSettingsData']);
		\add_filter(self::FILTER_SETTINGS_GLOBAL_NAME, [$this, 'getSettingsGlobalData']);
	}

	/**
	 * Get Settings sidebar data.
	 *
	 * @return array<string, mixed>
	 */
	public function getSettingsSidebar(): array
	{
		return [
			'label' => \__('Validation', 'andbrand-block-forms-base'),
			'value' => self::SETTINGS_TYPE_KEY,
			'icon' => Filters::ALL[self::SETTINGS_TYPE_KEY]['icon'],
		];
	}

	/**
	 * Get Form settings data array
	 *
	 * @param string $formId Form Id.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getSettingsData(string $formId): array
	{
		$output = [
			[
				'component' => 'intro',
				'introTitle' => \__('Validation messages', 'andbrand-block-forms-base'),
			]
		];

		$local = \array_flip(Labels::ALL_LOCAL_LABELS);

		// List all labels for settings override.
		foreach ($this->labels->getLabels() as $key => $label) {
			if (!isset($local[$key])) {
				continue;
			}

			$output[] = [
				'component' => 'input',
				'inputName' => $this->getSettingsName($key),
				'inputId' => $this->getSettingsName($key),
				'inputFieldLabel' => \ucfirst($key),
				'inputPlaceholder' => $label,
				'inputValue' => $this->getSettingsValue($key, $formId),
			];
		}

		return $output;
	}

	/**
	 * Get global settings array for building settings page.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getSettingsGlobalData(): array
	{
		$validationPatterns = '';
		foreach (self::VALIDATION_PATTERNS as $key => $value) {
			$validationPatterns .= "<li><code>{$key} : {$value}</code></li>";
		}

		$output = [
			[
				'component' => 'intro',
				'introTitle' => \__('Form validation', 'andbrand-block-forms-base'),
			],
			[
				'component' => 'textarea',
				'textareaId' => $this->getSettingsName(self::SETTINGS_VALIDATION_PATTERNS_KEY),
				'textareaIsMonospace' => true,
				'textareaFieldLabel' => \__('Validation patterns', 'andbrand-block-forms-base'),
				// translators: %s will be replaced with local validation patterns.
				'textareaFieldHelp' => Helper::minifyString(\sprintf(\__("
					These patterns can be selected inside the Form editor.
					<br /> <br />
					Each pattern should be in its own line and in the following format:
					<br />
					<code>pattern-name : pattern </code>
					<br /> <br />
					If you need help with writing regular expressions (<i>regex</i>), <a href='%1\$s' target='_blank' rel='noopener noreferrer'>click here</a>.
					<br /> <br /> <br />
					Use these patterns as an example:
					<ul>
					%2\$s
					</ul>", 'andbrand-block-forms-base'), 'https://regex101.com/', $validationPatterns)),
				'textareaValue' => $this->getOptionValue(self::SETTINGS_VALIDATION_PATTERNS_KEY),
			],
			[
				'component' => 'divider',
			],
			[
				'component' => 'intro',
				'introTitle' => \__('Validation messages', 'andbrand-block-forms-base'),
			],
		];

		$local = \array_flip(Labels::ALL_LOCAL_LABELS);

		// List all labels for settings override.
		foreach ($this->labels->getLabels() as $key => $label) {
			if (isset($local[$key])) {
				continue;
			}

			$output[] = [
				'component' => 'input',
				'inputName' => $this->getSettingsName($key),
				'inputId' => $this->getSettingsName($key),
				'inputFieldLabel' => \ucfirst($key),
				'inputPlaceholder' => $label,
				'inputValue' => $this->getOptionValue($key),
			];
		}

		return $output;
	}
}
