// eslint.config.js
import js from '@eslint/js';
import wordpress from '@wordpress/eslint-plugin';

export default [
	js.configs.recommended,
	{
		plugins: {
			'@wordpress': wordpress,
		},
		rules: {
			...wordpress.configs.recommended.rules,
		},
	},
];
