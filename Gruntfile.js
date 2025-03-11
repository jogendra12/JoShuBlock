module.exports = function(grunt) {
  // Project configuration
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    
    // Clean the dist directory
    clean: {
      dist: ['dist/']
    },
    
    // Copy only necessary files to dist
    copy: {
      main: {
        expand: true,
        src: [
          '**',
          '!node_modules/**',
          '!src/**',
          '!.git/**',
          '!.github/**',
          '!.gitignore',
          '!.editorconfig',
          '!package-lock.json',
          '!package.json',
          '!Gruntfile.js',
          '!.DS_Store',
          '!**/.DS_Store',
          '!dist/**',
          '!text/**',
          '!*.zip'
        ],
        dest: 'dist/jo-shu-block/'
      }
    },
    
    // Create a zip file from the dist directory
    compress: {
      main: {
        options: {
          archive: 'dist/jo-shu-block.zip'
        },
        expand: true,
        cwd: 'dist/',
        src: ['jo-shu-block/**'],
        dest: '/'
      }
    },
    
    // Update version in the main plugin file
    replace: {
      plugin_file: {
        src: ['dist/jo-shu-block/jo-shu-block.php'],
        overwrite: true,
        replacements: [{
          from: /Version:(\s*)(.*)/g,
          to: 'Version:$1<%= pkg.version %>'
        }]
      }
    }
  });
  
  // Load the plugins
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-text-replace');
  
  // Default task(s)
  grunt.registerTask('default', ['clean', 'copy', 'replace', 'compress']);
};