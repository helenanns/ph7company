# Tema PH7-Company

This repository contains the custom WordPress theme used by PH7 Company for its WooCommerce store. Assets are built with Vite and the development workflow uses modern tooling (ESLint, Stylelint, Prettier, Vitest, Husky, etc.) to ensure quality and fast iteration.

---

## 📦 Project Structure

- `dist/` – compiled files (CSS, JS, images, fonts) produced by Vite.
- `includes/` – PHP functions, ACF integrations, WooCommerce logic, etc.
- `src/` – source Sass/JS/TSX used by Vite.
- `template-parts/` – reusable theme fragments.
- `woocommerce/` – overrides and templates for WooCommerce.
- standard WordPress template files (`index.php`, `page.php`, `single.php`, etc.).

---

## ⚙️ Dependencies & Tooling

| Tool                                 | Version                    | Notes                           |
| ------------------------------------ | -------------------------- | ------------------------------- |
| Node.js                              | ≥20 (defined in `engines`) | use [nvm] to manage versions    |
| Vite                                 | ^7.x                       | dev server + bundler            |
| Vitest                               | ^2.x                       | unit tests                      |
| ESLint                               | ^8.x                       | WordPress + React configs       |
| Stylelint                            | ^16.x                      | WordPress-based rules           |
| Prettier                             | ^3.x + PHP plugin          | automatic formatting            |
| Husky / lint-staged                  | latest                     | pre‑commit linting & formatting |
| Sass                                 | ^1.77                      | SCSS compilation via Vite       |
| React (via plugin)                   | ^18.x                      | for blocks under `src/blocks`   |
| normalize.css, Plyr, Swiper, Select2 | listed in `dependencies`   | runtime libs                    |

---

## 🚀 Installation

1. Clone the theme into `wp-content/themes`:
   ```sh
   git clone git@github.com:helenanns/ph7company.git
   cd ph7company
   ```
2. Remove Git history if starting a new project:
   ```sh
   rm -rf .git && git init
   ```
3. Install Node 20 using NVM or installer:
   ```sh
   nvm install 20
   nvm use 20
   ```
4. Install dependencies:
   ```sh
   npm install
   ```

### 🛠 Additional Setup

- Vite configuration is in `vite.config.js`; it compiles assets to `dist/` and handles hashing, hot‑module replacement, etc.
- See `/includes/functions/scripts.php` for logic that enqueues hashed files in WordPress.
- Adjust the `browserslist` configuration in `package.json` if additional browser support is required.

---

## 🧪 Development & Useful Commands

- **`npm run dev`** – start Vite dev server with HMR.
- **`npm run build`** – production build for CSS/JS assets.
- **`npm run preview`** – locally preview the production build.
- **`npm run lint`** – run ESLint and Stylelint.
- **`npm run format`** – run Prettier across the repo.
- **`npm run test`** – run Vitest in watch mode.
- **`npm run test:run`** – run Vitest once (CI friendly).
- **`npm run test:ui`** – launch Vitest UI.

Source styles in `src/scss`, JavaScript in `src/js`, and React/TSX blocks under `src/blocks`. Vite outputs compiled files to `dist/`.

Pre‑commit hooks (Husky + lint‑staged) automatically run linters/formatters on staged files.

---

## 📝 Notes

- Keep Node version in sync with `engines` via `.nvmrc` (if present).
- When adding new dependencies, update `vite.config.js` to ensure they are bundled correctly.
