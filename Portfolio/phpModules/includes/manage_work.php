<?php
    include_once "../core/init.php";
    $work = new Work();
    switch($page->third()){
        case 'add':
        if(Input::exists()){
            $start= Input::get('workDate');
            $end = Input::get('workEnd');
            $lunch = Input::get('workLunch');
            //$break = Input::get('workBreak');
            echo $start.'<br>';
            $start_date = new DateTime($start);
            $since_start = $start_date->diff(new DateTime($end));
            
            $date = DateTime::createFromFormat("m-d-Y", $start);
            // $d = date_parse_from_format("Y-m-d", $date);
            // echo $d["month"];
            echo date(1, strtotime($date))."<br>";
            $hours = $since_start->h;
            
            $minutes = $since_start->i;
            // echo $minutes;
            $total_minutes = ($hours * 60) + $minutes;
            echo $total_minutes /60 .'<br>';
            $total_hours_minus_breaks = ($total_minutes - ($lunch + $break))/60;
            echo $total_hours_minus_breaks .'<br>';
            echo ($total_hours_minus_breaks) .'<br>';

         }
        break;
        case 'update':

        break;
        
    }

?>
<form action="/administrator/work/add" method="post">
    <table>
        <tr>
            <td><input type="datetime-local" name="workDate" id="workDate" onchange=''></td>
            <!-- <td><input type="datetime-local" name="workStart" id=""></td> -->
            <td><input type="datetime-local" name="workEnd" id="workEnd"></td>
            <td><input type="text" name="workLunch" id="workLunch"></td>
            <td><input type="text" name="workBreak" id="workBreak"></td>
            <td><input type="submit" value='Add'></td>
        </tr>
    </table>
</form>
