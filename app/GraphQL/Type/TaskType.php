<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

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

                'type' => GraphQL::type('User'),
                'description' => 'The user relationship'
              ],
        ];
    }
    // public function resolveUserField($root, $args)
    // {//return  'dupa';
    //   if (isset($args['id'])) {
    //     return  'dupa';//$root->user->where('id', $args['id']);
    //   }
    //
    //   return $root->user;
    // }

}
