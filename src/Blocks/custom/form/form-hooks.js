/* global esFormsBlocksLocalization */

import { addFilter } from '@wordpress/hooks';
import { select } from '@wordpress/data';
import { STORE_NAME } from '@eightshift/frontend-libs/scripts/editor';
import { isArray } from 'lodash';
import manifest from './manifest.json';

// Provide additional blocks to the forms.
export const hooks = () => {

	const namespace = select(STORE_NAME).getSettingsNamespace();

	const {
		blockName,
	} = manifest;

	// All adding additional blocks to the custom form builder.
	addFilter('blocks.registerBlockType', `${namespace}/${blockName}`, (settings, name) => {
		if (name === `${namespace}/${blockName}` && typeof esFormsBlocksLocalization !== 'undefined' && isArray(esFormsBlocksLocalization?.additionalBlocks)) {
			esFormsBlocksLocalization.additionalBlocks.forEach((element) => {
				settings.attributes.formAllowedBlocks.default.push(element);
			});
		}

		return settings;
	});
};
