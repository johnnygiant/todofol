<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;
use App\User;
use App\Task;

class UsersQuery extends Query {

    protected $attributes = [
        'name' => 'users'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()]
        ];
    }

    // public function resolve($root, $args)
    // {
    //     if(isset($args['id']))
    //     {
    //         return User::where('id' , $args['id'])->get();
    //     }
    //     else if(isset($args['email']))
    //     {
    //         return User::where('email', $args['email'])->get();
    //     }
    //     else if(isset($args['name']))
    //     {
    //         return User::where('name', $args['name'])->get();
    //     }
    //     else
    //     {
    //         return User::all();
    //     }
    // }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
         $fields = $info->getFieldSelection($depth = 3);
         //dump($fields);
         //dd('dupa');
         $users = \App\User::query();

         foreach ($fields as $field => $keys) {
             if($field === 'tasks') {
                 $users->with('Tasks');
                // dump($field);
             }
         }

        if(isset($args['id'])) {
            return $users->where('id' , $args['id'])->get();
        } else {
            return $users->get();
        }
    }

}
