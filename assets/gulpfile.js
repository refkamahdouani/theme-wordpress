var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglifyjs = require('gulp-uglifyjs'),
	cssmin = require('gulp-cssmin'),
	concatCss = require('gulp-concat-css'),
	stylus = require('gulp-stylus');


gulp.task('scripts', function() {
	return gulp.src([
		'vendors/animsition.min.js',
		'vendors/appear.js',
		'vendors/countTo.js',
		'vendors/imagesloaded.pkgd.min.js',
		'vendors/isotope.pkgd.min.js',
		'vendors/jarallax.js',
		'vendors/jarallax-video.js',
		'vendors/jquery.textillate.js',
		'vendors/jquery.lettering.js',
		'vendors/typed.js',
		'vendors/jquery.magnific-popup.min.js',
		'vendors/owl.carousel.min.js',
		'vendors/remodal.min.js',
		'vendors/scrollReveal.js',
		'vendors/portfolio.js',
		])
		.pipe(concat('plugins.min.js'))
		.pipe(uglifyjs())
		.pipe(gulp.dest('scripts/'));
});






gulp.task('styles', function () {
	return gulp.src([
		'css/plugins/bootstrap.css',
		'css/plugins/animate.css',
		'css/plugins/animsition.min.css',
		'css/plugins/crazy-font.css',
		'css/plugins/font-awesome.min.css',
		'css/plugins/linear_icons.css',
		'css/plugins/magnific-popup.css',
		'css/plugins/owl.carousel.css',
		'css/plugins/remodal.css',
		'css/plugins/remodal-default-theme.css'
		])
		.pipe(concatCss('plugins.min.css'))
		.pipe(cssmin())
		.pipe(gulp.dest('css/'));
});


gulp.task('stylus', function () {
  return gulp.src('css/*.styl')
    .pipe(stylus({
      // compress: true
    }))
    .pipe(gulp.dest('css/'));
});





gulp.task('default', ['styles', 'scripts', 'stylus']);