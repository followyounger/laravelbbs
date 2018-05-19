<?php
/**
 * Created by PhpStorm.
 * User: zvan
 * Date: 2018/5/19
 * Time: 20:54
 */

use App\Models\Topic;

return [
    'title' => '话题',
    'single' => '话题',
    'model' => Topic::class,

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title' => '话题',
            'sortable' => false,
            'output' => function($value,$model){
               return '<div style="max-width:26px">'.model_link($value,$model).'</div>';
            },
        ],
        'user' => [
            'title' => '作者',
            'sortable' => false,
            'output' => function($value,$model){
                $avatar = $model->user->avatar;
                $value = empty($avatar)?'N/A':'<img src="'.$avatar.'" style="height:22px;width:22px">'.$model->user->name;
                return model_link($value,$model);
            },
        ],
        'category' => [
            'title' => '分类',
            'sortable' => false,
            'output' => function($value,$model){
    return model_admin_link($model->category->name,$model->category);
            }
        ],
        'reply_count' => [
            'title' => '评论',
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title' => '标题',
        ],
        'user' => [
            'title' => '用户',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => ["CONCAT(id,' ',name)"],
            'options_sort_field' => 'id'
        ],
        'category' => [
            'title' => '分类',
            'type' => 'relationship',
            'name_field' => 'name',
            'search_fields' => ["CONCAT(id,' ',name)"],
            'options_sort_field' => 'id'
        ],
        'reply_count' => [
            'title' => '评论'
        ],
        'view_count' => [
            'title' => '查看'
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '内容ID'
        ],
        'user' => [
            'title' => '用户',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'serach_fields' => array("CONCAT[id,' ',name]"),
            'options_sort_field' => 'id'
        ],
        'category' => [
            'title' => '分类',
            'type' => 'relationship',
            'name_field' => 'name',
            'search_fields' => array("CONCAT(id,' ',name)"),
            'options_sort_field' => 'id',
        ],
    ],
    'rules' => [
        'title' => 'required'
    ],
    'messages' => [
        'rules.required' => '请填写标题'
    ]
];