module.exports = function(grunt) {
  // Do grunt-related things in here

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				files: {
					'www/css/styles.css' : 'www/css/styles.scss',
					'www/css/responsive.css' : 'www/css/responsive.scss',
					'www/css/fonts.css' : 'www/css/fonts.scss',

					// can these be automated (possibly read from same source as _appList.php)
					//'www/apps/**/css/*.css' : 'www/apps/**/css/*.scss'
					///*
					'www/apps/bookmarks/css/styles.css' : 'www/apps/bookmarks/css/styles.scss',
					'www/apps/budget/css/styles.css' : 'www/apps/budget/css/styles.scss',
					'www/apps/contacts/css/styles.css' : 'www/apps/contacts/css/styles.scss',
					'www/apps/key-store/css/styles.css' : 'www/apps/key-store/css/styles.scss',
					'www/apps/manage-users/css/styles.css' : 'www/apps/manage-users/css/styles.scss',
					'www/apps/music/css/styles.css' : 'www/apps/music/css/styles.scss',
					'www/apps/music/css/player.css' : 'www/apps/music/css/player.scss',
					'www/apps/nutrition/css/styles.css' : 'www/apps/nutrition/css/styles.scss',
					'www/apps/password-manager/css/styles.css' : 'www/apps/password-manager/css/styles.scss',
					'www/apps/reader/css/styles.css' : 'www/apps/reader/css/styles.scss',
					'www/apps/settings/css/styles.css' : 'www/apps/settings/css/styles.scss',
					'www/apps/stocks/css/styles.css' : 'www/apps/stocks/css/styles.scss',
					'www/apps/weather/css/styles.css' : 'www/apps/weather/css/styles.scss',
					'www/apps/xbmc-remote/css/styles.css' : 'www/apps/xbmc-remote/css/styles.scss',
					'www/apps/youtube-downloader/css/styles.css' : 'www/apps/youtube-downloader/css/styles.scss',

					'www/docs/icons/css/styles.css' : 'www/docs/icons/css/styles.scss'
					//*/
				}
			}
		},
		watch: {
			css: {
				files: {
					'www/css/*.css' : 'www/css/*.scss',
					'www/apps/**/css/*.css' : 'www/apps/**/css/*.scss'
				},
				tasks: ['sass']
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default',['watch']);

	grunt.registerTask('pig', 'My "pig" task.', function() {
		grunt.log.writeln('Oink! Oink!');

		var pkg = grunt.file.readJSON('package.json');

		pkg.apps.forEach(function( app ) {
			grunt.log.writeln( 'Reading ' + app.name + ' configuration');
			var appConfig = grunt.file.readJSON ('www/apps/' + app.name + '/config.json');

			grunt.log.writeln( '   ' + appConfig.title );
		});
	});
};