var gulp        = require('gulp'),
    browserSync = require('browser-sync'),
    sass        = require('gulp-sass'),
    prefix      = require('gulp-autoprefixer'),
    concat      = require('gulp-concat'),
    babel       = require('gulp-babel'),
    cp          = require('child_process');

/**
 * Lanzar servidor web
 */
 gulp.task('browser-sync', ['sass', 'scripts'], function() {
    browserSync.init({
      // Change as required, also remember to set in theme settings
      proxy: "HOSTNAME.dev",
      port: 3000
    });
});

/**
 * @task sass
 * Compilar archivos SCSS scss
 */
gulp.task('sass', function () {

  return gulp.src('scss/lokillo_theme.scss')
  .pipe(sass())
  .pipe(prefix(['last 3 versions', '> 1%', 'ie 8'], { cascade: true }))
  .pipe(gulp.dest('css'))
  .pipe(browserSync.reload({stream:true}))
});

/**
 * @task scripts
 * Compilar arhivos JS
 */
gulp.task('scripts', function() {

  return gulp.src(['js/*.js', 'js/lokillo_theme.js'])
  .pipe(babel({
    presets: ['es2015']
  }))
  .pipe(concat('scripts.js'))
  .pipe(gulp.dest('js'))
  .pipe(browserSync.reload({stream:true}))
});

/**
 * @task clearcache
 * Reconstruir cache de Drupal
 */
gulp.task('clearcache', function(done) {

  return cp.spawn('drush', ['cache-rebuild'], {stdio: 'inherit'})
  .on('close', done);
});
 /**
 * @task reload
 * Actualizar la pagina (no funciona en Drupal)
 */
gulp.task('reload', ['clearcache'], function () {

  browserSync.reload();
});

/**
 * @task watch
 * Watch scss files for changes & recompile
 * Clear cache when Drupal related files are changed
 */
gulp.task('watch', function () {

  gulp.watch(['scss/*.scss', 'scss/**/*.scss'], ['sass']);
  gulp.watch(['js/*.js'], ['scripts']);
  gulp.watch(['templates/*.html.twig', '**/*.yml'], ['reload']);
});

/**
 * Default task, running justgulpwill
 * compile Sass files, launch BrowserSync, watch files.
 */
gulp.task('default', ['browser-sync', 'watch']);
