<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $topic;
    public function __construct(Topic $topic)
    {
        // 队列任务构造器中接受了eloquent模型，将智慧序列化模型的ID
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 请求百度api翻译
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);
        // 为了避免模型监控器循环调用，我们使用db类直接对数据库进行更新
        \DB::table('topics')->where('id',$this->topic->id)->update(['slug' => $slug]);
    }
}
