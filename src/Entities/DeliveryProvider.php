<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class DeliveryProvider
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $name
 * @property int $cost
 */
class DeliveryProvider extends Entity
{
    #region [Properties]
    public $id;
    public $name;
    public $cost;
    public $visible;
    #endregion
}