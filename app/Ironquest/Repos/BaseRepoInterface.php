<?php namespace Ironquest\Repos;

interface BaseRepoInterface
{
    public function all(array $with = array());

    public function allPaginated(array $with = array(), $paginateBy = 15);

    public function find($id, array $with = array());

    public function getBy($key, $value, array $with = array());

    public function getByPaginated($key, $value, array $with = array(), $paginateBy = 15);

    public function create(array $input);

    public function update($id, array $input);

    public function delete($id);
}
