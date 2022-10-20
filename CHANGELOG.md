## Changelog

### Unreleased (0.2-dev.538)
- new filter 'multipass_load_modules', allow loading modules from other plugins
- new Lodgify bookings sync
- added send payment mail link in calendar modal
- added option to create custom roles
- added MultiPass Reader, Manager and Administrator capabilities sets * reorganised admin menu (defaults to Calendar)
- added source and origin edit links to Calendar modal
- added src/bin/build.sh and src/bin/deploy.sh
- added Mltp_Prestation summary() method
- addded src/bin/build.sh and src/bin/deploy.sh
- added MultiPass Reader, Manager and Administrator capabilities sets * reorganised admin menu (defaults to Calendar)
- fix PHP 7.4 compatibility
- fix issues with composer dependencies custom location (revert to
- fix duplicate details on wc order update, use uuid to identify linked detail

### 0.1.2 (alpha release)

- Calendar page:
  - added settings tab, including Calendars to display field
  - click on envent opens info modal box
  - added origin sign to timeline events (1 letter, ready for icons via css)
  - main section events bigger (in progress)
  - added custom order (on main sections and resources levels)
- Prices: per resource and per type rules (work in progress, need to sync with providers)

### 0.1.1 (alpha release)

- Functional(-ish) release
- Settings page
- Prestations: sets of services, ordered as parts of a common project).
  - Prestations admin list, showing prestation dates and payment status.
  - Manual operations (bookings, products, payments)
  - Prestation or service level deposit percentage or fixed amount.
  - Prestation or service level discount percentage or fixed amount.
  - Summarized payment status, centralizing amounts paid locally or via external providers.
- Resources, linked with their counterparts from other plugins or external solutions providers
- Calendar page, grouped by sections (default Main and Options, customizable)
- WooCommerce & WooCommerce Booking integration:
  - Bookable products synchronization
  - create a prestation for new orders, attempt to link to existing, open prestation
  - include bookings made with WooCommerce Bookings (or WC Accommodation Bookings)
  - include WC orders costs in prestation summmary count
  - include payments made via WooCommerce in prestation summmary count
  - allow defining payment-only products to count only payment in stat, not cost
- Lodgify integration
  - API key check, properties list synchronization
- HBook integration
  - Properties list synchronization
