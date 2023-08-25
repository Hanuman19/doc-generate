<?php

namespace App\Domain\Docs\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class docsData extends DataTransferObject
{
    public string $name;
    public string $inn;
    public string $kpp;
    public array $shopper;
    public array $products;
    public ?string $logo_path;
}
