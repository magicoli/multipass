<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
  error_log("Had to force load WP_List_Table class");
}

class Prestations_Table extends WP_List_Table {
  var $data = [];
  var $rows = [];

  public function __construct($data = [])
  {

    $this->data = $data;
    $this->rows = isset($data['rows']) ? $data['rows'] : [];
    $this->prepare_items();
    // $this->display();
  }

  function get_columns() {
    $rows = $this->rows;
    if(!is_array($rows)) return [ 'error' => __('Not an array') ];
    if(empty($rows)) return [ 'error' => __('Empty table') ];

    // $first_row = ;
    $keys = array_keys(array_shift($rows));
    switch ($keys[0]) {
      // case 'idprenota':
      // $columns = array (
      //   'key' => __('key', 'prestations'),
      //   'idprenota' => __('idprenota', 'prestations'),
      //   'customer' => __('Customer', 'prestations'),
      // );
      // break;

      default:
      if(!empty($this->data['columns'])) $columns = $this->data['columns'];
      else $columns = array_combine($keys, $keys);
      // error_log(print_r($columns, true));
    }

    return $columns;
  }

  function column_default( $item, $column_id ) {
    if(!is_array($item)) $item = array(
      $column_id => $item,
    );

    switch( $column_id ) {
      case 'actions':
      $actions = [];
      if(isset($item['external_url'])) {
        $actions[] = sprintf(
          '<a class="dashicons dashicons-external" href="%s"></a>',
          $item['external_url'],
          'edit',
        );
      }
      else if(isset($item['edit_url'])) {
        $actions[] = sprintf(
          '<a class="dashicons dashicons-edit" href="%s"></a>',
          $item['edit_url'],
          'edit',
        );
      }
      else if(isset($item['view_url'])) {
        $actions[] = sprintf(
          '<a class="dashicons dashicons-visibility" href="%s"></a>',
          $item['view_url'],
          'edit',
        );
      }
      $value = '<nobr>' . join('', $actions) . '</nobr>';
      break;

      // case 'idclienti':
      // if(isset($item['idprenota'])) {
      //   // todo return link to wp user if set
      //   return "client " . $item['idclienti'];
      // }
      // return $item['idclienti'];
      // break;

      default:
      $value = $item[ $column_id ];
      // else $value = $item;
    }

    if(isset($this->data['format'][$column_id])) {
      switch ($this->data['format'][$column_id]) {
        case 'price':
        $value = wc_price($value);
        break;

        case 'date_time';
        if(!empty($value)) $value = wp_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime($value) );
        break;

        case 'date';
        if(!empty($value)) $value = wp_date( get_option( 'date_format' ) );
        break;

        case 'status':
        if(is_array($item) && isset($item['id'])) return $this->render_status($item['id'], $value);
        else return $item;
        break;

      }
    }
    return $value;
  }

  function render_status($post_id = NULL, $status = NULL) {
    if(empty($status)) return;

    $post = get_post($post_id);
    if($post) $post_type = $post->post_type;

    $html = sprintf(
      '<span class="prestation-status-box %1$s-status status-%2$s">%3$s</span>',
      $post_type,
      $status,
      $status,
    );

    return $html;
  }

  function prepare_items() {

    $columns = $this->get_columns();
    $hidden = array();
    $sortable = $this->get_sortable_columns();
    $this->_column_headers = array($columns, $hidden, $sortable);
    // usort( $this->data, array( &$this, 'usort_reorder' ) );
    $this->items = $this->data;
  }

  /**
   * Sort doesn't seem work in tabbed settings page context
   * It's not a big deal in this case, so I won't fix it
  **/

  function get_sortable_columns() {
    $sortable_columns = [];
  //   $sortable_columns = array(
  //     'idclienti'  => array('idclienti',false),
  //     'idappartamenti'  => array('idappartamenti',false),
  //     'name'  => array('name',false),
  //   );
    return $sortable_columns;
  }
  //
  function usort_reorder( $a, $b ) {
  //   // If no sort, default to title
  //   $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'name';
  //   // If no order, default to asc
  //   $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
  //   // Determine sort order
  //   $result = strcmp( $a[$orderby], $b[$orderby] );
  //   // Send final sort direction to usort
  //   return ( $order === 'asc' ) ? $result : -$result;
  }

  function get_columns_headers() {
    $headers = '';
    foreach($this->get_columns() as $column_id => $column_name) {
      $headers .= "<th class='column column-$column_id'>$column_name</th>";
    }
    return $headers;
  }

  function get_rows() {
    $rows = '';
    $columns = $this->get_columns();
    foreach ($this->rows as $key => $row) {
      $rows .= '<tr>';
      foreach ($columns as $column_id => $column_name) {
        $format = (isset($this->data['format'][$column_id])) ? $this->data['format'][$column_id] : '';
        $value = $this->column_default($row, $column_id);
        $rows .= "<td class='column column-$column_id $format'>$value</td>";
      }
      $rows .= '</tr>';

      // code...
    }
    return $rows;
  }

  function get_columns_footers() {
    $footers = '';
    foreach($this->get_columns() as $column_id => $column_name) {
      $value = (isset($this->data[$column_id])) ? $this->data[$column_id] : '';
      $value = $this->column_default($value, $column_id);
      if(is_array($value)) $value = implode($value);

      $footers .= "<th class='column column-$column_id'>$value</th>";
    }
    return $footers;
  }

  function render() {
    return sprintf(
      '<table class="wp-list-table prestations-list">
      <thead>%s</thead>
      <tbody>%s</tbody>
      <tfoot>%s</tfoot>
      </table>',
      $this->get_columns_headers(),
      $this->get_rows(),
      $this->get_columns_footers(),
    );
  }
}
