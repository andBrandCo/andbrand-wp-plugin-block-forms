<?php

/**
 * Class that holds all labels.
 *
 * @package EightshiftLibs\Labels
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase\Labels;

use AndbrandWpPluginBlockFormsBase\Integrations\Goodbits\SettingsGoodbits;
use AndbrandWpPluginBlockFormsBase\Integrations\Greenhouse\SettingsGreenhouse;
use AndbrandWpPluginBlockFormsBase\Integrations\Hubspot\SettingsHubspot;
use AndbrandWpPluginBlockFormsBase\Integrations\Mailchimp\SettingsMailchimp;
use AndbrandWpPluginBlockFormsBase\Integrations\Mailerlite\SettingsMailerlite;
use AndbrandWpPluginBlockFormsBase\Settings\SettingsHelper;
use AndbrandWpPluginBlockFormsBase\Validation\SettingsCaptcha;

/**
 * Labels class.
 */
class Labels implements LabelsInterface
{
	/**
	 * Use general helper trait.
	 */
	use SettingsHelper;

	/**
	 * List all label keys that are stored in local form everything else is global settings.
	 */
	public const ALL_LOCAL_LABELS = [
		'mailerSuccess',
		'greenhouseSuccess',
		'mailchimpSuccess',
		'hubspotSuccess',
		'mailerliteSuccess',
		'goodbitsSuccess',
		'clearbitSuccess',
	];

	/**
	 * Get all labels
	 *
	 * @return array<string, string>
	 */
	public function getLabels(): array
	{
		$output = \array_merge(
			$this->getGenericLabels(),
			$this->getValidationLabels(),
			$this->getMailerLabels()
		);

		// Google reCaptcha.
		if ($this->isCheckboxOptionChecked(SettingsCaptcha::SETTINGS_CAPTCHA_USE_KEY, SettingsCaptcha::SETTINGS_CAPTCHA_USE_KEY)) {
			$output = \array_merge($output, $this->getCaptchaLabels());
		}

		// Greenhouse.
		if ($this->isCheckboxOptionChecked(SettingsGreenhouse::SETTINGS_GREENHOUSE_USE_KEY, SettingsGreenhouse::SETTINGS_GREENHOUSE_USE_KEY)) {
			$output = \array_merge($output, $this->getGreenhouseLabels());
		}

		// Mailchimp.
		if ($this->isCheckboxOptionChecked(SettingsMailchimp::SETTINGS_MAILCHIMP_USE_KEY, SettingsMailchimp::SETTINGS_MAILCHIMP_USE_KEY)) {
			$output = \array_merge($output, $this->getMailchimpLabels());
		}

		// Hubspot.
		if ($this->isCheckboxOptionChecked(SettingsHubspot::SETTINGS_HUBSPOT_USE_KEY, SettingsHubspot::SETTINGS_HUBSPOT_USE_KEY)) {
			$output = \array_merge($output, $this->getHubspotLabels());
		}

		// Mailerlite.
		if ($this->isCheckboxOptionChecked(SettingsMailerlite::SETTINGS_MAILERLITE_USE_KEY, SettingsMailerlite::SETTINGS_MAILERLITE_USE_KEY)) {
			$output = \array_merge($output, $this->getMailerliteLabels());
		}

		// Goodbits.
		if ($this->isCheckboxOptionChecked(SettingsGoodbits::SETTINGS_GOODBITS_USE_KEY, SettingsGoodbits::SETTINGS_GOODBITS_USE_KEY)) {
			$output = \array_merge($output, $this->getGoodbitsLabels());
		}

		return $output;
	}

	/**
	 * Return labels - Generic
	 *
	 * @return array<string, string>
	 */
	private function getGenericLabels(): array
	{
		return [
			'submitWpError' => \__('Something went wrong while submitting your form. Please try again.', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return labels - Validation
	 *
	 * @return array<string, string>
	 */
	private function getValidationLabels(): array
	{
		return [
			'validationRequired' => \__('This field is required.', 'andbrand-block-forms-base'),
			// translators: %s used for displaying required number.
			'validationRequiredCount' => \__('This field is required, with at least %s items selected.', 'andbrand-block-forms-base'),
			'validationEmail' => \__('This e-mail is not valid.', 'andbrand-block-forms-base'),
			'validationUrl' => \__('This URL is not valid.', 'andbrand-block-forms-base'),
			// translators: %s used for displaying length min number to the user.
			'validationMinLength' => \__('This field value has less characters than expected. We expect minimum %s characters.', 'andbrand-block-forms-base'),
			// translators: %s used for displaying length max number to the user.
			'validationMaxLength' => \__('This field value has more characters than expected. We expect maximum %s characters.', 'andbrand-block-forms-base'),
			'validationNumber' => \__('This field should only contain numbers.', 'andbrand-block-forms-base'),
			// translators: %s used for displaying validation pattern to the user.
			'validationPattern' => \__('This field doesn\'t satisfy the validation pattern: %s.', 'andbrand-block-forms-base'),
			// translators: %s used for displaying file type value.
			'validationAccept' => \__('The file type is not supported. Only %s are allowed.', 'andbrand-block-forms-base'),
			// translators: %s used for displaying file type value.
			'validationAcceptMime' => \__('The file seems to be corrupted. Only %s are allowed.', 'andbrand-block-forms-base'),
			// translators: %s used for displaying number value.
			'validationMinSize' => \__('The file is smaller than allowed. Minimum file size is %s kB.', 'andbrand-block-forms-base'),
			// translators: %s used for displaying number value.
			'validationMaxSize' => \__('The file is larger than allowed. Maximum file size is %s kB.', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return labels - Mailer
	 *
	 * @return array<string, string>
	 */
	private function getMailerLabels(): array
	{
		return [
			'mailerSuccessNoSend' => \__('E-mail was sent successfully.', 'andbrand-block-forms-base'),
			'mailerErrorSettingsMissing' => \__('Form settings are not configured correctly. Please try again.', 'andbrand-block-forms-base'),
			'mailerErrorEmailSend' => \__('E-mail was not sent due to an unknown issue. Please try again.', 'andbrand-block-forms-base'),
			'mailerErrorEmailConfirmationSend' => \__('Confirmation e-mail was not sent due to unknown issue. Please try again.', 'andbrand-block-forms-base'),
			'mailerSuccess' => \__('E-mail was sent successfully.', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return labels - Greenhouse
	 *
	 * @return array<string, string>
	 */
	private function getGreenhouseLabels(): array
	{
		return [
			'greenhouseErrorSettingsMissing' => \__('Greenhouse integration is not configured correctly. Please try again.', 'andbrand-block-forms-base'),
			'greenhouseBadRequestError' => \__('Something is not right with the job application. Please check all the fields and try again.', 'andbrand-block-forms-base'),
			'greenhouseUnsupportedFileTypeError' => \__('An unsupported file type was uploaded. Please try again.', 'andbrand-block-forms-base'),
			'greenhouseInvalidFirstNameError' => \__('"First name" is in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidLastNameError' => \__('"Last name" is in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidEmailError' => \__('Enter a valid email address.', 'andbrand-block-forms-base'),
			'greenhouseInvalidFirstNameLastNameEmailError' => \__('"First name", "Last name", and "E-mail" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidFirstNameLastNameError' => \__('"First name" and "Last name" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidFirstNameEmailError' => \__('"First name" and "E-mail" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidLastNameEmailError' => \__('"Last name" and "E-mail" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidFirstNamePhoneError' => \__('"First name" and "Phone" are an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidLastNamePhoneError' => \__('"First name" and "Phone" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidEmailPhoneError' => \__('"E-mail" and "Phone" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidFirstNameLastNameEmailPhoneError' => \__('"First name", "Last name", "E-mail", and "Phone" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidFirstNameLastNamePhoneError' => \__('"First name", "Last name", and "Phone" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidFirstNameEmailPhoneError' => \__('"First name", "E-mail", and "Phone" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseInvalidLastNameEmailPhoneError' => \__('"Last name", "E-mail", and "Phone" are in an incorrect format.', 'andbrand-block-forms-base'),
			'greenhouseSuccess' => \__('Application submitted successfully. Thank you!', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return labels - Mailchimp
	 *
	 * @return array<string, string>
	 */
	private function getMailchimpLabels(): array
	{
		return [
			'mailchimpErrorSettingsMissing' => \__('Mailchimp integration is not configured correctly. Please try again.', 'andbrand-block-forms-base'),
			'mailchimpBadRequestError' => \__('Something is not right with the subscription. Please check all the fields and try again.', 'andbrand-block-forms-base'),
			'mailchimpInvalidResourceError' => \__('Something is not right with the resource. Please check all the fields and try again.', 'andbrand-block-forms-base'),
			'mailchimpInvalidEmailError' => \__('Enter a valid email address.', 'andbrand-block-forms-base'),
			'mailchimpMissingFieldsError' => \__('It looks like some required fields are missing. Please check all the fields and try again.', 'andbrand-block-forms-base'),
			'mailchimpSuccess' => \__('Newsletter subscription successful. Thank you!', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return labels - HubSpot
	 *
	 * @return array<string, string>
	 */
	private function getHubspotLabels(): array
	{
		return [
			// Internal.
			'hubspotErrorSettingsMissing' => \__('Hubspot integration is not configured correctly. Please try again.', 'andbrand-block-forms-base'),
			'hubspotBadRequestError' => \__('Something is not with the application. Please check all the fields and try again.', 'andbrand-block-forms-base'),
			'hubspotInvalidRequestError' => \__('Something is not right with the application. Please check all the fields and try again.', 'andbrand-block-forms-base'),
			'hubspotSuccess' => \__('The form was submitted successfully. Thank you!', 'andbrand-block-forms-base'),

			// Hubspot.
			'hubspotMaxNumberOfSubmittedValuesExceededError' => \__('More than 1000 fields were included in the response. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotInvalidEmailError' => \__('Enter a valid email address.', 'andbrand-block-forms-base'),
			'hubspotBlockedEmailError' => \__('We are sorry but you email was blocked in our blacklist.', 'andbrand-block-forms-base'),
			'hubspotRequiredFieldError' => \__('Some required fields are not filled in, please check them and try again.', 'andbrand-block-forms-base'),
			'hubspotInvalidNumberError' => \__('Some of number fields are not a valid number value.', 'andbrand-block-forms-base'),
			'hubspotInputTooLargeError' => \__('The value in the field is too large for the type of field.', 'andbrand-block-forms-base'),
			'hubspotFieldNotInFormDefinitionError' => \__('The field was included in the form submission but is not in the form definition.', 'andbrand-block-forms-base'),
			'hubspotNumberOutOfRangeError' => \__('The value of a number field outside the range specified in the field settings.', 'andbrand-block-forms-base'),
			'hubspotValueNotInFieldDefinitionError' => \__('The value provided for an enumeration field (e.g. checkbox, dropdown, radio) is not one of the possible options.', 'andbrand-block-forms-base'),
			'hubspotInvalidMetadataError' => \__('The context object contains an unexpected attribute. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotInvalidGotowebinarWebinarKeyError' => \__('The value in goToWebinarWebinarKey in the context object is invalid. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotInvalidHutkError' => \__('The hutk field in the context object is invalid. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotInvalidIpAddressError' => \__('The ipAddress field in the context object is invalid. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotInvalidPageUriError' => \__('The pageUri field in the context object is invalid. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotInvalidLegalOptionFormatError' => \__('LegalConsentOptions was empty or it contains both the consent and legitimateInterest fields. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotMissingProcessingConsentError' => \__('The consentToProcess field in consent or value field in legitimateInterest was false. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotMissingProcessingConsentTextError' => \__('The text field for processing consent was missing. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotMissingCommunicationConsentTextError' => \__('The communication consent text was missing for a subscription. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotMissingLegitimateInterestTextError' => \__('The legitimate interest consent text was missing. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotDuplicateSubscriptionTypeIdError' => \__('The communications list contains two or more items with the same subscriptionTypeId. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotHasRecaptchaEnabledError' => \__('Your Hubspot form has reCaptch enabled and we are not able to process the request. Please disable reCaptcha and try again. Please contact website administrator.', 'andbrand-block-forms-base'),
			'hubspotError429Error' => \__('The HubSpot account has reached the rate limit. Please contact website administrator.', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return labels - Mailerlite
	 *
	 * @return array<string, string>
	 */
	private function getMailerliteLabels(): array
	{
		return [
			'mailerliteErrorSettingsMissing' => \__('MailerLite integration is not configured correctly. Please try again.', 'andbrand-block-forms-base'),
			'mailerliteBadRequestError' => \__('Something is not right with the subscription. Please check all the fields and try again.', 'andbrand-block-forms-base'),
			'mailerliteInvalidEmailError' => \__('Enter a valid email address.', 'andbrand-block-forms-base'),
			'mailerliteEmailTemporarilyBlockedError' => \__('The e-mail is temporarily blocked by our e-mail client. Please try again later or use try a different e-mail.', 'andbrand-block-forms-base'),
			'mailerliteSuccess' => \__('The newsletter was successful. Thank you!', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return labels - Goodbits
	 *
	 * @return array<string, string>
	 */
	private function getGoodbitsLabels(): array
	{
		return [
			'goodbitsErrorSettingsMissing' => \__('Goodbits integration is not configured correctly. Please try again.', 'andbrand-block-forms-base'),
			'goodbitsBadRequestError' => \__('Something is not right with the subscription. Please check all the fields and try again.', 'andbrand-block-forms-base'),
			'goodbitsInvalidEmailError' => \__('Enter a valid email address.', 'andbrand-block-forms-base'),
			'goodbitsUnauthorizedError' => \__('There was an authorization error (incorrect API key). Contact support.', 'andbrand-block-forms-base'),
			'goodbitsSuccess' => \__('The newsletter subscription was successful. Thank you!', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return labels - Google reCaptcha
	 *
	 * @return array<string, string>
	 */
	private function getCaptchaLabels(): array
	{
		return [
			'captchaMissingInputSecret' => \__('The Captcha "secret" parameter is missing.', 'andbrand-block-forms-base'),
			'captchaInvalidInputSecret' => \__('The Captcha "secret" parameter is invalid or malformed.', 'andbrand-block-forms-base'),
			'captchaInvalidInputResponse' => \__('The Captcha "response" parameter is invalid or malformed.', 'andbrand-block-forms-base'),
			'captchaMissingInputResponse' => \__('The Captcha "response" parameter is missing.', 'andbrand-block-forms-base'),
			'captchaBadRequest' => \__('The Captcha "request" is invalid or malformed.', 'andbrand-block-forms-base'),
			'captchaTimeoutOrDuplicate' => \__('The Captcha response is no longer valid: either is too old or has been used previously.', 'andbrand-block-forms-base'),
			'captchaWrongAction' => \__('The Captcha response "action" is not valid.', 'andbrand-block-forms-base'),
			'captchaIncorrectCaptchaSol' => \__('The Captcha keys are not valid. Please check your site and secret key configuration.', 'andbrand-block-forms-base'),
			'captchaScoreSpam' => \__('The automated system detected this request as a potential spam request. Please try again.', 'andbrand-block-forms-base'),
		];
	}

	/**
	 * Return one label by key
	 *
	 * @param string $key Label key.
	 * @param string $formId Form ID.
	 *
	 * @return string
	 */
	public function getLabel(string $key, string $formId = ''): string
	{
		// If form ID is not missing check form settings for the overrides.
		if (!empty($formId)) {
			$local = \array_flip(self::ALL_LOCAL_LABELS);

			if (isset($local[$key])) {
				$dbLabel = $this->getSettingsValue($key, $formId);
			} else {
				$dbLabel = $this->getOptionValue($key);
			}

			// If there is an override in the DB use that.
			if (!empty($dbLabel)) {
				return $dbLabel;
			}
		}

		$labels = $this->getLabels();

		return $labels[$key] ?? '';
	}
}
