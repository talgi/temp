'use strict';

module.exports = function(grunt) {

	// show elapsed time at the end
	require('time-grunt')(grunt);

	grunt.initConfig({
		// configurable yeoman bla bla
		pkg: grunt.file.readJSON('package.json'),

		yeoman: {
			app: 'src',
			build: 'public_html'
		},

		watch: {
			less: {
				files: ['<%= yeoman.app %>/css/{,*/}*.{less,css}'],
				tasks: ['less', 'autoprefixer']
			},
			styles: {
				files: ['<%= yeoman.app %>/css/{,*/}*.css'],
				tasks: ['copy:styles', 'autoprefixer']
			},
			livereload: {
				options: {
					livereload: '<%= connect.options.livereload %>'
				},
				files: [
					'<%= yeoman.app %>/**/*.php',
					'.tmp/css/{,*/}*.css',
					'{.tmp,<%= yeoman.app %>}/js/{,*/}*.js',
					'<%= yeoman.app %>/img/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
				]
			}
		},
		connect: {
			options: {
				port: 9000,
				livereload: 35729,
				// change this to '0.0.0.0' to access the server from outside
				hostname: 'localhost'
			},
			livereload: {
				options: {
					open: true,
					base: [
						'.tmp',
						'<%= yeoman.app %>'
					]
				}
			},
			build: {
				options: {
					open: true,
					base: '<%= yeoman.build %>'
				}
			}
		},
		clean: {
			build: {
				files: [{
					dot: true,
					src: [
						'.tmp',
						'<%= yeoman.build %>/app/*',
						'!<%= yeoman.build %>/.git*',
					]
				}]
			},
			server: '.tmp'
		},
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'<%= yeoman.app %>/js/{,*/}*.js',
				'!<%= yeoman.app %>/js/vendor/*',
				'!<%= yeoman.app %>/components/*'
			]
		},
		less: {
			compile: {
				files: [{
					src: '<%= yeoman.app %>/css/main.less',
					dest: '.tmp/css/main.css'
				}],
				yuicompress: false
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 1 version']
			},
			build: {
				files: [{
					expand: true,
					cwd: '.tmp/css/',
					src: '{,*/}*.css',
					dest: '.tmp/css/'
				}]
			}
		},

		requirejs: {
			dist: {
				options: {
					almond: true,
					replaceRequireScript: [{
						files: ['<%= yeoman.build %>/index.php'],
						module: 'main',
						modulePath: '<%= yeoman.build %>/app/js/main'
					}],
					mainConfigFile: "<%= yeoman.app %>/js/main.js",
					out: '<%= yeoman.build %>/app/js/main.js',
					baseUrl: "<%= yeoman.app %>/js",
					name: "main",
					optimize: 'none',
					findNestedDependencies: true,
					preserveLicenseComments: false,
				}
			}
		},

		uglify: {
			options: {
				mangle: true,
				compress: {
					drop_console: true
				},
				beautify: false,
				sourceMap: false,
				sourceMapName: '<%= yeoman.build %>/app/js/main.map'
			}
		},

		useminPrepare: {
			options: {
				dest: '<%= yeoman.build %>'
			},
			html: '<%= yeoman.app %>/index.php'
		},

		usemin: {
			options: {
				dirs: ['<%= yeoman.build %>']
			},
			html: ['<%= yeoman.build %>/{,*/}*.php'],
			css: ['<%= yeoman.build %>/app/css/{,*/}*.css']
		},

		imagemin: {
			build: {
				files: [{
					expand: true,
					cwd: '<%= yeoman.app %>/img',
					src: '{,*/}*.{png,jpg,jpeg}',
					dest: '<%= yeoman.build %>/app/img'
				}]
			}
		},
		svgmin: {
			build: {
				files: [{
					expand: true,
					cwd: '<%= yeoman.app %>/img',
					src: '{,*/}*.svg',
					dest: '<%= yeoman.build %>/app/img'
				}]
			}
		},

		cssmin: {
			// This task is pre-configured if you do not wish to use Usemin
			// blocks for your CSS. By default, the Usemin block from your
			// `index.php` will take care of minification, e.g.
			//
			//     <!-- build:css({.tmp,app}) css/main.css -->
			//
			// build: {
			//     files: {
			//         '<%= yeoman.build %>/css/main.css': [
			//             '.tmp/css/{,*/}*.css',
			//             '<%= yeoman.app %>/css/{,*/}*.css'
			//         ]
			//     }
			// }
		},
		htmlmin: {
			build: {
				options: {
					/*removeCommentsFromCDATA: true,
			        // https://github.com/yeoman/grunt-usemin/issues/44
			        //collapseWhitespace: true,
			        collapseBooleanAttributes: true,
			        removeAttributeQuotes: true,
			        removeRedundantAttributes: true,
			        useShortDoctype: true,
			        removeEmptyAttributes: true,
			        removeOptionalTags: true*/
				},
				files: [{
					expand: true,
					cwd: '<%= yeoman.app %>',
					src: '*.php',
					dest: '<%= yeoman.build %>'
				}]
			}
		},
		// Put files not handled in other tasks here
		copy: {
			build: {
				files: [{
					expand: true,
					dot: true,
					cwd: '<%= yeoman.app %>',
					dest: '<%= yeoman.build %>/app',
					src: [
						'*.{ico,png,txt}',
						'img/**',
						'fonts/**',
						'video/**'
					]
				}]
			},
			styles: {
				expand: true,
				dot: true,
				cwd: '<%= yeoman.app %>/css',
				dest: '.tmp/css/',
				src: '{,*/}*.css'
			}
		},
		modernizr: {
			dist: {
				devFile: '<%= yeoman.app %>/components/modernizr/modernizr.js',
				outputFile: '<%= yeoman.build %>/app/components/modernizr/modernizr.js',
				files: {
					src: [
						'<%= yeoman.build %>/app/js/{,*/}*.js',
						'<%= yeoman.build %>/app/css/{,*/}*.css',
						'!<%= yeoman.build %>/app/js/vendor/*'
					]
				},
				uglify: true
			}
		},
		concurrent: {
			server: [
				'less',
				'copy:styles'
			],
			build: [
				'less',
				'copy:styles',
				//'imagemin',
				//'svgmin',
				'htmlmin'
			]
		},

		bower: {
			options: {
				exclude: ['modernizr', 'almond']
			},
			all: {
				rjsConfig: '<%= yeoman.app %>/js/main.js'
			}
		},

		rev: {
			files: {
				src: ['<%= yeoman.build %>/app/js/main.js', '<%= yeoman.build %>/app/css/main.css']
			}
		},

		yuidoc: {
			compile: {
				name: '<%= pkg.name %>',
				description: '<%= pkg.description %>',
				version: '<%= pkg.version %>',
				url: '<%= pkg.homepage %>',
				options: {
					paths: '<%= yeoman.app %>/js/',
					themedir: 'theme',
					outdir: 'docs'
				}
			}
		},
		'regex-replace': {
			dist: {
				src: ['<%= yeoman.build %>/index.php'],
				actions: [{
					name: 'requirejs-onefile',
					search: '<script data-main="app/js/main" src="components/requirejs/require.js"></script>',
					replace: function(match) {
						//var regex = /js\/.*main/;
						//var result = regex.exec(match);
						return '<script src="app/js/main.js"></script>';
					},
					flags: 'g'
				}]
			}
		}
	});

	grunt.registerTask('server', function(target) {
		if (target === 'build') {
			return grunt.task.run(['build', 'connect:build:keepalive']);
		}

		grunt.task.run([
			'clean:server',
			'concurrent:server',
			'autoprefixer',
			'connect:livereload',
			'watch'
		]);
	});

	grunt.registerTask('build', [
		'clean:build',
		'useminPrepare',
		'concurrent:build',
		'autoprefixer',
		'concat',
		'cssmin',
		'uglify',
		'copy:build',
		'modernizr',
		'requirejs',
		'rev',
		'usemin',
		//'regex-replace'

	]);

	grunt.registerTask('devserver', [
		'server'
	]);

	grunt.registerTask('buildserver', [
		'server:build'
	]);

	// tasks
	grunt.loadNpmTasks('grunt-contrib-yuidoc');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-connect');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-htmlmin');
	grunt.loadNpmTasks('grunt-bower-requirejs');
	grunt.loadNpmTasks('grunt-requirejs');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-usemin');
	grunt.loadNpmTasks('grunt-modernizr');
	grunt.loadNpmTasks('grunt-svgmin');
	grunt.loadNpmTasks('grunt-concurrent');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-regex-replace');
	grunt.loadNpmTasks('grunt-rev');
};