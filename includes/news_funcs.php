<?php

function get_news_to_page($page, $lang, $news_per_site)
{
  	$liczba = get_total_news($lang);
  	
  	if($liczba < $page*$news_per_page) $min = $liczba-($liczba%$new_per_page)+1;
   	else $min = ($page-1)*$new_per_page;
			
    	$query = "SELECT portal_news.ID, portal_news.Data, Tytul, portal_news.Tresc, username
FROM portal_news, portal_users
WHERE portal_news.lang = '$lang'
AND portal_users.ID = portal_news.Dodal
ORDER BY DATA DESC, ID DESC
LIMIT $min, $news_per_site;";
    	$res = query($query);
   	
   	$news = array();
   	
    	while($row = mysql_fetch_assoc($res))
    	{
       		$temp['ID'] = $id = $row['ID'];
       		$temp['Data'] = $row['Data'];
       		$temp['Tytul'] = $row['Tytul'];
       		$temp['Tresc'] = substr($row['Tresc'],0,200);
       		$temp['Dodal'] = $row['username'];
       		
       		$query2 = "SELECT COUNT(ID) FROM portal_news_komentarze WHERE NewsID = $id";
       		$row2 = mysql_fetch_row(query($query2));
       		$temp['kom'] = $row2[0];
       		
       		$news[] = $temp;
     	}
    	
    	return $news;
}

function get_total_news($lang)
{
  	$query = "SELECT COUNT(ID) FROM portal_news WHERE lang = '$lang';";
  	$res = query($query);
  	$row = mysql_fetch_row($res);
  	return $row[0];
}

function get_news($id, $page, $com_per_site)
{
  	$query = "SELECT portal_news.ID, portal_news.Data, Tytul, portal_news.Tresc, username
FROM portal_news, portal_users
WHERE portal_users.ID = portal_news.Dodal 
AND portal_news.ID=$id";
  	$res = query($query);
  	$row = mysql_fetch_assoc($res);
  		
	$news['ID'] = $row['ID'];
	$news['Data'] = $row['Data'];
	$news['Tytul'] = $row['Tytul'];
	$news['Tresc'] = $row['Tresc'];
	$news['Dodal'] = $row['username'];
	
	$query2 = "SELECT COUNT(ID) FROM portal_news_komentarze WHERE NewsID = $id";
	$row2 = mysql_fetch_row(query($query2));
	$liczba = $row2[0];
	//echo '$liczba: '.$liczba.'<br />';
	/*if($liczba < $page*$com_per_site) $min = $liczba-($liczba%$com_per_site)+1;
   	else */$min = ($page-1)*$com_per_site;
	
	$query2 = "SELECT portal_news_komentarze.ID, username, Tresc, Data FROM portal_news_komentarze, portal_users WHERE NewsID = $id AND portal_news_komentarze.UserID = portal_users.ID ORDER BY ID DESC LIMIT $min, $com_per_site";
	//echo $query2.'<br />min: '.$min.'<br />page: '.$page;
	$res = query($query2);
	$kom = array();
	while($row = mysql_fetch_assoc($res))
	{
	  	$temp = array();
   		$temp['ID'] = $row['ID'];
   		$temp['Dodal'] = $row['username'];
   		$temp['Tresc'] = $row['Tresc'];
   		$temp['Data'] = $row['Data'];
   
		$kom[] = $temp;
 	}
	$news['kom'] = $liczba;
	
  
  	//var_dump($news);
  	//var_dump($kom);
  	return array($news, $kom);
}

//get_news(1,1);

?>
