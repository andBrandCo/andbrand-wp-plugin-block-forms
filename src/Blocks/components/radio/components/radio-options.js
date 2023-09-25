import React from 'react';
import { __ } from '@wordpress/i18n';
import { TextControl, Button } from '@wordpress/components';
import {
	checkAttr,
	getAttrKey,
	icons,
	IconLabel,
	FancyDivider
} from '@eightshift/frontend-libs/scripts';
import manifest from '../manifest.json';

export const RadioOptions = (attributes) => {
	const {
		setAttributes,
	} = attributes;

	const radioLabel = checkAttr('radioLabel', attributes, manifest);
	const radioValue = checkAttr('radioValue', attributes, manifest);
	const radioIsChecked = checkAttr('radioIsChecked', attributes, manifest);
	const radioIsDisabled = checkAttr('radioIsDisabled', attributes, manifest);
	const radioTracking = checkAttr('radioTracking', attributes, manifest);

	return (
		<>
			<TextControl
				label={<IconLabel icon={icons.textSize} label={__('Radio button label', 'andbrand-block-forms-base')} />}
				value={radioLabel}
				onChange={(value) => setAttributes({ [getAttrKey('radioLabel', attributes, manifest)]: value })}
			/>

			<Button
				icon={icons.checkCircle}
				isPressed={radioIsChecked}
				onClick={() => setAttributes({ [getAttrKey('radioIsChecked', attributes, manifest)]: !radioIsChecked })}
			>
				{__('Select by default', 'andbrand-block-forms-base')}
			</Button>

			<FancyDivider label={__('Advanced', 'andbrand-block-forms-base')} />

			<TextControl
				label={<IconLabel icon={icons.fieldValue} label={__('Value', 'andbrand-block-forms-base')} />}
				help={__('Internal value, sent if the radio button is selected.', 'andbrand-block-forms-base')}
				value={radioValue}
				onChange={(value) => setAttributes({ [getAttrKey('radioValue', attributes, manifest)]: value })}
			/>

			<Button
				icon={icons.fieldDisabled}
				isPressed={radioIsDisabled}
				onClick={() => setAttributes({ [getAttrKey('radioIsDisabled', attributes, manifest)]: !radioIsDisabled })}
			>
				{__('Disabled', 'andbrand-block-forms-base')}
			</Button>

			<FancyDivider label={__('Tracking', 'andbrand-block-forms-base')} />

			<TextControl
				label={<IconLabel icon={icons.code} label={__('GTM tracking code', 'andbrand-block-forms-base')} />}
				value={radioTracking}
				onChange={(value) => setAttributes({ [getAttrKey('radioTracking', attributes, manifest)]: value })}
			/>
		</>
	);
};
