<?php

/**
 * The file that defines actions on plugin activation.
 *
 * @package AndbrandWpPluginBlockFormsBase
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase;

use AndbrandWpPluginBlockFormsBase\Permissions\Permissions;
use AndbrandWpPluginBlockFormsBaseVendor\EightshiftLibs\Plugin\HasActivationInterface;
use WP_Role;

/**
 * The plugin activation class.
 */
class Activate implements HasActivationInterface
{
	/**
	 * Activate the plugin.
	 */
	public function activate(): void
	{
		// Add caps.
		foreach (Permissions::DEFAULT_MINIMAL_ROLES as $roleName) {
			$role = \get_role($roleName);

			if ($role instanceof WP_Role) {
				foreach (Permissions::getPermissions() as $item) {
					$role->add_cap($item);
				}
			}
		}

		// Do a cleanup.
		\flush_rewrite_rules();
	}
}
