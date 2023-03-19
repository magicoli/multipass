# Templates

The template directory is intend only to modify post types and custom pages handled by multipass. As such, it should not contain overrides for full page, although it is possible for specific purposes if a need appears in the future.

Other overrides must be left to the theme or implemented with blocks.

Eventually, these templates might be overridable by the theme, too.

## Content templates

Only for post types handled by multipass (e.g. to properly display a prestation)::

- `content-{post_type_slug}-single.php` post_type template in single display
- `content-{post_type_slug}-archive.php` post_type template in achive lists
- `content-{post_type_slug}.php` default default for post_type

Currently:

- `content-prestation-archive.php` prestation with details
- `content-prestation.php` prestation with details

## Per post content override

- `content-{post_type_slug}-{post_name}.php` (any post type, including page, post and CPT implemented by this plugin)

## Page templates

Override only for specific use cases, in most cases, full page overrides should be left to the theme.

- `page-{post_type_slug}.php`
