const mix = require('laravel-mix');

mix.js('resources/js/prodigy.js', 'public/')
    .postCss("resources/css/prodigy.css", "public/", [
        require("tailwindcss"),
    ]);