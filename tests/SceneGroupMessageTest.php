<?php

namespace PcbDingtalk\Tests;

class SceneGroupMessageTest extends TestCase
{
    protected $robotId = '';

    protected $sceneGroupId = '';

    protected $isAtAll = false;

    protected $atUsers = [];

    public function testSendText()
    {
        $content = '';

        $this->app()->makeSceneGroupMessage()->sendText(
            $this->robotId,
            $this->sceneGroupId,
            $content,
            $this->isAtAll,
            $this->atUsers
        );
    }

    public function testSendMarkdown()
    {
        $title = '';

        $content = '';

        $this->app()->makeSceneGroupMessage()->sendText(
            $this->robotId,
            $this->sceneGroupId,
            $title,
            $content,
            $this->isAtAll,
            $this->atUsers
        );
    }
}
