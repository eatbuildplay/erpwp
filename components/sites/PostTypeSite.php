<?php

namespace ERPWP\Components\Sites;

class PostTypeSite extends \ERPWP\PostType {

  public function key() {
    return 'site';
  }

  public function nameSingular() {
    return 'Site';
  }

}
