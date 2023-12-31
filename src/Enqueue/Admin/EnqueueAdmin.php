<?php

/**
 * The Admin Enqueue specific functionality.
 *
 * @package AndbrandWpPluginBlockFormsBase\Enqueue\Admin
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Enqueue\Admin;

use AndbrandWpPluginBlockFormsBase\Config\Config;
use AndbrandWpPluginBlockFormsBase\Rest\Routes\CacheDeleteRoute;
use AndbrandWpPluginBlockFormsBase\Rest\Routes\FormSettingsSubmitRoute;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Manifest\ManifestInterface;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Enqueue\Admin\AbstractEnqueueAdmin;

/**
 * Class EnqueueAdmin
 *
 * This class handles enqueue scripts and styles.
 */
class EnqueueAdmin extends AbstractEnqueueAdmin
{
	/**
	 * Create a new admin instance.
	 *
	 * @param ManifestInterface $manifest Inject manifest which holds data about assets from manifest.json.
	 */
	public function __construct(ManifestInterface $manifest)
	{
		$this->manifest = $manifest;
	}

	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('login_enqueue_scripts', [$this, 'enqueueStyles']);
		\add_action('admin_enqueue_scripts', [$this, 'enqueueStyles'], 50);
		\add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);
	}

	/**
	 * Method that returns assets name used to prefix asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsPrefix(): string
	{
		return Config::getProjectName();
	}

	/**
	 * Method that returns assets version for versioning asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsVersion(): string
	{
		return Config::getProjectVersion();
	}

	/**
	 * Get script localizations
	 *
	 * @return array<string, mixed>
	 */
	protected function getLocalizations(): array
	{
		$restRoutesPath = \rest_url() . Config::getProjectRoutesNamespace() . '/' . Config::getProjectRoutesVersion();

		return [
			'esFormsLocalization' => [
				'formSettingsSubmitRestApiUrl' => $restRoutesPath . FormSettingsSubmitRoute::ROUTE_SLUG,
				'clearCacheRestUrl' => $restRoutesPath . CacheDeleteRoute::ROUTE_SLUG,
			]
		];
	}
}
