<?php

namespace App\Repositories;

use App\DTO\User\UserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return array<string, string>
     */
    public function roleOptions(): array
    {
        return User::$role_name;
    }

    public function createFromData(UserData $data): Builder|Model
    {
        $payload = $data->toArray();
        $payload['password'] = Hash::make((string) $data->password);

        return $this->create($payload);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createFromArray(array $data): Builder|Model
    {
        return $this->createFromData(UserData::fromArray($data));
    }

    public function updateFromData(UserData $data): bool
    {
        $payload = $data->toArray();

        if ($data->password !== null) {
            $payload['password'] = Hash::make($data->password);
        }

        return $this->update($data->id, $payload);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function updateFromArray(array $data): bool
    {
        return $this->updateFromData(UserData::fromArray($data));
    }
}
