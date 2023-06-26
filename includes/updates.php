<?php

// if ( ! defined( 'MLTP_UPDATES' ) ) define('MLTP_UPDATES', 1 );
// /* Temporary disabled */
if ( ! defined( 'MLTP_UPDATES' ) ) {
	define( 'MLTP_UPDATES', 2 );
}

if ( get_option( 'multipass_updated' ) < MLTP_UPDATES ) {
	add_action( 'plugins_loaded', 'multipass_updates' );
	// multipass_updates();
}

function multipass_updates( $args = array() ) {
	$return = null;
	$class = null;
	$u = get_option( 'multipass_updated' ) + 1;
	$messages = array();
	if ( ! empty( $args['message'] ) ) {
		$messages[] = $args['message'];
	}
	while ( $u <= MLTP_UPDATES ) {
		$update = "multipass_update_$u";
		if ( function_exists( $update ) ) {
			$result = $update();
			if ( $result && $result === 'wait' ) {
				// not a success nor an error, will be processed after confirmation
				break;
			} elseif ( $result ) {
				$messages[] = sprintf( __( 'Update %s success', 'multipass' ), $u );
				$success[]  = $u;
				if ( $result != 1 ) {
					$messages[] = $result;
				}
				update_option('multipass_updated', $u);
			} else {
				$result = $update();
				$message = sprintf( __( 'Update %s failed', 'multipass' ), $u );
				$messages[] = $message;
				error_log($message);
				$errors[]   = $u;
				break;
			}
		}
		$u++;
	}
	if ( @$success ) {
		if ( empty( $messages ) ) {
			$messages[] = sprintf( _n( 'Update %s applied sucessfully', 'Updates %s applied sucessfully', count( $success ), 'multipass' ), join( ', ', $success ) );
		}
		$class  = 'success';
		$return = true;
	}
	if ( @$errors ) {
		$messages[] = sprintf(
			__( 'Error processing update %s', 'multipass' ),
			$errors[0]
		);
		$class      = 'error';
		$return     = false;
	}
	if ( ! $messages ) {
		$messages = array( __( 'MultiPass updated', 'multipass' ) );
	}
	if ( $messages ) {
		MultiPass::admin_notice( join( '<br/>', $messages ), $class );
	}
	return $return;
}

/*
 * Force save on existing prestation and detail posts, to update their title.
 */
function multipass_update_1() {
	return true; // obsolete, early dev stage

	global $wpdb;
	$u = 1;

	$posts = get_posts(
		array(
			'post_type'   => array( 'mltp_prestation', 'mltp_detail' ),
			'post_status' => 'any',
			'numberposts' => -1,
			'meta_query'  => array(
				array(
					'key'     => 'dbupdate',
					'value'   => $u,
					'compare' => '<',
				),
				array(
					'key'   => 'dbupdate',
					'value' => null,
				),
				'relation' => 'OR',
			),
		)
	);
	if ( ! $posts ) {
		$posts = array();
	}

	$updated = 0;
	$count   = 0;
	foreach ( $posts as $post ) {
		$object = false;

		if ( $updated < 10 ) {
			switch ( $post->post_type ) {
				case 'mltp_detail':
					$object = new Mltp_Item( $post );
					break;

				case 'mltp_prestation':
					$object = new Mltp_Prestation( $post );
					break;
			}

			if ( $object ) {
				$count++;
				$orig = $object->name;
				wp_update_post(
					array(
						'post_id'    => $object->id,
						'meta_input' => array(
							'dbupdate' => $u,
						),
					)
				);
				$object->update();
				$new = $object->name;
				if ( $orig === $new ) {
						$updated++;
				}
			}
		}
	}

	$output  = '';
	$output .= sprintf(
		_n( '%1$s title / %2$s updated', '%1$s titles / %2$s updated', $updated, 'multipass' ),
		$updated,
		count( $posts ),
	);
	error_log( $output );
	return $output;
}

/*
 * Create contact database
 */
function multipass_update_2() {
	$mltp_contacts = new Mltp_Contact();
	add_action( 'init', array( $mltp_contacts, 'update_tables') );
	return __('Table and contact update in progress', 'multipass');
}
