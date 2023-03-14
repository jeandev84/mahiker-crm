<?php
namespace App\Entity\Contract;

interface HasMetaTimestampInterface
{
      public function setCreatedAtValue();
      public function setUpdatedAtValue();
}