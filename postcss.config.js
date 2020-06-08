module.exports = {
  plugins: [
    require('autoprefixer'),
    require('postcss-nested'),
    require('postcss-for'),
    require('postcss-simple-vars'),
    require('cssnano')({
      preset: [
        'default', {
          minifyFontValues: {
            removeQuotes: false,
          },
        }],
    }),
  ],
}
