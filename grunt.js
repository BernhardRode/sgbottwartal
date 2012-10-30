module.exports = function (grunt) {
  'use strict';

  grunt.initConfig({
    pkg: '<json:package.json>',

    meta: {
      banner: '/*!\n'+
        'c o r p o r a t e   c o n t e n t   s e r v i c e s   b y :\n'+
        '\n'+
        ' ***********     ***********     ***********     ***********   1, 2, 3!\n'+
        '*************   *************   *************   *************\n'+
        '***       ***   ***       ***   ***       ***   ***       ***\n'+
        '***       ***   ***       ***   ***       ***   ***       ***\n'+
        '***       **    ***       ***   ***       ***   ***       ***\n'+
        '***             ***       ***   ***       ***   ***       ***\n'+
        '***             ***       ***   ***       ***   *************\n'+
        '***             ***       ***   ***       ***   *************\n'+
        '***             ***       ***   ***       ***   ***\n'+
        '***       **    ***       ***   *************   ***        **\n'+
        '***       ***   ***       ***   ************    ***       ***\n'+
        '***       ***   ***       ***   ***             ***       ***\n'+
        '*************   *************   ***             *************\n'+
        ' ***********     ***********    ***              *********** \n'+
        '\n'+
        'c o n t e n t   o b j e c t s   p r o c e s s i n g   e n v i r o n m e n t.\n'+
        '\n\n'+
        '<%= pkg.name %> Version: <%= pkg.version %>-<%= pkg.codename %> '+
        '(<%= grunt.template.today() %>)\n\n'+
        'Copyright (c) <%= grunt.template.today("yyyy") %> Bechtle AG\n'+
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
      // },
      // test: {
      //   src: ['<%= pkg.test %>/unit/**/*.coffee'],
      //   dest: '<%= pkg.dist %>/test',
      //   options: {
      //     bare: true,
      //     preserve_dirs: true,
      //     base_path: 'test/unit'
      //   }
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
        dest: '<%= pkg.dist %>/js/CopeApp.js',
        options: {
          overwrite: true
        }
      }
    },
    copy: {
      dist: {
        files: {
          '<%= pkg.dist %>/':'<%= pkg.src %>/html/**/*.html',
          '<%= pkg.dist %>/lib/':'<%= pkg.src %>/lib/**/*.js',
          '<%= pkg.dist %>/img/':'<%= pkg.src %>/img/**/*',
          '<%= pkg.dist %>/font/':'<%= pkg.src %>/lib/font-awesome/font/*'
        },
        options: {
          flatten:true
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
        src: '<%= pkg.src %>/less/cope.less',
        dest: '<%= pkg.dist %>/css/cope.css'
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
          'dist/': ['<%= pkg.src %>/manifest.appcache']
        }
      }
    },
    min: {
      prod: {
        src: ['<banner>', '<%= pkg.dist %>/js/CopeApp.js'],
        dest: '<%= pkg.dist %>/js/CopeApp.min.js'
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
        '<%= pkg.src %>/coffee/**/*.coffee',
        '<%= pkg.src %>/less/**/*.less',
        '<%= pkg.src %>/html/**/*.html',
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
  //grunt.loadNpmTasks('grunt-haml');

  grunt.registerTask('build', 'clean coffee replace less concat copy');
  grunt.registerTask('default', 'server reload build watch');
  grunt.registerTask('doc', 'docco');  
  grunt.registerTask('prod', 'build min');
  grunt.registerTask('test', 'testacularServer');
};