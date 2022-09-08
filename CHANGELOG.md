## Changelog

### Unreleased

### 0.1.x-dev

- Centralized view of prestations (sets of services, ordered as parts of a common project).
- Prestations admin list, showing service dates and payment status.
- Prestation or service level deposit percentage or fixed amount.
- Prestation or service level discount percentage or fixed amount.
- Summarized payment status, centralizing amounts paid locally or via external providers.
- WooCommerce integration:
  - create a prestation for new orders, attempt to link to existing, open prestation
  - include bookings made with WooCommerce Bookings (or WC Accommodation Bookings)
  - include WC orders costs in prestation summmary count
  - include payments made via WooCommerce in prestation summmary count
  - allow defining payment-only products to count only payment in stat, not cost
