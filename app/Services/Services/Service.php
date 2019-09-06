<?php


namespace App\Services\Services;


use App\Services\Contracts\ServiceInterface;
use Illuminate\Filesystem\Filesystem;

class Service implements ServiceInterface
{
    protected $repository;

    /**
     * @param mixed $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        $this->repository->getAll();
    }

    public function getById($id)
    {
        $this->repository->getById($id);
    }

    public function create($request)
    {
        $this->repository->create($request);
    }

    public function update($request, $id)
    {
        $result = $this->repository->getById($id);
        if ($result) {
            if ($request->hasFile('image')) {
                if ($result->image !== '1.png') {
                    //chua xoa dc
                    $this->deleteFile('image/' . $result->image);
                }
                $file = $request->image;
                $file->store('/image', 'public');
                $array = $request->all();
                $array['image'] = $file->hashName();
                $this->repository->update($array, $result);
            }
        }
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function deleteFile($url)
    {
        $file = new Filesystem();
        $file->delete($url);
    }
}
