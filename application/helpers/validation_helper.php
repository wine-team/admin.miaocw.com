<?php
/*
 * 日期验证 YYYY-MM-DD
 */
function checkDateFormat($date) {
    // match the format of the date
    if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)) {
        // check whether the date is valid of not
        if (checkdate($parts[2], $parts[3], $parts[1])) {
             return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/*
 * $allContent : 1,2,4,8使用逗号分割
* $findme     : 4
* 验证$findme是否存在与$allContent内。
*/
function validateFind($findme = '', $allContent)
{
    $result = false;
    if (empty($findme)) {
        return $result;
    }
    
    if (strpos($allContent, ',') > 0) {
        $allContent = explode(',', $allContent);
    }
    if ((is_array($allContent) && in_array($findme, $allContent)) || ($findme == $allContent)) {
        $result = true;
    }

    return $result;
}