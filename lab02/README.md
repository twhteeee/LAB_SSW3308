# Campus Events Portal – Lab 2

## Bootstrap installation
- Method: Official jsDelivr CDN (no npm build step needed for a static HTML page)
- Version: Bootstrap 5.3.8
- CSS: loaded in `<head>` of `index.html`, before `css/custom.css`
- JS: `bootstrap.bundle.min.js` (includes Popper), loaded once before `</body>`
- Both links use `integrity` (SRI) and `crossorigin="anonymous"` attributes
- Source: https://getbootstrap.com/docs/5.3/getting-started/introduction/