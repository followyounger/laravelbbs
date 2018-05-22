<?php

namespace App\Models\Traits;

use Redis;
use Carbon\Carbon;

trait LastActivedAtHelper
{
    // 缓存相关
    protected $hash_prefix = 'larabbs_last_actived_at_';
    protected $field_prefix = 'user_';

    public function recordLastActivedAt()
    {
        // 获取今天的日期
        $date = Carbon::now()->toDateString();

        // Redis 哈希表的命名，如：larabbs_last_actived_at_2017-10-21
        $hash = $this->getHashFromDateString($date);

        // 字段名称，如：user_1
        $field = $this->getHashField();
//        dd(Redis::hGetAll($hash));
        // 当前时间，如：2017-10-21 08:35:15
        $now = Carbon::now()->toDateTimeString();

        // 数据写入 Redis ，字段已存在会被更新
        Redis::hSet($hash, $field, $now);
    }

    public function syncUserActivedAt()
    {
        // 获取昨天的日期，
        $yesterday_date = Carbon::yesterday()->toDateString();
        // redis哈希表的命名，如：larabbs_last_actived_at_2017-10-21
        $hash = $this->getHashFromDateString($yesterday_date);
        // 从redis中获取所有哈希表里的数据
        $dates = Redis::hGetAll($hash);

        // 遍历，同步到数据库中
        foreach ($dates as $user_id => $actived_at){
            // 会将user_1  转换为1
            $user_id = str_replace($this->field_prefix,'',$user_id);

            // 只有当用户存在时，才更新到数据库中
            if ($user = $this->find($user_id)){
                $user->last_actived_at = $actived_at;
                $user->save();
            }
        }
        // 以数据库为中心的存储，  记忆存储，即可删除
        Redis::del($hash);
    }

    public function getLastActivedAtAttribute($value)
    {
        // 获取今日的日期
        $date = Carbon::now()->toDateString();

        $hash = $this->hash_prefix.$date;

        $field = $this->field_prefix.$this->id;

        // 优先使用三元运算符，优先使用redis， 否则使用数据库中
        $datetime = Redis::hGet($hash,$field)?:$value;

        if ($datetime){
            return new Carbon($datetime);
        }else{
            return $this->created_at;
        }
    }

    public function getHashFromDateString($date)
    {
        return $this->hash_prefix.$date;
    }
    public function getHashField()
    {
        return $this->field_prefix.$this->id;
    }
}