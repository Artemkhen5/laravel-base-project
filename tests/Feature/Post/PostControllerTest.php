<?php

namespace Feature\Post;

use App\Models\Post;
use Tests\Feature\BaseTest;

class PostControllerTest extends BaseTest
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->model = Post::class;
        $this->route = 'posts';
    }

    public function testCorrectMethodIndex(): void
    {
        parent::testCorrectMethodIndex();
    }

    public function testCorrectMethodIndexWithRange(): void
    {
        parent::testCorrectMethodIndexWithRange();
    }
}
