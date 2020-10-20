<?php


namespace App\Repositories;

/**
 * Class BaseRepositoryEloquent
 * @package App\Repositories
 */
class BaseRepositoryEloquent
{
    /**
     * @var $model = Model yang digunakan pada repositoru ini.
     */
    private $model;

    /**
     *
     * Constructor, Parameter Model
     *
     * @param $model
     *
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     *
     * Get Data Single dengan menggunakan primary key
     *
     * @param int $primary_key
     * @return mixed
     */
    public function getByPrimaryKey(int $primary_key)
    {
        return $this->model->find($primary_key);
    }

    /**
     *
     * Get Data dengan parameter id
     *
     * @param string $column
     * @param $value
     * @return mixed
     */
    public function getByColumn(string $column, $value)
    {
        return $this->model->where($column,$value)->first();
    }

    /**
     *
     * Get Data dengan Beberapa Parameter Array
     *
     * $params['select']
     * $params['where']
     * $params['where_in']
     * $params['sort_by']
     * $params['offset']
     * $params['limit']
     * $params['relations']
     *
     * @param array $params
     * @return mixed
     */

    public function getAllData(array $params = [])
    {
        # Jika mau Seleksi beberapa kolom saja
        if(isset($params['select'])) {
            $this->model->select($params['select']);
        }

        # Jika mau mencari sesuatu single
        if(isset($params['where'])) {
            $this->model->where($params['where']);
        }

        # Jika mau mencari data yang ada di relation dengan where in
        if(isset($params['where_in'])) {
            $this->model->whereIn($params['where_in']);
        }


        # Jika menggunakan limit dan offset
        if(isset($params['limit'])){
            $offset = 0;
            if(isset($params['offset'])){
                $offset = $params['offset'];
            }

            return $this->model->offset($offset)->limit($params['limit'])->get();
        }
        return $this->model->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $this->model->fill($data);
        return $this->model->save();
    }

    /**
     * @param int $primary_key
     * @param $data
     * @return mixed
     */
    public function updateByPrimaryKey(int $primary_key, $data)
    {
        $model = $this->model->find($primary_key);
        $model->fill($data);
        return $model->save();
    }

    /**
     * @param string $column
     * @param $value
     * @param $data
     * @return mixed
     */
    public function updateByColumn(string $column, $value, $data)
    {
        $model = $this->model->where($column,$value)->first();
        $model->fill($data);
        return $model->save();
    }

    /**
     * @param int $primary_key
     * @return bool
     */
    public function deleteByPrimaryKey(int $primary_key){
        $model = $this->model->find($primary_key);

        if($model){
            return $model->delete();
        }else{
            return false;
        }
    }

    /**
     * @param string $column
     * @param $value
     * @return bool
     */
    public function deleteByColumnKey(string $column, $value){
        $model = $this->model->where($column,$value)->first();

        if($model){
            return $model->delete();
        }else{
            return false;
        }
    }
}
