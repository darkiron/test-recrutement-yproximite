<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testEntity(): void
    {
        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Smith');
        $user->setRoles([]);

        static::assertSame('John', $user->getFirstName());
        static::assertSame('Smith', $user->getLastName());
        static::assertEquals(['ROLE_USER'], $user->getRoles());

        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        static::assertEquals(['ROLE_USER', 'ROLE_ADMIN'], $user->getRoles());
    }
}
