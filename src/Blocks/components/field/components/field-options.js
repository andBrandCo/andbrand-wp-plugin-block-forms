import React from 'react';
import { __ } from '@wordpress/i18n';
import { TextControl, Button, BaseControl } from '@wordpress/components';
import {
	icons,
	checkAttr,
	getAttrKey,
	IconLabel,
} from '@eightshift/frontend-libs/scripts';
import manifest from '../manifest.json';

export const FieldOptions = (attributes) => {
	const {
		setAttributes,

		showFieldLabel = true,
	} = attributes;

	const fieldHelp = checkAttr('fieldHelp', attributes, manifest);
	const fieldLabel = checkAttr('fieldLabel', attributes, manifest);
	const fieldHideLabel = checkAttr('fieldHideLabel', attributes, manifest);

	return (
		<>
			{showFieldLabel &&
				<BaseControl
					label={(
						<div className='es-flex-between'>
							<IconLabel icon={icons.fieldLabel} label={__('Field label', 'andbrand-block-forms-base')} />
							<Button
								icon={icons.hide}
								isPressed={fieldHideLabel}
								onClick={() => setAttributes({ [getAttrKey('fieldHideLabel', attributes, manifest)]: !fieldHideLabel })}
								content={__('Hide', 'andbrand-block-forms-base')}
							/>

						</div>
					)}
					help={fieldHideLabel ? __('Hiding the label might impact accessibility!', 'andbrand-block-forms-base') : null}
				>
					{!fieldHideLabel &&
						<TextControl
							value={fieldLabel}
							onChange={(value) => setAttributes({ [getAttrKey('fieldLabel', attributes, manifest)]: value })}
						/>
					}

				</BaseControl>
			}

			<TextControl
				label={<IconLabel icon={icons.fieldHelp} label={__('Help text', 'andbrand-block-forms-base')} />}
				value={fieldHelp}
				onChange={(value) => setAttributes({ [getAttrKey('fieldHelp', attributes, manifest)]: value })}
			/>
		</>
	);
};
