# MultiPass (dev)

![Stable 0.1.1](https://badgen.net/badge/Stable/0.1.1/yellow)
![WordPress 5.9.0 - 6.0.2](https://badgen.net/badge/WordPress/5.9.0%20-%206.0.2/blue)
![Requires PHP 7.4](https://badgen.net/badge/PHP/7.4/purple)
![License AGPLv3 or later](https://badgen.net/badge/License/AGPLv3%20or%20later)

Manage bookings and other services from different sources (WooCommerce, Lodgify, HBook, OTA, PMS, booking engines...).

## Description

Bring orders from several sources together and see them as a single provision of services.

Particularly useful in lodging facilities, if your business offers other kinds of services (meals, vehicule rentals, merchandising, local products...) that are not or poorly handled by your usual booking engine.

This plugin could also fit well other kinds of services, needing a more fluid approach than usual e-commerce solutions.

DISCLAIMER: this is an early-stage development version, updates might include breaking changes until 1.0 release.

WARNING: **Make a full backup of your website and databases** before installing this plugin. I MEAN IT (see disclaimer).

### Use cases

- An order is created and paid upon reservation, but **additional services are usually added later** (e.g. once the prestation begins).
- Your booking engine **can not handle the other kinds of service you provide**.
- When customer book several rooms, your booking engine create **separated orders**, one for each room, and you want to manage the full project.
- You use an external booking engine, but you prefer to **collect payments on your website** (e.g. with WooCommerce)
- You need to handle **partial payments**.
- You need to **validate booking** when deposit threshold is reached.

## Features

- [x] Multi-calendar view
- [x] Centralized view of prestations (sets of services, ordered as parts of a common project).
- [x] Prestations admin list, showing prestation dates and payment status.
- [x] Deposits, on prestation or service level, by percentage or fixed amount.
- [x] Discounts, on prestation or service level, by percentage or fixed amount.
- [x] Payments, on prestation or service level.
- [x] Resources collation: link products/services present on several sources/channels
- [x] Summarized payment status, centralizing amounts paid locally or via external providers.
- [x] Custom payments via WooCommerce product
- [x] Class-based modular design, allowing developpers to create addons for other plugins or other service providers.

### Integrations (work in progress)

- [x] WooCommerce, including
  - [x] WooCommerce Bookings
  - [x] WooCommerce Accommodation Bookings
  - [x] Custom payments made via WooCommerce
- Lodgify
  - [x] Sync properties
- HBook by Maestrel
  - [x] Sync properties
- HotelDruid (probably import only)
- Email processing (access your mailbox and link messages to related prestations)

