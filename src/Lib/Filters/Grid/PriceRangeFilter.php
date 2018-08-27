<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/2/2017
 * Time: 5:51 PM
 */

namespace SphereMall\MS\Lib\Filters\Grid;

/**
 * Class PriceRangeFilter
 * @package SphereMall\MS\Lib\Filters\Grid
 * @property string $name
 */
class PriceRangeFilter extends GridFilterElement
{
    #region [Properties]
    protected $name = 'priceRange';
    #endregion

    #region [Constructor]
    /**
     * PriceRangeFilter constructor.
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->values = [$values];
    }
    #endregion
}
