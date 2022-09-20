const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require('path');
const CopyPlugin = require("copy-webpack-plugin");

// Configuration object.
const config = {
  ...defaultConfig,
	entry: {
		// 'admin/admin': './dev/admin/admin-index.js',
    '../public/public': './src/public/index.js',
    '../admin/admin': './src/admin/index.js',
    '../includes/fullcalendar/fullcalendar': './src/fullcalendar/index.js',
	},
	output: {
    filename: '[name].js',
    // Specify the path to the JS files.
    path: path.resolve( __dirname, 'build' )
	},
}

// Export the config object.
module.exports = config;
