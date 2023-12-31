<?php

/**
 * The class register route for public form submiting endpoint - Mailerlite
 *
 * @package AndbrandWpPluginBlockFormsBase\Rest\Routes
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Rest\Routes;

use AndbrandWpPluginBlockFormsBase\Settings\SettingsHelper;
use AndbrandWpPluginBlockFormsBase\Helpers\UploadHelper;
use AndbrandWpPluginBlockFormsBase\Integrations\ClientInterface;
use AndbrandWpPluginBlockFormsBase\Integrations\Mailerlite\SettingsMailerlite;
use AndbrandWpPluginBlockFormsBase\Labels\LabelsInterface;
use AndbrandWpPluginBlockFormsBase\Validation\ValidatorInterface;

/**
 * Class FormSubmitMailerliteRoute
 */
class FormSubmitMailerliteRoute extends AbstractFormSubmit
{
	/**
	 * Use trait Upload_Helper inside class.
	 */
	use UploadHelper;

	/**
	 * Use general helper trait.
	 */
	use SettingsHelper;

	/**
	 * Instance variable of ValidatorInterface data.
	 *
	 * @var ValidatorInterface
	 */
	public $validator;

	/**
	 * Instance variable of LabelsInterface data.
	 *
	 * @var LabelsInterface
	 */
	protected $labels;

	/**
	 * Instance variable for Mailerlite data.
	 *
	 * @var ClientInterface
	 */
	protected $mailerliteClient;

	/**
	 * Create a new instance that injects classes
	 *
	 * @param ValidatorInterface $validator Inject ValidatorInterface which holds validation methods.
	 * @param LabelsInterface $labels Inject LabelsInterface which holds labels data.
	 * @param ClientInterface $mailerliteClient Inject Mailerlite which holds Mailerlite connect data.
	 */
	public function __construct(
		ValidatorInterface $validator,
		LabelsInterface $labels,
		ClientInterface $mailerliteClient
	) {
		$this->validator = $validator;
		$this->labels = $labels;
		$this->mailerliteClient = $mailerliteClient;
	}

	/**
	 * Get the base url of the route
	 *
	 * @return string The base URL for route you are adding.
	 */
	protected function getRouteName(): string
	{
		return '/form-submit-mailerlite';
	}

	/**
	 * Implement submit action.
	 *
	 * @param string $formId Form ID.
	 * @param array<string, mixed> $params Params array.
	 * @param array<string, array<int, array<string, mixed>>> $files Files array.
	 *
	 * @return mixed
	 */
	public function submitAction(string $formId, array $params = [], $files = [])
	{

		// Check if Mailerlite data is set and valid.
		$isSettingsValid = \apply_filters(SettingsMailerlite::FILTER_SETTINGS_IS_VALID_NAME, $formId);

		// Bailout if settings are not ok.
		if (!$isSettingsValid) {
			return \rest_ensure_response([
				'status' => 'error',
				'code' => 400,
				'message' => $this->labels->getLabel('mailerliteErrorSettingsMissing', $formId),
			]);
		}

		// Send application to Mailerlite.
		$response = $this->mailerliteClient->postApplication(
			$this->getSettingsValue(SettingsMailerlite::SETTINGS_MAILERLITE_LIST_KEY, $formId),
			$params,
			[],
			$formId
		);

		// Finish.
		return \rest_ensure_response([
			'code' => $response['code'],
			'status' => $response['status'],
			'message' => $this->labels->getLabel($response['message'], $formId),
		]);
	}
}
