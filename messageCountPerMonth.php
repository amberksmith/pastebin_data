<html>
<body>
	<p> jsfiddle </p> 
	<table>
	<?php
	//start dates
	//200305
	//go through all the pastebins and see whats the first date and use that for all
	$todaysDate = '201403';
	$year = 2003;
	$month = 5;
	$display = "";
	//$year = 2013;
	//$month = 12;
	
	$date = "";
	if($month < 10)
	{
		$date = $year . "0" . $month;
	}
	else
	{
		$date = $year . $month;
	}
	
	while($todaysDate != $date){
	
		//example markmail.org/search/?q=pastebin+date%3A201004
		$pastebin = 'jsfiddle';
		$url = 'http://markmail.org/search/?q=' . $pastebin . '+date%3A' . $date;
		//$url = 'http://markmail.org/search/?q=' . $pastebin . '+-list%3Acom.googlegroups.jquery-br+date%3A' . $date . '+';
		
		$file_string = file_get_contents($url);
	
		preg_match('/<span class="info">(.*)<\/span>/i', $file_string, $span_info);
		$span_info_out = $span_info[1];
		$about_substring = strpos($span_info_out, "about");
		$about_substring = $about_substring + 5;
		$sort_by_substring = strpos($span_info_out, "Sort");
		$length = $sort_by_substring - $about_substring;
		$number = substr($span_info_out, $about_substring, $length);
		
		//put the number and date in a row of a table
		//if parsing and no count was return the web scraper returns span> because of parsing
		if(strpos($number, 'pan>') == false)
		{
			$display = "<tr>" . "<td>" . $date . "</td>" . "<td>" . "0" . "</td>" . "</tr>";
		}
		else
		{
			$display = "<tr>" . "<td>" . $date . "</td>" . "<td>" . $number . "</td>" . "</tr>";
		}
		
		//update the date
		$month++;
		if($month > 12)
		{
			$year++;
			$month = 1;
		}
		
		if($month < 10)
		{
			$date = $year . "0" . $month;
		}
		else
		{
			$date = $year . $month;
		}
		echo $display;
	}
	
	
	?>
	</table>
</body>
</html> 