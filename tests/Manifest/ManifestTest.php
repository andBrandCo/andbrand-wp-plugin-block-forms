<?php

namespace Tests\Unit\Manifest;

use Brain\Monkey;
use AndbrandWpPluginBlockFormsBase\Manifest\Manifest;

use function Tests\setupMocks;

beforeEach(function() {
	Monkey\setUp();
	setupMocks();

	// Setup manifest mock.
	$this->manifest = new Manifest();
});

afterEach(function() {
	Monkey\tearDown();
});

test('Register method will call init hook', function () {
	$this->manifest->register();

	$this->assertSame(10, has_action('init', 'AndbrandWpPluginBlockFormsBase\Manifest\Manifest->setAssetsManifestRaw()'));
	$this->assertSame(10, \has_filter(Manifest::MANIFEST_ITEM, 'AndbrandWpPluginBlockFormsBase\Manifest\Manifest->getAssetsManifestItem()'));
});
