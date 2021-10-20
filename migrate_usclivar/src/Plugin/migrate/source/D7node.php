<?php

namespace Drupal\migrate_usclivar\Plugin\migrate\source;

use Drupal\node\Plugin\migrate\source\d7\Node;
use Drupal\migrate\Row;


/**
 * Drupal 7 node source from database.
 *
 * @MigrateSource(
 *   id = "usclivar_d7_node"
 * )
 */
class D7node extends Node {
  
  public function prepareRow(Row $row) {
    // Include path alias.
    $nid = $row->getSourceProperty('nid');
    $query = $this->select('url_alias', 'ua')
			->fields('ua', ['alias']);
		$query->condition('ua.source', 'node/' . $nid);
		$alias = $query->execute()->fetchField();
		if (!empty($alias)) {
			$row->setSourceProperty('alias', '/' . $alias);
		}
    return parent::prepareRow($row);
  }

  
}
