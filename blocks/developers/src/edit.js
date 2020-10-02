import { __ } from '@wordpress/i18n';
import './editor.scss';
import { Card, CardBody,CardHeader, TextControl, TextareaControl } from '@wordpress/components';
import { withState } from '@wordpress/compose';
import { useState } from '@wordpress/element';



export default function Edit({ setAttributes, attributes, className } ) {
	function changeTitle(value) {
		setAttributes({ title: value });
	}
	function changeDesc(value) {
		setAttributes({ description: value });
	}
	return (
	
		
<Card isElevated>

<img src="http://localhost/senpai/wp-content/uploads/2020/09/contact.jpeg" alt="Developers"   height="75px" 
    width="75px" class="center" /> 


<CardHeader >Developers</CardHeader>
<CardBody>
	<TextControl
		label="Section title"
		value={ attributes.title }
		onChange={ ( Value ) => {changeTitle(Value)} }
	/>
	<TextareaControl
			label="Section Description"
			value={ attributes.description }
			onChange={ ( text ) => {changeDesc(text)} }
	/>
</CardBody>
</Card>



	);
}
