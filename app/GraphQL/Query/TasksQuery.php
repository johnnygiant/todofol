<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;
use App\User;
use App\Task;

class TasksQuery extends Query {

    protected $attributes = [
        'name' => 'tasks'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Task'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'title' => ['name' => 'title', 'type' => Type::string()],
            'body' => ['name' => 'body', 'type' => Type::string()]
        ];
    }

    // public function resolve($root, $args)
    // {
    //   //  $fields = $info->getFieldSelection( 3);
    //     //dump($fields);
    //     if(isset($args['id']))
    //     {
    //         return Task::where('id' , $args['id'])->get();
    //     }
    //     else if(isset($args['title']))
    //     {
    //         return Task::where('title', $args['title'])->get();
    //     }
    //     else if(isset($args['body']))
    //     {
    //         return Task::where('body', $args['body'])->get();
    //     }
    //     else
    //     {
    //         return Task::all();
    //     }
    // }



    public function resolve($root, $args, $context, ResolveInfo $info)
    {
         $fields = $info->getFieldSelection($depth = 3);
         //dump($fields);
         //dd('dupa');
         $tasks = Task::query();

         foreach ($fields as $field => $keys) {
             if($field === 'user') {
                 $tasks->with('User');
                // dump($field);
             }
         }

        if(isset($args['id'])) {
            return $tasks->where('id' , $args['id'])->get();
        } else {
            return $tasks->get();
        }
    }

}
