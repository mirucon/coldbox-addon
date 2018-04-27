var gulp = require('gulp');
var browserSync = require('browser-sync');
var stylus = require('gulp-stylus');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');

gulp.task( 'browser-sync', function () {
  browserSync({
    open: 'external',
    notify: false,
    proxy: "http://coldbox.vccw/"
  });
});
gulp.task( 'bs-reload', function () {
	browserSync.reload();
});
gulp.task( 'default', ['browser-sync'], function () {
	gulp.watch("*.php", ['bs-reload']);
});

gulp.task( 'copy', function() {
  return gulp.src(
    [ '*.php', 'inc/*.php', 'readme.txt' ],
    { base: '.' }
  )
  .pipe( gulp.dest( 'dist' ) );
} );

gulp.task( 'styl', ['stylus'], function () {
	return gulp.src('inc/amp-style.css')
		.pipe(cleanCSS())
		.pipe(gulp.dest('inc/'))
})

gulp.task( 'stylus', function () {
	return gulp.src('inc/amp-style.styl')
		.pipe(stylus())
		.pipe(autoprefixer({
			browsers: ['> 1%', 'not ie 11'],
			cascade: false
		}))
		.pipe(gulp.dest('inc/'))
})

gulp.task( 'watch', ['styl'], function () {
	gulp.watch( 'inc/amp-style.styl', ['styl'])
})
