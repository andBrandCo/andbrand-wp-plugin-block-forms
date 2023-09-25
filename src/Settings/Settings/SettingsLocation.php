<?php

/**
 * Location Settings class.
 *
 * @package AndbrandWpPluginBlockFormsBase\Settings\Settings
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Settings\Settings;

use AndbrandWpPluginBlockFormsBase\Helpers\Helper;
use AndbrandWpPluginBlockFormsBase\Hooks\Filters;
use AndbrandWpPluginBlockFormsBase\Settings\SettingsHelper;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Services\ServiceInterface;

/**
 * SettingsLocation class.
 */
class SettingsLocation implements SettingsDataInterface, ServiceInterface
{
	/**
	 * Use general helper trait.
	 */
	use SettingsHelper;

	/**
	 * Filter settings sidebar key.
	 */
	public const FILTER_SETTINGS_SIDEBAR_NAME = 'es_forms_settings_sidebar_location';

	/**
	 * Filter settings key.
	 */
	public const FILTER_SETTINGS_NAME = 'es_forms_settings_location';

	/**
	 * Settings key.
	 */
	public const SETTINGS_TYPE_KEY = 'location';

	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_filter(self::FILTER_SETTINGS_SIDEBAR_NAME, [$this, 'getSettingsSidebar']);
		\add_filter(self::FILTER_SETTINGS_NAME, [$this, 'getSettingsData']);
	}

	/**
	 * Get Settings sidebar data.
	 *
	 * @return array<string, mixed>
	 */
	public function getSettingsSidebar(): array
	{
		return [
			'label' => \__('Display locations', 'andbrand-block-forms-base'),
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
				'introTitle' => \__('Display locations', 'andbrand-block-forms-base'),
				'introSubtitle' => \__('See where your form appears throughout the website.', 'andbrand-block-forms-base'),
			],
		];

		$locations = $this->getBlockLocations($formId);

		if (!$locations) {
			$output[] = [
				'component' => 'highlighted-content',
				'highlightedContentTitle' => \__('Nothing to see here...', 'andbrand-block-forms-base'),
				'highlightedContentSubtitle' => \__('The form isn\'t used anywhere on this website.', 'andbrand-block-forms-base'),
				'highlightedContentIcon' => 'empty',
			];
		} else {
			$output[] = [
				'component' => 'admin-listing',
				'adminListingForms' => $this->getBlockLocations($formId),
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
		return [];
	}

	/**
	 * Return all posts where form is assigned.
	 *
	 * @param string $formId Form Id.
	 *
	 * @return array<int, mixed>
	 */
	private function getBlockLocations(string $formId): array
	{
		global $wpdb;

		$items = $wpdb->get_results( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			$wpdb->prepare(
				"SELECT ID, post_type, post_title, post_status
				 FROM $wpdb->posts
				 WHERE post_content
				 LIKE %s
				 AND (post_status='publish' OR post_status='draft')
				",
				"%\"formsFormPostId\":\"{$formId}\"%"
			)
		);

		if (!$items) {
			return [];
		}

		return \array_map(
			static function ($item) {
				return [
					'id' => $item->ID,
					'postType' => $item->post_type, // phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
					'title' => $item->post_title, // phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
					'status' => $item->post_status, // phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
					'editLink' => Helper::getFormEditPageUrl((string) $item->ID),
					'viewLink' => \get_permalink($item->ID),
				];
			},
			$items
		);
	}
}
