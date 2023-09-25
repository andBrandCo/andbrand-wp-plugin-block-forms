<?php

/**
 * File containing Mailchimp specific interface.
 *
 * @package AndbrandWpPluginBlockFormsBase\Integrations\Mailchimp
 */

namespace AndbrandWpPluginBlockFormsBase\Integrations\Mailchimp;

use AndbrandWpPluginBlockFormsBase\Integrations\ClientInterface;

/**
 * Interface for a Client
 */
interface MailchimpClientInterface extends ClientInterface
{
	/**
	 * Return Mailchimp tags for a list.
	 *
	 * @param string $itemId Item id to search.
	 *
	 * @return array<int, mixed>
	 */
	public function getTags(string $itemId): array;
}
