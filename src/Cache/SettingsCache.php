<?php

/**
 * Cache Settings class.
 *
 * @package AndbrandWpPluginBlockFormsBase\Cache
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Cache;

use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Helpers\Components;
use AndbrandWpPluginBlockFormsBase\Hooks\Filters;
use AndbrandWpPluginBlockFormsBase\Integrations\Greenhouse\GreenhouseClient;
use AndbrandWpPluginBlockFormsBase\Integrations\Hubspot\HubspotClient;
use AndbrandWpPluginBlockFormsBase\Integrations\Mailchimp\MailchimpClient;
use AndbrandWpPluginBlockFormsBase\Integrations\Mailerlite\MailerliteClient;
use AndbrandWpPluginBlockFormsBase\Settings\SettingsHelper;
use AndbrandWpPluginBlockFormsBase\Settings\GlobalSettings\SettingsGlobalDataInterface;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Services\ServiceInterface;

/**
 * SettingsCache class.
 */
class SettingsCache implements SettingsGlobalDataInterface, ServiceInterface
{
	/**
	 * Use general helper trait.
	 */
	use SettingsHelper;

	/**
	 * Filter settings sidebar key.
	 */
	public const FILTER_SETTINGS_SIDEBAR_NAME = 'es_forms_settings_sidebar_cache';

	/**
	 * Filter global settings key.
	 */
	public const FILTER_SETTINGS_GLOBAL_NAME = 'es_forms_settings_global_cache';

	/**
	 * Settings key.
	 */
	public const SETTINGS_TYPE_KEY = 'cache';

	/**
	 * List all cache options in the project.
	 */
	public const ALL_CACHE = [
		'mailchimp' => [
			MailchimpClient::CACHE_MAILCHIMP_ITEMS_TRANSIENT_NAME,
			MailchimpClient::CACHE_MAILCHIMP_ITEM_TRANSIENT_NAME,
			MailchimpClient::CACHE_MAILCHIMP_ITEM_TAGS_TRANSIENT_NAME,
		],
		'greenhouse' => [
			GreenhouseClient::CACHE_GREENHOUSE_ITEMS_TRANSIENT_NAME,
			GreenhouseClient::CACHE_GREENHOUSE_ITEM_TRANSIENT_NAME,
		],
		'hubspot' => [
			HubspotClient::CACHE_HUBSPOT_ITEMS_TRANSIENT_NAME,
			HubspotClient::CACHE_HUBSPOT_CONTACT_PROPERTIES_TRANSIENT_NAME,
		],
		'mailerlite' => [
			MailerliteClient::CACHE_MAILERLITE_ITEMS_TRANSIENT_NAME,
			MailerliteClient::CACHE_MAILERLITE_ITEM_TRANSIENT_NAME,
		],
	];

	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_filter(self::FILTER_SETTINGS_SIDEBAR_NAME, [$this, 'getSettingsSidebar']);
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
			'label' => \__('Clear cache', 'andbrand-block-forms-base'),
			'value' => self::SETTINGS_TYPE_KEY,
			'icon' => Filters::ALL[self::SETTINGS_TYPE_KEY]['icon'],
		];
	}

	/**
	 * Get global settings array for building settings page.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getSettingsGlobalData(): array
	{
		$output = [
			[
				'component' => 'intro',
				'introTitle' => \__('Clear cache', 'andbrand-block-forms-base'),
				'introSubtitle' => \__('Use the buttons below to clear the cache if the entry you\'re looking for isn\'t available or has changed.', 'andbrand-block-forms-base'),
			]
		];

		$manifestForm = Components::getManifest(\dirname(__DIR__, 1) . '/Blocks/components/form');

		foreach (self::ALL_CACHE as $key => $value) {
			$output[] = [
				'component' => 'submit',
				'submitFieldWidthLarge' => 2,
				'submitValue' => "Clear " . \ucfirst($key) . ' cache',
				'submitIcon' => $key,
				'submitAttrs' => [
					'data-type' => $key,
				],
				'additionalClass' => $manifestForm['componentCacheJsClass'] . ' es-submit--cache-clear',
			];
		};

		return $output;
	}
}
