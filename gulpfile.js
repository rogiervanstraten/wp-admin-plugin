var fs = require('fs'),
		gulp = require('gulp'),
		
		gutil = require('gulp-util'),
		uglify = require('gulp-uglify'),

		sass = require('gulp-sass'),
		// imagemin = require('gulp-imagemin'),
		concat = require('gulp-concat'),
		
		jshint = require('gulp-jshint'),
		sourcemaps = require('gulp-sourcemaps'),

		rp = require('gulp-replace'),
		plumber = require('gulp-plumber'),

		cache = require('gulp-cache');


var json = JSON.parse( fs.readFileSync( './package.json', 'utf8' ) ),
		themeFolderName = ( json.name ).replace(/\s/g,'-') ;

var SRC_PATH = './src/',
		DIST_PATH = './' + themeFolderName + '/',

		SRC_IMG_PATH = SRC_PATH + 'images/',
		DIST_IMG_PATH = DIST_PATH + 'images/' ;


gulp.task('php', function () {

	return gulp.src( SRC_PATH + '**/*.php' )
		.pipe( rp('%%AUTHOR%%', json.author ) )
		.pipe( rp('%%AUTHORURI%%', json.authorUri ) )
		.pipe( rp('%%DESCRIPTION%%', json.description ) )
		.pipe( rp('%%VERSION%%', json.version ) )
		.pipe( gulp.dest( DIST_PATH ) );

});

gulp.task('cp-images', function() {

  gulp.src( SRC_IMG_PATH + '**/*.{png,jpg,gif}' )
    .pipe( gulp.dest( DIST_IMG_PATH ) ) ;

});

gulp.task('clear', function (done) {
  return cache.clearAll(done);
});

gulp.task('watch', [ 'index' ], function(){
	livereload.listen();
	gulp.watch( SRC_PATH + '**/*.php', [ 'php' ] ) ;
	gulp.watch( SRC_IMG_PATH + '**/*', [ 'cp-images' ] ) ;
});

gulp.task('build', ['index'], function(){});
gulp.task( 'index', [ 'clear', 'php', 'cp-images' ], function(){});
gulp.task( 'default', ['index'] );
