# Campus Events Portal – Lab 2

## Bootstrap installation

- Method: Official jsDelivr CDN (no npm build step needed for a static HTML page)
- Version: Bootstrap 5.3.8
- CSS: loaded in `<head>` of `index.html`, before `css/custom.css`
- JS: `bootstrap.bundle.min.js` (includes Popper), loaded once before `</body>`
- Both links use `integrity` (SRI) and `crossorigin="anonymous"` attributes
- Source: https://getbootstrap.com/docs/5.3/getting-started/introduction/

## Create the responsive shell (Task 2)

- Navbar: `navbar-expand-lg` in `index.html`; collapses below 992 px. The toggler is a `<button>`, so user can work with the keyboard.
- Event cards: `col-12 col-md-6 col-lg-4` gives 1 card per row below 768 px, 2 cards per row from 768 px, 3 cards per row from 992 px.
- Success case: at 1280 px, 3 cards in one row, full menu visible.
- Boundary case: at 767 px, 1 card per row; at 768 px, 2 cards per row.

## Extend and style the content (Task 3)

- Cards and badges: `.card` and `.badge` inside `#featured-events`.
- Schedule table: wrapped in `.table-responsive` so only the table scrolls sideways.
- Form: Bootstrap `form-control`, `form-select`, `btn`; validation feedback with `needs-validation` and `invalid-feedback`.
- Custom CSS: 35 lines in `css/custom.css`.
- Success case: valid name, email and event → fields turn green
- Invalid case: empty name and email `email` → error messages shown, form not submitted.

## Verify accessibility and responsive behavior (Task 4)

Tested at 360, 768 and 1280 px, each at 200% zoom.

| Width   | Horizontal page scroll? | Effective width at 200% zoom | Navbar                              | Screenshot                                |
| ------- | ----------------------- | ---------------------------- | ----------------------------------- | ----------------------------------------- |
| 360 px  | No                      | 360 px                       | Collapsed, toogler opens with Enter | `evidence/responsive/360px_200_zoom.png`  |
| 768 px  | No                      | 548 px                       | Collapsed, toogler opens with Enter | `evidence/responsive/768px_200_zoom.png`  |
| 1280 px | No                      | 548 px                       | Collapsed, toogler opens with Enter | `evidence/responsive/1280px_200_zoom.png` |

- Horizontal scroll check (Console): `document.documentElement.scrollWidth <= document.documentElement.clientWidth` returned true at each width.
- Keyboard-only test: Tab through the navbar, links and form; Enter or Space on the navbar toggler; Enter on Submit. Focus outline visible: Yes.

## Checks and fixes

- W3C HTML Validator: 2 typo error.
- Browser console: no errors.
- Fixed during development:  
  `<label for="event" class="" form-label>Event</label>` --------> `<label for="event" class="form-label">Event</label>` at line 207 in index.html.  
  `ref` --------> `rel` on the CSS link.
