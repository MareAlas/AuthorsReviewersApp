<?php

namespace App\Enums;

use App\BaseEnum;

final class ArticleStatus extends BaseEnum
{
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const PUBLISHED = 'published';
}