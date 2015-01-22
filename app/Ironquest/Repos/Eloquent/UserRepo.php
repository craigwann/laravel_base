<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\User;
use Ironquest\Repos\UserRepoInterface;

class UserRepo extends BaseRepo implements UserRepoInterface
{
    use ReviveableTrait;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function make(array $with = array())
    {
        return $this->model->withTrashed()->with($with);
    }

    /**
     * Find a single entity
     *
     * composite primary key인 경우 $id는 array
     *  - MemberOption::scopeCompositeKey
     *
     * @param $id
     * @param array $with
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = array())
    {
        $entity = $this->make($with);

        if (is_array($id)) {
            $model = $entity->compositeKey($id)->first();
        } else {
            $model = $this->model->withTrashed()->find($id);
        }

        return $model;
    }
}
