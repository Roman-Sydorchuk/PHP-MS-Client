<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources;

use SphereMall\MS\Entities\Entity;

class BasketResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "basket";
    }
    #endregion

    #region [Override CRUD]
    /**
     * Get entity by id
     * @param int $id
     * @return Entity
     */
    public function get(int $id)
    {
        $params = [];

        if ($this->fields) {
            $params['fields'] = implode(',', $this->fields);
        }

        $uriAppend = 'byId/' . $id;
        $response = $this->handler->handle('GET', false, $uriAppend, $params);
        $result = $this->make($response);

        //TODO: Add additional wrapper or check for one element
        return $result->current();
    }

    /**
     * @param $data
     * @return Entity
     */
    public function new($data)
    {
        $response = $this->handler->handle('POST', $data, 'new');
        $result = $this->make($response);

        return $result->current();
    }
    #endregion
}