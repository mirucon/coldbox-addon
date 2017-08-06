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