"use strict";

const gulp = require("gulp");
const sass = require("gulp-sass");

sass.compiler = require("node-sass")

gulp.task("sass", compileSass);
gulp.task("default", watch);

function compileSass(){
    return gulp
        .src("resources/scss/**/*.scss")
        .pipe(sass({ outputStyle: "compressed" }))
        .pipe(gulp.dest("public/css"));
};

function watch() {
    gulp.watch("resource/scss/**/*.scss", compileSass);
}