import React from 'react';
import { __ } from '@wordpress/i18n';
import { TextControl } from '@wordpress/components';
import {
	icons,
	checkAttr,
	getAttrKey,
	IconLabel,
	FancyDivider
} from '@eightshift/frontend-libs/scripts';
import manifest from '../manifest.json';

export const FormOptions = (attributes) => {
	const {
		setAttributes,
	} = attributes;

	const formName = checkAttr('formName', attributes, manifest);
	const formId = checkAttr('formId', attributes, manifest);

	return (
		<>
			<TextControl
				label={<IconLabel icon={icons.fieldName} label={__('Form name', 'andbrand-block-forms-base')} />}
				help={__('Used to identify and reference the form. If not set, a random name will be generated.', 'andbrand-block-forms-base')}
				value={formName}
				onChange={(value) => setAttributes({ [getAttrKey('formName', attributes, manifest)]: value })}
			/>

			<FancyDivider label={__('Advanced', 'andbrand-block-forms-base')} />

			<TextControl
				label={<IconLabel icon={icons.id} label={__('Unique identifier', 'andbrand-block-forms-base')} />}
				value={formId}
				onChange={(value) => setAttributes({ [getAttrKey('formId', attributes, manifest)]: value })}
			/>
		</>
	);
};
