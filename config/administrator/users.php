<?php
/**
 * Created by PhpStorm.
 * User: zvan
 * Date: 2018/5/19
 * Time: 19:26
 */

use App\Models\User;

return [
    // 页面标题
    'title' => '用户',
    // 模型单数，用作页面
    'single' => '用户',
    // 数据模型，，用于增删改查
    'model' => User::class,

    // 设置当前页面的访问权限，通过返回布尔值来控制权限
    // 返回true，即通过权限验证，false 则无权访问并从menu中隐藏
    'permission' =>function()
    {
        return Auth::user()->can('manage_contents');
    },

    // 字段负责 渲染数据表格，由无数的列组成

    //  列的表示，这是最小化列的信息配置的例子，，读取的是模型里对应
    'columns' => [
        'id',
        'avatar' => [
            'title' => '头像',
            'output' =>function($avatar,$model){
                return empty($avatar)?'N/A':'<img src="'.$avatar.'" width="40">';
            },
            'sortable' =>false,
        ],
        'name' => [
            'title' => '用户名',
            'sortable' => false,
            'output' => function($name,$model){
                return '<a href="/users/'.$model->id.'" target=_blank>'.$name.'</a>';
            }
        ],
        'email' => [
            'title' => "邮箱",
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],
    // 模型表单  设置项
    'edit_fields' => [
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱'
        ],
        'password' => [
            'title' => '密码',
            'type' => 'password'
        ],
        'avatar' => [
            'title' => '用户头像',
            'type' => 'image',
            'location' => public_path().'/uploads/images/avatars/',
        ],
        'roles' => [
            'title' => '用户角色',
            'type' => 'relationship',
            'name_field' => 'name'
        ],
    ],

    'filters' => [
        'id' => [
            'title' => '用户ID'
        ],
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱'
        ]
    ]
];