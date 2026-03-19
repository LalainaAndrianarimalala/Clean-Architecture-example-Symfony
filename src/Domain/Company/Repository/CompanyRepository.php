<?php

namespace App\Domain\Company\Repository;

use App\Domain\Company\Entity\Company;

interface CompanyRepository
{
    public function findByEmail(string $email): ?Company;
    public function getById(int $id): Company;
    public function save(Company $company): void;
    public function remove(Company $company): void;
}