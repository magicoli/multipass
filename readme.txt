=== MultiPass (dev) ===
Contributors: magicoli69
Donate link: https://magiiic.com/support/MultiPass+Plugin
Tags: hotel, booking, multi-prestations, multi-services, woocommerce, ota, pms, booking engine
Requires at least: 5.9.0
Tested up to: 6.2.2
Requires PHP: 7.3
Stable tag: 0.5.1
License: AGPLv3 or later
License URI: http://www.gnu.org/licenses/agpl-3.0.txt

Group services or products sold from different sources (WooCommerce, OTA, booking engines...) and manage them as a whole.

== Description ==

Bring orders from several sources together and see them as a single provision of services.

Particularly useful in lodging facilities, if your business offers other kinds of services (meals, vehicule rentals, merchandising, local products...) that are not or poorly handled by your usual booking engine.

This plugin could also fit well other kinds of services, needing a more fluid approach than usual e-commerce solutions.

DISCLAIMER: this is an early-stage development version, updates might include breaking changes until 1.0 release.

WARNING: **Make a full backup of your website and databases** before installing this plugin. I MEAN IT (see disclaimer).

= Use cases =

* An order is created and paid upon reservation, but **additional services are usually added later** (e.g. once the prestation begins).
* Your booking engine **can not handle the other kinds of service you provide**.
* When customer book several rooms, your booking engine create **separated orders**, one for each room, and you want to manage the full project.
* You use an external booking engine, but you prefer to **collect payments on your website** (e.g. with WooCommerce)
* You need to handle **partial payments**.
* You need to **validate booking** when deposit threshold is reached.

== Features ==

* [x] Multi-calendar view
* [x] Centralized view of prestations (sets of services, ordered as parts of a common project).
* [x] Prestations admin list, showing prestation dates and payment status.
* [x] Deposits, on prestation or service level, by percentage or fixed amount.
* [x] Discounts, on prestation or service level, by percentage or fixed amount.
* [x] Payments, on prestation or service level.
* [x] Resources collation: link products/services present on several sources/channels
* [x] Summarized payment status, centralizing amounts paid locally or via external providers.
* [x] Custom payments via WooCommerce product
* [x] Class-based modular design, allowing developpers to create addons for other plugins or other service providers.

= Integrations (work in progress) =

* [x] WooCommerce, including
  * [x] WooCommerce Bookings
  * [x] WooCommerce Accommodation Bookings
  * [x] Custom payments made via WooCommerce
* Lodgify
  * [x] Sync properties
* HBook by Maestrel
  * [x] Sync properties
* HotelDruid (probably import only)
* Email processing (access your mailbox and link messages to related prestations)

== Installation ==

1. Upload `prestations.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to admin menu > Prestations > Settings, enable and configure at least one source
4. WooCommerce must be enabled to handle custom payments.

== Changelog ==

= Unreleased (0.5.2-dev.764) =
* fix missing class on activation and db update 2

= 0.5.1 =
* new contacts list
* new reports admin page
* new Rates and Taxes settings page
* added "Connect for Stripe" payment link on mobile devices
* added booking time to rates
* added taxes taxonomy, added field to prestation, detail and resources
* added /multipass/ redirecto to multipass admin page
* fixed permalink conflict (Revert "prefix resource permalink with resource type")
* fixed "from" and "to" fields not set when saving prestation
* fixed enabled modules detection after saving modules settings page

= 0.4 =
* added number of nights in calendar display
* added prestation slug to permalink options page
* added content templates
* addded guests and beds repartition in calendar popup

= 0.3 =
* new handle Lodgify API new booking and booking change events
* added prestation details to woocommerce new order admin notification (optional)
* fix prestation balance rounding
* fix html tags in prestation detail title when imported from WooCommerce
* register to Lodgify webhooks, debug received data
* make prestations viewable in front end for multipass roles

= 0.2 =
* new filter 'multipass_load_modules', allow loading modules from other plugins
* new Lodgify bookings sync
* added prestation details to woocommerce new order admin notification (optional)
* added send payment mail link in calendar modal
* added option to create custom roles
* added MultiPass Reader, Manager and Administrator capabilities sets * reorganised admin menu (defaults to Calendar)
* added source and origin edit links to Calendar modal
* added src/bin/build.sh and src/bin/deploy.sh
* added Mltp_Prestation summary() method
* addded src/bin/build.sh and src/bin/deploy.sh
* added MultiPass Reader, Manager and Administrator capabilities sets * reorganised admin menu (defaults to Calendar)
* fix html tags in prestation detail title when imported from WooCommerce
* fix woocommerce payment product adding paid amount to prestation total
* fix woocommerce order creating new prestation when exsitiong prestation code provided
* fix PHP 7.4 compatibility
* fix issues with composer dependencies custom location (revert to
* fix duplicate details on wc order update, use uuid to identify linked detail

= 0.1.2 (alpha release) =

* Calendar page:
  - added settings tab, including Calendars to display field
  - click on envent opens info modal box
  - added origin sign to timeline events (1 letter, ready for icons via css)
  - main section events bigger (in progress)
  - added custom order (on main sections and resources levels)
* Prices: per resource and per type rules (work in progress, need to sync with providers)

= 0.1.1 (alpha release) =

* Functional(-ish) release
* Settings page
* Prestations: sets of services, ordered as parts of a common project).
  * Prestations admin list, showing prestation dates and payment status.
  * Manual operations (bookings, products, payments)
  * Prestation or service level deposit percentage or fixed amount.
  * Prestation or service level discount percentage or fixed amount.
  * Summarized payment status, centralizing amounts paid locally or via external providers.
* Resources, linked with their counterparts from other plugins or external solutions providers
* Calendar page, grouped by sections (default Main and Options, customizable)
* WooCommerce & WooCommerce Booking integration:
  * Bookable products synchronization
  * create a prestation for new orders, attempt to link to existing, open prestation
  * include bookings made with WooCommerce Bookings (or WC Accommodation Bookings)
  * include WC orders costs in prestation summmary count
  * include payments made via WooCommerce in prestation summmary count
  * allow defining payment-only products to count only payment in stat, not cost
* Lodgify integration
  * API key check, properties list synchronization
* HBook integration
  * Properties list synchronization
