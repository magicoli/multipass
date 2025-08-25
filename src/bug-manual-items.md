# Bug Summary: manual items not populated properly in prestation edit form

## Problem Statement
The "Manual operations" section in Prestation post type edit pages appears empty on load, even though data exists correctly in the database. This is a **display-only issue** - data storage and retrieval work perfectly for all other plugin functions.

## Root Cause
Meta Box library (v5.6+) cloned group fields (`'type' => 'group', 'clone' => true`) are not properly populating their UI on admin edit page load. The field definition and save mechanisms are correct and functional.

## Technical Context
- **File**: `/includes/class-prestation.php` around line 660
- **Field ID**: `manual_items` 
- **Field Type**: Meta Box cloned group field with complex nested structure
- **Data Format**: Array of arrays stored as serialized meta (working correctly)
- **Meta Box Packages**: Uses `meta-box/meta-box-group` for cloned group functionality

## Confirmed Working
- Data saves correctly as array of arrays
- Backend calculations (pricing, etc.) work perfectly 
- Debug shows correct data retrieval: `get_post_meta($post_id, 'manual_items', true)`
- Field definition follows Meta Box standards

## Confirmed Broken
- **1 item**: Edit page shows empty, click "Add more" adds a row (as it should) populated with the existing data
- **2+ items**: Edit page shows only last item, click "Add more" adds blank row (as it should) but missing rows are still missing
- Saving without interacting clears the non-displayed values from post_meta, rendering them definitively missing

## Constraints for Fix
- **CANNOT** change field definition structure (hundreds of existing records)
- **CANNOT** modify save/storage format (used throughout plugin)
- **MUST** use standard wp Meta Box hooks/filters only (avoid rwmb in new developments)
- **FOCUS** only on admin UI value population

## Attempted Solutions (didn't work)
1. Adding `'clone_as_multiple' => true` and other field properties
2. Custom `get_value` callback in field definition
3. `rwmb_field_value` general filter
4. `rwmb_manual_items_value` specific filter

## Recommended Next Approach
Research Meta Box Group extension documentation for cloned group value loading issues. The problem likely involves:
1. How Meta Box retrieves values for cloned groups during admin UI rendering
2. JavaScript initialization timing for existing cloned items
3. Potential version compatibility issue between Meta Box core and Group extension

## Development Environment Setup
Use MultiPass::debug() method to add visible debug output to admin pages for testing value retrieval and display.

## Key Question for Dev Testing
Why does clicking "Add item" correctly populate existing data, but initial page load doesn't trigger the same population mechanism?

## Example Data Structure
```php
[manual_items] => Array
    (
        [0] => Array
            (
                [type] => payment
                [description] => Virement
                [from] => Array
                    (
                        [timestamp] => 1738627200
                        [formatted] => 04-02-2025
                    )
                [to] => Array
                    (
                        [timestamp] => 0
                    )
                [paid] => 540
            )
        [1] => Array
            (
                [type] => payment
                [description] => Virement
                [from] => Array
                    (
                        [timestamp] => 1754697600
                        [formatted] => 09-08-2025
                    )
                [paid] => 1297.20
            )
    )
```

## Meta Box Dependencies
```json
"wpmetabox/meta-box": "^5.6",
"meta-box/mb-admin-columns": "dev-master",
"meta-box/mb-settings-page": "dev-master",
"meta-box/meta-box-columns": "dev-master",
"meta-box/meta-box-conditional-logic": "dev-master",
"meta-box/meta-box-geolocation": "dev-master",
"meta-box/meta-box-group": "dev-master",
"meta-box/meta-box-include-exclude": "dev-master",
"meta-box/meta-box-show-hide": "dev-master",
"meta-box/meta-box-tabs": "dev-master",
"meta-box/mb-term-meta": "dev-master",
"meta-box/mb-custom-table": "dev-master"
```
