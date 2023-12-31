/* global esFormsBlocksLocalization */

import React from 'react';
import { __ } from '@wordpress/i18n';
import {
	icons,
	checkAttr,
	getAttrKey,
	IconLabel,
	Responsive,
	CustomSlider,
} from '@eightshift/frontend-libs/scripts';
import { TextControl, SelectControl, PanelBody, Button, BaseControl } from '@wordpress/components';
import manifest from '../manifest.json';
import _, { isObject } from 'lodash';

export const FieldOptionsAdvanced = (attributes) => {
	const {
		blockName,
		setAttributes,
	} = attributes;

	const {
		attributes: manifestAttributes,
		responsiveAttributes: {
			fieldWidth
		},
		options
	} = manifest;

	const fieldBeforeContent = checkAttr('fieldBeforeContent', attributes, manifest);
	const fieldAfterContent = checkAttr('fieldAfterContent', attributes, manifest);
	const fieldStyle = checkAttr('fieldStyle', attributes, manifest);

	let fieldStyleOptions = [];

	if (typeof esFormsBlocksLocalization !== 'undefined' && isObject(esFormsBlocksLocalization?.fieldBlockStyleOptions)) {
		fieldStyleOptions = esFormsBlocksLocalization.fieldBlockStyleOptions[blockName];
	}

	const mainFieldWidth = checkAttr(fieldWidth['large'], attributes, manifest, true);

	return (
		<PanelBody title={(
			<span>
				{__('Form field', 'andbrand-block-forms-base')}

				{mainFieldWidth !== undefined && mainFieldWidth < 12 &&
					<span className='es-panel-body-muted'> - {__('width', 'andbrand-block-forms-base')} {mainFieldWidth}</span>
				}
			</span>
		)} initialOpen={false}>


			{fieldStyleOptions &&
				<SelectControl
					label={<IconLabel icon={icons.color} label={__('Style', 'andbrand-block-forms-base')} />}
					help={__('Set what style type is your form.', 'andbrand-block-forms-base')}
					value={fieldStyle}
					options={fieldStyleOptions}
					onChange={(value) => setAttributes({ [getAttrKey('fieldStyle', attributes, manifest)]: value })}
				/>
			}

			<Responsive label={<IconLabel icon={icons.fieldWidth} label={__('Width', 'andbrand-block-forms-base')} />}>
				{Object.entries(fieldWidth).map(([breakpoint, responsiveAttribute], index) => {
					const { default: defaultWidth } = manifestAttributes[responsiveAttribute];

					return (
						<CustomSlider
							key={index}
							label={<IconLabel icon={icons[`screen${_.capitalize(breakpoint)}`]} label={_.capitalize(breakpoint)} />}
							value={checkAttr(responsiveAttribute, attributes, manifest, true) ?? 12}
							onChange={(value) => setAttributes({ [getAttrKey(responsiveAttribute, attributes, manifest)]: value })}
							min={options.fieldWidth.min}
							max={options.fieldWidth.max}
							step={options.fieldWidth.step}
							marks={{ 1: 1, 2: 2, 3: 3, 4: 4, 5: 5, 6: 6, 7: 7, 8: 8, 9: 9, 10: 10, 11: 11, 12: 12 }}
							hasCompactMarks
							rightAddition={
								<Button
									label={__('Reset', 'andbrand-block-forms-base')}
									icon={icons.rotateLeft}
									onClick={() => setAttributes({ [getAttrKey(responsiveAttribute, attributes, manifest)]: defaultWidth })}
									isSmall
									className='es-small-square-icon-button'
								/>
							}
						/>
					);
				})}
			</Responsive>

			<hr />

			<BaseControl label={__('Additional content ', 'andbrand-block-forms-base')}>
				<TextControl
					label={<IconLabel icon={icons.fieldBeforeText} label={__('Below the field label', 'andbrand-block-forms-base')} />}
					value={fieldBeforeContent}
					onChange={(value) => setAttributes({ [getAttrKey('fieldBeforeContent', attributes, manifest)]: value })}
				/>

				<TextControl
					label={<IconLabel icon={icons.fieldAfterText} label={__('Above the help text', 'andbrand-block-forms-base')} />}
					value={fieldAfterContent}
					onChange={(value) => setAttributes({ [getAttrKey('fieldAfterContent', attributes, manifest)]: value })}
				/>
			</BaseControl>
		</PanelBody>
	);
};
