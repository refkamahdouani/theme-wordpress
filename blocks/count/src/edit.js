
import { __ } from '@wordpress/i18n';

import './editor.scss';
import './style.scss';


export default function Edit( { className } ) {
	return (
		<p className={ className }>
			{ __( 'Count – hello from the editor!', 'count' ) }
		</p>
	);
}
