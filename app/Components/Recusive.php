<?php
/**
 * Created by PhpStorm.
 * User: Trung Pham
 * Date: 11/30/2020
 * Time: 11:10 PM
 */

namespace App\Components;


use App\Category;

class Recusive
{
    protected $htmlSelect = '';
    protected $data = [];
    protected $category;
    public function __construct(
        Category $category
    ) {
        $this->category = $category;
    }

    public function categoryRecusive($id = 0, $currentCategory = 0, $delimiter = '') {
        $data = $this->category->all();
        foreach ($data as $value) {
            $categoryId = $value->id;
            if($value->parent_id == $id) {
                if($categoryId != 0 && $categoryId == $currentCategory) {
                    $this->htmlSelect .= "<option value='$categoryId' selected>".$delimiter.$value->name."</option>";
                } else {
                    $this->htmlSelect .= "<option value='$categoryId'>".$delimiter.$value->name."</option>";
                }
                $this->categoryRecusive($categoryId, $currentCategory,$delimiter.'--');
            }
        }
        return $this->htmlSelect;
    }
}