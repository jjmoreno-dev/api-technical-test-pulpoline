<?php

namespace App\Http\Controllers\API\IdentityAndAccess\Application\UseCases;

use App\Http\Controllers\API\IdentityAndAccess\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class RegisterUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $data): array
    {       
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            throw new \Exception(json_encode($validator->errors()));
        }

        $userEmailExist = $this->userRepository->existsByEmail($data['email']);
        if ($userEmailExist) {
            throw new \Exception(json_encode('User already exists!'));
        }

        $data['password'] = bcrypt($data['password']);
        $user = $this->userRepository->create($data);

        return ['user' => $user];
    }
}