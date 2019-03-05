<?php 
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $date= Input::get('date');
        $start = Input::get('start');
        $end = Input::get('end');
        $date1 = $date." ".$start;
        $date2 = $date." ".$end;
        $db = DB::getInstance();
        if(!$db->insert('work', array(
            'workDate'  => $date,
            'workStart' => $start,
            'workEnd'   => $end
        ))){
            echo 'ERROR';
        }
    }    
        
    
}
$db = DB::getInstance();
$output='';
if($db->query('SELECT * FROM work')->count()>0){
    $output.="<table><thead><th>Date</th><th>Start Time</th><th>End Time</th><th>Hours Worked</th><th> $ </th><th> Lunch </th><th> $ </th><tbody>";
    foreach($db->results() as $result){
        $date= $result->workDate;
        $start = $result->workStart;
        $end = $result->workEnd;
        $date1 = $date." ".$start;
        $date2 = $date." ".$end;
        $date1Timestamp = strtotime($date1);
        $date2Timestamp = strtotime($date2);
        
        //Calculate the difference.
        $difference = ((($date2Timestamp - 1800) - $date1Timestamp)/60)/60;

        $output.="<tr><td>$date</td><td>$start</td><td>$end</td><td>".($difference)."</td><td>$".($difference*33) ."</td>";
    }
    $output.="</tbody><table>";
    echo $output;
}else{
    echo "No results";
}


?>
<div class="form-container">
    <div class="container">
        <form action="/?p=<?php echo Input::get('p') ?>#Calendar" method='post'>
        <input type="hidden" name="month" value="<?php echo Input::get('month') ?>">
        <input type="hidden" name="year" value="<?php echo Input::get('year') ?>">
        <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
        <label for="date">Date</label>
        <input type="date" name="date" id="date">
        <label for="start">Start</label>
        <input type="time" name="start" id="start">
        <label for="end">End</label>
        <input type="time" name="end" id="end">
        <input type="submit" value="Save">
        </form>
    </div>
</div>