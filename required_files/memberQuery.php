<?php
    /** Fetch data from members table */
        function getNestedData($data){
            $output = '<ul>';
            $query = "SELECT * FROM `members` where `parent_id` = $data";
            $result = mysqli_query($GLOBALS['conn'], $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $output .= '<li>'.$row['name'];
                $output .= getNestedData($row['id']);
                $output .= '</li>';
            }
            $output .= '</ul>';

            return $output;
        }

    /** Get data for select tag */
    function showSelectOption(){
        $getParentName = '
            <option>Select Parent</option>
            <option vlaue="0">None</option>
        ';
        $sql = "SELECT * FROM `members` order by id DESC";
        $res = mysqli_query($GLOBALS['conn'], $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $getParentName .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        return $getParentName;
    }
    
?>
