module.exports = {
	...require('@wordpress/prettier-config'),
	plugins: ['@prettier/plugin-php'],
	phpVersion: '8.0',

	useTabs: true,
	tabWidth: 2,
	printWidth: 100,
	singleQuote: true,
	trailingComma: 'es5',
	bracketSpacing: true,
	bracketSameLine: false,
	semi: true,
	arrowParens: 'avoid',
};
