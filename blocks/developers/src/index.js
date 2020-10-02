
import { registerBlockType } from '@wordpress/blocks';

import { __ } from '@wordpress/i18n';

import './style.scss';

import Edit from './edit';
import save from './save';

registerBlockType( 'create-block/developers', {

	title: __( 'Developers', 'developers' ),

	description: __(
		'Example block written with ESNext standard and JSX support – build step required.',
		'developers'
	),

	category: 'widgets',

	icon: 'smiley',

	supports: {
		// Removes support for an HTML mode.
		html: false,
	},


	edit: Edit,

	save: save,



attributes:{
	title: {
		type: 'string',
	},
	description: {
		type: 'string',
	}
}
} );
