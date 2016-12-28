module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    meta: {
      banner: '/*!\n' +
          ' * <%= pkg.title || pkg.name %> v<%= pkg.version %>\n' +
          ' * A jQuery plugin for infinite scrolling\n' +
          ' <%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
          ' *\n' +
          ' * Commercial use requires one-time purchase of a commercial license\n' +
          ' * http://infiniteajaxscroll.com/docs/license.html\n' +
          ' *\n' +
          ' * Non-commercial use is licensed under the MIT License\n' +
          ' *\n' +
          ' * Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.company %> (<%= pkg.author.name %>)\n' +
          ' */' +
          '\n'
    },
    buster: {
      default: {
        test: {
          config: 'test/buster.js',
          reporter: 'specification'
        }
      }
    },
    jshint: {
      default: {
        src: ['Gruntfile.js', 'src/*.js', 'test/*.js']
      }
    },
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: ['<banner:meta.banner>', 'src/callbacks.js', 'src/jquery-ias.js', 'src/extension/*.js'],
        dest: 'dist/<%= pkg.name %>.js'
      }
    },
    uglify: {
      options: {
        banner: '<%=meta.banner %>'
      },
      dist: {
        files: {
          'dist/<%= pkg.name %>.min.js': ['dist/<%= pkg.name %>.js']
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-buster');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-jshint');

  // Default task(s).
  grunt.registerTask('default', []);
  grunt.registerTask('build', ['concat','uglify']);

  // other
  grunt.registerTask('test', ['buster']);
};
