<?php
// Hàm thông báo lỗi data
function form_error($fieldName, $errors, $beforeHtml = '', $afterHtml = '')
{
    return (!empty($errors[$fieldName]))
        ? $beforeHtml . $errors[$fieldName] . $afterHtml : false;
}

// Hàm hiển thị old data
function old($fieldName, $oldValue)
{
    return (!empty($oldValue[$fieldName]))
        ? $oldValue[$fieldName] : false;
}
