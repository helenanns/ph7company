# Tema PH7-Company

This repository contains the custom WordPress theme used by PH7 Company for its WooCommerce store. It includes a modern development setup with Gulp, Babel, ESLint, StyleLint, Prettier, and other tools to streamline the workflow and ensure code quality.

---

## 📦 Project Structure

- `assets/` – compiled files (CSS, JS, images, fonts).
- `includes/` – PHP functions, ACF integrations, WooCommerce logic, etc.
- `src/` – source Sass/JS used by Gulp.
- `template-parts/` – reusable theme fragments.
- `woocommerce/` – reusable theme fragments.
- template files (`index.php`, `page.php`, `single.php`, etc.).

---

## ⚙️ Dependencies & Tooling

| Tool       | Version           | Notes       |
|------------|-------------------|-------------|
| Node.js    | 16.x (defined in `engines`)     | use [nvm] to manage versions          |
| Gulp       | 4.x                             | scripts defined in `package.json`     |
| Babel      | 7.x                             | via `gulp-babel` and Rollup           |
| Prettier   | 2.x + plugin PHP                | automatic formatting                  |
| ESLint     | 8.x                             | Airbnb + WordPress config             |
| StyleLint  | 13.x                            | WordPress-based rules                 |
| Husky / lint-staged | 7.x / 12.x             | pre-commit linting/formatting         |
| jQuery, Plyr, Swiper, Select2, normalize.css, etc. | listed in `dependencies`        |

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
3. Use Node 16.x via NVM:
   ```sh
   nvm install 16
   nvm use 16
   ```
4. Install dependencies:
   ```sh
   npm install
   ```

### 🛠 Additional Setup

- The `gulpfile.js` compiles assets and generates hashed filenames; check `/includes/functions/scripts.php` to register hashed assets in WordPress.
- Adjust the `browserslist` configuration if you need support for additional browsers.

---

## 🧪 Development & Useful Commands

- **`npm run start`** – starts the watcher (Gulp `watch`) and recompiles assets automatically.
- **`npm run build`** – production build for CSS/JS assets.
- **`npm run lint`** – runs ESLint on `src/js`.
- **`npm run lint:fix`** – auto-fixes lint issues.

Styles are located in `src/scss` and JavaScript in `src/js`. Gulp compiles everything into `assets/css` and `assets/js`.

Before committing, Husky + lint-staged will automatically run linters and formatters on staged files.