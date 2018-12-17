<?php

function format_name($name_unformatted)
{
   $name_formatted = ucwords(strtolower($name_unformatted));  // this will handle 90% of the names

   // ucwords will work for most strings, but if you wanted to break out each word so you can deal with exceptions, you could do something like this:
   $separator = array(" ","-","+","'");
   foreach($separator as $s)
   {
      if (strpos($name_formatted, $s) !== false)
      {
         $word = explode($s, $name_formatted);
         $tmp_ary = array_map("ucfirst", array_map("strtolower", $word));  // whatever processing you want to do here
         $name_formatted = implode($s, $tmp_ary);
      }
   }

   return $name_formatted;
}


/*function highlightKeywords($text, $keyword)
{
   $words_arr = explode(" ", $keyword);
   $wordsCount = count($words_arr);
   
   for($i=0;$i<$wordsCount;$i++) {
      $highlighted_text = "<span style='font-weight:bold;'>".$words_arr[$i]."</span>";
      $text = str_ireplace($words_arr[$i], $highlighted_text, $text);
   }

   return $text;
}*/

function highlightkeyword($str, $search) {
   $highlightcolor = "#ffeb3b";
   $occurrences = substr_count(strtolower($str), strtolower($search));
   $newstring = $str;
   $match = array();

   for ($i=0;$i<$occurrences;$i++) {
      $match[$i] = stripos($str, $search, $i);
      $match[$i] = substr($str, $match[$i], strlen($search));
      $newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
   }

   $newstring = str_replace('[#]', '<span style="background-color:'.$highlightcolor.';padding:3px;">', $newstring);
   $newstring = str_replace('[@]', '</span>', $newstring);
   return $newstring;
 
}