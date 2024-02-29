<?php
namespace App\Dto;

use App\Search\SearchDto;

class AccountSearchDto extends SearchDto
{
    private ?bool $unassigned = null;

    /**
     * @return bool|null
     */
    public function getUnassigned(): ?bool
    {
        return $this->unassigned;
    }

    /**
     * @param string|null $unassigned
     */
    public function setUnassigned(?string $unassigned): void
    {
        $this->unassigned = filter_var($unassigned, FILTER_VALIDATE_BOOLEAN);
    }
}
