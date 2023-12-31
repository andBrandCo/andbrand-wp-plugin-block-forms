<?php

/**
 * Class that holds all filter used the Block Editor page.
 *
 * @package AndbrandWpPluginBlockFormsBase\Editor
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Editor;

use AndbrandWpPluginBlockFormsBase\AdminMenus\FormAdminMenu;
use AndbrandWpPluginBlockFormsBase\CustomPostType\Forms;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Services\ServiceInterface;

/**
 * Editor class.
 */
class Editor implements ServiceInterface
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_filter('admin_init', [$this, 'getEditorBackLink']);
	}

	/**
	 * Create back link for editor.
	 *
	 * @return void
	 */
	public function getEditorBackLink(): void
	{
		$request = isset($_SERVER['REQUEST_URI']) ? \sanitize_text_field(\wp_unslash($_SERVER['REQUEST_URI'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		$postType = Forms::POST_TYPE_SLUG;
		$page = FormAdminMenu::ADMIN_MENU_SLUG;

		$links = [
			\get_admin_url(null, "edit.php?post_type={$postType}"),
			\get_admin_url(null, "edit.php?post_status=publish&post_type={$postType}"),
			\get_admin_url(null, "edit.php?post_status=draft&post_type={$postType}"),
			\get_admin_url(null, "edit.php?post_status=trash&post_type={$postType}"),
			\get_admin_url(null, "edit.php?post_status=publish&post_type={$postType}"),
			\get_admin_url(null, "edit.php?post_status=future&post_type={$postType}"),
		];

		if (\in_array($request, $links, true)) {
			\wp_safe_redirect(\get_admin_url(null, "admin.php?page={$page}"));
			exit;
		}
	}
}
