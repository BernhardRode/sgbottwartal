module.exports = function (grunt) {
  'use strict';

  grunt.initConfig({
    pkg: '<json:package.json>',

    meta: {
      banner: '/*!\n'+
        '<%= pkg.name %> Version: <%= pkg.version %>-<%= pkg.codename %> '+
        '(<%= grunt.template.today() %>)\n\n'+
        'Copyright (c) <%= grunt.template.today("yyyy") %> SG Bottwartal\n'+
      '*/'
    },
    clean: {
      folder: 'dist'
    },
    coffee: {
      src: {
        src: ['<%= pkg.src %>/coffee/**/*.coffee'],
        dest: '<%= pkg.dist %>/js',
        options: {
          bare: true,
          preserve_dirs: true,
          base_path: 'src/coffee'
        }
      }
    },
    haml: {
      index: {
        src: '<%= pkg.src %>/haml/*.haml',
        dest: '<%= pkg.dist %>/*.html'
      }
    },
    lint: {
      all: ['<%= pkg.dist %>/js/bootstrap.js']
    },
    concat: {
      js: {
        src: ['<banner>', '<%= pkg.dist %>/js/cope/**/*.js'],
        dest: '<%= pkg.dist %>/js/app.js',
        options: {
          overwrite: true
        }
      }
    },
    copy: {
      application: {
        files: {
          '<%= pkg.dist %>/':'<%= pkg.src %>/php/*',
          '<%= pkg.dist %>/lib/':'<%= pkg.src %>/lib/**/*.js',
          '<%= pkg.dist %>/img/':'<%= pkg.src %>/img/**/*',
          '<%= pkg.dist %>/font/awesome/':'<%= pkg.src %>/lib/font-awesome/font/*',
          '<%= pkg.dist %>/font/diavlo/':'<%= pkg.src %>/lib/diavlo/font/*',
          '<%= pkg.dist %>/languages/':'<%= pkg.src %>/languages/*'
        },
        options: {
          flatten:true
        }
      },
      plugins: {
        files: {
          '<%= pkg.dist %>/../../plugins/':'<%= pkg.src %>/plugins/**/*',
        },
        options: {
          flatten:false
        }
      }      
    },
    jshint: {
      options: {
        browser: true,
        devel: true,
        camelcase: true,
        curly: true,
        immed: true,
        latedef: true,
        newcap: true,
        globalstrict: true,
        eqnull: true, // CoffeeScript uses null for default parameter values
        jquery: true,
        smarttabs: true,
      },
      globals: {
        angular: true
      }
    },
    // compile Less to CSS
    less: {
      dist: {
        src: '<%= pkg.src %>/less/app.less',
        dest: '<%= pkg.dist %>/style.css'
      }
    },
    replace: {
      dist: {
        options: {
          variables: {
            name: '<%= pkg.name %>',
            version: '<%= pkg.version %>',
            codename: '<%= pkg.codename %>',
            timestamp: '<%= grunt.template.today() %>'
          }
        },
        files: {
          '<%= pkg.dist %>/': ['<%= pkg.src %>/manifest.appcache']
        }
      }
    },
    min: {
      prod: {
        src: ['<banner>', '<%= pkg.dist %>/js/app.js'],
        dest: '<%= pkg.dist %>/js/app.min.js'
      }
    },
    testacularServer: {
      unit: {
        configFile: 'test/config/testacular.conf.js'
      }
    },
    testacularRun: {
      unit: {
        runnerPort: 9003
      }
    },
    docco: {
      app: {
        src: ['<%= pkg.src %>/coffee/**/*.coffee', '<%= pkg.test %>/unit/**/*.coffee']
      }
    },
    reload: {
      port: 9000,
      proxy: {
          host: 'localhost',
          port: 9001
      }
    },
    server: {
      port: 9001,
      base: './dist'
    },
    watch: {
      files: [
        '<%= pkg.src %>/lib/**/*.js',
        '<%= pkg.src %>/lib/**/*.less',
        '<%= pkg.src %>/coffee/**/*.coffee',
        '<%= pkg.src %>/less/**/*.less',
        '<%= pkg.src %>/php/**/*.php',
        '<%= pkg.src %>/plugins/**/*',
        '<%= pkg.test %>/unit/**/*.coffee',
      ],
      tasks: 'build reload'
    }
  });

  grunt.loadNpmTasks('grunt-coffee');
  grunt.loadNpmTasks('grunt-clean');
  grunt.loadNpmTasks('grunt-less');
  grunt.loadNpmTasks('grunt-reload');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-replace');
  grunt.loadNpmTasks('grunt-testacular');
  grunt.loadNpmTasks('grunt-docco');

  grunt.registerTask('build', 'clean coffee replace less copy');
  grunt.registerTask('default', 'server reload build watch');
  grunt.registerTask('doc', 'docco');  
  grunt.registerTask('prod', 'build min');
  grunt.registerTask('test', 'testacularServer');
};