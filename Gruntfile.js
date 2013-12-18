module.exports = function(grunt) {
	// grunt config
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		concat: {
			dist: {
				src: [
					'./templates/js/*.js',
					'./templates/js/common.js'
				],
				dest: '../js/dist.js'
			}
		},
		uglify: {
			build: {
				src: '../js/dist.js',
				dest: '../js/dist.min.js'
			}
		},
		imagemin: {
			png: {
				options: { 
					optimizationLevel: 7
				},
				files:[{
					expand : true,
					cwd : './templates/img/',
					src : ['**/*.png'],
					dest : './../img/',
					ext : '.png'
				}]
			}, 
			jpg: {
				options: {
					progressive: true
				},
				files:[{
					expand : true,
					cwd : './templates/img/',
					src : ['**/*.jpg'],
					dest : './../img/',
					ext : '.jpg'
				}]
			}
		},
		jshint: {
			files: ['Gruntfile.js', './templates/**/*.js'],
			options: {
				curly: true,
				eqeqeq:  true,
				immed: true,
				latedef: true,
				newcap: true,
				noarg: true,
				sub: true,
				undef: true,
				boss: true,
				eqnull: true,
				browser: true,

				globals: {
						module: true,
						require: true,
						requirejs: true,
						define: true,

						// Environments
						console: true,

						// General Purpose Libraries
						$: true,
						jQuery: true,

						// Testing
						sinon: true,
						describe: true,
						it: true,
						expect: true,
						beforeEach: true,
						afterEach: true
				}
			}
		},
		watch: {
			scripts: {
				files: ['./templates/js/*.js'],
				tasks: ['concat', 'uglify'],
				options: {
					spawn: false
				}
			},
			css: {
				files: ['./templates/sass/*.scss'],
				tasks: ['sass'],
				options: {
					spawn: false
				}
			}
		},
		sass: {
			dist: {
				options: {
					style: 'compressed'
				},
				expand: true,
				cwd: './templates/sass/',
				src: ['all.scss'],
				dest: './../css/',
				ext: '.css'
			},
			dev: {
				options: {
					style: 'expanded',
					debugInfo: true,
					lineNumbers: true
				},
				expand: true,
				cwd: './templates/sass/',
				src: ['all.scss'],
				dest: './templates/css/',
				ext: '.css'
			}
		},
		browser_sync: {
			files: {
				src : './templates/css/all.css'
			},
			options: {
				watchTask: true,
				proxy: {
					host: "localhost",
					ghostMode: {
						scroll: true,
						links: true,
						forms: true
					}
				}
			}
		}
	});

	// use these plugins
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-browser-sync');

	// "grunt" in terminal translates to these commands:
	grunt.registerTask('default', ['concat', 'uglify', 'sass:dev', 'imagemin', 'jshint', 'browser_sync', 'watch']);

};
