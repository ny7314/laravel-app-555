<?php

namespace App\Repositories;

use App\Models\Thread;
use Carbon\Carbon;

class ThreadRepository
{
  protected $thread;

  public function __construct(Thread $thread)
  {
    $this->thread = $thread;
  }

  public function create(array $data)
  {
    return $this->thread->create($data);
  }

  public function findById(int $id)
  {
    return $this->thread->find($id);
  }

  public function updateTime(int $id)
  {
    $thread = $this->findById($id);
    $thread->latest_comment_time = Carbon::now();
    return $thread->save();
  }
}