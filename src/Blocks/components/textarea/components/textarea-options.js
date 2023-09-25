/* global esFormsBlocksLocalization */

import React, { useState } from 'react';
import { __ } from '@wordpress/i18n';
import { isArray } from 'lodash';
import { TextControl, PanelBody, Button, Popover } from '@wordpress/components';
import {
	icons,
	checkAttr,
	getAttrKey,
	IconLabel,
	props,
	SimpleVerticalSingleSelect,
	FancyDivider,
} from '@eightshift/frontend-libs/scripts';
import { FieldOptions } from '../../../components/field/components/field-options';
import { FieldOptionsAdvanced } from '../../field/components/field-options-advanced';
import manifest from '../manifest.json';

export const TextareaOptions = (attributes) => {
	const {
		setAttributes,
	} = attributes;

	const textareaName = checkAttr('textareaName', attributes, manifest);
	const textareaValue = checkAttr('textareaValue', attributes, manifest);
	const textareaPlaceholder = checkAttr('textareaPlaceholder', attributes, manifest);
	const textareaIsDisabled = checkAttr('textareaIsDisabled', attributes, manifest);
	const textareaIsReadOnly = checkAttr('textareaIsReadOnly', attributes, manifest);
	const textareaIsRequired = checkAttr('textareaIsRequired', attributes, manifest);
	const textareaTracking = checkAttr('textareaTracking', attributes, manifest);
	const textareaValidationPattern = checkAttr('textareaValidationPattern', attributes, manifest);

	let textareaValidationPatternOptions = [];

	if (typeof esFormsBlocksLocalization !== 'undefined' && isArray(esFormsBlocksLocalization?.validationPatternsOptions)) {
		textareaValidationPatternOptions = esFormsBlocksLocalization.validationPatternsOptions;
	}

	const [showValidation, setShowValidation] = useState(false);

	return (
		<>
			<PanelBody title={__('Multiline text', 'andbrand-block-forms-base')}>
				<FieldOptions
					{...props('field', attributes)}
				/>

				<TextControl
					label={<IconLabel icon={icons.fieldPlaceholder} label={__('Placeholder', 'andbrand-block-forms-base')} />}
					help={__('Shown when the field is empty', 'andbrand-block-forms-base')}
					value={textareaPlaceholder}
					onChange={(value) => setAttributes({ [getAttrKey('textareaPlaceholder', attributes, manifest)]: value })}
				/>

				<FancyDivider label={__('Validation', 'andbrand-block-forms-base')} />

				<div className='es-h-spaced'>
					<Button
						icon={icons.fieldRequired}
						isPressed={textareaIsRequired}
						onClick={() => setAttributes({ [getAttrKey('textareaIsRequired', attributes, manifest)]: !textareaIsRequired })}
					>
						{__('Required', 'andbrand-block-forms-base')}
					</Button>

					<Button
						icon={icons.regex}
						isPressed={textareaValidationPattern?.length > 0}
						onClick={() => setShowValidation(true)}
					>
						{__('Pattern validation', 'andbrand-block-forms-base')}

						{showValidation &&
							<Popover noArrow={false} onClose={() => setShowValidation(false)}>
								<div className='es-popover-content'>
									<SimpleVerticalSingleSelect
										label={__('Validation pattern', 'andbrand-block-forms-base')}
										options={textareaValidationPatternOptions.map(({ label, value }) => ({
											onClick: () => setAttributes({ [getAttrKey('textareaValidationPattern', attributes, manifest)]: value }),
											label: label,
											isActive: textareaValidationPattern === value,
										}))}
									/>
								</div>
							</Popover>
						}
					</Button>
				</div>

				<FancyDivider label={__('Advanced', 'andbrand-block-forms-base')} />

				<TextControl
					label={<IconLabel icon={icons.fieldValue} label={__('Initial value', 'andbrand-block-forms-base')} />}
					value={textareaValue}
					onChange={(value) => setAttributes({ [getAttrKey('textareaValue', attributes, manifest)]: value })}
				/>

				<TextControl
					label={<IconLabel icon={icons.fieldName} label={__('Name', 'andbrand-block-forms-base')} />}
					help={__('Should be unique! Used to identify the field within form submission data. If not set, a random name will be generated.', 'andbrand-block-forms-base')}
					value={textareaName}
					onChange={(value) => setAttributes({ [getAttrKey('textareaName', attributes, manifest)]: value })}
				/>

				<div className='es-h-spaced'>
					<Button
						icon={icons.fieldReadonly}
						isPressed={textareaIsReadOnly}
						onClick={() => setAttributes({ [getAttrKey('textareaIsReadOnly', attributes, manifest)]: !textareaIsReadOnly })}
					>
						{__('Read-only', 'andbrand-block-forms-base')}
					</Button>

					<Button
						icon={icons.fieldDisabled}
						isPressed={textareaIsDisabled}
						onClick={() => setAttributes({ [getAttrKey('textareaIsDisabled', attributes, manifest)]: !textareaIsDisabled })}
					>
						{__('Disabled', 'andbrand-block-forms-base')}
					</Button>
				</div>

				<FancyDivider label={__('Tracking', 'andbrand-block-forms-base')} />

				<TextControl
					label={<IconLabel icon={icons.code} label={__('GTM tracking code', 'andbrand-block-forms-base')} />}
					value={textareaTracking}
					onChange={(value) => setAttributes({ [getAttrKey('textareaTracking', attributes, manifest)]: value })}
				/>
			</PanelBody>

			<FieldOptionsAdvanced
				{...props('field', attributes)}
			/>
		</>
	);
};
