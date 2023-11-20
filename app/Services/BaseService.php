<?php

namespace App\Services;

use App\Repositories\Repository;
use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Repositories\CustomerRepository;
use Crm\Customer\Models\Customer;
use Illuminate\Http\Request;

class BaseService
{
    protected Repository $repository;

    /**
     * @return Model
     */
    public function getRepository(): Repository
    {
        return $this->repository;
    }

    /**
     * @param Model $model
     */
    public function setRepository(Repository $repository): void
    {
        $this->repository = $repository;
    }

    public function index(Request $request) :array
    {      
        $query = $this->repository->getModel()->query();
        if($request->has('search'))
        {
            foreach ($request->search as $key => $value) {
                if (strpos($key, '_ar') !== false || strpos($key, '_en') !== false) {
                $query->whereTranslationLike(explode('_', $key)[0], "%{$value}%",explode('_', $key)[1]);
                } else {
                 $query->where($key, 'like' ,"%{$value}%");
                }
            }
        }

        if($request->has('filter'))
        {  
            foreach ($request->filter as $key => $value) {
                $query->whereIn($key,$value);
            } 
        }
        

        $entities = isset($request->skip) ? $query->skip($request->skip )->take($request->take)->get() : $query->get();

        return [ $entities , $query->count()];
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function create($data)
    {   
        $entity = $this->repository->create($data);

        return [$entity, trans('messages.created'), 200];

    }


    public function update(Request $request, $id)
    {
        if(!$this->repository->find($id)) {
            return [null,trans('messages.not_found'),404];
        }
        $entity = $this->repository->update($request->all(),$id);
        return [$entity, trans('messages.updated'), 200];
    }


    public function delete(Request $request , int $id)
    {
        $entity = $this->repository->find($id);

        if(!$entity) {
            return [null,trans('messages.not_found'),404];
        }
        $this->repository->delete($id);

        return [null, trans('messages.deleted'), 200];
    }
}
