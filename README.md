# Official brand theme update

The stylesheet now applies the exact approved palette: forest green #1E3A2B, warm gold #C59B27, warm red #A8322D, warm cream #F8F6F0, and white #FFFFFF. Georgia (with Merriweather as a fallback) is used for headings, with a clean sans-serif body font. The logo, images, data, PHP backend and JavaScript workflows are unchanged.

To update an existing installation without replacing its records, copy only `public/assets/style.css` from this package into the same location in your existing project, then refresh your browser (Ctrl+F5).

# Revised visual design — November 2026

The new homepage follows the approved green-and-gold visual concept with 12 orderable dishes. The four original dishes keep the previous proposal-aligned sample prices (₱149–₱199); the eight additional dishes have proposed sample prices. The photo-style images are **AI-generated** crops of the approved mockup, not actual restaurant photography. They are stored locally in `public/assets/` and do not require internet. Replace the JPEG files with approved real photographs when available. The original logo is retained. Operating hours follow the proposal; no unverified address or phone is used.

Start with a fresh extracted folder. `storage/menu-seed.json` initializes the 12 dishes on first run. Existing JSON/MySQL data from an older version is not automatically expanded; use the Admin menu editor to add missing dishes or migrate data after backing it up. Do not delete an existing live database.

The previous PHP backend, optional MySQL adapter and workflows remain in place. PayMongo, email/SMS and password reset delivery still require integration. Earlier external photo references in the historical notes below have been superseded by the new bundled assets.

# Kusina ng Lahat

Modern Website Presence & Online Reservation System — runnable student-project implementation based on the October 2026 revised proposal.

## Quick start on Windows

1. Install PHP 8.1+ (XAMPP is fine). Extract the ZIP to a normal folder.
2. Open `kusina-ng-lahat` and double-click `START-WEBSITE.bat`, or open PowerShell in this folder and run:

```powershell
php -S localhost:8000 -t public
```

If PHP is not on PATH but you have XAMPP, run:

```powershell
& 'C:\xampp\php\php.exe' -S localhost:8000 -t public
```

3. Open http://localhost:8000 in your browser. Leave the terminal open while using the website. Press Ctrl+C to stop it. Do **not** open only `public/index.html` if you want the database, account, and order features.

The default demo writes to `storage/data.json` outside the public web root. No database installation is required for this mode. The file is created automatically on the first API request. Restarting the server preserves the records. For a clean demonstration, stop the server and delete `storage/data.json` and `storage/data.json.lock`.

## Demo accounts

Use the Staff portal link in the footer or the Account link. Customer accounts can be registered from the website; guests can submit orders, reservations and inquiries without signing in.

| Role | Email | Password |
|---|---|---|
| Admin | admin@kusina.test | DemoAdmin!2026 |
| Staff | staff@kusina.test | DemoStaff!2026 |

Use only fictional personal information in the demo. These public demo credentials are not suitable for deployment. For a new database, set `KUSINA_ADMIN_PASSWORD` and `KUSINA_STAFF_PASSWORD` before first startup to override the seeded passwords.

## MySQL mode (optional)

The project includes `database/schema.sql` and an optional PDO MySQL adapter. The schema maps to the nine tables described in the proposal: roles, users, menu_categories, menu_items, orders, order_items, payments, reservations, and catering_inquiries. An extra lock table coordinates the demo repository. MySQL mode requires MySQL 8+ and PHP's `pdo_mysql` extension. This mode was not integration-tested because MySQL and the PDO MySQL driver were unavailable in the build environment.

Create a UTF-8 database named `kusina_db`, then import `database/schema.sql` using phpMyAdmin (select the database first), or the MySQL command-line client. Set the connection values in PowerShell, changing the password to your actual local database credentials:

```powershell
$env:KUSINA_DSN = 'mysql:host=127.0.0.1;port=3306;dbname=kusina_db;charset=utf8mb4'
$env:KUSINA_DB_USER = 'root'
$env:KUSINA_DB_PASSWORD = ''
php -S localhost:8000 -t public
```

If you have existing JSON demo data, it is not automatically migrated into MySQL. To return to JSON mode, stop the server, run `Remove-Item Env:KUSINA_DSN`, and restart.

## Implemented scope

- Home, About, Dishes, Services & Catering, Reservation, Online Ordering, Account, and Staff/Admin Dashboard.
- Category-filtered menu cards, sample prices, serving information, tags, dietary notes and availability.
- Cart with quantities, server-calculated totals and sample delivery fee; delivery/pick-up scheduling; guest checkout; cash and online payment choices.
- Reservation with operating-hours validation, guest count, large-group flag, occasion, seating, optional pre-order, special requests and status flow.
- Catering inquiry with event details and staff status management.
- Registration, sign-in, profile editing, own-record history; role-restricted dashboard; staff availability and status controls; admin menu prices, role management and basic reports.
- PHP session cookies, bcrypt password hashing, CSRF token, server-side validation, prepared SQL statements in optional MySQL mode.
- Responsive HTML/CSS/JavaScript UI in the requested forest green, gold and cream palette with original local SVG dish illustrations.

## Differences from the proposal / production limitations

- This implementation uses dependency-free plain PHP, not Laravel. Composer/Laravel was not available in the build environment. It is suitable for a local student demonstration, not a fully deployed Laravel application.
- PayMongo hosted checkout, verified webhooks and refunds are **not** integrated. Online payments remain Pending; the system does not accept card or wallet credentials or mark an unverified online payment as paid. Cash payments can be marked paid by staff.
- Email/SMS confirmations and password-reset email delivery are not connected. In-app submission references and account history are available.
- Prices (₱149–₱199), ₱50 delivery fee, maximum quantity 20, guest flag at 10, package labels, 30-minute slots and original food illustrations are demo choices, not management-approved facts. Contact details, official imagery, exact allergens, menu add-ons and catering inclusions need confirmation. Reservations are staff-confirmed requests, not automatically allocated tables.
- Do not publicly expose PHP's development server, demo credentials or test customer records. Production deployment requires HTTPS, secure secret management, proper database privileges, gateway and email integration, data privacy controls, rate limits, backups, and further security/accessibility testing.

## Testing performed

PHP syntax and JavaScript syntax checks passed. Local PHP API tests verified registration, order/reservation/catering submission, history, staff reservation and cash-payment updates, staff permission restrictions, admin price editing, guest delivery totals, sold-out items, past-date checks, CSRF checks, and blocking unverified online payment changes. Chromium rendered the standalone frontend without JavaScript page errors and with no horizontal overflow at a 390px viewport. Direct localhost navigation in the browser was restricted by the build environment, so complete browser-to-server interaction was not verified. MySQL, email, payment gateway and live deployment remain untested/not connected.

### Restaurant logo
The provided restaurant logo is included unchanged at `public/assets/restaurant-logo.jpg`. A square crop of the surrounding background (`brand-mark.png`) is used in the navigation, footer and favicon.


## Restaurant visual refresh
The supplied logo and all existing backend routes are unchanged. Menu and hero use Wikimedia Commons reference photos (not actual restaurant product photos); internet access is needed, and local illustrations are retained as fallback. Final prices and photos require management approval. The preview is frontend-only.

- sinigang: Joy D. Ganaden, CC BY-SA 4.0, https://commons.wikimedia.org/wiki/File:Sinigang_na_Baboy_DSCF4234.jpg
- liempo: Phenheart, CC BY-SA 4.0, https://commons.wikimedia.org/wiki/File:Inihaw_na_liempo.jpg
- adobo: Strawberrysweet07, CC BY-SA 4.0, https://commons.wikimedia.org/wiki/File:Adobo_sa_Gata.jpg
- pancit: Obsidian Soul, CC0 1.0, https://commons.wikimedia.org/wiki/File:Pancit_bihon_(Filipino_rice_noodles).jpg
- feast: Ej Afable, CC BY-SA 4.0, https://commons.wikimedia.org/wiki/File:Boodle_fight_(kamayan)_01.jpg
