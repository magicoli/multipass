## Changelog

### Unreleased (0.7.0-dev.827)
- (dev breaking change) reorganized includes and modules
- added dates to prestations list in menu
- fix prestation options empty in resource edit form
- fix prestation options empty in detail edit form
- cache resources and prestations options menus
- enchancement resource options hierarchical

### 0.6.1
- updated dependencies
- fix phone link on booking popup
- fix wp_get_current_user() called before being defined in MultiPass::debug()
- fix fatal error with invalid phone numbers

### 0.6.0
- added payment history csv download button
- added payment history page
- fix missing class on activation and db update 2

### 0.5.1
- new contacts list
- new reports admin page
- new Rates and Taxes settings page
- added "Connect for Stripe" payment link on mobile devices
- added booking time to rates
- added taxes taxonomy, added field to prestation, detail and resources
- added /multipass/ redirecto to multipass admin page
- fixed permalink conflict (Revert "prefix resource permalink with resource type")
- fixed "from" and "to" fields not set when saving prestation
- fixed enabled modules detection after saving modules settings page

### 0.4
- added number of nights in calendar display
- added prestation slug to permalink options page
- added content templates
- addded guests and beds repartition in calendar popup

### 0.3
- new handle Lodgify API new booking and booking change events
- added prestation details to woocommerce new order admin notification (optional)
- fix prestation balance rounding
- fix html tags in prestation detail title when imported from WooCommerce
- register to Lodgify webhooks, debug received data
- make prestations viewable in front end for multipass roles

### 0.2
- new filter 'multipass_load_modules', allow loading modules from other plugins
- new Lodgify bookings sync
- added prestation details to woocommerce new order admin notification (optional)
- added send payment mail link in calendar modal
- added option to create custom roles
- added MultiPass Reader, Manager and Administrator capabilities sets * reorganised admin menu (defaults to Calendar)
- added source and origin edit links to Calendar modal
- added src/bin/build.sh and src/bin/deploy.sh
- added Mltp_Prestation summary() method
- addded src/bin/build.sh and src/bin/deploy.sh
- added MultiPass Reader, Manager and Administrator capabilities sets * reorganised admin menu (defaults to Calendar)
- fix html tags in prestation detail title when imported from WooCommerce
- fix woocommerce payment product adding paid amount to prestation total
- fix woocommerce order creating new prestation when exsitiong prestation code provided
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
