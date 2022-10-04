#!/bin/bash

[ ! "$1" ] && echo specify the post types to delete >&2 && exit
read -p "really delete all post of types $@? " || exit $?

# wp post-type list --format=csv | cut -d , -f 1 | sort | egrep "^mp_|mltp|prestation|resource"

for post_type in $@
do
  count=$(wp db query "select count(*) from wp_posts where post_type='$post_type'" | tail +2)
  echo "# removein $count $post_type posts" >&2
  wp post delete --force $(wp post list --post_type=$post_type --format=ids)
  count=$(wp db query "select count(*) from wp_posts where post_type='$post_type'" | tail +2)
  echo "  remaining: $count" >&2
done

# wp post delete --force $(wp post list --post_type='prestation_part' --format=ids)
# wp post delete --force $(wp post list --post_type='prestation-part' --format=ids)
# wp post delete --force $(wp post list --post_type='prestationpart' --format=ids)
# wp post delete --force $(wp post list --post_type='			// $source_url = 'https://app.lodgify.com/#/reservation/inbox/B' . $booking['id'];
# wp post delete --force $(wp post list --post_type='prestation-part' --format=ids)
# wp post delete --force $(wp post list --post_type='mltp_detail' --format=ids)
# wp post delete --force $(wp post list --post_type='mltp_detail' --format=ids)
