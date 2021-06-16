<?php


namespace App\Repositories;


interface UsersRepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createInvite(array $data): array;
}
