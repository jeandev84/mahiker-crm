<?php
namespace App\DataFixtures;

class UserFaker
{
    /**
     * @return array
    */
    public static function getUsers(): array
    {
        return [
            [
                'email' => 'andrey@gmail.com',
                'password' => 'andrey123',
                'fullName' => 'Тимотиев Андрей П.',
                'roles' => ['ROLE_ADMIN']
            ],
            [
                'email' => 'jeanyao@ymail.com',
                'password' => 'jeanyao123',
                'fullName' => 'Яо Куасси Жан-Клод',
                'roles' => ['ROLE_USER']
            ],
            [
                'email' => 'katya@yandex.ru',
                'password' => 'katya123',
                'fullName' => 'Федотова Экатерина А.',
                'roles' => ['ROLE_USER']
            ],
            [
                'email' => 'nikolay@yandex.ru',
                'password' => 'ikolay123',
                'fullName' => 'Николай Николаевич С.',
                'roles' => ['ROLE_USER']
            ],
        ];
    }
}