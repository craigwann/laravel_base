<?php namespace Ironquest\Services;

use \Session as Session;
use \Exception as Exception;

/**
 * For services that are tied to a repository.
 *
 * Class EntityBase
 * @package Ironquest\Services
 */

abstract class EntityBase extends ServiceBase {
    protected $errorFlashMessage = 'An unexpected error has occurred.';
    protected $name;

    /**
     * Create
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data)
    {
        $validator = $this->validator->make($data);
        if ($validator->fails()) {
            $this->setErrors($validator->messages());
            return false;
        }

        try {
            $this->repository->create($data);
        } catch (Exception $e) {
            Session::flash('message', array('message' => $this->errorFlashMessage, 'context' => 'danger'));
            return false;
        }

        Session::flash('message', array('message' => ucfirst($this->name) . ' created!', 'context' => 'success'));
        return $this->repository->getLastId();
    }

    /**
     * Update
     *
     * @param array $data
     * @return boolean
     */
    public function update(array $data)
    {
        $validator = $this->validator->existing()->make($data);
        if ($validator->fails()) {
            $this->setErrors($validator->messages());
            return false;
        }

        try {
            $this->repository->update($data);
        } catch (Exception $e) {
            Session::flash('message', array('message' => $this->errorFlashMessage, 'context' => 'danger'));
            return false;
        }

        Session::flash('message', array('message' => ucfirst($this->name) . ' updated!', 'context' => 'success'));
        return $this->repository->getLastId();
    }

    /**
     * Delete a record.
     *
     * @param $id
     * @return bool
     */
    public function delete($id) {
        try {
            $this->repository->delete($id);
        } catch (Exception $e) {
            Session::flash('message', array('message' => $this->errorFlashMessage, 'context' => 'danger'));
            return false;
        }

        Session::flash('message', array('message' => ucfirst($this->name) . ' deleted!', 'context' => 'success'));
        return true;
    }
}