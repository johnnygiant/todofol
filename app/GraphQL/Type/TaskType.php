<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\User;

class TaskType extends GraphQLType {

    protected $attributes = [
        'name' => 'Task',
        'description' => 'A Task'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of task'
            ],
            'body' => [
                'type' => Type::string(),
                'description' => 'The body of task'
            ],
            'user' => [
                'args' => [
                  'id' => [
                      'type'        => Type::string(),
                      'description' => 'id of the user',
                  ],
                ],
                'type' => GraphQL::type('User'),
                'description' => 'The user relationship'
              ],
        ];
    }
    // public function resolveUserField($root, $args)
    // { //dump($root->user->where('id', 1)->first());
    //   $users = User::query();
    //   if (isset($args['id'])) {
    //     return $users->where('id', $args['id']->get() );
    //   }
    //
    //   return $users->get();
    // }
    // public function resolveTasksField($root, $args)
    // {
    //     if (isset($args['id'])) {
    //         return  $root->tasks->where('id', $args['id']);
    //     }
    //
    //     return $root->tasks;
    // }
}
