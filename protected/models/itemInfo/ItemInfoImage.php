<?php

class ItemInfoImage extends ItemInfo
{
    /**
     * @param string $className
     * @return ItemInfoImage
     */
    public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function defaultScope()
    {
        $t = $this->getTableAlias(false, false);
        return array(
            'condition' => $t.'.item_type = :'.$t.'_item_type',
            'params' => array(':'.$t.'_item_type' => ItemTypes::ITEM_TYPE_IMAGE)
        );
    }

    public function beforeValidate()
    {
        $this->item_type = ItemTypes::ITEM_TYPE_IMAGE;
        return parent::beforeValidate();
    }

    public static function updateAllByAlbumId($attributes, $condition, $params)
    {
        if($condition == '')
            $condition = 'item_type = :item_type';
        else
            $condition .= ' and item_type = :item_type';
        $params = CMap::mergeArray($params, array(':item_type' => ItemTypes::ITEM_TYPE_IMAGE));

        return self::model()->updateAll($attributes, $condition, $params);
    }
}