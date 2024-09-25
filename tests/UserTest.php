<?php

namespace PcbDingtalk\Tests;

class UserTest extends TestCase
{
    protected $userId = '';

    protected $phoneNumber = '';

    protected $unionId = '';

    public function testGetUser()
    {
        $data = $this->app()->makeUser()->getUser($this->userId);

        $this->assertIsArray($data);
    }

    public function testGetUserByPhone()
    {
        $data = $this->app()->makeUser()->getUserByPhone($this->phoneNumber);

        $this->assertIsArray($data);
    }

    public function testGetUserByUnionId()
    {
        $data = $this->app()->makeUser()->getUserByUnionId($this->unionId);

        $this->assertIsArray($data);
    }
}
