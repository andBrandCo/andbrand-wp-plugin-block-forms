<?php

/**
 * File containing an user Permissions class.
 *
 * @package AndbrandWpPluginBlockFormsBase\Permissions
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Permissions;

use AndbrandWpPluginBlockFormsBase\AdminMenus\FormAdminMenu;
use AndbrandWpPluginBlockFormsBase\AdminMenus\FormGlobalSettingsAdminSubMenu;
use AndbrandWpPluginBlockFormsBase\AdminMenus\FormListingAdminSubMenu;
use AndbrandWpPluginBlockFormsBase\AdminMenus\FormSettingsAdminSubMenu;
use AndbrandWpPluginBlockFormsBase\CustomPostType\Forms;

/**
 * Class Permissions
 */
class Permissions
{
	/**
	 * Default user role to assign permissions.
	 */
	public const DEFAULT_MINIMAL_ROLES = [
		'editor',
		'administrator',
	];

	/**
	 * All permissions.
	 *
	 * @return array <string>
	 */
	public static function getPermissions(): array
	{
		$postType = Forms::POST_CAPABILITY_TYPE;

		return [
			$postType,
			FormAdminMenu::ADMIN_MENU_CAPABILITY,
			FormGlobalSettingsAdminSubMenu::ADMIN_MENU_CAPABILITY,
			FormListingAdminSubMenu::ADMIN_MENU_CAPABILITY,
			FormSettingsAdminSubMenu::ADMIN_MENU_CAPABILITY,
			"edit_{$postType}",
			"read_{$postType}",
			"delete_{$postType}",
			"edit_{$postType}s",
			"edit_others_{$postType}s",
			"delete_{$postType}s",
			"publish_{$postType}s",
			"read_private_{$postType}s",
		];
	}
}
