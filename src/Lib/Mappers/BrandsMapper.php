<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Brand;

/**
 * Class BrandsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class BrandsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Brand
     */
    protected function doCreateObject(array $array)
    {
        return new Brand(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
    #endregion
}
