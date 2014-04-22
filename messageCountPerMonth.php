<html>
<body>
	<p> jsfiddle </p> 
	<table>
	<?php
	//start date: 200305 (chose this date because it was the earliest mention of any of the pastebin websites)
	$todaysDate = '201403';
	$year = 2003;
	$month = 5;
	$display = "";
	
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
		
		$file_string = file_get_contents($url);
	
		preg_match('/<span class="info">(.*)<\/span>/i', $file_string, $span_info);
		$span_info_out = $span_info[1];
		$about_substring = strpos($span_info_out, "about");
		$about_substring = $about_substring + 5;
		$sort_by_substring = strpos($span_info_out, "Sort");
		$length = $sort_by_substring - $about_substring;
		$number = substr($span_info_out, $about_substring, $length);
		
		//put the number and date in a row of a table
		//if parsing and no count was return the web scraper returns span> because of parsing the html 
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
