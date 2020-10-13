<?php
namespace App\Repositories;

use App\Models\RenovationData;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

use Illuminate\Pagination\LengthAwarePaginator;


class RenovationClass extends BaseRepository
{
    /**
     * BlogCategoryRepository constructor.
     *
     * @param  BlogCategory  $model
     */
    public function __construct(RenovationData $model)
    {
        $this->model = $model;
    }


    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc',$type = 1) : LengthAwarePaginator
    {
        return $this->model
            ->where('type', $type)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}