<?php


class Calendar{
    private $month,
            $year,
            $days_of_week,
            $num_days,
            $date_info,
            $day_of_week,
            $last_month,
            $next_month,    
            $last_year,
            $next_year,
            $current_month,
            $todays_day,
            $todays_month,
            $todays_year;

    public function __construct($month, $year, $days_of_week = array('S','M', 'T', 'W', 'T', 'F', 'S')){
        $this->month        = $month;
        $this->year         = $year;
        $this->days_of_week = $days_of_week;
        $this->num_days     = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->date_info    = getdate(strtotime('first day of', mktime(0, 0, 0, $this->month, 1, $this->year)));
        $this->day_of_week  = $this->date_info['wday'];
        if(($this->month - 1) == 0) {
            $this->last_month = 12; 
            $this->last_year = $this->year - 1;
        }else{
            $this->last_month = $this->month - 1;
            $this->last_year = $this->year;
        }

        if(($this->month + 1 )== 13){
            $this->next_month = 1;
            $this->next_year=$this->year + 1;
        }else{
            $this->next_month = $this->month + 1;
            $this->next_year = $this->year;
        }
        $this->todays_day = date('d');
        $this->todays_month = date('m');
        $this->todays_year = date('Y');
        
    }

    public function show(){
        $prev_month_num_days = cal_days_in_month(CAL_GREGORIAN, $this->last_month, $this->year);
        //echo "<h1>". $prev_month_num_days  ."</h1>";
        $output="<table class='calendar'>";
        $output.="<caption><div class='cal-head-container'><div><a href='/?p=".Input::get('p') ."&month=" .$this->last_month ."&year=".$this->last_year."#Calendar'><i class='fas fa-chevron-circle-left'></i></a></div> <div>" .$this->date_info['month'] ." " .$this->year ."</div><div> <a href='/?p=".Input::get('p') ."&month=" .$this->next_month ."&year=".$this->next_year."#Calendar'><i class='fas fa-chevron-circle-right'></i></a></div></div></caption>";
        $output.="<tr>";
        foreach($this->days_of_week as $day){
            $output.="<th class='header'>" .$day ."</th>";
        }
        $output.="</tr><tr>";
        if($this->day_of_week>0)
            for($t=0;$t<=$this->day_of_week-1;$t++){
                $output.="<td class='lastmonth'>".($prev_month_num_days - ($this->day_of_week - ($t+1)))."</td>";
            }
            //$output.="<td colspan='".$this->day_of_week ."'></td>";
        $current_day = 1;
        while($current_day <= $this->num_days){
            if($this->day_of_week >= 7){
                $this->day_of_week = 0;
                $output .="</tr><tr>";
            }
            $output .="<td class='day " .$this->isToday($current_day) ."'>" .$current_day ."</td>";

            $current_day++;
            $this->day_of_week++;
        }
        if($this->day_of_week != 7){
            $remaining = 7 - $this->day_of_week;
            for($t=1;$t<=$remaining;$t++)
                $output .="<td class='lastmonth'>". $t."</td>";
        }
        $output.="</tr>";
        $output.="</table>";
        return $output;



    }
    private function isToday($current_day){
        if($this->todays_day == $current_day &&
            $this->todays_month == $this->month &&
            $this->todays_year == $this->year){
                return "today";
            }
            return "";
    }
}
