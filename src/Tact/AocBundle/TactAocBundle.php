<?php

namespace Tact\AocBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TactAocBundle extends Bundle
{

  /**
   *
   * {@inheritdoc}
   *
   * @see \Symfony\Component\HttpKernel\Bundle\Bundle::getParent()
   */
  public function getParent() {
    return 'TactDoryBundle';
  }
}
