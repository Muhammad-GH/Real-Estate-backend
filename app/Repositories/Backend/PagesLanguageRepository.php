<?php
namespace App\Repositories\Backend;

use App\Models\PagesLanguage;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;

use Illuminate\Pagination\LengthAwarePaginator;


class PagesLanguageRepository extends BaseRepository
{
    /**
     * BlogCategoryRepository constructor.
     *
     * @param  BlogCategory  $model
     */
    public function __construct(PagesLanguage $model)
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
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'asc') : LengthAwarePaginator
    {
        return $this->model
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
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'asc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}