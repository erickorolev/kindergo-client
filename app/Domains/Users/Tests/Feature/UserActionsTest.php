<?php

declare(strict_types=1);

namespace Domains\Users\Tests\Feature;

use Domains\Authorization\Models\Role;
use Domains\Authorization\Seeders\PermissionsSeeder;
use Domains\Users\Actions\DeleteUserAction;
use Domains\Users\Actions\GetUserByCrmidAction;
use Domains\Users\Actions\GetUserByEmailAction;
use Domains\Users\Actions\GetUserByIdAction;
use Domains\Users\Actions\StoreUserAction;
use Domains\Users\Actions\UpdateUserAction;
use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Models\User;
use Domains\Users\ValueObjects\PasswordValueObject;
use Illuminate\Foundation\Testing\WithFaker;
use Parents\Tests\PhpUnit\TestCase;
use Parents\ValueObjects\CrmIdValueObject;
use Parents\ValueObjects\UrlValueObject;

class UserActionsTest extends TestCase
{
    use WithFaker;
    /**
     * @test
     * @covers \Domains\Users\Actions\GetUserByEmailAction
     */
    public function testGetUserByEmailAction(): void
    {
        User::factory()->count(3)->create();
        User::factory()->create([
            'email' => 'test@mail.ru'
        ]);
        /** @var User $result */
        $result = GetUserByEmailAction::run('test@mail.ru');
        $this->assertEquals('test@mail.ru', $result->email);
    }

    /**
     * @test
     * @covers \Domains\Users\Actions\GetUserByCrmidAction
     */
    public function testGetUserByCrmidAction(): void
    {
        User::factory()->count(3)->create();
        User::factory()->create([
            'crmid' => CrmIdValueObject::fromNative('22x333')
        ]);
        /** @var User $result */
        $result = GetUserByCrmidAction::run('22x333');
        $this->assertEquals('22x333', $result->crmid);
    }

    /**
     * @test
     * @covers \Domains\Users\Actions\DeleteUserAction
     */
    public function testDeleteUserAction(): void
    {
        $user = User::factory()->createOne();
        DeleteUserAction::run($user->id);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    /**
     * @test
     * @covers \Domains\Users\Actions\GetUserByIdAction
     */
    public function testGetUserByIdAction(): void
    {
        User::factory()->count(3)->create();
        $user = User::factory()->createOne();
        /** @var User $result */
        $result = GetUserByIdAction::run($user->id);
        $this->assertEquals($user->id, $result->id);
    }

    /**
     * @test
     * @covers \Domains\Users\Actions\StoreUserAction
     */
    public function testStoreUserAction(): void
    {
        /** @var Role $role */
        $role = Role::create(['name' => 'usus']);
        /** @var User $user */
        $user = User::factory()->makeOne();
        $userArr = $user->toFullArray();
        $userArr['roles'] = [$role->id];
        $userArr['password'] = PasswordValueObject::fromNative('password');
        $userArr['external_file'] = UrlValueObject::fromNative(null);
        $userData = new UserData($userArr);
        /** @var User $result */
        $result = StoreUserAction::run($userData);
        $this->assertDatabaseHas('users', [
            'email' => $result->email,
            'firstname' => $result->firstname
        ]);
        $this->assertTrue($result->hasRole('usus'));
    }

    /**
     * @test
     * @covers \Domains\Users\Actions\UpdateUserAction
     */
    public function testUpdateUserAction(): void
    {
        /** @var Role $role */
        $role = Role::create(['name' => 'usus']);
        /** @var User $user */
        $user = User::factory()->createOne();
        $userArr = $user->toFullArray();
        $userArr['roles'] = [$role->id];
        $userArr['firstname'] = 'changed';
        $userArr['external_file'] = UrlValueObject::fromNative(null);
        $userData = new UserData($userArr);
        $userData->id = $user->id;
        /** @var User $result */
        $result = UpdateUserAction::run($userData);
        $this->assertDatabaseHas('users', [
            'email' => $result->email,
            'firstname' => 'changed'
        ]);
        $this->assertTrue($result->hasRole('usus'));
        $this->assertEquals('changed', $result->firstname);
    }
}
