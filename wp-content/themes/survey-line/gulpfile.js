const gulp = require('gulp');
const sass = require('sass');
const gulpSass = require('gulp-dart-sass');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();
const browserify = require('browserify');
const babelify = require('babelify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');

const projectUrl = '.local';

const assetPaths = {
  sass: {
    src: ['src/scss/**/*.scss', 'template-parts/blocks/**/*.scss'],
    dest: 'dist/css',
    outputFileName: 'styles.css'
  },
  js: {
    src: 'src/js/**/*.js',
    entry: './src/js/main.js',
    dest: 'dist/js'
  },
  html: {
    src: '**/*.php'
  }
};

function compileSass() {
  return gulp.src(assetPaths.sass.src)
    .pipe(sourcemaps.init())
    .pipe(gulpSass({ sass }).on('error', gulpSass.logError))
    .pipe(concat(assetPaths.sass.outputFileName))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(assetPaths.sass.dest))
    .pipe(browserSync.stream());
}

function buildScript() {
  return browserify(assetPaths.js.entry, { bare: true })
    .transform(babelify, { presets: ['@babel/preset-env'] })
    .bundle()
    .pipe(source('scripts.js'))
    .pipe(buffer())
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(assetPaths.js.dest));
}

// New build task for editor-blocks.js
function buildEditorBlocksScript() {
  return browserify('./src/js/editor-blocks.js', { bare: true })
    .transform(babelify, { presets: ['@babel/preset-env'] })
    .bundle()
    .pipe(source('editor-blocks.js'))
    .pipe(buffer())
    .pipe(gulp.dest(assetPaths.js.dest));
}

function serve() {
  browserSync.init({
    proxy: projectUrl,
    files: [
      assetPaths.sass.dest + '/*.css',
      assetPaths.js.dest + '/*.js',
      assetPaths.html.src
    ]
  });

  gulp.watch(assetPaths.sass.src, compileSass);
  gulp.watch(assetPaths.js.src, buildScript);
  gulp.watch(assetPaths.html.src).on('change', browserSync.reload);
}

// New watch task without BrowserSync
function watch() {
  gulp.watch(assetPaths.sass.src, compileSass);
  gulp.watch(assetPaths.js.src, buildScript);
  gulp.watch(assetPaths.html.src);
}

gulp.task('build', gulp.series(compileSass, buildScript));
gulp.task('default', gulp.series(compileSass, buildScript, serve));
gulp.task('watch', watch);
gulp.task('build:editor-blocks', buildEditorBlocksScript);