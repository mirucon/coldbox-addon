gulp.task( 'browser-sync', function () {
  browserSync({
    open: 'external',
    notify: false,
    proxy: "http://coldbox.vccw/",
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
    [ '*.php', 'readme.txt' ],
    { base: '.' }
  )
  .pipe( gulp.dest( 'dist' ) );
} );