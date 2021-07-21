<?php

declare(strict_types=1);

namespace Domains\Payments\Repositories\Eloquent;

use Domains\Payments\Models\Payment;
use Domains\Payments\Repositories\PaymentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class PaymentRepository extends \Parents\Repositories\Repository implements PaymentRepositoryInterface
{

    public function basicPaginate(string $search, int $pagination): LengthAwarePaginator
    {
        return Payment::search($search)
            ->latest()
            ->paginate(5);
    }
}
