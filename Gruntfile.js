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

//					'www/apps/**/css/*.css' : 'www/apps/**/css/*.scss',
                    'www/apps/SARAH-reader/css/styles.css' : 'www/apps/SARAH-reader/css/styles.scss',
                    'www/apps/SARAH-media/css/styles.css' : 'www/apps/SARAH-media/css/styles.scss',
                    'www/apps/SARAH-media/css/player.css' : 'www/apps/SARAH-media/css/player.scss',
                    'www/apps/SARAH-xbmc/css/styles.css' : 'www/apps/SARAH-xbmc/css/styles.scss'

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
