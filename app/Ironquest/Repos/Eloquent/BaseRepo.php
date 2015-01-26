<?php namespace Ironquest\Repos\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Ironquest\Repos\BaseRepoInterface;

abstract class BaseRepo implements BaseRepoInterface
{
    /**
     * The model to execute queries on.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model to execute queries on
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new instance of the model.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNew(array $attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    /**
     * Retrieve all entities
     *
     * @param array $with
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        $entity = $this->make($with);
        return $entity->get();
    }

    /**
     * Retrieve all entities paginated
     *
     * @param array $with
     * @param int $paginateBy
     * @return mixed
     */
    public function allPaginated(array $with = array(), $paginateBy = 15) {
        return $this->make($with)->paginate($paginateBy);
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
            $model = $this->model->find($id);
        }

        return $model;
    }

    /**
     * Search for many results by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return Illuminate\Database\Query\Builders
     */
    public function getBy($key, $value, array $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    /**
     * Search for many results by key and value
     * Returns paginated result
     *
     * @param $key
     * @param $value
     * @param array $with
     * @param int $paginateBy
     * @return mixed
     */
    public function getByPaginated($key, $value, array $with = array(), $paginateBy = 15)
    {
        return $this->make($with)->where($key, '=', $value)->paginate($paginateBy);
    }

    /**
     * Create a record.
     *
     * @param array $input
     * @return static
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update a record.
     *
     * @param $id
     * @param array $input
     * @return bool|int
     */
    public function update($id, array $input)
    {
        return $this->model->find($id)->update($input);
    }

    /**
     * Delete a record.
     *
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Get the ID of the last saved record.
     *
     * @return mixed
     */
    public function getLastId()
    {
        return $this->model->id;
    }
}