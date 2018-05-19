<?php
/**
 * Created by PhpStorm.
 * User: zvan
 * Date: 2018/5/19
 * Time: 20:21
 */

use Spatie\Permission\Models\Permission;

return [
    'title' => '权限',
    'single' => '权限',
    'model' => Permission::class,

    'permission' => function(){
       return Auth::user()->can('manage_users');
    },

    // 对增删改查 进行单独的权限控制，通过返回布尔值来控制权限
    'action_permissions' => [
        // 控制新建按钮的显示
        'create' => function($model){
            return true;
        },
        'update' => function($model){
             return true;
        },
        'delete' => function($model){
            return false;
        },
        'view' => function($model){
            return true;
        },


    ],

    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'name' => [
            'title' => '标识'
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false
        ],
    ],
    'edit_fields' => [
        'name' => [
            'title' => '标识（请慎重修改）',
            // 表单条目标题胖的 提示信息
            'hint' => '修改权限标识会影响代码的调用， 请不要轻易更改',

        ],
        'roles' => [
            'type' => 'relationship',
            'title' => '角色',
            'name_field' => 'name'
        ],
    ],

    'filter' => [
        'name' => [
            'title' => '标示'
        ]
    ]
];