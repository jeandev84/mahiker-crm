<?php
namespace App\Entity\Contract;

interface HasTimestampInterface
{
      public function setCreatedAtValue();
      public function setUpdatedAtValue();
}