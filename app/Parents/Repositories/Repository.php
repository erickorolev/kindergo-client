<?php

namespace Parents\Repositories;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Parents\Models\Model;
use Parents\QueryBuilder\QB;
use Parents\Scopes\UserScope;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository as PrettusCacheableRepository;
use Prettus\Repository\Criteria\RequestCriteria as PrettusRequestCriteria;
use Parents\Requests\Request;

/**
 * Class Repository
 * @package Parents\Repositories
 */
class Repository extends \Prettus\Repository\Eloquent\BaseRepository implements CacheableInterface
{
    use PrettusCacheableRepository;

    protected array $allowedSorts = [];

    /**
     * Define the maximum amount of entries per page that is returned.
     * Set to 0 to "disable" this feature
     */
    protected int $maxPaginationLimit = 0;

    /**
     * This function relies on strict conventions.
     * Conventions:
     *    - Repository name should be same like it's model name (model: Foo -> repository: FooRepository).
     *    - If the container contains Models with names different than the container name, the repository class must
     *          set `$container='ContainerName'` property for this function to work properly
     * Specify Model class name.
     *
     * @return string
     * @psalm-suppress TooManyArguments
     */
    public function model(): string
    {
        // 1_ get the full namespace of the child class who's extending this class.
        // 2_ remove the namespace and keep the class name
        // 3_ remove the word Repository from the class name
        // 4_ check if the container name is set on the repository to indicate that the
        //    model has different name than the container holding it
        // 5_ build the namespace of the Model based on the conventions

        $fullName = get_called_class();
        $namePos = strrpos($fullName, '\\');
        if (!$namePos) {
            $namePos = 0;
        }
        $className = substr($fullName, $namePos + 1);
        $classOnly = str_replace('Repository', '', $className);
        $modelNamespace = 'Domains\\' . $this->getCurrentContainer() . '\\Models\\' . $classOnly;

        return $modelNamespace;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot(): void
    {
        // only apply the RequestCriteria if config flag is set!
        if (Config::get('portal.requests.automatically-apply-request-criteria', true)) {
            $this->pushCriteria(app(PrettusRequestCriteria::class));
        }
    }

    /**
     * Paginate the response
     *
     * Apply pagination to the response. Use ?limit= to specify the amount of entities in the response.
     * The client can request all data (skipping pagination) by applying ?limit=0 to the request, if
     * PAGINATION_SKIP is set to true.
     *
     * @param null|int   $limit
     * @param array  $columns
     * @param string $method
     *
     * @return  mixed
     * @psalm-suppress PossiblyInvalidMethodCall
     * @psalm-suppress PossiblyNullReference
     */
    public function paginate($limit = null, $columns = ['*'], $method = "paginate"): mixed
    {
        // the priority is for the function parameter, if not available then take
        // it from the request if available and if not keep it null.
        if (\request()?->has('limit')) {
            $requestLimit = (int) \request()?->get('limit');
        } else {
            $requestLimit = null;
        }
        $limit = $limit ?: $requestLimit;

        // check, if skipping pagination is allowed and the requested by the user
        if (Config::get('repository.pagination.skip') && $limit == "0") {
            return parent::all($columns);
        }

        // check for the maximum entries per pagination
        if (
            $this->maxPaginationLimit > 0
            && $limit > $this->maxPaginationLimit
        ) {
            $limit = $this->maxPaginationLimit;
        }

        return parent::paginate($limit, $columns, $method);
    }

    private function getCurrentContainer(): string
    {
        $searchVal = strpos(str_replace("Domains\\", "", get_called_class()), '\\');
        if (!$searchVal) {
            $searchVal = null;
        }
        return substr(
            str_replace("Domains\\", "", get_called_class()),
            0,
            $searchVal
        );
    }

    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection
    {
        $this->applyCriteria();
        $this->applyScope();
        /** @var string $type */
        $type = $this->model()::RESOURCE_NAME;
        $includes = $this->getIncludesData($type);
        $results = QB::for($this->model())
            ->allowedFields($columns)
            ->allowedSorts(config("jsonapi.resources.{$type}.allowedSorts"))
            ->allowedFilters(
                config("jsonapi.resources.{$type}.allowedFilters")
            )
            ->allowedIncludes($includes)
            ->get();
        $this->resetModel();

        return $results;
    }


    /**
     * @return LengthAwarePaginator
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @psalm-suppress MixedAssignment
     */
    public function jsonPaginate(): LengthAwarePaginator
    {
        $this->applyCriteria();
        $this->applyScope();
        /** @var string $type */
        $type = $this->model()::RESOURCE_NAME;
        $includes = $this->getIncludesData($type);
        /** @var LengthAwarePaginator $results */
        $results = QB::for($this->model())
            ->allowedSorts(config("jsonapi.resources.{$type}.allowedSorts"))
            ->allowedFilters(
                config("jsonapi.resources.{$type}.allowedFilters")
            )
            ->allowedIncludes($includes)
            ->jsonPaginate();
        $this->resetModel();

        return $results;
    }


    /**
     * @param int $id
     * @return Model
     */
    public function findJson(int $id): Model
    {
        /** @var string $type */
        $type = $this->model()::RESOURCE_NAME;
        $includes = $this->getIncludesData($type);
        /** @var Model $model */
        $model = QB::for($this->model())
            ->allowedIncludes($includes)
            ->findOrFail($id);

        return $model;
    }

    protected function getIncludesData(string $type): array
    {
        /** @var array $includes */
        $includes = collect(config("jsonapi.resources.{$type}.relationships"))
            ->map(function (array $relation) {
                /** @var array<string, string> $relation */
                return $relation['method'];
            })->toArray();
        return $includes;
    }
}
