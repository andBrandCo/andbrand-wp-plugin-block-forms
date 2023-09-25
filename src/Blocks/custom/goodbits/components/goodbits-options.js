/* global esFormsBlocksLocalization */

import React from 'react';
import { __ } from '@wordpress/i18n';
import { select } from "@wordpress/data";
import { PanelBody, BaseControl, Button } from '@wordpress/components';
import { IconLabel, icons, STORE_NAME } from '@eightshift/frontend-libs/scripts';

export const GoodbitsOptions = ({ postId }) => {
	const {
		settingsPageUrl,
	} = select(STORE_NAME).getSettings();

	const wpAdminUrl = esFormsBlocksLocalization.wpAdminUrl;
	
	return (
		<PanelBody title={__('Goodbits', 'andbrand-block-forms-base')}>
			<BaseControl
				label={<IconLabel icon={icons.options} label={__('Settings', 'andbrand-block-forms-base')} />}
				help={__('On Goodbits settings page you can setup all details regarding you integration.', 'andbrand-block-forms-base')}
			>
				<Button
					href={`${wpAdminUrl}${settingsPageUrl}&formId=${postId}&type=goodbits`}
					isSecondary
				>
					{__('Open Goodbits Form Settings', 'andbrand-block-forms-base')}
				</Button>
			</BaseControl>
		</PanelBody>
	);
};
