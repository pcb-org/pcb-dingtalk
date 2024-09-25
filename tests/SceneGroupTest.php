<?php

namespace PcbDingtalk\Tests;

class SceneGroupTest extends TestCase
{
    protected $title = '';

    protected $templateId = '';

    protected $ownerUserId = '';

    public function testCreate()
    {
        $data = $this->app()->makeSceneGroup()->create(
            $this->title,
            $this->templateId,
            $this->ownerUserId
        );

        $this->assertIsArray($data);
    }
}
