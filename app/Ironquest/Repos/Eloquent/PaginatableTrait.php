<?php namespace Ironquest\Repos\Eloquent;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 12/2/14
 * Time: 7:04 PM
 *
 * Lists a model's rows or structure as an option list compatible with laravel's form helper select objects.
 * Requires model name class var.
 */

trait PaginatableTrait {

    protected $paginateBy = 15;
    protected $autoPaginate = true;
    protected $paginate = false;

    /**
     * Set if queries should be paginated by default.
     *
     * @param $bool
     */
    public function setAutoPaginate($bool) {
        $this->autoPaginate = $bool;
    }

    /**
     * Make a new instance of the entity to query on.
     * Will return a paginated instance if autoPaginate or paginate set to true.
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function make(array $with = array())
    {
        $model = $this->model->with($with);
        if ($this->paginate || $this->autoPaginate) $model->paginate($this->paginateBy);
        $this->paginate = false;
        return $model = $this->model->with($with)->paginate($this->paginateBy);
    }

    /**
     * Paginate the next query by $number results per page.
     *
     * @param $number
     * @return mixed
     */
    public function paginate($number) {
        $this->paginateBy = $number;
        $this->paginate = true;
        return this;
    }
}