import React from 'react';
import { __ } from '@wordpress/i18n';
import { TextControl, PanelBody, Button } from '@wordpress/components';
import {
	icons,
	checkAttr,
	getAttrKey,
	IconLabel,
	props,
	FancyDivider,
} from '@eightshift/frontend-libs/scripts';
import { FieldOptions } from '../../../components/field/components/field-options';
import { FieldOptionsAdvanced } from '../../field/components/field-options-advanced';
import manifest from '../manifest.json';

export const SubmitOptions = (attributes) => {
	const {
		setAttributes,
	} = attributes;

	const submitValue = checkAttr('submitValue', attributes, manifest);
	const submitIsDisabled = checkAttr('submitIsDisabled', attributes, manifest);
	const submitTracking = checkAttr('submitTracking', attributes, manifest);

	return (
		<>
			<PanelBody title={__('Submit', 'andbrand-block-forms-base')}>
				<FieldOptions
					{...props('field', attributes)}
					showFieldLabel={false}
				/>

				<TextControl
					label={<IconLabel icon={icons.buttonOutline} label={__('Button label', 'andbrand-block-forms-base')} />}
					value={submitValue}
					onChange={(value) => setAttributes({ [getAttrKey('submitValue', attributes, manifest)]: value })}
				/>

				<Button
					icon={icons.fieldDisabled}
					isPressed={submitIsDisabled}
					onClick={() => setAttributes({ [getAttrKey('submitIsDisabled', attributes, manifest)]: !submitIsDisabled })}
				>
					{__('Disabled', 'andbrand-block-forms-base')}
				</Button>

				<FancyDivider label={__('Tracking', 'andbrand-block-forms-base')} />

				<TextControl
					label={<IconLabel icon={icons.code} label={__('GTM tracking code', 'andbrand-block-forms-base')} />}
					value={submitTracking}
					onChange={(value) => setAttributes({ [getAttrKey('submitTracking', attributes, manifest)]: value })}
				/>
			</PanelBody>

			<FieldOptionsAdvanced
				{...props('field', attributes)}
			/>
		</>
	);
};
