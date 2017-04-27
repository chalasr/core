<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Core\Api;

use Psr\Container\ContainerInterface;

/**
 * Filter collection factory.
 *
 * @author Baptiste Meyer <baptiste.meyer@gmail.com>
 *
 * @internal
 */
class FilterCollectionFactory
{
    private $filters;

    public function __construct(string ...$filters)
    {
        $this->filters = $filters;
    }

    /**
     * Creates a filter collection from a filter locator.
     *
     * @param ContainerInterface $filterLocator
     *
     * @return FilterCollection
     */
    public function createFilterCollectionFromLocator(ContainerInterface $filterLocator): FilterCollection
    {
        $filters = [];

        foreach ($this->filters as $filterId) {
            if ($filterLocator->has($filterId)) {
                $filters[$filterId] = $filterLocator->get($filterId);
            }
        }

        return new FilterCollection($filters);
    }
}
