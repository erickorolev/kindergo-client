<?php

declare(strict_types=1);

namespace Domains\Users\Tests\Feature;

use Domains\Children\Models\Child;
use Domains\Users\Models\User;
use Parents\Tests\PhpUnit\TestCase;
use Illuminate\Database\Eloquent\Collection;

class UserModelRelationshipsTest extends TestCase
{
    public function testChildManyRelationships(): void
    {
        $user = User::factory()->create();
        $child = Child::factory()->create();
        $user->children()->attach($child);

        $this->assertInstanceOf(Collection::class, $user->children);
        $this->assertInstanceOf(Child::class, $user->children->first());
        $this->assertEquals($child->id, $user->children->first()->id);
    }
}
