<?php

namespace App\Services;

use Exception;
use App\Repositories\MessageRepository;
use App\Repositories\ThreadRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Message;
use App\Models\Thread;

class ThreadService
{

  protected $message_repository;

  protected $thread_repository;

  public function __construct(
    MessageRepository $message_repository,
    ThreadRepository $thread_repository
  ){
    $this->message_repository = $message_repository;
    $this->thread_repository = $thread_repository;
  }

  public function createNewThread(array $data, string $user_id)
  {
    DB::beginTransaction();
    try {
      $thread_data = $this->getThreadData($data['title'], $user_id);
      $thread = $this->thread_repository->create($thread_data);

      $message_data = $this->getMessageData($data['content'], $user_id, $thread->id);
      $this->message_repository->create($message_data);
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error->getMessage());
      throw new Exception($error->getMessage());
    }
    DB::commit();

    return $thread;
  }

  public function getThreadData(string $thread_title, string $user_id)
  {
    return [
      'title' => $thread_title,
      'user_id' => $user_id,
      'latest_comment_time' => Carbon::now()
    ];
  }

  public function getMessageData(string $message, string $user_id, string $thread_id)
  {
    return [
      'body' => $message,
      'user_id' => $user_id,
      'thread_id' => $thread_id
    ];
  }
}