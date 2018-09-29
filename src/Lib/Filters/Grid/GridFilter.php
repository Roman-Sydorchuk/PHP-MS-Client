<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 12:57 PM
 */

namespace SphereMall\MS\Lib\Filters\Grid;

use SphereMall\MS\Lib\Filters\Filter;

/**
 * @property array $availableFilters
 * @property array $elements
 * @property int $level
 */
class GridFilter extends Filter
{
    #region [Properties]
    protected $level = 0;
    protected $elements;

    #endregion

    #region [Public methods]
    /**
     * @param GridFilterElement[] $elements
     *
     * @return $this
     */
    public function elements(array $elements)
    {
        /**
         * @var GridFilterElement $element
         */
        foreach ($elements as $element) {
            $this->elements[$this->level][$element->getName()] = $element->getValues();
        }

        $this->level++;

        return $this;
    }

    /**
     * @param GridFilterElement $element
     * @return $this
     */
    public function addElement(GridFilterElement $element) {
        $this->elements[0][$element->getName()] = $element->getValues();
        return $this;
    }


    /**
     * @return $this
     */
    public function reset()
    {
        $this->elements = null;
        $this->level    = 0;

        return $this;
    }

    /**
     * @param array $filters
     *
     * @return $this
     */
    public function setFilters($filters = [])
    {
        foreach ($filters as $key => $value) {
            $this->addFilter($key, $value);
        }

        return $this;
    }

    /**
     *  Adds a filter to the resource request
     *
     * @param string $field the field to filter on
     * @param string $value the value of the attribute to operate on
     *
     * @param $operator
     *
     * @return $this
     */
    public function addFilter($field, $value, $operator = null)
    {
        $this->filters[$field] = $value;

        return $this;
    }

    /**
     * @return GridFilterElement[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     *  Convert the filter object to a string for a URL
     *
     * @return string
     */
    public function __toString()
    {
        $set = $this->getStandardFilter();

        if (!empty($this->elements)) {
            $set['params'] = json_encode($this->elements);
        }

        return urldecode(http_build_query($set));
    }
    #endregion

    #region [Private methods]
    /**
     * @return array
     */
    private function getStandardFilter()
    {
        $set = [];
        if (!empty($this->filters)) {
            foreach ($this->filters as $key => $value) {
                $set[$key] = is_array($value) ? implode(',', $value) : $value;
            }
        }

        return $set;
    }
    #endregion
}
