<?php

namespace Tests\Unit\Integrations\Greenhouse;

use Brain\Monkey;
use AndbrandWpPluginBlockFormsBase\Integrations\ClientInterface;
use AndbrandWpPluginBlockFormsBase\Integrations\Greenhouse\Greenhouse;
use AndbrandWpPluginBlockFormsBase\Integrations\Greenhouse\GreenhouseClient;
use AndbrandWpPluginBlockFormsBase\Integrations\Greenhouse\SettingsGreenhouse;
use AndbrandWpPluginBlockFormsBase\Integrations\MapperInterface;
use AndbrandWpPluginBlockFormsBase\Labels\Labels;
use AndbrandWpPluginBlockFormsBase\Validation\Validator;

use function Tests\setupMocks;

class SettingsGreenhouseMock extends SettingsGreenhouse {

	public function __construct(
		ClientInterface $greenhouseClient,
		MapperInterface $greenhouse
	) {
		parent::__construct($greenhouseClient, $greenhouse);
	}
};

/**
 * Mock before tests.
 */
beforeEach(function () {
	Monkey\setUp();
	setupMocks();

	$greenhouseClient = new GreenhouseClient();
	$labels = new Labels();
	$validator = new Validator($labels);
	$greenhouse = new Greenhouse($greenhouseClient, $validator);

	$this->greenhouseSettings = new SettingsGreenhouseMock($greenhouseClient, $greenhouse);
});

afterAll(function() {
	Monkey\tearDown();
});

test('Register method will call sidebar hook', function () {
	$this->greenhouseSettings->register();

	$this->assertSame(10, \has_filter(SettingsGreenhouseMock::FILTER_SETTINGS_SIDEBAR_NAME, 'Tests\Unit\Integrations\Greenhouse\SettingsGreenhouseMock->getSettingsSidebar()'), 'The callback getSettingsSidebar should be hooked to custom filter hook with priority 10.');
	$this->assertSame(10, \has_filter(SettingsGreenhouseMock::FILTER_SETTINGS_NAME, 'Tests\Unit\Integrations\Greenhouse\SettingsGreenhouseMock->getSettingsData()'), 'The callback getSettingsData should be hooked to custom filter hook with priority 10.');
	$this->assertSame(10, \has_filter(SettingsGreenhouseMock::FILTER_SETTINGS_GLOBAL_NAME, 'Tests\Unit\Integrations\Greenhouse\SettingsGreenhouseMock->getSettingsGlobalData()'), 'The callback getSettingsGlobalData should be hooked to custom filter hook with priority 10.');
	$this->assertSame(10, \has_filter(SettingsGreenhouseMock::FILTER_SETTINGS_IS_VALID_NAME, 'Tests\Unit\Integrations\Greenhouse\SettingsGreenhouseMock->isSettingsValid()'), 'The callback isSettingsValid should be hooked to custom filter hook with priority 10.');
});
