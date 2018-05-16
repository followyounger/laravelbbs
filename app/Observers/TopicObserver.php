<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }
    

    public function saving(Topic $topic)
    {
        // 这个是xss过滤
        $topic->body = clean($topic->body,'user_topic_body');
        // 生成话题摘要

        $topic->excerpt = make_excerpt($topic->body);

    }

    public function saved(Topic $topic)
    {
        // 如果slug字段无内容，即  使用翻译器对title进行编译
        if (! $topic->slug)
        {
//            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);

            //推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }

    public function updating(Topic $topic)
    {
        //
    }
}