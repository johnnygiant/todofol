<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\User;
use App\Task;

class UserType extends GraphQLType {

    protected $attributes = [
        'name' => 'User',
        'description' => 'A user'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of user'
            ],
            'tasks' => [
                'args' => [
                  'id' => [
                      'type'        => Type::string(),
                      'description' => 'id of the task',
                  ],
                ],
                'type' => Type::listOf(GraphQL::type('Task')),
                'description' => 'The task relationship'
              ],
        ];
    }
    protected function resolveEmailField($root, $args)
    {
      return strtolower($root->email);
      //return dump($args);
    }

    public function resolveTasksField($root, $args)
    {
        if (isset($args['id'])) {
            return  $root->tasks->where('id', $args['id']);
        }

        return $root->tasks;
    }


}
