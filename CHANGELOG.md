## Changelog

### Unreleased

### 0.1.2
- added origin sign to timeline events
- timeline events bigger font size

### 0.1.1

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
