<?php
function getCategoriesCheckboxes($categories, $old = '', $parentId = 0, $char = '') {
    $id = request()->category;
    if ($categories) {
        foreach ($categories as $key => $category) {
            if ($category->parent_id === $parentId && $id!=$category->id) {
                echo'<label class="list-group-item"><div class="ml-3"><input name="categories[]" class="form-check-input"  type="checkbox" value="'.$category->id.'"><span>'.$char.$category->name.'</span></div></label>';
                unset($categories[$key]);
                getCategoriesCheckboxes($categories, $old, $category->id, $char . '|-- ');
            }
        }
    }
}
