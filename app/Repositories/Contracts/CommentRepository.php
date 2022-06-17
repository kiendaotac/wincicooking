<?php

namespace App\Repositories\Contracts;

interface CommentRepository
{
    public function addComment($payload);
}