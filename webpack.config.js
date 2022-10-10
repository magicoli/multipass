const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require('path');
const CopyPlugin = require("copy-webpack-plugin");

// Configuration object.
const config = {
  ...defaultConfig,
	entry: {
    '../public/js/public': './src/public/index.js',
    '../admin/js/admin': './src/admin/index.js',
    '../includes/js/fullcalendar': './src/fullcalendar/fullcalendar-library.js',
    '../includes/js/calendar': './src/fullcalendar/calendar.js',
	},
	output: {
    filename: '[name].js',
    // Specify the path to the JS files.
    path: path.resolve( __dirname, 'build' )
	},
}

// Export the config object.
module.exports = config;
